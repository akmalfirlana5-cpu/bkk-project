<?php

namespace App\Filament\Dudi\Resources\Vacancies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class VacanciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('vacancy_name')
                    ->label('Jabatan')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('vacancy_number')
                    ->label('Kuota')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('deadline')
                    ->label('Batas Waktu')
                    ->date()
                    ->sortable()
                    ->color(fn ($record) => $record->deadline && $record->deadline->isPast() ? 'danger' : null),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('lihatLamaran')
                    ->label('Lihat Lamaran')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->url(fn ($record) => \App\Filament\Dudi\Resources\Vacancies\VacancieResource::getUrl('applications', ['record' => $record])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
