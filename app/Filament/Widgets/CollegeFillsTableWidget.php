<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\CollegeFill;

class CollegeFillsTableWidget extends BaseWidget
{
    protected static ?string $heading = '';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(CollegeFill::query()->with('user'))
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.nisn')
                    ->label('NISN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('university_name')
                    ->label('Universitas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('major')
                    ->label('Jurusan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }
}
