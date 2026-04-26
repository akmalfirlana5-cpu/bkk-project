<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TracerStudyLineChart extends ChartWidget
{
    protected ?string $heading = 'Tren Pengisian Tracer Study';
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 7;
    protected ?string $maxHeight = '225px';
    

    protected function getData(): array
    {
        $data = User::whereNotNull('status')
            ->select(DB::raw('MONTH(updated_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengisian',
                    'data' => array_values($data),
                    'borderColor' => '#3b82f6',
                    'fill' => false,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
        ];
    }
}