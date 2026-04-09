<?php

namespace App\Livewire\User\Partials\Survey;

use App\Models\SurveyCategory;
use App\Models\SurveyQuestion;
use Livewire\Component;

class Step3PenilaianLayananForm extends Component
{
    public $data, $type , $questionId, $question;
    public $questionData = [];

    public function mount($data, $type)
    {
        $this->data = $data;
        $this->type = $type;

        // Ambil pertanyaan
        $this->questionId = SurveyCategory::
            where('slug', $type)
            ->firstOrFail()
            ->id;
        
        $this->question = SurveyQuestion::where('category_id', $this->questionId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function submit() 
    {
        $rules = [];
        $messages = [];

        foreach ($this->question as $q) {
        if ($q->is_required) {
            $rules["questionData.{$q->id}"] = 'required';
            $messages["questionData.{$q->id}.required"] = "Pertanyaan ini wajib diisi.";
        }
    }
        $this->validate($rules, $messages);
        
        $formattedResponses = [];

        foreach ($this->question as $q) {
        $formattedResponses[] = [
            'no'    => $q->id, 
            'jawaban' => $this->questionData[$q->id] ?? '-' 
        ];
    }
        $fullData = array_merge($this->data, ['survey_responses' => $formattedResponses]);

        $this->dispatch('step3-completed', data: $fullData);
    } 
    
    public function goToPrevious()
    {
        $this->dispatch('step-3-previous');
    }

    public function render()
    {
        return view('livewire..user.partials.survey.step3-penilaian-layanan-form');
    }
}
