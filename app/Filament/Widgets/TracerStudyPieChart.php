<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;

class TracerStudyPieChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Status Alumni';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 5;
    protected ?string $maxHeight = '225px';
    

    protected function getData(): array
    {
        $bekerja = User::where('status', 'bekerja')->count();
        $kuliah = User::where('status', 'kuliah')->count();
        $wiraswasta = User::where('status', 'wiraswasta')->count();
        $menganggur = User::where('status', 'menganggur')->count();

        return [
            'datasets' => [
                [
                    'data' => [$bekerja, $kuliah, $wiraswasta, $menganggur],
                    'backgroundColor' => ['#22c55e', '#3b82f6', '#f59e0b', '#ef4444'],
                ],
            ],
            'labels' => ['Bekerja', 'Kuliah', 'Wiraswasta', 'belum bekerja'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
        ];
    }
}