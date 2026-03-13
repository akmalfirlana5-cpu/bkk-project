<?php

namespace App\Livewire\Profil;

use App\Models\ProfileSetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dokumen Pendukung - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class SupportingDocuments extends Component
{
    public $supportingContent;
    public $supportingItems;

    public function mount() {
        // Ambil data supporting settings
        $this->supportingContent = ProfileSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
        // json decode field json
        if (isset($this->supportingContent['dokumen_pendukung']['items'])) {
            $rawSlides = json_decode($this->supportingContent['dokumen_pendukung']['items'], true);

            $this->supportingItems = collect($rawSlides)
            ->map(function ($item) {
                return $item;
            })->values()->all();
        }
    }
    public function render()
    {
        return view('livewire..profil.supporting-documents');
    }
}
