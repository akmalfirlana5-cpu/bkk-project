<?php

namespace App\Filament\Resources\SurveyQuestions;

use App\Filament\Resources\SurveyQuestions\Pages\ListSurveyQuestions;
use App\Filament\Resources\SurveyQuestions\Pages\CreateSurveyQuestion;
use App\Filament\Resources\SurveyQuestions\Pages\EditSurveyQuestion;
use App\Models\SurveyCategory;
use App\Models\SurveyQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class SurveyQuestionResource extends Resource
{
    protected static ?string $model = SurveyQuestion::class;

    protected static ?string $navigationLabel = 'Soal Survey';
    protected static ?string $modelLabel = 'Soal Survey';
    protected static ?string $pluralModelLabel = 'Soal Survey';
    protected static ?int $navigationSort = 8;
    protected static string | \UnitEnum | null $navigationGroup = 'Survey Kepuasan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('category_id')
                ->label('Kategori Survey')
                ->relationship('category', 'name')
                ->required()
                ->searchable()
                ->preload(),

            Textarea::make('question_text')
                ->label('Teks Soal')
                ->required()
                ->columnSpan('full'),

            Select::make('field_type')
                ->label('Tipe Field')
                ->options([
                    'dropdown' => 'Dropdown (Pilihan)',
                    'textarea' => 'Textarea (Isian Panjang)',
                ])
                ->required()
                ->live(),

            TagsInput::make('options')
                ->label('Opsi Jawaban')
                ->placeholder('Ketik atau pilih opsi jawaban')
                ->helperText('Ketik lalu Enter, atau pilih dari saran yang muncul saat diklik')
                ->suggestions(function () {
                    $defaultOptions = [
                        'Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Kurang',
                        'Sangat Setuju', 'Setuju', 'Kurang Setuju', 'Tidak Setuju',
                        'Ya', 'Tidak', 'Sering', 'Kadang-kadang', 'Jarang', 'Tidak Pernah'
                    ];

                    $existing = \App\Models\SurveyQuestion::pluck('options')
                        ->flatten()
                        ->filter()
                        ->unique()
                        ->toArray();

                    return array_values(array_unique(array_merge($defaultOptions, $existing)));
                })
                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('field_type') === 'dropdown'),

            TextInput::make('sort_order')
                ->label('Urutan')
                ->numeric()
                ->default(0),

            Toggle::make('is_required')
                ->label('Wajib Diisi')
                ->default(true),

            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->label('Soal')
                    ->limit(60),
                Tables\Columns\TextColumn::make('field_type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => $state === 'dropdown' ? 'Pilihan' : 'Isian'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->defaultSort('category_id')
            ->actions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->actionsColumnLabel('Aksi');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyQuestions::route('/'),
            'create' => CreateSurveyQuestion::route('/create'),
            'edit' => EditSurveyQuestion::route('/{record}/edit'),
        ];
    }
}
