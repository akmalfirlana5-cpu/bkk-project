<div
    class="relative"
    >
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('/assets/static/background/hero-section.png') }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('perusahaan') }}">Perusahaan</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    Perusahaan
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[50%]">
                    Informasi profil perusahaan mitra yang bekerja sama, meliputi bidang usaha, lokasi, dan gambaran umum perusahaan sebagai referensi bagi siswa dan alumni dalam mengenal perusahaan sebelum melamar pekerjaan.
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 lg:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <div class="flex flex-col md:flex-row items-start md:items-end gap-3 mb-10">
                <div class="w-full md:w-[90%]">
                    <div class="heading-16 mb-3">Kata Kunci Perusahaan</div>
                    <div class="relative">
                        <input 
                            class="py-3 px-6 border border-bkkNeutral-200 rounded-xl w-full focus:ring-primary focus:border-primary paragraph-14r"
                            wire:model.live.debounce.500ms="filterSearch"
                            type="text"
                            placeholder="Masukkan kata kunci perusahaan atau lokasi"
                        />
                    </div>
                </div>
                <div class=" md:w-[10%]">
                    <button 
                        class="md:w-full py-2 md:py-3 px-6 bg-primary rounded-xl text-bkkNeutral-50 paragraph-16s cursor-pointer hover:bg-primary-hover transition duration-300"
                    >
                        Cari
                    </button>
                </div>
            </div>
            <div
                x-data="{ openModal: false,  modalIndex: null }"
                x-init="$watch('openModal', value => document.body.style.overflow = value ? 'hidden' : 'auto')"
                >
                <h2 class="heading-42s text-bkkNeutral-900 mb-9">Cari Perusahaan</h2>
                <div 
                    class="flex flex-col gap-8 relative">
                    {{-- Companies Card --}}
                    <div id="lowongan" class="w-full scroll-mt-25">
                        <div wire:loading.class="opacity-50" class="grid grid-cols-1 md:grid-cols-2 items-start gap-6">
                            @forelse ( $companies as $company )
                            <div class="w-full p-6 bg-white shadow-lg rounded-[20px] my-2">
                                <div class="flex flex-col lg:flex-row gap-6 justify-between items-start">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg    flex-shrink-0">
                                            <img 
                                                src="{{ $company->companies_logo 
                                                ? \Illuminate\Support\Facades\Storage::url($company->companies_logo) 
                                                : asset('assets/static/partial/fallbackUser.webp') }}" 
                                                class="w-full h-full object-cover object-center">
                                        </div>
                                        <div 
                                            x-data="{companiesName: '{{ $company->companies_name }}'}"
                                            class="space-y-1">
                                            <h3 
                                                class="heading-20s text-black capitalize"
                                                x-text="companiesName.length > 30 ? companiesName.substring(0, 30) + '...' : companiesName">
                                            </h3>
                                        </div>
                                    </div>
                                    @if (
                                            $company->mou                          
                                        )
                                    <div class="paragraph-12s text-bkkYellow-800 bg-bkkYellow-600 my-2 lg:my-0 lg:mt-4 px-2 py-1 rounded-md">
                                        MoU
                                    </div>
                                    @endif
                                </div>
                                <div class="space-y-2 mt-6">
                                    <div class="flex items-center gap-4">
                                        <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                                            {{ $company->short_address }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700">
                                            {{ $company->field }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.75 15.7499C18.75 14.0083 17.0804 12.5267 14.75 11.9775M12.75 15.75C12.75 13.5409 10.0637 11.75 6.75 11.75C3.43629 11.75 0.75 13.5409 0.75 15.75M12.75 8.75C14.9591 8.75 16.75 6.95914 16.75 4.75C16.75 2.54086 14.9591 0.75 12.75 0.75M6.75 8.75C4.54086 8.75 2.75 6.95914 2.75 4.75C2.75 2.54086 4.54086 0.75 6.75 0.75C8.95914 0.75 10.75 2.54086 10.75 4.75C10.75 6.95914 8.95914 8.75 6.75 8.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700">
                                            {{ $company->employee }} karyawan
                                        </div>
                                    </div>
                                </div>
                                {{-- Divider --}}
                                <div class="h-[1.5px] w-full bg-bkkNeutral-200 my-5"></div>
                                <div class="flex flex-col lg:flex-row justify-between items-start gap-6 lg:gap-0 lg:items-center ">
                                    <div class="paragraph-14r text-bkkNeutral-700">
                                        Bergabung pada tahun 
                                        {{ \Carbon\Carbon::parse( $company->created_at )->translatedFormat('Y') }}
                                    </div>
                                    <a 
                                        @click="openModal = true; modalIndex = {{ $company->id }}"
                                        class="w-full lg:w-auto text-center lg:text-start paragraph-16s text-bkkNeutral-50 bg-primary hover:bg-primary-hover py-3 px-4 rounded-[12px] transition duration-300 cursor-pointer">
                                        Detail Perusahaan
                                    </a>
                                </div>
                            </div>
                            {{-- Detail perusahaan modal --}}
                            <div
                                x-show="openModal && modalIndex == {{ $company->id }}"
                                x-cloak
                                class="fixed bg-black/15 inset-0 flex items-end justify-center z-50 pt-[15vh] pb-[5vh]">
                                <div 
                                    @click.outside = "openModal = false"
                                    class="w-full md:w-[80vw] h-full px-8 pt-8 bg-bkkNeutral-50 rounded-2xl relative mx-5 lg:mx-0 overflow-auto">
                                    {{-- close button --}}
                                    <div 
                                        @click="openModal = false"
                                        class="absolute top-4 right-4 text-bkkNeutral-900 cursor-pointer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col lg:flex-row gap-6 justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg    flex-shrink-0">
                                                <img 
                                                    src="{{ $company->companies_logo 
                                                    ? \Illuminate\Support\Facades\Storage::url($company->companies_logo) 
                                                    : asset('assets/static/partial/fallbackUser.webp') }}" 
                                                    class="w-full h-full object-cover object-center">
                                            </div>
                                            <div 
                                                class="space-y-1">
                                                <h3 
                                                    class="heading-20s text-black capitalize">
                                                    {{ $company->companies_name }}
                                                </h3>
                                            </div>
                                        </div>
                                        @if (
                                                $company->mou                          
                                            )
                                        <div class="paragraph-12s text-bkkYellow-800 bg-bkkYellow-600 my-2 lg:my-0 lg:mt-4 px-2 py-1 rounded-md">
                                            MoU
                                        </div>
                                        @endif
                                    </div>
                                    <div class="space-y-2 mt-6">
                                        <div class="flex items-center gap-4">
                                            <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                                                {{ $company->short_address }}
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <div class="paragraph-16r text-bkkNeutral-700">
                                                {{ $company->field }}
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.75 15.7499C18.75 14.0083 17.0804 12.5267 14.75 11.9775M12.75 15.75C12.75 13.5409 10.0637 11.75 6.75 11.75C3.43629 11.75 0.75 13.5409 0.75 15.75M12.75 8.75C14.9591 8.75 16.75 6.95914 16.75 4.75C16.75 2.54086 14.9591 0.75 12.75 0.75M6.75 8.75C4.54086 8.75 2.75 6.95914 2.75 4.75C2.75 2.54086 4.54086 0.75 6.75 0.75C8.95914 0.75 10.75 2.54086 10.75 4.75C10.75 6.95914 8.95914 8.75 6.75 8.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <div class="paragraph-16r text-bkkNeutral-700">
                                                {{ $company->employee }} karyawan
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paragraph-16r text-bkkNeutral-700 mt-5">
                                        Bergabung pada tahun 
                                        {{ \Carbon\Carbon::parse( $company->created_at )->translatedFormat('Y') }}
                                    </div>
                                    {{-- Divider --}}
                                    <div class="h-px w-full bg-bkkNeutral-200 my-6"></div>
                                    <div class="paragraph-16r text-bkkNeutral-700">
                                        
                                        {{ $company->companies_profile 
                                        ? \Filament\Forms\Components\RichEditor\RichContentRenderer::make($company->companies_profile)
                                        : 'Belum ada deskripsi perusahaan' }}
                                    </div>
                                    <h3 
                                        class="heading-20s text-black capitalize mt-6">
                                        Alamat Lengkap Perusahaan
                                    </h3>
                                    <div class="paragraph-16r text-bkkNeutral-700 mt-2">
                                        {{ $company->address ?? 'Belum ada alamat perusahaan' }}
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-span-2 flex flex-col items-center justify-center py-20 px-6 bg-white rounded-[32px] border border-bkkNeutral-100 shadow-sm">
                                    <div class="w-24 h-24 bg-bkkBlue-50 text-primary rounded-full flex items-center justify-center mb-6">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.5 15.5L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9 7V5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>

                                    <h2 class="heading-32s text-bkkNeutral-900 mb-2">Lowongan Belum Tersedia</h2>
                                    <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm">
                                        Saat ini belum ada lowongan yang sesuai. Silakan cek kembali nanti atau coba kata kunci lain.
                                    </p>
                                </div>
                            @endforelse
                        </div>  
                        <div class="mt-16 flex justify-center w-full">
                            {{ $companies->links(data: ['scrollTo' => '#lowongan']) }}
                        </div>
                    </div>                      
                </div>
            </div>
        </div>
    </section>
</div>


