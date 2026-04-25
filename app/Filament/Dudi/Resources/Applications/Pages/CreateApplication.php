<?php

namespace App\Filament\Dudi\Resources\Applications\Pages;

use App\Filament\Dudi\Resources\Applications\ApplicationResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;


class CreateApplication extends CreateRecord
{
    protected static string $resource = ApplicationResource::class;
}
