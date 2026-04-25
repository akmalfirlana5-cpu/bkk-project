<?php

namespace App\Filament\Dudi\Resources\Vacancies\Pages;

use App\Filament\Dudi\Resources\Vacancies\VacancieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVacancies extends ListRecords
{
    protected static string $resource = VacancieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
