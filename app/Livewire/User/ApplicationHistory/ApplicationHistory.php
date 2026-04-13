<?php

namespace App\Livewire\User\ApplicationHistory;

use Livewire\Component;
use App\Models\Companie;
use App\Models\Vacancie;
use App\Models\Application;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Riwayat Lamaran - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class ApplicationHistory extends Component
{
    use WithPagination;
    #[Url('s')]
    public $filterSearch = null;

    public function updatedFilterSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $applications = Application::with(['vacancy', 'company'])
        ->where('id_user', auth()->user()->id)
        ->when($this->filterSearch, function ($query) {
             $query->whereHas('vacancy', function ($subQuery) {
                $subQuery->where('vacancy_name', 'like', '%' . $this->filterSearch . '%');
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(4);

        return view('livewire..user.application-history.application-history' , [
            'applications' => $applications,
        ]);
    }
}
