<?php

namespace App\Livewire\Profil;

use App\Models\ProfileSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Alur Kerja - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class ActivityFlow extends Component
{
    public $activityContent;

    public function mount() {
        // Ambil data activity settings
        $this->activityContent = ProfileSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire..profil.activity-flow');
    }
}
