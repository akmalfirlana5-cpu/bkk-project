<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\TracerStudyLineChart;
use App\Filament\Widgets\TracerStudyPieChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\ContactsTableWidget;

class Dashboard extends BaseDashboard
{
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
