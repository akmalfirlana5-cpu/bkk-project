<?php

namespace App\Filament\Dudi\Resources\Applications\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class ApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Nama Pelamar')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('vacancy.vacancy_name')
                    ->label('Lowongan')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'belum_diproses',
                        'warning' => 'lolos_berkas',
                        'info' => 'interview',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ]),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
