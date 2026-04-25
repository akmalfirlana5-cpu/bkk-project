<?php

namespace App\Filament\Dudi\Widgets;

use Filament\Widgets\ChartWidget;

class DudiVacancyChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Lowongan & Lamaran';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $companyId = auth()->user()->company_id;
        
        // Sum of kuota lowongan per month (based on created_at of vacancy)
        $kuotaData = \App\Models\Vacancie::where('company_id', $companyId)
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, SUM(vacancy_number) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Lamaran Masuk per month
        $masukData = \App\Models\Application::where('id_company', $companyId)
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Lamaran Terima per month
        $terimaData = \App\Models\Application::where('id_company', $companyId)
            ->where('status', 'diterima')
            ->whereYear('created_at', date('Y'))
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Prepare arrays for 12 months
        $kuota = [];
        $masuk = [];
        $terima = [];

        for ($i = 1; $i <= 12; $i++) {
            $kuota[] = $kuotaData[$i] ?? 0;
            $masuk[] = $masukData[$i] ?? 0;
            $terima[] = $terimaData[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Kuota Lowongan',
                    'data' => $kuota,
                    'borderColor' => '#3b82f6', // blue
                    'fill' => false,
                ],
                [
                    'label' => 'Lamaran Masuk',
                    'data' => $masuk,
                    'borderColor' => '#10b981', // emerald
                    'fill' => false,
                ],
                [
                    'label' => 'Lamaran Diterima',
                    'data' => $terima,
                    'borderColor' => '#f59e0b', // amber
                    'fill' => false,
                ]
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
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
