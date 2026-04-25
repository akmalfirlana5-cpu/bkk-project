<?php

namespace App\Filament\Pages;

use App\Exports\TracerStudyExport;
use App\Filament\Widgets\CollegeFillsTableWidget;
use App\Filament\Widgets\EntrepreneurFillsTableWidget;
use App\Filament\Widgets\TracerStudyAllTableWidget;
use App\Filament\Widgets\UnemployedFillsTableWidget;
use App\Filament\Widgets\WorkFillsTableWidget;
use App\Models\CollegeFill;
use App\Models\EntrepreneurFill;
use App\Models\UnemployedFill;
use App\Models\WorkFill;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Url;

class TracerStudyDashboard extends Page
{
    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.tracer_study');
    }

    protected static ?string $navigationLabel = 'Tracer Study';

    protected static ?string $title = 'Tracer Study';

    protected static ?int $navigationSort = 1;

    protected static string|\UnitEnum|null $navigationGroup = 'Survey & Tracer Study';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartPie;

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
                    $fileName = 'Tracer_Study_'.ucfirst($type).'_'.date('Y-m-d_H-i-s').'.xlsx';

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
