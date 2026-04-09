<?php

namespace App\Livewire\Survey;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Survey - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class Survey extends Component
{
    public $selectedSlug = null; 

    public $participantType = [
        [
            'label' => 'DUDI',
            'description' => 'Mitra dunia usaha dan industri',
            'slug' => 'dudi', 
            'icon' => '<svg width="57" height="49" viewBox="0 0 57 49" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.5 46.8333H6.83333M6.83333 46.8333H33.5M6.83333 46.8333V10.0339C6.83333 7.04691 6.83333 5.55232 7.41463 4.41146C7.92596 3.40793 8.74126 2.59262 9.74479 2.0813C10.8857 1.5 12.3802 1.5 15.3672 1.5H24.9672C27.9541 1.5 29.4455 1.5 30.5864 2.0813C31.5899 2.59262 32.4079 3.40793 32.9193 4.41146C33.5 5.5512 33.5 7.04398 33.5 10.0251V25.5M33.5 46.8333H49.5M33.5 46.8333V25.5M49.5 46.8333H54.8333M49.5 46.8333V25.5C49.5 23.015 49.4997 21.7731 49.0937 20.793C48.5524 19.4862 47.5151 18.4473 46.2083 17.906C45.2282 17.5 43.9843 17.5 41.4993 17.5C39.0143 17.5 37.7718 17.5 36.7917 17.906C35.4848 18.4473 34.4473 19.4862 33.906 20.793C33.5 21.7731 33.5 23.015 33.5 25.5M14.8333 20.1667H25.5M14.8333 12.1667H25.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            '
        ],
        [
            'label' => 'Orang Tua/Wali',
            'description' => 'Orang tua atau wali Siswa',
            'slug' => 'orangtua',
            'icon' => '<svg width="51" height="43" viewBox="0 0 51 43" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M49.5 41.4998C49.5 36.8555 45.0477 32.9044 38.8333 31.4401M33.5 41.5C33.5 35.609 26.3366 30.8333 17.5 30.8333C8.66344 30.8333 1.5 35.609 1.5 41.5M33.5 22.8333C39.391 22.8333 44.1667 18.0577 44.1667 12.1667C44.1667 6.27563 39.391 1.5 33.5 1.5M17.5 22.8333C11.609 22.8333 6.83333 18.0577 6.83333 12.1667C6.83333 6.27563 11.609 1.5 17.5 1.5C23.391 1.5 28.1667 6.27563 28.1667 12.1667C28.1667 18.0577 23.391 22.8333 17.5 22.8333Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            '
        ],
        [
            'label' => 'Alumni',
            'description' => 'Lulusan SMKN 4 Malang',
            'slug' => 'siswa-alumni',
            'icon' => '<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M30.7615 12.6565C31.5388 12.2473 32.4679 12.2473 33.2452 12.6565L52.3436 22.7082C54.3367 23.7572 54.2121 26.6517 52.1364 27.5257L33.0383 35.5671C32.3764 35.8457 31.6303 35.8457 30.9684 35.5671L11.8702 27.5257C9.79445 26.6517 9.66997 23.7572 11.663 22.7082L30.7615 12.6565Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/>
            <path d="M53.332 26.666V40.6855" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            <path d="M16 29.334V42.7761C16 44.3692 16.8139 45.8518 18.1581 46.7073C25.79 51.5639 35.5435 51.5639 43.1752 46.7073C44.5195 45.8518 45.3333 44.3692 45.3333 42.7761V29.334" stroke="currentColor" stroke-width="3"/>
            </svg>
            '
        ]
    ];

    public function goToIdentity()
    {
        $this->validate([
            'selectedSlug' => 'required'
        ]);

        return redirect()->route('survey-detail', ['type' => $this->selectedSlug]);
    }
    public function render()
    {
        return view('livewire..survey.survey');
    }
}
