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
use Filament\Forms\Components\RichEditor;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

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
            TextInput::make('companies_name')->required()->label('Nama'),
            FileUpload::make('companies_logo')->label('Logo')->disk('public')->directory('companies')->image(),
            RichEditor::make('companies_profile')->label('Profil Perusahaan')->columnSpan('full')->extraInputAttributes(['style' => 'min-height: 200px;']),
            TextInput::make('employee')->label('Jumlah Karyawan')->numeric(),
            FileUpload::make('mou')->label('MOU')->disk('public')->directory('companies'),
            TextInput::make('address')->label('Alamat Perusahaan'),
            TextInput::make('short_address')->label('Alamat Singkat Perusahaan'),
            
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('companies_name')->label('Nama')->searchable()->sortable(),
            Tables\Columns\ImageColumn::make('companies_logo')->label('Logo')->disk('public'),
            Tables\Columns\TextColumn::make('companies_profile')->label('Profil')->limit(50),
            Tables\Columns\TextColumn::make('short_address')->label('Kota / Provinsi')->searchable()->sortable(),  
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
