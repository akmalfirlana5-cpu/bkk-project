<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Pages\CreateCompanie;
use App\Filament\Resources\Companies\Pages\EditCompanie;
use App\Filament\Resources\Companies\Pages\ListCompanies;
use App\Models\Companie;
use Filament\Tables;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class CompanieResource extends Resource
{
    protected static ?string $model = Companie::class;

    protected static ?string $navigationLabel = 'Perusahaan';

    protected static ?string $modelLabel = 'Perusahaan';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Daftar Perusahaan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'companie';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('companies_name')->required()->label('nama perusahaan'),
            FileUpload::make('companies_logo')->label('logo perusahaan')->disk('public')->directory('companies')->image(),
            Textarea::make('companies_profile')->label('profil perusahaan'),
            TextInput::make('field')->label('bidang perusahaan'),
            TextInput::make('employee')->label('jumlah karyawan')->numeric(),
            FileUpload::make('mou')->label('mou')->disk('public')->directory('companies'),
            TextInput::make('address')->label('alamat perusahaan'),
            TextInput::make('short_address')->label('alamat singkat perusahaan'),
            
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('companies_name')->label('nama perusahaan')->searchable()->sortable(),
            Tables\Columns\ImageColumn::make('companies_logo')->label('logo perusahaan')->disk('public'),
            Tables\Columns\TextColumn::make('companies_profile')->label('profil perusahaan')->limit(50),
            Tables\Columns\TextColumn::make('address')->label('alamat perusahaan')->searchable()->sortable(),  
        ])
        ->actions([
            EditAction::make()
                ->label('edit'),
            DeleteAction::make()
                ->label('Hapus'),
        ])->actionsColumnLabel('Aksi');;;
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompanie::route('/create'),
            'edit' => EditCompanie::route('/{record}/edit'),
        ];
    }
}
