<?php

namespace App\Filament\Dudi\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class DudiDashboard extends BaseDashboard
{
    public function getColumns(): int|array
    {
        return 12;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Dudi\Widgets\DudiStatsOverview::class,
            \App\Filament\Dudi\Widgets\DudiVacancyChart::class,
        ];
    }
}
