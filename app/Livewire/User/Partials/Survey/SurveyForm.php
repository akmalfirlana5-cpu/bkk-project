<?php

namespace App\Livewire\User\Partials\Survey;

use App\Models\SurveyAnswer;
use App\Models\SurveyCategory;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Survey - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class SurveyForm extends Component
{
    public $type;
    public $currentStep = 2; // Langsung lompat ke step 2 karena step 1 sudah diisi di halaman survey   utama
    public $formData = []; // Menampung semua data dari step 1 dan step 2

    public function mount($type) 
    {
        $this->type = $type;

        if (!in_array($type, ['dudi', 'orangtua', 'siswa-alumni'])) {
            abort(404);
        }
    }

    #[On('step2-completed')]
    public function handleStep2($data)
    {
        $this->formData = array_merge($this->formData, $data);
        $this->currentStep = 3; 

        $this->dispatch('next-step-scrolled');
    }

    #[On('step3-completed')]
    public function handleStep3($data)
    {
        $this->formData = array_merge($this->formData, $data);
        
        // Simpan semua data ke database
        $this->saveAllData();

        $this->dispatch('next-step-scrolled');
    }

    #[On('step-2-previous')]
    public function step2Previous()
    {
        redirect()->route('survey');       
    }

    #[On('step-3-previous')]
    public function step3Previous()
    {
        $this->currentStep = 2;

        $this->dispatch('next-step-scrolled');
    }

    public function saveAllData()
    {
        // Simpan semua data ke database
        $data = $this->formData;

        DB::transaction(function () use ($data) {

            $categoryId = SurveyCategory::where('slug', $data['type'])->first()->id;

            // Form Alumni
            if ($data['type'] === 'siswa-alumni') {

                $identity = [
                    'full_name' => $data['full_name'],
                    'nik' => $data['nik'],
                    'graduation_year' => $data['graduation_year'],
                    'email' => $data['email'],
                    'address' => $data['address'],
                    'status' => $data['status'],
                ];

                if ($data['status'] === 'bekerja')
                {
                    $identity['is_career_linier'] = $data['is_career_linier'];
                    $identity['company_name'] = $data['company_name'];
                    $identity['how_long'] = $data['how_long'];
                    $identity['company_address'] = $data['company_address'];

                } elseif ($data['status'] === 'berwirausaha') {
                    $identity['is_career_linier'] = $data['is_career_linier'];
                    $identity['business_name'] = $data['business_name'];
                    $identity['how_long'] = $data['how_long'];
                    $identity['business_address'] = $data['business_address'];

                } elseif ($data['status'] === 'kuliah') {
                    $identity['is_study_linier'] = $data['is_study_linier'];
                    $identity['college_name'] = $data['college_name'];
                    $identity['how_long'] = $data['how_long'];
                    $identity['college_address'] = $data['college_address'];

                } elseif ($data['status'] === 'menganggur') {
                    $identity['is_looking_for_job'] = $data['is_looking_for_job'];
                    $identity['constraint'] = $data['constraint'];
                }

                $response = SurveyResponse::Create([
                    'category_id' => $categoryId,
                    'phone' => $data['phone'],
                    'identity_data' => json_encode($identity),
                ]);
                
                foreach ($data['survey_responses'] as $item) {
                    SurveyAnswer::create([
                        'response_id' => $response->id, 
                        'question_id' => $item['no'],
                        'answer'      => $item['jawaban'],
                    ]);
                }
            } 
            // Form Orang tua
            elseif ($data['type'] === 'orangtua') 
            {
                $identity = [
                    'full_name' => $data['full_name'],
                    'student_name' => $data['student_name'],
                    'class' => $data['class'],
                ];

                $response = SurveyResponse::Create([
                    'category_id' => $categoryId,
                    'phone' => $data['phone'],
                    'identity_data' => json_encode($identity),
                ]);

                foreach ($data['survey_responses'] as $item) {
                    SurveyAnswer::create([
                        'response_id' => $response->id, 
                        'question_id' => $item['no'],
                        'answer'      => $item['jawaban'],
                    ]);
                }
            } 
            // Form Dudi
            elseif ($data['type'] === 'dudi') 
            {
                $identity = [
                    'company_name' => $data['company_name'],
                    'address' => $data['address'],
                    'leader_name' => $data['leader_name'],
                    'email' => $data['email'],
                    'student_count' => $data['student_count'],
                ];

                $response = SurveyResponse::Create([
                    'category_id' => $categoryId,
                    'phone' => $data['phone'],
                    'identity_data' => json_encode($identity),
                ]);

                foreach ($data['survey_responses'] as $item) {
                    SurveyAnswer::create([
                        'response_id' => $response->id, 
                        'question_id' => $item['no'],
                        'answer'      => $item['jawaban'],
                    ]);
                }  
            } 
        });

        session()->flash('success', 'Data survey kepuasan berhasil diperbarui!');
        return redirect()->route('survey-sukses');
    }

    public function render()
    {
        return view('livewire..user.partials.survey.survey-form');
    }
}
