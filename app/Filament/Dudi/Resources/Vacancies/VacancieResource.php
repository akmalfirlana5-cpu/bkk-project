<?php

namespace App\Filament\Dudi\Resources\Vacancies;

use App\Filament\Dudi\Resources\Vacancies\Pages\CreateVacancie;
use App\Filament\Dudi\Resources\Vacancies\Pages\EditVacancie;
use App\Filament\Dudi\Resources\Vacancies\Pages\ListVacancies;
use App\Filament\Dudi\Resources\Vacancies\Schemas\VacancieForm;
use App\Filament\Dudi\Resources\Vacancies\Tables\VacanciesTable;
use App\Models\Vacancie;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VacancieResource extends Resource
{
    protected static ?string $model = Vacancie::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'vacancy_name';

    protected static ?string $navigationLabel = 'Lowongan';

    protected static ?string $modelLabel = 'Lowongan';

    protected static ?string $pluralModelLabel = 'Daftar Lowongan';

    protected static ?int $navigationSort = 2;
    public static function form(Schema $schema): Schema
    {
        return VacancieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VacanciesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVacancies::route('/'),
            'create' => CreateVacancie::route('/create'),
            'edit' => EditVacancie::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('company_id', auth()->user()->company_id);
    }
}
