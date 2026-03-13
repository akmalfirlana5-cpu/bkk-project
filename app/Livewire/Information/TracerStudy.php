<?php

namespace App\Livewire\Information;

use App\Models\InfoSetting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tracer Study - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class TracerStudy extends Component
{
    public $tracerContent;
    public $pieData;
    public $barLabels;
    public $barDatasets;

    public function mount() {
        // Ambil data tracer study settings
        $this->tracerContent = InfoSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
        
        // Ambil data status alumni di seluruh waktu
        $allTimeStats = User::where('role', 'user')
            ->whereNotNull('status')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        $this->pieData = [
            $allTimeStats['bekerja'] ?? 0,
            $allTimeStats['kuliah'] ?? 0,
            $allTimeStats['wiraswasta'] ?? 0,
            $allTimeStats['menganggur'] ?? 0,
        ];

        $this->barLabels = User::whereNotNull('graduation_year')
            ->distinct()
            ->orderBy('graduation_year', 'asc')
            ->take(5)
            ->pluck('graduation_year')
            ->toArray();
        
        $statuses = ['bekerja', 'kuliah', 'wiraswasta', 'menganggur'];
        $this->barDatasets = [];

        foreach ($statuses as $status) {
            $counts = [];

            foreach ($this->barLabels as $year) {
                $counts[] = User::where('graduation_year', $year)
                ->where('status', $status)
                ->count();
            }

             $this->barDatasets[] = [
            'label' => ucfirst($status),
            'data' => $counts,
            'borderRadius' => 6
        ];
        }
    }
    public function render()
    {
        return view('livewire..information.tracer-study');
    }
}
