<?php

namespace App\Livewire\Information;

use App\Models\SurveyCategory;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Title('Terima Kasih - Survey')]
#[Layout('layouts.app')]
class SuccessSurvey extends Component
{
    public $category;

    public function mount($slug)
    {
        $this->category = SurveyCategory::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.survey.success-survey');
    }
}
