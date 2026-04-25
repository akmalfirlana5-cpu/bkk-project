<?php

namespace App\Filament\Resources\SurveyResponses;

use App\Filament\Resources\SurveyResponses\Pages\ListSurveyResponses;
use App\Filament\Resources\SurveyResponses\Pages\ViewSurveyResponse;
use App\Models\SurveyResponse;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('resource.survey_responses');
    }

    protected static ?string $navigationLabel = 'Hasil Survey';

    protected static ?string $modelLabel = 'Hasil Survey';

    protected static ?string $pluralModelLabel = 'Hasil Survey';

    protected static ?int $navigationSort = 9;

    protected static string|\UnitEnum|null $navigationGroup = 'Survey & Tracer Study';

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
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->getStateUsing(function ($record) {
                        return $record->identity_data['nama_lengkap']
                            ?? $record->identity_data['nama_perusahaan']
                            ?? '-';
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
                            if (! $firstRecord) {
                                return;
                            }

                            $export = new \App\Exports\SurveyResponsesExport($records);

                            $categoryIds = $records->pluck('category_id')->unique();
                            $namePart = $categoryIds->count() > 1
                                ? 'Multi_Kategori'
                                : str()->slug($firstRecord->category->name ?? 'survey');

                            $fileName = 'Survey_'.$namePart.'_'.now()->format('Ymd').'.xlsx';

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
