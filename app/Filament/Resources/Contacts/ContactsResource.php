<?php

namespace App\Filament\Resources\Contacts;

use App\Filament\Resources\Contacts\Pages\CreateContacts;
use App\Filament\Resources\Contacts\Pages\EditContacts;
use App\Filament\Resources\Contacts\Pages\ViewContacts;
use App\Filament\Resources\Contacts\Pages\ListContacts;
use App\Filament\Resources\Contacts\Schemas\ContactsForm;
use App\Models\Contacts;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;



use function Laravel\Prompts\table;

class ContactsResource extends Resource
{
    protected static ?string $model = Contacts::class;

    protected static ?string $navigationLabel = 'Masukan';

    protected static ?string $modelLabel = '=Masukan';

    protected static ?int $navigationSort = 7;

    protected static ?string $pluralModelLabel = 'daftar masukan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxStack;

    protected static ?string $recordTitleAttribute = 'contact';

    public static function form(Schema $schema): Schema
    {
        return ContactsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([

        Split::make([
             TextColumn::make('firstname')->label('Nama')->searchable()->sortable(),
            Stack::make([
                TextColumn::make('email')->label('Email')
                ->icon('heroicon-m-envelope')->searchable()->sortable(),
                TextColumn::make('message')->label('Pesan')->limit(50),
                        ]) 
            ]),
        ])
        ->actions([
            ViewAction::make()
                ->label('Lihat'),
            DeleteAction::make()
                ->label('Hapus'),
        ])
        ->actionsColumnLabel('Aksi')
        ->actionsAlignment('end');
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
            'index' => ListContacts::route('/'),
            'create' => CreateContacts::route('/create'),
            'view' => ViewContacts::route('/{record}'),
            'edit' => EditContacts::route('/{record}/edit'),
        ];
    }
}
