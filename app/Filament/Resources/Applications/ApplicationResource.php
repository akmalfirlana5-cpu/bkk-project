<?php

namespace App\Filament\Resources\Applications;

use App\Filament\Resources\Applications\Pages\CreateApplication;
use App\Filament\Resources\Applications\Pages\EditApplication;
use App\Filament\Resources\Applications\Pages\ListApplications;
use App\Models\Application;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Illuminate\Support\Facades\App;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $navigationLabel = 'Lamaran';

    protected static ?string $modelLabel = 'Lamaran';

    protected static ?string $pluralModelLabel = 'Lamaran';

    protected static ?int $navigationSort = 5;
    
    public static function form(Schema $schema): Schema
    {
        return ApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Nama')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('vacancy.vacancy_name')
                    ->label('Jabatan')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('vacancy.company.companies_name')
                    ->label('Perusahaan')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(Application::STATUSES)
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->date()
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(Application::STATUSES),

                Tables\Filters\SelectFilter::make('id_vacancy')
                    ->label('Lowongan')
                    ->relationship('vacancy', 'vacancy_name')
                    ->searchable()
                    ->preload(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('hapus pilihan'),

                    BulkAction::make('updateStatus')
                        ->label('Ubah Status')
                        ->icon('heroicon-o-arrow-path')
                        ->form([
                            Select::make('status')
                                ->label('Status Baru')
                                ->options(Application::STATUSES)
                                ->required(),
                        ])
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records, array $data): void {
                            $records->each(function ($record) use ($data) {
                                $record->update(['status' => $data['status']]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('export')
                        ->label('Export Terpilih')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $firstApp = $records->first();
                            if (!$firstApp || !$firstApp->vacancy) {
                                return;
                            }

                            $service = new \App\Services\ApplicationExportService();
                            $zipPath = $service->exportToZip(
                                $records,
                                $firstApp->vacancy->vacancy_name ?? 'Lowongan',
                                $firstApp->vacancy->company->companies_name ?? 'Perusahaan'
                            );

                            return response()->download($zipPath)->deleteFileAfterSend(true);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Export Lamaran')
                        ->modalDescription('Download data kandidat terpilih beserta CV dan Sertifikat sebagai ZIP?')
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
            'index' => ListApplications::route('/'),
            'create' => CreateApplication::route('/create'),
            'edit' => EditApplication::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'vacancy.company']);
    }
}
