<?php

namespace App\Filament\Dudi\Resources\Vacancies\Schemas;

use Filament\Schemas\Schema;

class VacancieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('vacancy_name')
                    ->label('judul lowongan')
                    ->required(),
                \Filament\Forms\Components\TextInput::make('location')
                    ->label('lokasi')
                    ->required(),
                \Filament\Forms\Components\DatePicker::make('deadline')
                    ->label('batas akhir')
                    ->required(),
                \Filament\Forms\Components\Select::make('loker_tipe')
                    ->label('tipe loker')
                    ->options(\App\Models\Vacancie::LOKER_TYPES)
                    ->required()
                    ->live(),
                \Filament\Forms\Components\RichEditor::make('requirements')
                    ->label('persyaratan')
                    ->required()
                    ->columnSpan('full'),
                \Filament\Forms\Components\TextInput::make('salary')
                    ->label('gaji')
                    ->numeric(),
                \Filament\Forms\Components\CheckboxList::make('major')
                    ->label('jurusan')
                    ->options(fn () => \App\Models\Vacancie::getMajorOptions()),
                \Filament\Forms\Components\Select::make('employment_classification')
                    ->label('tipe pekerjaan')
                    ->options(\App\Models\Vacancie::EMPLOYMENT_TYPES),
                \Filament\Forms\Components\TextInput::make('jobdesk')
                    ->label('deskripsi / posisi pekerjaan'),
                \Filament\Forms\Components\TextInput::make('vacancy_number')
                    ->label('kuota lowongan')
                    ->numeric(),
                \Filament\Forms\Components\FileUpload::make('image')
                    ->label('gambar lowongan')
                    ->disk('public')
                    ->directory('vacancies')
                    ->image(),
            ]);
    }
}
