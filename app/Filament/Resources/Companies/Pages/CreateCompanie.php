<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanieResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanie extends CreateRecord
{
    protected static string $resource = CompanieResource::class;

    protected static ?string $title = 'Tambah Perusahaan';
}
