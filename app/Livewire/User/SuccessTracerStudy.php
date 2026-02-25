<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Terima Kasih - Tracer Study')]
#[Layout('layouts.app')]
class SuccessTracerStudy extends Component
{
    public function render()
    {
        return view('livewire.user.success-tracer-study');
    }
}
