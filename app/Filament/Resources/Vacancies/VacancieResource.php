<?php

namespace App\Filament\Resources\Vacancies;

use App\Filament\Resources\Vacancies\Pages\CreateVacancie;
use App\Filament\Resources\Vacancies\Pages\EditVacancie;
use App\Filament\Resources\Vacancies\Pages\ListVacancies;
use App\Filament\Resources\Vacancies\Pages\ListVacancyApplications;
use App\Models\Vacancie;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class VacancieResource extends Resource
{
    protected static ?string $model = \App\Models\Vacancie::class;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('resource.vacancies');
    }

    protected static ?string $navigationLabel = 'Lowongan';

    protected static ?int $navigationSort = 4;

    protected static string|\UnitEnum|null $navigationGroup = 'Lowongan & Lamaran';

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
                ->options(Vacancie::LOKER_TYPES)
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
                ->options(Vacancie::MAJORS),

            Select::make('employment_classification')
                ->label('tipe pekerjaan')
                ->options(Vacancie::EMPLOYMENT_TYPES),

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
            Tables\Columns\TextColumn::make('vacancy_number')->label('Kuota')->searchable(),
            Tables\Columns\TextColumn::make('deadline')->label('Batas waktu')->date()->sortable()
                ->color(fn ($record) => $record->deadline && $record->deadline->isPast() ? 'danger' : null),
        ])
            ->modifyQueryUsing(fn ($query) => $query->orderByRaw('CASE WHEN deadline < NOW() THEN 1 ELSE 0 END ASC, deadline DESC'))
            ->actions([
                \Filament\Actions\Action::make('lihatLamaran')
                    ->label('Lihat Lamaran')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->url(fn ($record) => static::getUrl('applications', ['record' => $record])),
                EditAction::make()
                    ->label('edit'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])->actionsColumnLabel('Aksi')
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('deleteSelected')
                        ->label('Hapus Pilihan')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function (Collection $records) {
                            $records->each->delete();
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('extendDeadline')
                        ->label('Perpanjang Batas Waktu')
                        ->icon('heroicon-o-calendar')
                        ->color('primary')
                        ->form([
                            DatePicker::make('new_deadline')
                                ->label('Atur Batas Waktu Baru')
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $newDeadline = $data['new_deadline'];
                            $records->each(function ($record) use ($newDeadline) {
                                $record->update(['deadline' => $newDeadline]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('changenumber')
                        ->label('Ubah Kuota')
                        ->icon('heroicon-o-user-group')
                        ->color('secondary')
                        ->form([
                            TextInput::make('new_vacancy_number')
                                ->label('Atur Kuota Baru')
                                ->numeric()
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $newNumber = $data['new_vacancy_number'];
                            $records->each(function ($record) use ($newNumber) {
                                $record->update(['vacancy_number' => $newNumber]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),
                ])->label('Aksi'),
            ]);
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
            'applications' => ListVacancyApplications::route('/{record}/applications'),
        ];
    }
}
