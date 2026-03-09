<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanieResource::class;

    protected static ?string $title = 'Daftar Perusahaan';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Perusahaan'),
        ];
    }
}
