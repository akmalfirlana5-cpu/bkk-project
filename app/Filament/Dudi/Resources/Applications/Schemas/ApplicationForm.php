<?php

namespace App\Filament\Dudi\Resources\Applications\Schemas;

use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('status')
                    ->label('Status Lamaran')
                    ->options(\App\Models\Application::STATUSES)
                    ->required(),
            ]);
    }
}
