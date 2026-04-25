<?php

namespace App\Filament\Dudi\Resources\Applications;

use App\Filament\Dudi\Resources\Applications\Pages\CreateApplication;
use App\Filament\Dudi\Resources\Applications\Pages\EditApplication;
use App\Filament\Dudi\Resources\Applications\Pages\ListApplications;
use App\Filament\Dudi\Resources\Applications\Schemas\ApplicationForm;
use App\Filament\Dudi\Resources\Applications\Tables\ApplicationsTable;
use App\Models\Application;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $navigationLabel = 'Daftar Lamaran';

    protected static ?string $modelLabel = 'Lamaran';

    protected static ?string $pluralModelLabel = 'Daftar Lamaran';

    public static function form(Schema $schema): Schema
    {
        return ApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApplicationsTable::configure($table);
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
            'index' => ListApplications::route('/'),
            'create' => CreateApplication::route('/create'),
            'edit' => EditApplication::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('id_company', auth()->user()->company_id);
    }
}
