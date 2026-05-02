<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MajorResource\Pages;
use App\Models\Major;
use Filament\Actions\Action;
use Filament\Schemas\Components\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MajorResource extends Resource
{
    protected static ?string $model = Major::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Kelola Jurusan';

    protected static ?string $modelLabel = 'Jurusan';

    protected static ?string $pluralModelLabel = 'Daftar Jurusan';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Data Jurusan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Jurusan')
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Generate Kelas Otomatis')
                    ->description('Gunakan fitur ini untuk membuat banyak kelas sekaligus secara otomatis.')
                    ->schema([
                        TextInput::make('class_count')
                            ->label('Jumlah Kelas')
                            ->numeric()
                            ->live(),
                        Select::make('class_format')
                            ->label('Format Penomoran')
                            ->options([
                                'numeric' => 'Angka (1, 2, 3)',
                                'alphabet' => 'Abjad (A, B, C)',
                            ])
                            ->default('numeric')
                            ->live(),
                        TextInput::make('class_prefix')
                            ->label('Prefix Kelas (Opsional)')
                            ->placeholder('Contoh: b/ atau RPL b/')
                            ->live(),
                        Actions::make([
                            Action::make('generate_classes')
                                ->label('Generate Kelas')
                                ->action(function (Get $get, Set $set) {
                                    $count = (int) $get('class_count');
                                    if ($count <= 0) return;

                                    $format = $get('class_format');
                                    $prefix = $get('class_prefix') ? $get('class_prefix') . ' ' : '';

                                    $classes = $get('studentClasses') ?? [];

                                    for ($i = 1; $i <= $count; $i++) {
                                        $suffix = $format === 'alphabet' ? chr(64 + $i) : $i;
                                        $classes[] = ['name' => trim($prefix . $suffix)];
                                    }

                                    $set('studentClasses', $classes);
                                    $set('class_count', null);
                                    $set('class_prefix', null);
                                })
                        ])
                    ])
                    ->collapsed()
                    ->collapsible(),

                Repeater::make('studentClasses')
                    ->relationship('studentClasses')
                    ->label('Daftar Kelas')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kelas')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->defaultItems(0)
                    ->addActionLabel('Tambah Kelas Manual')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Jurusan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make()->slideOver(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMajors::route('/'),
        ];
    }
}
