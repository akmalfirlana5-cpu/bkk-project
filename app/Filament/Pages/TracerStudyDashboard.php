<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\TracerStudyLineChart;
use App\Filament\Widgets\TracerStudyPieChart;
use App\Filament\Widgets\WorkFillsTableWidget;
use App\Filament\Widgets\CollegeFillsTableWidget;
use App\Filament\Widgets\EntrepreneurFillsTableWidget;

class TracerStudyDashboard extends Page
{
    protected static ?string $navigationLabel = 'Tracer Study';
    
    protected static ?string $title = 'Tracer Study';

    protected static ?int $navigationSort = 1;
    
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    
    
    protected function getHeaderWidgets(): array
    {
        return [
            TracerStudyLineChart::class,
            TracerStudyPieChart::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            WorkFillsTableWidget::class,
            CollegeFillsTableWidget::class,
            EntrepreneurFillsTableWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 12;
    }
}
