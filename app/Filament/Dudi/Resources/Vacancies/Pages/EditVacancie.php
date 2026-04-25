<?php

namespace App\Filament\Dudi\Resources\Vacancies\Pages;

use App\Filament\Dudi\Resources\Vacancies\VacancieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVacancie extends EditRecord
{
    protected static string $resource = VacancieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
