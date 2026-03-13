<?php

namespace App\Livewire\Company;

use App\Models\companie;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Perusahaan - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]

class Company extends Component
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
        $query = companie::query();

        $query->when($this->filterSearch, function ($q) {
            $q->whereAny(['companies_name', 'short_address'], 'like', '%' . $this->filterSearch . '%' );
        });
        
        $companies = $query->orderBy('created_at', 'desc')
            ->paginate(8);


        return view('livewire..company.company', [
            'companies' => $companies,
        ]);
    }
}
