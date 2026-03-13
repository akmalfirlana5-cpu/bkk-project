<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Contacts;
use App\Filament\Resources\Contacts\ContactsResource;

class ContactsTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Masukan Terbaru';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 5;
    protected static ?string $maxHeight = '400px';

    public function table(Table $table): Table
    {
        return $table
            ->query(Contacts::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('firstname')
                    ->label('Nama')
                    ->formatStateUsing(fn ($record) => trim(($record->firstname ?? '') . ' ' . ($record->lastname ?? ''))),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(60)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y'),
            ])
            ->recordUrl(null)
            ->searchable(false)
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}
