<?php

namespace App\Filament\Resources\Admins\Pages;

use App\Filament\Resources\Admins\AdminResource;
use App\Models\AdminPermission;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;

    protected static ?string $title = 'Edit Admin';

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $existingPermissions = AdminPermission::where('user_id', $this->record->id)
            ->pluck('permission')
            ->toArray();

        // Fill each grouped checkbox field with matching permissions
        foreach (AdminPermission::PERMISSION_GROUPS as $groupName => $options) {
            $fieldName = 'perm_'.\Illuminate\Support\Str::slug($groupName, '_');
            $data[$fieldName] = array_values(array_intersect($existingPermissions, array_keys($options)));
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $permissions = $this->collectPermissionsFromForm();

        // Sync permissions: delete old, insert new
        AdminPermission::where('user_id', $this->record->id)->delete();

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

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
