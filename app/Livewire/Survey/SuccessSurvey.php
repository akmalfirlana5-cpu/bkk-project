<?php

namespace App\Livewire\Survey;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Terima Kasih - Survey Kepuasan')]
#[Layout('layouts.app')]
class SuccessSurvey extends Component
{
    public function render()
    {
        return view('livewire..survey.success-survey');
    }
}
