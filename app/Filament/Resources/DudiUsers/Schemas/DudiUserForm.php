<?php

namespace App\Filament\Resources\DudiUsers\Schemas;

use Filament\Schemas\Schema;

class DudiUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('company_id')
                    ->relationship('company', 'companies_name')
                    ->label('Perusahaan (DUDI)')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nama Penanggung Jawab (PIC)')
                    ->required()
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                \Filament\Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state) => filled($state))
                    ->maxLength(255),
            ]);
    }
}
