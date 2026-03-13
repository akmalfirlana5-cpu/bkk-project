<?php

namespace App\Livewire\Profil;

use App\Models\ProfileSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Program Kerja - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class WorkProgram extends Component
{
    public $workContent;

    public function mount() {
        // Ambil data work settings
        $this->workContent = ProfileSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire..profil.work-program');
    }
}
