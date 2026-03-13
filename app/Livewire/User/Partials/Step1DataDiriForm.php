<?php

namespace App\Livewire\User\Partials;

use Livewire\Component;

class Step1DataDiriForm extends Component
{
    public $full_name, $nisn, $nik, $no_hp, $major, $graduation_year, $address, $status;

    public function mount($userData)
    {
        // Isi data awal dari parent
        $this->fill($userData);
    }

    public function nextStep()
    {
        $validated = $this->validate([
            'full_name' => 'required|max:255',
            'nisn'      => 'required|max:20',
            'nik'       => 'required|min:16|max:16',
            'address'   => 'required',
            'no_hp'     => 'required|min:12',
            'major'     => 'required',
            'graduation_year' => 'required',
            'status'    => 'required',
        ]);

        // Kirim data ke parent dan suruh parent pindah ke step 2
        $this->dispatch('step1-completed', data: $this->all());
    }

    public function render()
    {
        return view('livewire.user.partials.step1-data-diri-form');
    }
}
