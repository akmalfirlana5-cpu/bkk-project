<?php

namespace App\Livewire;

use App\Models\announcement;
use App\Models\HomepageSetting;
use App\Models\User;
use App\Models\vacancie;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Beranda - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]

class Homepage extends Component
{
    public $homepageContent;

    public $statisticContent = [];

    public $testimoniSwiperContent = [
        [
            'testimoni' => 'Berkat BKK, saya berhasil bekerja di bidang IT yang saya impikan sejak sekolah. Proses rekrutmennya cepat dan dukungan dari BKK sangat berarti bagi perjalanan karier saya.',
            'person_name' => 'Dimas Prasetyo',
            'graduate_of' => '2021',
            'company_name' => 'PT ABC Teknologi',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
        [
            'testimoni' => 'Saya diterima bekerja di PT Maju Sejahtera berkat info lowongan dari BKK. Saya merasa sangat terbantu dengan bimbingan dan fasilitas yang telah diberikan oleh BKK.',
            'person_name' => 'Ayla Putri',
            'graduate_of' => '2020',
            'company_name' => 'PT Maju Sejahtera',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
        [
            'testimoni' => 'BKK membantu saya mendapatkan pekerjaan pertama saya di PT Astra Otoparts. Terima kasih BKK atas kesempatan dan arahan kariernya.',
            'person_name' => 'Eka Rizky Andika',
            'graduate_of' => '2019',
            'company_name' => 'PT Astra Otoparts Tbk',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
        [
            'testimoni' => 'Berkat BKK, saya berhasil bekerja di bidang IT yang saya impikan sejak sekolah. Proses rekrutmennya cepat dan dukungan dari BKK sangat berarti bagi perjalanan karier saya.',
            'person_name' => 'Dimas Prasetyo',
            'graduate_of' => '2021',
            'company_name' => 'PT ABC Teknologi',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
        [
            'testimoni' => 'Saya diterima bekerja di PT Maju Sejahtera berkat info lowongan dari BKK. Saya merasa sangat terbantu dengan bimbingan dan fasilitas yang telah diberikan oleh BKK.',
            'person_name' => 'Ayla Putri',
            'graduate_of' => '2020',
            'company_name' => 'PT Maju Sejahtera',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
        [
            'testimoni' => 'BKK membantu saya mendapatkan pekerjaan pertama saya di PT Astra Otoparts. Terima kasih BKK atas kesempatan dan arahan kariernya.',
            'person_name' => 'Eka Rizky Andika',
            'graduate_of' => '2019',
            'company_name' => 'PT Astra Otoparts Tbk',
            'quote_image' => '/assets/static/partial/quote.png',
        ],
    ];

    public $vacancies;
    public $vacanciesTotal;
    public $announcements;
    public $heroSlides = [];
    public $graduates_absorbed;

    public function mount()
    {
        $this->vacancies = vacancie::where('deadline', '>=', now())
            ->latest()->take(6)->get();
        $this->announcements = announcement::where('active_until', '>=', now())
            ->latest()->take(3)->get();
        // Ambil data Homepage settings
        $this->homepageContent = HomepageSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
        // json decode field json
        if (isset($this->homepageContent['hero']['slides'])) {
            $rawSlides = json_decode($this->homepageContent['hero']['slides'], true);

            $this->heroSlides = collect($rawSlides)
            ->map(function ($item) {
                $data = $item['data'];

                return $data;
            })->values()->all();
        }

        // Lulusan Terserap
        $this->graduates_absorbed = User::where('status', '!=', 'menganggur')
            ->whereNotNull('status')
            ->count();
        // Jumlah loker tersedia
        $this->vacanciesTotal = vacancie::where('deadline', '>=', now())
            ->count();

        $this-> statisticContent = [
            [
                'title' => 'Mitra Industri',
                'amount' => 260,
                'suffix' => '+',
            ],
            [
                'title' => 'Lulusan Terserap',
                'amount' => $this->graduates_absorbed,
                'suffix' => '+',
            ],
            [
                'title' => 'Tingkat Keterserapan',
                'amount' => 85,
                'suffix' => '%',
            ],
            [
                'title' => 'Program Rekrutmen & Magang',
                'amount' => $this->vacanciesTotal,
                'suffix' => '+',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
