<?php

namespace App\Filament\Resources\Admins\Pages;

use App\Filament\Resources\Admins\AdminResource;
use App\Models\AdminPermission;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    protected static ?string $title = 'Tambah Admin Baru';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'admin';

        return $data;
    }

    protected function afterCreate(): void
    {
        $permissions = $this->collectPermissionsFromForm();

        foreach ($permissions as $permission) {
            AdminPermission::create([
                'user_id' => $this->record->id,
                'permission' => $permission,
            ]);
        }
    }

    protected function collectPermissionsFromForm(): array
    {
        $permissions = array_merge(
            $this->data['perm_umum'] ?? [],
            $this->data['perm_survey_kepuasan'] ?? [],
            $this->data['perm_pengaturan_halaman'] ?? [],
        );

        return array_unique($permissions);
    }
}
