<?php

namespace App\Filament\Widgets;
use App\Models\User;
use App\Models\Vacancie;
use App\Models\Application;
use App\Models\Contacts;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tracer Study', User::whereNotNull('status')->count())
            ->description('Pengisi Tracer Study')
            ->icon('heroicon-m-users')
            ->view('filament.widgets.custom-stat')
            ->extraAttributes([
                'iconColor' => 'text-indigo-600 dark:text-indigo-400',
                'iconBg' => 'bg-indigo-200/80 dark:bg-indigo-500/20',
            ]),
            Stat::make('Total lowongan', Vacancie::where('deadline', '>', now())->count())
            ->description('Lowongan tersedia')
            ->icon('heroicon-m-briefcase')
            ->view('filament.widgets.custom-stat')
            ->extraAttributes([
                'iconColor' => 'text-emerald-600 dark:text-emerald-400',
                'iconBg' => 'bg-emerald-200/80 dark:bg-emerald-500/20',
            ]),
            Stat::make('Total lamaran', Application::where('status', 'belum_diproses')->count())
            ->description('Lamaran yang masuk')
            ->icon('heroicon-m-document-text')
            ->view('filament.widgets.custom-stat')
            ->extraAttributes([
                'iconColor' => 'text-blue-600 dark:text-blue-400',
                'iconBg' => 'bg-blue-200/80 dark:bg-blue-500/20',
            ]),
            Stat::make('Total masukan', Contacts::where('created_at', '>=', now()->subDays(30))->count())
            ->description('Masukan bulan ini')
            ->icon('heroicon-m-chat-bubble-left-right')
            ->view('filament.widgets.custom-stat')
            ->extraAttributes([
                'iconColor' => 'text-yellow-500 dark:text-yellow-300',
                'iconBg' => 'bg-yellow-200/80 dark:bg-yellow-500/20',
            ]),
            
        ];
    }
}
