<?php

namespace App\Livewire\User\Partials\Survey;

use Livewire\Component;

class Step2DataRespondenForm extends Component
{
    public $identity_data = [];
    public $phone;
    public $type;

    public $statusOptions = [
        [
            'value' => 'bekerja',
            'label' => 'Bekerja'
        ],
        [
            'value' => 'kuliah',
            'label' => 'Kuliah'
        ],
        [
            'value' => 'berwirausaha',
            'label' => 'Berwirausaha'
        ],
        [
            'value' => 'menganggur',
            'label' => 'Menganggur'
        ]
    ];

    public function mount($type)
    {
        $this->type = $type;
        $this->identity_data = [];
        
    }

    public function goToSurvey() 
    {
        $alumniStatus = $this->identity_data['status'] ?? null;

        $rules = match($this->type) {
            'orangtua' => [
                'identity_data.full_name' => 'required|max:255',
                'identity_data.student_name' => 'required|max:255',
                'identity_data.class' => 'required|max:50',
                'phone' => 'required|min:12',
            ],
            'dudi' => [
                'identity_data.company_name' => 'required|max:255',
                'identity_data.address' => 'required|max:255',
                'identity_data.leader_name' => 'required|max:255',
                'identity_data.email' => 'required|max:255',
                'identity_data.student_count' => 'required|max:255',
                'phone' => 'required|min:12',
            ],
            'siswa-alumni' => array_merge(
                [
                'identity_data.full_name' => 'required|max:255',
                'identity_data.nik' => 'required|max:255',
                'identity_data.graduation_year' => 'required|max:255',
                'identity_data.email' => 'required|max:255',
                'identity_data.address' => 'required|max:255',
                'identity_data.status' => 'required|max:255',
                'phone' => 'required|min:12',
                ],

                match($alumniStatus) {
                    'berwirausaha' => [
                        'identity_data.is_career_linier' => 'required|in:true,false',
                        'identity_data.business_name' => 'required|max:255',
                        'identity_data.how_long' => 'required|max:255',
                        'identity_data.business_address' => 'required|max:255',
                    ],
                    'bekerja' => [
                        'identity_data.is_career_linier' => 'required|in:true,false',
                        'identity_data.company_name' => 'required|max:255',
                        'identity_data.how_long' => 'required|max:255',
                        'identity_data.company_address' => 'required|max:255',
                    ],
                    'kuliah' => [
                        'identity_data.is_study_linier' => 'required|in:true,false',
                        'identity_data.college_name' => 'required|max:255',
                        'identity_data.how_long' => 'required|max:255',
                        'identity_data.college_address' => 'required|max:255',
                    ],
                    'menganggur' => [
                        'identity_data.is_looking_for_job' => 'required|in:true,false',
                        'identity_data.constraint' => 'required|max:255',
                    ],

                    default => []
                }
            ),
        };

        $this->validate($rules);

        $this->identity_data['type'] = $this->type;

        $this->identity_data['phone'] = $this->phone;

        $this->identity_data['status'] = $alumniStatus;

        $this->dispatch('step2-completed', data: $this->identity_data);
    }

    public function goToPrevious()
    {
        $this->dispatch('step-2-previous');
    }

    public function render()
    {
        return view('livewire..user.partials.survey.step2-data-responden-form');
    }
}
