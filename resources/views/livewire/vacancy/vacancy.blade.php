<div>
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('storage/' . $vacancyContent['lowongan']['hero_image']) }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('lowongan') }}">Lowongan</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    {{ $vacancyContent['lowongan']['hero_title'] }}
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[50%]">
                    {{ $vacancyContent['lowongan']['hero_description'] }}
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 lg:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <div class="flex flex-col md:flex-row items-start md:items-end gap-3 mb-10">
                <div class="w-full md:w-[90%]">
                    <div class="heading-16 mb-3">Kata Kunci Pekerjaan</div>
                    <div class="relative">
                        <input 
                            class="py-3 px-6 border border-bkkNeutral-200 rounded-xl w-full focus:ring-primary focus:border-primary paragraph-14r"
                            wire:model.live.debounce.500ms="filterSearch"
                            type="text"
                            placeholder="Masukkan kata kunci"
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
            <div>
                <h2 class="heading-42s text-bkkNeutral-900 mb-9">
                    {{ $vacancyContent['lowongan']['section_title'] }}
                </h2>
                <div class="flex flex-col lg:flex-row gap-8 relative">
                    {{-- Filter section --}}
                    <div 
                        class="w-full lg:w-[25%] p-6 shadow-md rounded-3xl lg:sticky top-24 self-start bg-white">
                        <div 
                            x-data="{close: true, closeCollapse: 'kompetensi'}"
                            class="paragraph-16r text-bkkNeutral-900">
                            <div
                                @click="close = !close; closeCollapse = 'kompetensi'"
                                class="flex items-center justify-between cursor-pointer"
                                >
                                <div>Kompetensi Keahlian</div>
                                <svg 
                                    class="transition duration-300"
                                    :class="close === true && closeCollapse == 'kompetensi' ? 'transform rotate-180' : ''" 
                                    width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L5 1L1 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div
                                x-show="close && closeCollapse == 'kompetensi'"
                                x-collapse
                                x-cloak
                                class="mt-4 space-y-1">
                                @foreach ( $kompetensiKeahlians as $kompetensi )
                                    <div class="flex items-center gap-3">
                                        <input 
                                            type="checkbox" 
                                            id="{{ $kompetensi }}" 
                                            value="{{ $kompetensi }}"
                                            wire:model.live="filterKompetensi"
                                            class="rounded-sm border-bkkNeutral-600" />
                                        <label for="{{ $kompetensi }}" class="">{{ $kompetensi }}</label>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                        {{-- divider --}}
                        <div class="border-t border-bkkNeutral-200 my-9"></div>
                        <div 
                            x-data="{close: true, closeCollapse: 'tipe'}"
                            class="paragraph-16r text-bkkNeutral-900">
                            <div
                                @click="close = !close; closeCollapse = 'tipe'"
                                class="flex items-center justify-between cursor-pointer"
                                >
                                <div>Tipe Pekerjaan</div>
                                <svg 
                                    class="transition duration-300"
                                    :class="close === true && closeCollapse == 'tipe' ? 'transform rotate-180' : ''" 
                                    width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L5 1L1 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div
                                x-show="close && closeCollapse == 'tipe'"
                                x-collapse
                                x-cloak
                                class="mt-4 space-y-1">
                                @foreach ( $tipePekerjaans as $tipe )
                                    <div class="flex items-center gap-3">
                                        <input 
                                            type="checkbox" 
                                            id="{{ $tipe }}" 
                                            value="{{ $tipe }}"
                                            wire:model.live="filterTipe"
                                            class="rounded-sm border-bkkNeutral-600" />
                                        <label for="{{ $tipe }}" class="">{{ $tipe }}</label>
                                    </div>
                                 @endforeach                              
                            </div>
                        </div>
                        {{-- divider --}}
                        <div class="border-t border-bkkNeutral-200 my-9"></div>
                        <div 
                            x-data="{close: true, closeCollapse: 'diperbarui'}"
                            class="paragraph-16r text-bkkNeutral-900">
                            <div
                                @click="close = !close; closeCollapse = 'diperbarui'"
                                class="flex items-center justify-between cursor-pointer"
                                >
                                <div>Terakhir Diperbarui</div>
                                <svg 
                                    class="transition duration-300"
                                    :class="close === true && closeCollapse == 'diperbarui' ? 'transform rotate-180' : ''" 
                                    width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L5 1L1 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div
                                x-show="close && closeCollapse == 'diperbarui'"
                                x-collapse
                                x-cloak
                                class="mt-4 space-y-1">
                                @foreach ( $terakhirDiperbarui as $diperbarui )
                                    <div class="flex items-center gap-3">
                                        <input 
                                            type="checkbox" 
                                            id="{{ $diperbarui }}" 
                                            value="{{ $diperbarui }}"
                                            wire:model.live="filterTerakhirDiperbarui"
                                            class="rounded-full border-bkkNeutral-600" />
                                        <label for="{{ $diperbarui }}" class="">{{ $diperbarui }}</label>
                                    </div>
                                 @endforeach                      
                            </div>
                        </div>
                    </div>
                    {{-- Job Vacancy Card --}}
                    <div id="lowongan" class="w-full lg:w-[75%] scroll-mt-25">
                        <div wire:loading.class="opacity-50" class="grid grid-cols-1 md:grid-cols-2 items-start gap-6">
                            @forelse ( $vacancies as $vacancy )
                            <div class="w-full p-6 bg-white shadow-lg rounded-[20px] my-2">
                                <div class="flex flex-col lg:flex-row gap-6 justify-between items-start">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg flex-shrink-0">
                                            <img 
                                                src="{{ $vacancy->company->companies_logo 
                                                ? \Illuminate\Support\Facades\Storage::url($vacancy->company->companies_logo) 
                                                : asset('assets/static/partial/fallbackUser.webp') }}" 
                                                class="w-full h-full object-cover object-center">
                                        </div>
                                        <div 
                                            x-data="{vacancyName: '{{ $vacancy->vacancy_name }}'}"
                                            class="space-y-1">
                                            <h3 
                                                class="heading-20s text-black capitalize"
                                                @if (
                                                    $vacancies->onFirstPage() &&               
                                                    $loop->index < 4 &&                        
                                                    $userMajor &&                              
                                                    in_array($userMajor, $vacancy->major)
                                                )
                                                    x-text="vacancyName.length > 15 ? vacancyName.substring(0, 15) + '...' : vacancyName"
                                                @else
                                                    x-text="vacancyName.length > 25 ? vacancyName.substring(0, 25) + '...' : vacancyName"
                                                @endif>
                                            </h3>
                                            <div class="paragraph-14r text-bkkNeutral-700 capitalize">
                                                {{ $vacancy->company->companies_name }}
                                            </div>
                                        </div>
                                    </div>
                                    @if (
                                        $vacancies->onFirstPage() &&               
                                        $loop->index < 4 &&                        
                                        $userMajor &&                              
                                        in_array($userMajor, $vacancy->major)      
                                        )
                                    <div class="paragraph-12s text-bkkYellow-800 bg-bkkYellow-600 my-2 lg:my-0 lg:mt-4 px-2 py-1 rounded-md">
                                        Rekomendasi
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
                                            {{ $vacancy->company->short_address }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700 line-clamp-1">
                                            @foreach ( $vacancy->major as $major)
                                                {{ $major }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <svg class="shrink-0 w-5 h-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.75 4.75V9.75H14.75M9.75 18.75C4.77944 18.75 0.75 14.7206 0.75 9.75C0.75 4.77944 4.77944 0.75 9.75 0.75C14.7206 0.75 18.75 4.77944 18.75 9.75C18.75 14.7206 14.7206 18.75 9.75 18.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                                            {{ $vacancy->employment_classification }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <svg class="shrink-0 w-5 h-5" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.75 2.75V1.75C5.75 1.48478 5.85536 1.23043 6.04289 1.04289C6.23043 0.855357 6.48478 0.75 6.75 0.75H17.75C18.0152 0.75 18.2696 0.855357 18.4571 1.04289C18.6446 1.23043 18.75 1.48478 18.75 1.75V8.75C18.75 9.01522 18.6446 9.26957 18.4571 9.45711C18.2696 9.64464 18.0152 9.75 17.75 9.75H16.75M0.75 13.75V6.75C0.75 6.48478 0.855357 6.23043 1.04289 6.04289C1.23043 5.85536 1.48478 5.75 1.75 5.75H12.75C13.0152 5.75 13.2696 5.85536 13.4571 6.04289C13.6446 6.23043 13.75 6.48478 13.75 6.75V13.75C13.75 14.0152 13.6446 14.2696 13.4571 14.4571C13.2696 14.6446 13.0152 14.75 12.75 14.75H1.75C1.48478 14.75 1.23043 14.6446 1.04289 14.4571C0.855357 14.2696 0.75 14.0152 0.75 13.75ZM8.75 10.25C8.75 10.6478 8.59196 11.0294 8.31066 11.3107C8.02936 11.592 7.64782 11.75 7.25 11.75C6.85218 11.75 6.47064 11.592 6.18934 11.3107C5.90804 11.0294 5.75 10.6478 5.75 10.25C5.75 9.85218 5.90804 9.47064 6.18934 9.18934C6.47064 8.90804 6.85218 8.75 7.25 8.75C7.64782 8.75 8.02936 8.90804 8.31066 9.18934C8.59196 9.47064 8.75 9.85218 8.75 10.25Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                        <div class="paragraph-16r text-bkkNeutral-700">
                                            {{ 'Rp ' . number_format($vacancy->salary, 0, ',', '.') . ' / bulan'}}
                                        </div>
                                    </div>
                                </div>
                                {{-- Divider --}}
                                <div class="h-[1.5px] w-full bg-bkkNeutral-200 my-5"></div>
                                <div class="flex flex-col lg:flex-row justify-between items-start gap-6 lg:gap-0 lg:items-center ">
                                    <div class="paragraph-14r text-bkkNeutral-700">
                                        Lamar sebelum {{ \Carbon\Carbon::parse( $vacancy->deadline )->translatedFormat('d F Y') }}
                                    </div>
                                    <a 
                                        href="{{ route('lowongan-detail', ['id' => $vacancy->entryId]) }}" 
                                        class="w-full lg:w-auto text-center lg:text-start paragraph-16s text-bkkNeutral-50 bg-primary hover:bg-primary-hover py-3 px-4 rounded-[12px] transition duration-300">
                                        Detail Lowongan
                                    </a>
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
                            {{ $vacancies->links(data: ['scrollTo' => '#lowongan']) }}
                        </div>
                    </div>                      
                </div>
            </div>
        </div>
    </section>
</div>

