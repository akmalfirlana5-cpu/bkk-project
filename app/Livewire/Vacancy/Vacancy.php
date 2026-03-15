<?php

namespace App\Livewire\Vacancy;

use App\Models\InfoSetting;
use App\Models\vacancie;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Lowongan - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class Vacancy extends Component
{
    use WithPagination;
    #[Url('s')]
    public $filterSearch = null;

    #[Url('k')]
    public $filterKompetensi = [];

    #[Url('tipe')]
    public $filterTipe = [];

    #[Url('td')]
    public $filterTerakhirDiperbarui = [];

    public $vacancyContent;

    public function updatedFilterSearch()
    {
        $this->resetPage();
    }


    public function updatedFilterTipe()
    {
        $this->resetPage();
    }

    public function updatedFilterTerakhirDiperbarui()
    {
        $this->resetPage();
    }

    public $kompetensiKeahlians = [
        'Teknik Grafika',
        'Teknik Logistik',
        'Teknik Mekatronika',
        'Desain Komunikasi Visual',
        'Rekayasa Perangkat Lunak',
        'Animasi',  
        'Perhotelan',
    ];

    public $tipePekerjaans = [
        'Full-time',
        'Part-time',
    ];

    public $terakhirDiperbarui = [
        '24 Jam Terakhir',
        'Seminggu Terakhir',
        'Sebulan Terakhir',
        'Kapan pun',
    ];

    public function mount() {
        // Ambil data vacancy settings
        $this->vacancyContent = InfoSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }

    public function render()
    {
        $userMajor = auth()->check() ? auth()->user()->major : null;

        $query = vacancie::with('company')
            ->where('deadline', '>=', now())
            ->where('quota_status', 'open');

        $query->when($this->filterSearch, function ($q) {
            $q->where('vacancy_name', 'like', '%' . $this->filterSearch . '%');
        })
        ->when($this->filterKompetensi, function ($q) {
            $q->where(function ($sub) {
                foreach ($this->filterKompetensi as $kompetensi) {
                    $sub->orWhereJsonContains('major', $kompetensi);
                }
            });
        })
        ->when($this->filterTipe, function ($q) {
            $cleanedTypes = array_map('strtolower', $this->filterTipe);
            $q->whereIn('employment_classification', $cleanedTypes);
        })
        ->when($this->filterTerakhirDiperbarui, function ($q) {
            $q->where(function ($sub) {
                foreach ($this->filterTerakhirDiperbarui as $filter) {
                    if ($filter === '24 Jam Terakhir') $sub->orWhere('created_at', '>=', now()->subDay());
                    elseif ($filter === 'Seminggu Terakhir') $sub->orWhere('created_at', '>=', now()->subWeek());
                    elseif ($filter === 'Sebulan Terakhir') $sub->orWhere('created_at', '>=', now()->subMonth());
                }
            });
        });

        if ($userMajor) {
            $query->orderByRaw("JSON_CONTAINS(major, '\"$userMajor\"') DESC");
        }
        
        $vacancies = $query->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('livewire.vacancy.vacancy', [
            'vacancies' => $vacancies,
            'userMajor' => $userMajor 
        ]);
    }
}
