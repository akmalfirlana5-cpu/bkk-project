<?php

namespace App\Livewire\Profil;

use App\Models\ProfileSetting;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Visi & Misi - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]

class VisiMisi extends Component
{
    public $visiContent;

    public function mount() {
        // Ambil data visi misi settings
        $this->visiContent = ProfileSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire..profil.visi-misi');
    }
}
