<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\WorkFill;
use App\Models\CollegeFill;
use Livewire\Attributes\On;
use App\Models\UnemployedFill;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\EntrepreneurFill;
use Illuminate\Support\Facades\DB;


#[Title('Isi Tracer Study - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class FillTracerStudy extends Component
{
    public $currentStep = 1;
    public $formData = [];

    public function mount()
    {
        // Ambil data user saat ini untuk dikirim ke Child 1
        $user = auth()->user();
        $this->formData = $user ? $user->toArray() : [];
    }

    #[On('step1-completed')]
    public function handleStep1($data)
    {
        $this->formData = array_merge($this->formData, $data);
        $this->currentStep = 2;
    }

    #[On('step2-completed')]
    public function handleStep2($data)
    {
        $this->formData = array_merge($this->formData, $data);
        $this->saveAllData();
    }

    #[On('go-to-previous-step')]
    public function previousStep()
    {
        $this->currentStep = 1;
    }

    private function saveAllData()
    {
        $data = $this->formData;

        DB::transaction(function () use ($data) {
            // 1. Update Profile User
            $user = User::updateOrCreate(
                ['nisn' => $data['nisn']],
                [
                    'full_name' => $data['full_name'],
                    'nik' => $data['nik'],
                    'address' => $data['address'],
                    'no_hp' => $data['no_hp'],
                    'major' => $data['major'],
                    'graduation_year' => $data['graduation_year'],
                    'status' => $data['status'],
                ]
            );

            // 2. PROSES PEMBERSIHAN (Hapus data lama di semua tabel detail)
            // Ini memastikan tidak ada data ganda jika user pindah status
            WorkFill::where('id_user', $user->id)->delete();
            CollegeFill::where('id_user', $user->id)->delete();
            EntrepreneurFill::where('id_user', $user->id)->delete();
            UnemployedFill::where('id_user', $user->id)->delete();

            // 3. Simpan Detail BARU Berdasarkan Status saat ini
            if ($data['status'] === 'bekerja') {
                WorkFill::create([
                    'id_user' => $user->id,
                    'start_date' => $data['work_start_date'],
                    'position' => $data['work_position'],
                    'salary' => $data['work_salary'],
                    'location' => $data['work_location'],
                    'company_name' => $data['work_company_name'],
                    'major_relevance' => $data['work_major_relevance'],
                ]);
            } elseif ($data['status'] === 'kuliah') {
                CollegeFill::create([
                    'id_user' => $user->id,
                    'start_date' => $data['college_start_date'],
                    'university_name' => $data['college_university_name'],
                    'degree' => $data['college_degree'],
                    'major' => $data['college_major'],
                ]);
            } elseif ($data['status'] === 'wiraswasta') {
                EntrepreneurFill::create([
                    'id_user' => $user->id,
                    'start_date' => $data['entrepreneur_start_date'],
                    'company_name' => $data['entrepreneur_company_name'],
                    'field' => $data['entrepreneur_field'],
                    'location' => $data['entrepreneur_location'],
                    'salary' => $data['entrepreneur_salary'],
                    'major_relevance' => $data['entrepreneur_major_relevance'],
                    'sosial_media' => $data['entrepreneur_sosial_media'],
                ]);
            } elseif ($data['status'] === 'menganggur') {
                UnemployedFill::create([
                    'id_user' => $user->id,
                    'timespan' => $data['unemployed_timespan'],
                    'reason' => $data['unemployed_reason'],
                    'activity' => $data['unemployed_activity'],
                ]);
            }
        });

        session()->flash('success', 'Data tracer study berhasil diperbarui!');
        return redirect()->route('tracer-study-sukses');
    }

    public function render()
    {
        return view('livewire.user.fill-tracer-study');
    }
}
