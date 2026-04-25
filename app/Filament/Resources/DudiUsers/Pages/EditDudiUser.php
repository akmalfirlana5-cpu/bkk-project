<?php

namespace App\Filament\Resources\DudiUsers\Pages;

use App\Filament\Resources\DudiUsers\DudiUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDudiUser extends EditRecord
{
    protected static string $resource = DudiUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
