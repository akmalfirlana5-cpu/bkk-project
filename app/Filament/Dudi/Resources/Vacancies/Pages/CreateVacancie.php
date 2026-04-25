<?php

namespace App\Filament\Dudi\Resources\Vacancies\Pages;

use App\Filament\Dudi\Resources\Vacancies\VacancieResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVacancie extends CreateRecord
{
    protected static string $resource = VacancieResource::class;

    protected static ?string $title = "Buat Lowongan";
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['company_id'] = auth()->user()->company_id;
        return $data;
    }
}
