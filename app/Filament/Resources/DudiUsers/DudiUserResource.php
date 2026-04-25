<?php

namespace App\Filament\Resources\DudiUsers;

use App\Filament\Resources\DudiUsers\Pages\CreateDudiUser;
use App\Filament\Resources\DudiUsers\Pages\EditDudiUser;
use App\Filament\Resources\DudiUsers\Pages\ListDudiUsers;
use App\Filament\Resources\DudiUsers\Schemas\DudiUserForm;
use App\Filament\Resources\DudiUsers\Tables\DudiUsersTable;
use App\Models\DudiUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DudiUserResource extends Resource
{
    protected static ?string $model = DudiUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DudiUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DudiUsersTable::configure($table);
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
            'index' => ListDudiUsers::route('/'),
            'create' => CreateDudiUser::route('/create'),
            'edit' => EditDudiUser::route('/{record}/edit'),
        ];
    }
}
