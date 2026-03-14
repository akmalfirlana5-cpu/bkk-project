<?php

namespace App\Filament\Widgets;

use App\Models\WorkFill;
use App\Models\CollegeFill;
use App\Models\EntrepreneurFill;
use App\Models\UnemployedFill;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TracerStudyAllTableWidget extends BaseWidget
{
    protected static ?string $heading = '';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $work = DB::table('work_fills')
            ->select(
                'id_user',
                DB::raw("'Bekerja' as status_label"),
                'company_name as detail_label',
                'created_at as filled_at'
            );

        $college = DB::table('college_fills')
            ->select(
                'id_user',
                DB::raw("'Kuliah' as status_label"),
                'university_name as detail_label',
                'created_at as filled_at'
            );

        $entrepreneur = DB::table('entrepeneur_fills')
            ->select(
                'id_user',
                DB::raw("'Wirausaha' as status_label"),
                'company_name as detail_label',
                'created_at as filled_at'
            );

        $unemployed = DB::table('unemployed_fills')
            ->select(
                'id_user',
                DB::raw("'Belum Bekerja' as status_label"),
                'reason as detail_label',
                'created_at as filled_at'
            );

        $unionQuery = $work->union($college)->union($entrepreneur)->union($unemployed);

        $query = \App\Models\User::query()
            ->joinSub($unionQuery, 'combined_fills', function ($join) {
                $join->on('users.id', '=', 'combined_fills.id_user');
            })
            ->select('users.*', 'combined_fills.status_label', 'combined_fills.detail_label', 'combined_fills.filled_at');

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_label')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Bekerja' => 'success',
                        'Kuliah' => 'info',
                        'Wirausaha' => 'warning',
                        'Belum Bekerja' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('detail_label')
                    ->label('Keterangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('filled_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->recordUrl(null)
            ->defaultSort('filled_at', 'desc');
    }
}
