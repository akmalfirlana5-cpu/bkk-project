<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Portfolio;
use App\Models\PklExperience;

#[Title('Data Pribadi - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class PersonalData extends Component
{
    Use WithFileUploads;

    public $isCvExist = false; 
    public $userPhoto;

    public $kompetensiKeahlians = [
        'Animasi',
        'Desain Komunikasi Visual',
        'Logistik', 
        'Perhotelan',
        'Teknik Grafika',
        'Teknik Komputer dan Jaringan',
        'Rekayasa Perangkat Lunak',
        'Mekatronika'
    ];

    public $tahunLulus = [];
    public $tahunMasuk = [];
    public $personal = [];

    // Data portofolio
    public $portfolios = [];

    // Data PKL
    public $pklExperiences = [];

    public function submitPersonal() {
         $rules = [
            'personal.full_name' => 'required|max:255',
            'personal.major' => 'required',
            'personal.nisn' => 'required',
            'personal.domisili' => 'required',
            'personal.no_hp' => 'required',
        ];

        if ($this->personal['cv'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $rules['personal.cv'] = 'mimes:pdf,docx,jpg,jpeg,png|max:3072';
        }

        $this->validate($rules, [
            'personal.full_name.required' => 'Nama Lengkap harus diisi.',
            'personal.domisili.required' => 'Domisili harus diisi.',
            'personal.no_hp.required' => 'No whatsapp aktif harus diisi.',
            'personal.cv.mimes' => 'Format CV tidak didukung.',
            'personal.cv.max' => 'Ukuran CV maksimal 3MB.',
        ]);

        foreach ($this->pklExperiences as $index => $pkl) {
            $this->validate([
                'pklExperiences.' . $index . '.company_name' => 'required',
                'pklExperiences.' . $index . '.position' => 'required',
            ], [
                'pklExperiences.' . $index . '.company_name.required' => 'Nama perusahaan wajib diisi.',
                'pklExperiences.' . $index . '.position.required' => 'Posisi wajib diisi.',
            ]);
        }

        foreach ($this->portfolios as $index => $portfolio) {
            $this->validate([
                'portfolios.' . $index . '.judul' => 'required',
                'portfolios.' . $index . '.image_path' => $portfolio['image_path'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? 'image|max:2048' : '',
            ], [
                'portfolios.' . $index . '.judul.required' => 'Judul portofolio wajib diisi.',
                'portfolios.' . $index . '.image_path.image' => 'File harus berupa gambar.',
                'portfolios.' . $index . '.image_path.max' => 'Ukuran gambar maksimal 2MB.',
            ]);
        }

        $updateData = ([
            'full_name' => $this->personal['full_name'],
            'major' => $this->personal['major'],
            'nisn' => $this->personal['nisn'],
            'graduation_year' => $this->personal['tahun_lulus'],
            'domicile' => $this->personal['domisili'],
            'no_hp' => $this->personal['no_hp'],
            'entry_year' => $this->personal['entry_year'] ?? null,
            'major_description' => $this->personal['major_description'] ?? null,
            'hard_skills' => $this->personal['hard_skills'] ?? null,
            'soft_skills' => $this->personal['soft_skills'] ?? null,
        ]);

        $user = auth()->user();

        if ($this->personal['cv']) {
            if ($user->CVuser) {
                Storage::disk('public')->delete($user->CVuser);
            }
            $path = $this->personal['cv']->store('cv', 'public');
            $updateData['CVuser'] = $path;

            $this->personal['cv'] = null;
        }

        $user->update($updateData);

        // Update PKL Experiences
        $existingPklIds = [];
        foreach ($this->pklExperiences as $pklData) {
            $pklParams = [
                'company_name' => $pklData['company_name'],
                'position' => $pklData['position'],
                'description' => $pklData['description'],
            ];

            if (isset($pklData['id'])) {
                $pkl = PklExperience::find($pklData['id']);
                if ($pkl) {
                    $pkl->update($pklParams);
                    $existingPklIds[] = $pkl->id;
                }
            } else {
                $newPkl = $user->pklExperiences()->create($pklParams);
                $existingPklIds[] = $newPkl->id;
            }
        }
        $user->pklExperiences()->whereNotIn('id', $existingPklIds)->delete();

        // Update portfolios
        $existingPortfolioIds = [];
        foreach ($this->portfolios as $portfolioData) {
            $portfolioParams = [
                'judul' => $portfolioData['judul'],
                'description' => $portfolioData['description'],
                'link' => $portfolioData['link'],
            ];

            if ($portfolioData['image_path'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                // Hapus gambar lama jika ada
                if (isset($portfolioData['id'])) {
                    $oldPortfolio = Portfolio::find($portfolioData['id']);
                    if ($oldPortfolio && $oldPortfolio->image_path) {
                        Storage::disk('public')->delete($oldPortfolio->image_path);
                    }
                }
                $path = $portfolioData['image_path']->store('portfolios', 'public');
                $portfolioParams['image_path'] = $path;
            }

            if (isset($portfolioData['id'])) {
                $portfolio = Portfolio::find($portfolioData['id']);
                if ($portfolio) {
                    $portfolio->update($portfolioParams);
                    $existingPortfolioIds[] = $portfolio->id;
                }
            } else {
                $newPortfolio = $user->portfolios()->create($portfolioParams);
                $existingPortfolioIds[] = $newPortfolio->id;
            }
        }

        // Hapus portfolio yang dihapus dari UI
        $portfoliosToDelete = $user->portfolios()->whereNotIn('id', $existingPortfolioIds)->get();
        foreach ($portfoliosToDelete as $portToDelete) {
            if ($portToDelete->image_path) {
                Storage::disk('public')->delete($portToDelete->image_path);
            }
            $portToDelete->delete();
        }
        
        $this->mount(); // reload data
        

        $this->isCvExist = $user->CVuser ? true : false;

        Session::flash('success', 'Data pribadi berhasil diperbarui.');

        $this->dispatch('scroll-to-top');
    }

    public function updatedUserPhoto() {
        $this->validate([
            'userPhoto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ],
        [
            'userPhoto.required' => 'Foto harus diisi.',
            'userPhoto.image' => 'Foto harus berformat jpg, png, jpeg.',
            'userPhoto.mimes' => 'Foto harus berformat jpg, png, jpeg.',
            'userPhoto.max' => 'Foto harus kurang dari 2MB.',
        ]);

        $user = auth()->user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $this->userPhoto->store('photo', 'public');

        $user->update([
            'photo' => $path
        ]);

        $this->dispatch('update-profile');

        $this->userPhoto = null;
    }

    public function addPortfolio()
    {
        $this->portfolios[] = [
            'judul' => '',
            'description' => '',
            'link' => '',
            'image_path' => null,
        ];
    }

    public function removePortfolio($index)
    {
        unset($this->portfolios[$index]);
        $this->portfolios = array_values($this->portfolios); // Reset keys
    }

    public function addPklExperience()
    {
        $this->pklExperiences[] = [
            'company_name' => '',
            'position' => '',
            'description' => '',
        ];
    }

    public function removePklExperience($index)
    {
        unset($this->pklExperiences[$index]);
        $this->pklExperiences = array_values($this->pklExperiences); // Reset keys
    }

    public function mount() {
        $user = auth()->user();
        $this->tahunLulus = range(2019, date('Y'));
        $this->tahunMasuk = range(2016, date('Y'));
        $this->isCvExist = auth()->user()->CVuser ? true : false;

        $this->personal = ([
            'full_name' => $user->full_name,
            'major' => $user->major,
            'nisn' => $user->nisn,
            'tahun_lulus' => $user->graduation_year,
            'domisili' => $user->domicile ?? $user->birth_place,
            'no_hp' => $user->no_hp,
            'entry_year' => $user->entry_year,
            'major_description' => $user->major_description,
            'hard_skills' => $user->hard_skills,
            'soft_skills' => $user->soft_skills,
            'cv' => null,
        ]);

        $this->pklExperiences = $user->pklExperiences->map(function ($pkl) {
            return [
                'id' => $pkl->id,
                'company_name' => $pkl->company_name,
                'position' => $pkl->position,
                'description' => $pkl->description,
            ];
        })->toArray();

        $this->portfolios = $user->portfolios->map(function ($portfolio) {
            return [
                'id' => $portfolio->id,
                'judul' => $portfolio->judul,
                'description' => $portfolio->description,
                'link' => $portfolio->link,
                'image_path' => $portfolio->image_path,
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire..user.profile.personal-data');
    }
}
