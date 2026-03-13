<?php

namespace App\Filament\Resources\SurveyResponses;

use App\Filament\Resources\SurveyResponses\Pages\ListSurveyResponses;
use App\Filament\Resources\SurveyResponses\Pages\ViewSurveyResponse;
use App\Models\SurveyResponse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;

    protected static ?string $navigationLabel = 'Hasil Survey';
    protected static ?string $modelLabel = 'Hasil Survey';
    protected static ?string $pluralModelLabel = 'Hasil Survey';
    protected static ?int $navigationSort = 9;
    protected static string | \UnitEnum | null $navigationGroup = 'Survey Kepuasan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('No HP'),
                Tables\Columns\TextColumn::make('identity_data')
                    ->label('Nama')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return $state['nama_lengkap']
                                ?? $state['nama_perusahaan']
                                ?? '-';
                        }
                        return '-';
                    }),
                Tables\Columns\TextColumn::make('answers_count')
                    ->label('Jawaban')
                    ->counts('answers'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ViewAction::make()->label('Lihat'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->actionsColumnLabel('Aksi')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus Pilihan'),

                    BulkAction::make('export')
                        ->label('Export Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            $firstRecord = $records->first();
                            if (!$firstRecord) {
                                return;
                            }

                            $export = new \App\Exports\SurveyResponsesExport($records);
                            $fileName = 'Survey_' . str()->slug($firstRecord->category->name ?? 'survey') . '_' . now()->format('Ymd') . '.xlsx';

                            return $export->download($fileName);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Export Survey')
                        ->modalDescription('Download data survey terpilih sebagai file Excel?')
                        ->deselectRecordsAfterCompletion(),
                ])->label('Aksi'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyResponses::route('/'),
            'view' => ViewSurveyResponse::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->with(['category', 'answers.question']);
    }
}
