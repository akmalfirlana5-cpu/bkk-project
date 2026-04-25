<?php

namespace App\Filament\Dudi\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DudiStatsOverview extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $companyId = auth()->user()->company_id;

        $totalLowongan = \App\Models\Vacancie::where('company_id', $companyId)
            ->where('deadline', '>', now())
            ->where(function ($query) {
                $query->whereNull('vacancy_number')
                      ->orWhereRaw('vacancy_number > (SELECT COUNT(*) FROM applications WHERE id_vacancy = vacancies.id AND status = "diterima")');
            })
            ->count();

        $totalLamaran = \App\Models\Application::where('id_company', $companyId)->count();

        return [
            Stat::make('Total Lowongan Aktif', $totalLowongan)
                ->description('Lowongan yang belum terpenuhi')
                ->icon('heroicon-m-briefcase')
                ->view('filament.widgets.custom-stat')
                ->extraAttributes([
                    'iconColor' => 'text-emerald-600 dark:text-emerald-400',
                    'iconBg' => 'bg-emerald-200/80 dark:bg-emerald-500/20',
                ]),
            Stat::make('Total Lamaran Masuk', $totalLamaran)
                ->description('Semua lamaran yang masuk')
                ->icon('heroicon-m-document-text')
                ->view('filament.widgets.custom-stat')
                ->extraAttributes([
                    'iconColor' => 'text-blue-600 dark:text-blue-400',
                    'iconBg' => 'bg-blue-200/80 dark:bg-blue-500/20',
                ]),
        ];
    }
}
