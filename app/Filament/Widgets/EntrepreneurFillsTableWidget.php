<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\EntrepreneurFill;

class EntrepreneurFillsTableWidget extends BaseWidget
{
    protected static ?string $heading = '';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(EntrepreneurFill::query()->with('user'))
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.nisn')
                    ->label('NISN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Nama Usaha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('field')
                    ->label('Bidang'),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi'),
                Tables\Columns\TextColumn::make('major_relevance')
                    ->label('Kesesuaian Jurusan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sesuai' => 'success',
                        'tidak sesuai' => 'danger',
                        'mungkin' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc');
    }
}
