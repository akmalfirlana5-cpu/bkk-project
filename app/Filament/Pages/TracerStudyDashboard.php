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
