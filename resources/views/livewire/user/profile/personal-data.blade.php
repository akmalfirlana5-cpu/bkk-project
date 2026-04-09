<div>
    <section class="py-30 lg:py-25">
        <div class="container mx-auto px-5 lg:px-0">
            <h1 class="heading-42s text-bkkNeutral-900 mb-9">Profil Saya</h1>
            <div class="rounded-3xl shadow-lg overflow-hidden">
                <div class="flex items-center h-[64px] bg-primary-light">
                    <div class="h-full paragraph-16s text-primary flex items-center gap-3 px-6 ">
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
                                        NISN
                                    </label>
                                    <input 
                                        id="nisn"
                                        type="text" 
                                        wire:model="personal.nisn" 
                                        placeholder="Masukkan NISN"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.nisn')
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
                                    <label 
                                        for="domisili" 
                                        class="heading-16 text-bkkNeutral-900">
                                        Alamat Domisili
                                    </label>
                                    <input 
                                        id="domisili"
                                        type="text" 
                                        wire:model="personal.domisili" 
                                        placeholder="Masukkan alamat domisili"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.domisili')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label 
                                        for="no_hp" 
                                        class="heading-16 text-bkkNeutral-900">
                                        No WhatsApp Aktif
                                    </label>
                                    <input 
                                        id="no_hp"
                                        type="number" 
                                        wire:model="personal.no_hp" 
                                        placeholder="Masukkan no whatsApp aktif"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.no_hp')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 lg:gap-4">
                                <div class="w-full md:w-[50%] relative">
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
                                <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                    <label 
                                        for="portofolio" 
                                        class="heading-16 text-bkkNeutral-900">
                                        LinkedIn / Portofolio (Opsional)
                                    </label>
                                    <input 
                                        id="portofolio"
                                        type="text" 
                                        wire:model="personal.portofolio" 
                                        placeholder="Masukkan linkedIn / portofolio"
                                        class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                        border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                    <div class="absolute -bottom-6">
                                        @error('personal.portofolio')
                                            <span class="text-red-500 text-xs ">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button 
                                    type="submit" 
                                    wire:loading.attr="disabled"
                                    wire:target="submitPersonal"
                                    class="w-full lg:w-auto justify-self-end px-6 py-3 bg-primary paragraph-16s hover:bg-primary-hover text-bkkNeutral-50 rounded-lg cursor-pointer transition duration-300">
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
