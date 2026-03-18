<?php

namespace App\Filament\Resources\Admins\Pages;

use App\Filament\Resources\Admins\AdminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdmins extends ListRecords
{
    protected static string $resource = AdminResource::class;

    protected static ?string $title = 'Daftar Admin';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Admin Baru'),
        ];
    }
}
