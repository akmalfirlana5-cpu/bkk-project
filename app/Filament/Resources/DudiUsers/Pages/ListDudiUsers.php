<?php

namespace App\Filament\Resources\DudiUsers\Pages;

use App\Filament\Resources\DudiUsers\DudiUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDudiUsers extends ListRecords
{
    protected static string $resource = DudiUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
