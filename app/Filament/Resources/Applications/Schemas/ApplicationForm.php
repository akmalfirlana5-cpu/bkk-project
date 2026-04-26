<?php

namespace App\Filament\Resources\Applications\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_vacancy')
                    ->required()
                    ->numeric(),
                TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(\App\Models\Application::STATUSES)
                    ->required(),
            ]);
    }
}
