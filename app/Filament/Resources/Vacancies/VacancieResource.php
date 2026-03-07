<?php

namespace App\Filament\Resources\Vacancies;

use App\Filament\Resources\Vacancies\Pages\CreateVacancie;
use App\Filament\Resources\Vacancies\Pages\EditVacancie;
use App\Filament\Resources\Vacancies\Pages\ListVacancies;
use App\Filament\Resources\Vacancies\Schemas\VacancieForm;
use App\Filament\Resources\Vacancies\Tables\VacanciesTable;
use App\Models\Vacancie;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;


class VacancieResource extends Resource
{
    protected static ?string $model = \App\Models\vacancie::class;

    protected static ?string $navigationLabel = 'Lowongan';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Lowongan';

    protected static ?string $pluralModelLabel = 'Daftar Lowongan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $recordTitleAttribute = 'vacancie';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            'company_id' => Select::make('company_id')
            ->label('Perusahaan')
            ->relationship('company', 'companies_name')
            ->required()
            ->searchable()
            ->preload(),

            TextInput::make('vacancy_name')
            ->label('judul lowongan')
            ->required(),

            TextInput::make('location')
            ->label('lokasi')
            ->required(),

            DatePicker::make('deadline')
            ->label('batas akhir')
            ->required(),

            Select::make('loker_tipe')
            ->label('tipe loker')
            ->options(vacancie::LOKER_TYPES)
            ->required()
            ->live(),

            RichEditor::make('requirements')
            ->json()
            ->label('persyaratan')
            ->required()
            ->columnSpan('full')
            ->extraInputAttributes(['style' => 'min-height: 200px;']),

            TextInput::make('salary')
            ->label('gaji')
            ->numeric(),

            CheckboxList::make('major')
            ->label('jurusan')
            ->options(vacancie::MAJORS), 

            Select::make('employment_classification')
            ->label('tipe pekerjaan')
            ->options(vacancie::EMPLOYMENT_TYPES),

            TextInput::make('jobdesk')
            ->label('deskripsi / posisi pekerjaan'),

            TextInput::make('email_company')
            ->label('email perusahaan')
            ->visible(fn (Get $get) => $get('loker_tipe') === 'keperusahaan'),

            TextInput::make('phone_company')
            ->label('nomor telepon perusahaan')
            ->visible(fn (Get $get) => $get('loker_tipe') === 'keperusahaan'),

            TextInput::make('vacancy_number')
            ->label('kuota lowongan')
            ->numeric(), 

            FileUpload::make('image')
            ->label('gambar lowongan')
            ->disk('public')
            ->directory('vacancies')
            ->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('company.companies_name')->label('Perusahaan')->searchable(),
            Tables\Columns\TextColumn::make('vacancy_name')->label('Jabatan')->searchable(),
            Tables\Columns\TextColumn::make('location')->label('Lokasi')->searchable(),
            Tables\Columns\TextColumn::make('vacancy_number')->label('Kuota')->searchable(),
            Tables\Columns\TextColumn::make('deadline')->label('Batas waktu')->date()->sortable(),
        ])
        ->actions([
            EditAction::make()
                ->label('edit'),
            DeleteAction::make()
                ->label('Hapus'),
        ])->actionsColumnLabel('Aksi');
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

    
    
}

