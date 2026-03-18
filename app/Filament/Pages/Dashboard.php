<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ContactsTableWidget;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TracerStudyLineChart;
use App\Filament\Widgets\TracerStudyPieChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.dashboard');
    }

    public function getColumns(): int|array
    {
        return 12;
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            TracerStudyLineChart::class,
            TracerStudyPieChart::class,
            ContactsTableWidget::class,
        ];
    }
}
