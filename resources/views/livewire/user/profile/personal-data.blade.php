<div>
    <section class="py-30 lg:py-25">
        <div class="container mx-auto px-5 lg:px-0">
            <h1 class="heading-42s text-bkkNeutral-900 mb-9">Profil Saya</h1>
            <div class="rounded-3xl shadow-lg overflow-hidden">
                <div class="flex items-center h-[64px] bg-primary-light justify-between px-6">
                    <div class="h-full paragraph-16s text-primary flex items-center gap-3">
                        <svg class="shrink-0" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.3333 16C14.3333 13.6988 11.3486 11.8333 7.66667 11.8333C3.98477 11.8333 1 13.6988 1 16M7.66667 9.33333C5.36548 9.33333 3.5 7.46785 3.5 5.16667C3.5 2.86548 5.36548 1 7.66667 1C9.96785 1 11.8333 2.86548 11.8333 5.16667C11.8333 7.46785 9.96785 9.33333 7.66667 9.33333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Data Diri & Karier
                    </div>
                </div>
                <div class="p-5 lg:p-12">
                    <div class="flex gap-8 mb-14 relative">
                        <div class="w-31 h-31 rounded-full overflow-hidden">
                            <img 
                                src="{{ Auth::user()->photo 
                                ? \Illuminate\Support\Facades\Storage::url(Auth::user()->photo) 
                                : asset('assets/static/partial/fallbackUser.webp') }}" 
                                class="w-full h-full object-cover object-center" />
                        </div>
                        <div class="flex flex-col justify-center gap-3">
                            <div class="heading-40s text-bkkNeutral-900 capitalize">
                                {{ $personal['full_name'] }}
                            </div>
                            <div 
                                wire:loading.attr="disabled"
                                wire:target="userPhoto"
                                wire:loading.class="animate-pulse pointer-events-none opacity-50"
                                class="paragraph-16s bg-primary-light text-primary py-2 px-4 rounded-lg self-start cursor-pointer">
                                <label 
                                    for="changePhoto"
                                    class="flex items-center gap-3 cursor-pointer">
                                    <svg class="shrink-0" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.3346 11.4665C15.3346 11.8201 15.1942 12.1592 14.9441 12.4093C14.6941 12.6593 14.3549 12.7998 14.0013 12.7998H2.0013C1.64768 12.7998 1.30854 12.6593 1.05849 12.4093C0.808445 12.1592 0.667969 11.8201 0.667969 11.4665V4.13314C0.667969 3.77952 0.808445 3.44038 1.05849 3.19033C1.30854 2.94028 1.64768 2.7998 2.0013 2.7998H4.66797L6.0013 0.799805H10.0013L11.3346 2.7998H14.0013C14.3549 2.7998 14.6941 2.94028 14.9441 3.19033C15.1942 3.44038 15.3346 3.77952 15.3346 4.13314V11.4665Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.0013 10.1331C9.47406 10.1331 10.668 8.93923 10.668 7.46647C10.668 5.99371 9.47406 4.7998 8.0013 4.7998C6.52854 4.7998 5.33464 5.99371 5.33464 7.46647C5.33464 8.93923 6.52854 10.1331 8.0013 10.1331Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div wire:loading.remove wire:target="userPhoto">
                                        {{ Auth::user()->photo ? 'Ubah foto' : 'Unggah foto' }}
                                    </div>
                                    <div wire:loading wire:target="userPhoto">
                                        Mengunggah
                                    </div>
                                </label>
                                <input 
                                    class="hidden"
                                    id="changePhoto"
                                    wire:model.live="userPhoto"
                                    type="file"/>
                                <div class="absolute -bottom-6">
                                @error('userPhoto')
                                    <span class="text-red-500 text-xs ">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        x-on:scroll-to-top.window="document.getElementById('personalForm').scrollIntoView({ behavior: 'smooth' })">
                        @if (session('success'))
                        <div x-data="{ open: true }" x-show="open"
                            class="w-full rounded-xl p-4 flex gap-2 mb-6 items-center border border-primary col-span-2 text-primary">
                            <svg class="w-6 h-6 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="paragraph-14r flex-1">{{ session('success') }}</span>
                            <button type="button" @click="open = false" class="ml-auto   cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endif
                        @error('error')
                            <div x-data="{ open: true }" x-show="open"
                                class="w-full rounded-xl p-4  flex gap-2 mb-6 items-center border border-primary text-primary col-span-2">
                                <svg class="w-6 h-6 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="paragraph-14r flex-1">{{ $message }}</span>
                            </div>
                        @enderror
                        <form
                            id="personalForm"
                            class="space-y-6 lg:space-y-9 scroll-mt-60"
                            wire:submit.prevent="submitPersonal">
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="full_name" class="heading-16 text-bkkNeutral-900">Nama Lengkap</label>
                                    <input 
                                        id="full_name"
                                        type="text" 
                                        wire:model="personal.full_name" 
                                        placeholder="Masukkan nama lengkap"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.full_name')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="major" class="heading-16 text-bkkNeutral-900">Kompetensi Keahlian</label>
                                    <select 
                                        id="major" 
                                        wire:model="personal.major" 
                                        placeholder="Pilih kompetensi keahlian"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6">
                                        <option 
                                            class="paragraph-14r text-bkkNeutral-500"
                                            selected hidden>
                                            Pilih kompetensi keahlian
                                        </option>
                                        @foreach ($kompetensiKeahlians as $kompetensi)
                                            <option 
                                                value="{{ $kompetensi }}">
                                                {{ $kompetensi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute -bottom-6">
                                        @error('personal.major')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label 
                                        for="nisn" 
                                        class="heading-16 text-bkkNeutral-900">
                                        Tahun Masuk
                                    </label>
                                    <select 
                                        id="entry_year"
                                        wire:model="personal.entry_year" 
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6">
                                        <option class="paragraph-14r text-bkkNeutral-500" selected hidden>Pilih tahun masuk</option>
                                        @foreach ($tahunMasuk as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute -bottom-6">
                                        @error('personal.entry_year')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label 
                                        for="tahun_lulus" 
                                        class="heading-16 text-bkkNeutral-900">
                                        Tahun Lulus
                                    </label>
                                    <select 
                                        id="tahun_lulus" 
                                        wire:model="personal.tahun_lulus" 
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6">
                                        <option 
                                            class="paragraph-14r text-bkkNeutral-500"
                                            selected hidden>
                                            Pilih tahun lulus
                                        </option>
                                        @foreach ($tahunLulus as $tahun)
                                            <option 
                                                value="{{ $tahun }}">
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute -bottom-6">
                                        @error('personal.tahun_lulus')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="nisn" class="heading-16 text-bkkNeutral-900">NISN</label>
                                    <input 
                                        id="nisn"
                                        type="text" 
                                        wire:model="personal.nisn" 
                                        placeholder="Masukkan NISN"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.nisn') <span class="text-red-500 text-xs ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="no_hp" class="heading-16 text-bkkNeutral-900">No WhatsApp Aktif</label>
                                    <input 
                                        id="no_hp"
                                        type="number" 
                                        wire:model="personal.no_hp" 
                                        placeholder="Masukkan no whatsApp aktif"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.no_hp') <span class="text-red-500 text-xs ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full flex flex-col gap-3 relative">
                                    <label for="domisili" class="heading-16 text-bkkNeutral-900">Alamat Lengkap Domisili</label>
                                    <input 
                                        id="domisili"
                                        type="text" 
                                        wire:model="personal.domisili" 
                                        placeholder="Masukkan alamat domisili"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.domisili') <span class="text-red-500 text-xs ">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="hard_skills" class="heading-16 text-bkkNeutral-900">Hard Skills (Keahlian Teknis)</label>
                                    <textarea id="hard_skills" wire:model="personal.hard_skills" rows="4" placeholder="Contoh: <ul><li>PHP</li><li>Laravel</li></ul>" class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"></textarea>
                                </div>
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label for="soft_skills" class="heading-16 text-bkkNeutral-900">Soft Skills (Keahlian Non-Teknis)</label>
                                    <textarea id="soft_skills" wire:model="personal.soft_skills" rows="4" placeholder="Contoh: <ul><li>Komunikasi</li><li>Kerja Tim</li></ul>" class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"></textarea>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full relative">
                                    <div class="w-full flex flex-col gap-3">
                                        <label for="cv" class="heading-16 text-bkkNeutral-900">Unggah CV</label>
                                        <div class="paragraph-14r text-bkkNeutral-900 focus:ring-primary border border-bkkNeutral-200 bg-white rounded-2xl focus:border-primary flex overflow-hidden">
                                            
                                            <div class="w-[80%] px-6 py-3.5 flex items-center">
                                         
                                                <div wire:loading wire:target="personal.cv">
                                                    <span class="paragraph-14r text-bkkNeutral-700 animate-pulse ">Sedang mengunggah file...</span>
                                                </div>

                                                <div 
                                                    class="paragraph-14r text-bkkNeutral-700"
                                                    wire:loading.remove 
                                                    wire:target="personal.cv">
                                                    @if ($personal['cv'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                                        <span>
                                                            {{ $personal['cv']->getClientOriginalName() }}
                                                        </span>
                                                    @elseif ($isCvExist)
                                                        <a 
                                                            href="{{ asset('storage/' . Auth::user()     ->CVuser) }}"
                                                            target="_blank">
                                                            Lihat CV
                                                        </a>
                                                    @else
                                                        <span>Belum ada file dipilih</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <input class="hidden" id="cv" type="file" wire:model.live="personal.cv" accept=".pdf,.docx" />

                                            <label for="cv" class="w-[20%] flex justify-center items-center cursor-pointer paragraph-14r text-bkkNeutral-900 bg-bkkNeutral-100 py-3.5 hover:bg-bkkNeutral-200 transition">
                                                <span wire:loading.remove wire:target="personal.cv">
                                                    {{ $isCvExist ? 'Ubah CV' : 'Pilih CV' }}
                                                </span>
                                                <span wire:loading wire:target="personal.cv">...</span>
                                            </label>
                                        </div>
                                        <div class="paragraph-12r text-bkkNeutral-500">Unggah file PDF, PNG, JPEG atau DOCS, maks. 3MB</div>
                                    </div>
                                    <div class="absolute -bottom-6">
                                        @error('personal.cv')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="border-t border-bkkNeutral-200 my-8">
                            
                            <div>
                                <div class="flex justify-between items-center mb-6">
                                    <h2 class="heading-24 text-bkkNeutral-900">Pengalaman PKL</h2>
                                    <button type="button" wire:click="addPklExperience" class="px-4 py-2 border border-primary text-primary hover:bg-primary-light rounded-lg transition paragraph-14r">
                                        + Tambah PKL
                                    </button>
                                </div>
                                
                                <div class="space-y-8">
                                    @foreach($pklExperiences as $index => $pkl)
                                    <div class="p-6 border border-bkkNeutral-200 rounded-2xl relative bg-bkkNeutral-50">
                                        <button type="button" wire:click="removePklExperience({{ $index }})" class="absolute top-4 right-4 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        
                                        <div class="flex flex-col md:flex-row gap-6 mb-4 mt-2">
                                            <div class="w-full md:w-[50%] flex flex-col gap-3">
                                                <label class="heading-16 text-bkkNeutral-900">Nama Perusahaan / Tempat *</label>
                                                <input type="text" wire:model="pklExperiences.{{ $index }}.company_name" placeholder="Contoh: PT. Inovasi Teknologi" class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"/>
                                                @error('pklExperiences.' . $index . '.company_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="w-full md:w-[50%] flex flex-col gap-3">
                                                <label class="heading-16 text-bkkNeutral-900">Posisi *</label>
                                                <input type="text" wire:model="pklExperiences.{{ $index }}.position" placeholder="Contoh: Web Developer Intern" class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"/>
                                                @error('pklExperiences.' . $index . '.position') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col gap-3 mb-4">
                                            <label class="heading-16 text-bkkNeutral-900">Rincian Tugas / Pengalaman</label>
                                            <textarea wire:model="pklExperiences.{{ $index }}.description" rows="3" placeholder="Ceritakan detail tugas saat PKL..." class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"></textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @if(count($pklExperiences) === 0)
                                    <div class="text-center py-8 bg-bkkNeutral-50 rounded-2xl border border-dashed border-bkkNeutral-300">
                                        <p class="paragraph-14r text-bkkNeutral-500">Belum ada pengalaman PKL ditambahkan.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <hr class="border-t border-bkkNeutral-200 my-8">
                            
                            <div>
                                <div class="flex justify-between items-center mb-6">
                                    <h2 class="heading-24 text-bkkNeutral-900">Portofolio Saya</h2>
                                    <button type="button" wire:click="addPortfolio" class="px-4 py-2 border border-primary text-primary hover:bg-primary-light rounded-lg transition paragraph-14r">
                                        + Tambah Portofolio
                                    </button>
                                </div>
                                
                                <div class="space-y-8">
                                    @foreach($portfolios as $index => $portfolio)
                                    <div class="p-6 border border-bkkNeutral-200 rounded-2xl relative bg-bkkNeutral-50">
                                        <button type="button" wire:click="removePortfolio({{ $index }})" class="absolute top-4 right-4 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        
                                        <div class="flex flex-col md:flex-row gap-6 mb-4 mt-2">
                                            <div class="w-full md:w-[50%] flex flex-col gap-3">
                                                <label class="heading-16 text-bkkNeutral-900">Judul Portofolio *</label>
                                                <input type="text" wire:model="portfolios.{{ $index }}.judul" placeholder="Contoh: Aplikasi Website Sekolah" class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"/>
                                                @error('portfolios.' . $index . '.judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="w-full md:w-[50%] flex flex-col gap-3">
                                                <label class="heading-16 text-bkkNeutral-900">Link Tambahan (Opsional)</label>
                                                <input type="text" wire:model="portfolios.{{ $index }}.link" placeholder="Contoh: https://github.com/saya/repo" class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"/>
                                            </div>
                                        </div>
                                        
                                        <div class="flex flex-col gap-3 mb-4">
                                            <label class="heading-16 text-bkkNeutral-900">Deskripsi Singkat</label>
                                            <textarea wire:model="portfolios.{{ $index }}.description" rows="3" placeholder="Ceritakan detail proyek ini..." class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 rounded-2xl py-3.5 px-6 focus:border-primary focus:ring-primary"></textarea>
                                        </div>
                                        
                                        <div class="flex flex-col gap-3 relative">
                                            <label class="heading-16 text-bkkNeutral-900">Gambar/Screenshot (Opsional)</label>
                                            <div class="paragraph-14r text-bkkNeutral-900 border border-bkkNeutral-200 bg-white rounded-2xl grid md:flex overflow-hidden relative">
                                                <div class="w-full md:w-[80%] px-6 py-3.5 flex items-center min-h-[48px]">
                                                    <div wire:loading wire:target="portfolios.{{ $index }}.image_path" class="absolute w-full h-full bg-white bg-opacity-80 flex items-center justify-center top-0 left-0">
                                                        <span class="paragraph-14r text-bkkNeutral-700 animate-pulse">Sedang mengunggah...</span>
                                                    </div>
                                                    
                                                    <div class="paragraph-14r text-bkkNeutral-700">
                                                        @if ($portfolios[$index]['image_path'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                                            <span>{{ $portfolios[$index]['image_path']->getClientOriginalName() }}</span>
                                                        @elseif (isset($portfolio['id']) && $portfolio['image_path'])
                                                            <a href="{{ Storage::url($portfolio['image_path']) }}" target="_blank" class="text-primary hover:underline">Lihat Gambar Saat Ini</a>
                                                        @else
                                                            <span>Belum ada gambar dipilih</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <input class="hidden" id="porto-img-{{ $index }}" type="file" wire:model.live="portfolios.{{ $index }}.image_path" accept=".jpg,.jpeg,.png" />
                                                
                                                <label for="porto-img-{{ $index }}" class="w-full md:w-[20%] flex justify-center items-center cursor-pointer paragraph-14r text-bkkNeutral-900 bg-bkkNeutral-100 py-3.5 hover:bg-bkkNeutral-200 transition text-center whitespace-nowrap px-4">
                                                    Pilih Gambar
                                                </label>
                                            </div>
                                            @error('portfolios.' . $index . '.image_path') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @if(count($portfolios) === 0)
                                    <div class="text-center py-8 bg-bkkNeutral-50 rounded-2xl border border-dashed border-bkkNeutral-300">
                                        <p class="paragraph-14r text-bkkNeutral-500">Belum ada portofolio ditambahkan.</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <hr class="border-t border-bkkNeutral-200 my-8">
                            
                            <div class="flex flex-col-reverse md:flex-row justify-end gap-4 mt-8">
                                <a href="{{ route('cv.download') }}" target="_blank" class="w-full md:w-auto px-6 py-3 bg-white border border-primary text-primary paragraph-16s hover:bg-primary-light rounded-lg text-center cursor-pointer transition duration-300">
                                    Unduh CV Otomatis
                                </a>
                                <button 
                                    type="submit" 
                                    wire:loading.attr="disabled"
                                    wire:target="submitPersonal"
                                    class="w-full md:w-auto px-6 py-3 bg-primary paragraph-16s hover:bg-primary-hover text-bkkNeutral-50 rounded-lg cursor-pointer transition duration-300">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
