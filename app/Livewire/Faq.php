<?php

namespace App\Livewire;

use App\Models\FaqSetting;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Faq - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class Faq extends Component
{
    public $faqContent;
    public $faqItems;

    public function mount() 
    {
        // Ambil data faq settings
        $this->faqContent = FaqSetting::all()
            ->groupBy('key')
            ->map(function ($items) {
               return $items->pluck('value');
            })
            ->toArray();
        // json decode field json
        if (isset($this->faqContent['items'][0])) {
            $rawData = json_decode($this->faqContent['items'][0], true);

            $this->faqItems = collect($rawData)
            ->map(function ($item) {
                $data = $item['data'];

                return $data;
            })->values()->all();
        }

    }

    public function render()
    {
        return view('livewire.faq');
    }
}
