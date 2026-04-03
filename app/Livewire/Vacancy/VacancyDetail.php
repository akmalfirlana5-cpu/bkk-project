<?php

namespace App\Livewire\Vacancy;

use App\Models\User;
use Livewire\Component;
use App\Models\vacancie;
use App\Models\Application;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Detail Lowongan - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class VacancyDetail extends Component
{
    public $vacancyId;
    public $vacancy;
    public $otherVacancies;
    public $alredyApplied = false;

    public function mount($id)
    {
        $this->vacancyId = $id;
        $this->vacancy = vacancie::with('company')
        ->where('entryId', $this->vacancyId)
        ->firstOrFail();

        $this->otherVacancies = vacancie::where('entryId', '!=', $this->vacancyId)
        ->where('deadline', '>=', now())
        ->where('quota_status', 'open')
        ->where( function ($q) {
            foreach ($this->vacancy->major as $major) {
                $q->orWhereJsonContains('major', $major);
            }
        })
        ->inRandomOrder()
        ->take(2)
        ->get();

        if (auth()->check()) {
            $this->checkApplication();
        }
    }

    public function checkApplication() {
        $this->alredyApplied = Application::where('id_user', Auth::id())
        ->where('id_vacancy', $this->vacancy->id)
        ->exists();
    }

    public function applyNow() {

        if (!auth()->check()) {
            $this->dispatch('open-login-modal');
            return;
        }

        // Cek apakah user sudah melengkapi CV
        if (empty(auth()->user()->CVuser)) {
            session()->flash('error_cv', true);
            return;
        }

        // Cek apakah kuota lowongan sudah penuh
        $this->vacancy->refresh();
        if ($this->vacancy->isQuotaFull()) {
            session()->flash('error_quota', true);
            return;
        }

        if (!$this->alredyApplied) {
            Application::create([
                'id_vacancy' => $this->vacancy->id,
                'id_user' => Auth::id(),
                'id_company' => $this->vacancy->company->id,
                'status' => 'diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->alredyApplied = true;

            session()->flash('success', 'Lamaran berhasil dikirim!');
        } 
    }

    public function render()
    {
        return view('livewire..vacancy.vacancy-detail');
    }
}
