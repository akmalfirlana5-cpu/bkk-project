<?php

namespace App\Livewire\Profil;

use App\Models\ProfileSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Struktur Organisasi - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class OrganizationStructure extends Component
{
    public $organizationContent;

    public function mount() {
        // Ambil data organization settings
        $this->organizationContent = ProfileSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire..profil.organization-structure');
    }
}
