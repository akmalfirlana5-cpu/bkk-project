<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\WorkFillsTableWidget;
use App\Filament\Widgets\CollegeFillsTableWidget;
use App\Filament\Widgets\EntrepreneurFillsTableWidget;
use App\Filament\Widgets\UnemployedFillsTableWidget;
use App\Filament\Widgets\TracerStudyAllTableWidget;
use App\Models\WorkFill;
use App\Models\CollegeFill;
use App\Models\EntrepreneurFill;
use App\Models\UnemployedFill;
use Livewire\Attributes\Url;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use App\Exports\TracerStudyExport;

class TracerStudyDashboard extends Page
{
    protected static ?string $navigationLabel = 'Tracer Study';

    protected static ?string $title = 'Tracer Study';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.pages.tracer-study-dashboard';

    #[Url]
    public string $activeTab = 'semua';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportExcel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary')
                ->form([
                    Select::make('category')
                        ->label('Pilih Kategori Laporan')
                        ->options([
                            'semua' => 'Semua Kategori (Multi-sheet)',
                            'bekerja' => 'Bekerja Saja',
                            'kuliah' => 'Kuliah Saja',
                            'wirausaha' => 'Wirausaha Saja',
                            'belum_bekerja' => 'Belum Bekerja Saja',
                        ])
                        ->default('semua')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $type = $data['category'];
                    $fileName = 'Tracer_Study_' . ucfirst($type) . '_' . date('Y-m-d_H-i-s') . '.xlsx';
                    
                    return \Maatwebsite\Excel\Facades\Excel::download(
                        new TracerStudyExport($type),
                        $fileName
                    );
                }),
        ];
    }

    public function getTabCounts(): array
    {
        $bekerja = WorkFill::count();
        $kuliah = CollegeFill::count();
        $wirausaha = EntrepreneurFill::count();
        $belum = UnemployedFill::count();

        return [
            'semua' => $bekerja + $kuliah + $wirausaha + $belum,
            'bekerja' => $bekerja,
            'kuliah' => $kuliah,
            'wirausaha' => $wirausaha,
            'belum_bekerja' => $belum,
        ];
    }

    public function getActiveTableWidget(): string
    {
        return match ($this->activeTab) {
            'bekerja' => WorkFillsTableWidget::class,
            'kuliah' => CollegeFillsTableWidget::class,
            'wirausaha' => EntrepreneurFillsTableWidget::class,
            'belum_bekerja' => UnemployedFillsTableWidget::class,
            default => TracerStudyAllTableWidget::class,
        };
    }
}
