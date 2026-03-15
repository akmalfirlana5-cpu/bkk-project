<?php

namespace App\Livewire\Information;

use App\Models\SurveyAnswer;
use App\Models\SurveyCategory;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Survey extends Component
{
    public $slug;
    public $category;
    public $identity = [];
    public $answers = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->category = SurveyCategory::where('slug', $slug)
            ->where('is_active', true)
            ->with(['questions' => fn($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->firstOrFail();

        // Initialize defaults
        foreach ($this->category->identity_fields as $field) {
            $this->identity[$field['key']] = '';
        }
    }

    public function submit()
    {
        // 1. Persiapkan Validasi Dinamis
        $rules = [];
        $messages = [];
        $phoneFieldKey = null;

        // Identity Validation
        foreach ($this->category->identity_fields as $field) {
            $key = $field['key'];
            $fieldRules = [$field['required'] ? 'required' : 'nullable'];
            
            if ($field['type'] === 'number') {
                $fieldRules[] = 'numeric';
            } else {
                $fieldRules[] = 'string';
            }
            $fieldRules[] = 'max:255';
            
            if (in_array($key, ['no_hp', 'no_kontak', 'phone', 'whatsapp'])) {
                $phoneFieldKey = $key;
                $fieldRules[] = 'regex:/^[0-9+]+$/';
                $fieldRules[] = 'min:10';
            }

            $rules["identity.{$key}"] = $fieldRules;
            $messages["identity.{$key}.required"] = "Field {$field['label']} wajib diisi.";
        }

        // Questions Validation
        $questions = $this->category->questions;
        foreach ($questions as $question) {
            $fieldRules = [$question->is_required ? 'required' : 'nullable'];
            
            if ($question->field_type === 'dropdown') {
                $fieldRules[] = Rule::in($question->options ?? []);
            } else {
                $fieldRules[] = 'string';
                $fieldRules[] = 'max:2000';
            }
            
            $rules["answers.{$question->id}"] = $fieldRules;
            $messages["answers.{$question->id}.required"] = "Pertanyaan nomor ini wajib diisi.";
        }

        $this->validate($rules, $messages);

        // 2. Cek Duplikasi No HP
        $phoneValue = $this->identity[$phoneFieldKey] ?? null;
        if ($phoneValue && $phoneFieldKey) {
            $exists = SurveyResponse::where('category_id', $this->category->id)
                ->where('phone', $phoneValue)
                ->exists();

            if ($exists) {
                $this->addError("identity.{$phoneFieldKey}", 'Maaf, nomor ini sudah pernah mengisi survey ini sebelumnya.');
                return;
            }
        }

        // 3. Simpan Data
        DB::beginTransaction();
        try {
            $response = SurveyResponse::create([
                'category_id' => $this->category->id,
                'phone' => $phoneValue ?? 'anon-' . uniqid(),
                'identity_data' => $this->identity,
            ]);

            foreach ($questions as $question) {
                $answerText = $this->answers[$question->id] ?? null;
                
                if ($answerText !== null) {
                    SurveyAnswer::create([
                        'response_id' => $response->id,
                        'question_id' => $question->id,
                        'answer' => $answerText,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('survey.thanks', $this->slug);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Survey Livewire Error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.survey.survey')->layout('layouts.app');
    }
}
