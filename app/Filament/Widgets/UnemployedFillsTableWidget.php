<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\UnemployedFill;

class UnemployedFillsTableWidget extends BaseWidget
{
    protected static ?string $heading = '';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 6;

    public function table(Table $table): Table
    {
        return $table
            ->query(UnemployedFill::query()->with('user'))
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.nisn')
                    ->label('NISN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Alasan'),
                Tables\Columns\TextColumn::make('activity')
                    ->label('Aktivitas Saat Ini'),
                Tables\Columns\TextColumn::make('timespan')
                    ->label('Rentang Waktu'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }
}
