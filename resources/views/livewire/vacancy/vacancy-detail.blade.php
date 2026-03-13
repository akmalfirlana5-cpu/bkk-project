<div>
    @if ($vacancy->image)
      <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('storage/' . $vacancy->image) }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
        </div>
        </section>  
    @endif
    <section class="@if ($vacancy->image) py-15 lg:py-20 @else py-30 lg:py-25 @endif">
        <div class="container flex flex-col lg:flex-row items-start gap-16 mx-auto px-5 lg:px-0 relative">
            <div class="w-full lg:w-[60%]">
                <div class="w-20 h-20 rounded-full overflow-hidden shadow-lg mb-6">
                    <img 
                        src="{{ $vacancy->company->companies_logo 
                            ? \Illuminate\Support\Facades\Storage::url($vacancy->company->companies_logo) 
                            : asset('assets/static/partial/fallbackUser.webp') }}" 
                        class="w-full h-full object-cover object-center">
                </div>
                <h1 class="heading-42s text-bkkNeutral-900 mb-1 capitalize">
                    {{ $vacancy->vacancy_name }}
                </h1>
                <div class="paragraph-20r text-bkkNeutral-700 mb-6 capitalize">
                    {{ $vacancy->company->companies_name }} 
                </div>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center gap-4">
                        <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                            {{ $vacancy->location }}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                            @foreach ($vacancy->major as $major)
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
                <div class="flex items-center pargraph-16r text-bkkNeutral-600 gap-3 mb-6">
                    <div>
                        Lamar sebelum 
                        {{ \Carbon\Carbon::parse( $vacancy->deadline )->translatedFormat('d F Y') }}
                    </div>
                    {{-- divider --}}
                    <div class="w-[1.5px] h-3.5 bg-bkkNeutral-300"></div>
                    <div class="flex gap-1 items-center">
                        <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.4167 12.75C11.4167 10.9091 9.02885 9.41667 6.08333 9.41667C3.13781 9.41667 0.75 10.9091 0.75 12.75M6.08333 7.41667C4.24238 7.41667 2.75 5.92428 2.75 4.08333C2.75 2.24238 4.24238 0.75 6.08333 0.75C7.92428 0.75 9.41667 2.24238 9.41667 4.08333C9.41667 5.92428 7.92428 7.41667 6.08333 7.41667Z" stroke="#596B88" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div>{{ $vacancy->vacancy_number }} orang</div>
                    </div>
                </div>
                {{-- Tampilkan jika loker tipenya bkk --}}
                @if ($vacancy->loker_tipe == 'kebkk')
                    @if (session()->has('error_cv'))
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 paragraph-14r">
                            Anda belum melengkapi CV. Silakan melengkapi 
                            <a href="{{ route('data-pribadi') }}" class="font-bold underline text-red-700 hover:text-red-800">
                                Data Diri Anda
                            </a> 
                            terlebih dahulu sebelum melamar.
                        </div>
                    @endif
                    <div 
                        wire:click="applyNow"
                        wire:loading.attr="disabled"
                        class="py-3 px-6 {{ $alredyApplied 
                        ? 'bg-bkkNeutral-200 text-bkkNeutral-500'
                        : 'bg-bkkBlue-700 hover:bg-bkkBlue-800 text-bkkNeutral-50' }} 
                        rounded-lg w-max paragraph-16s cursor-pointer transition duration-300 
                        @if ($alredyApplied) pointer-events-none @endif">
                        <span wire:loading.remove wire:target="applyNow">
                            @if ($alredyApplied)
                                Sudah dilamar
                            @else
                                Lamar sekarang
                            @endif
                        </span>

                        <span wire:loading wire:target="applyNow">
                            Mengirim..
                        </span>
                    </div>
                @endif
                {{-- Divider --}}
                <div class="w-full h-px bg-bkkNeutral-200 my-12"></div>
                <div class="heading-20s text-bkkNeutral-900 mb-4">Kualifikasi</div>
                <div class="dynamic-vacancy mb-9">
                    {{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($vacancy->requirements) }}
                </div>
                {{-- Tampilkan jika tipe loker ke perusahaan --}}
                @if ($vacancy->loker_tipe == 'keperusahaan')
                    <div class="heading-20s text-bkkNeutral-900 mb-4">Kontak Perusahaan</div>
                    <div class="paragraph-14r text-bkkNeutral-700 mb-2">Hubungi:</div>
                    <div class="flex items-center gap-3 paragraph-14r text-bkkNeutral-700 mb-2">
                        <svg class="w-4 h-4 shrink-0" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.25246 2.00722C6.94873 1.2479 6.21332 0.75 5.39551 0.75H2.64474C1.5983 0.75 0.75 1.5981 0.75 2.64453C0.75 11.5392 7.96078 18.75 16.8555 18.75C17.9019 18.75 18.75 17.9016 18.75 16.8552L18.7505 14.104C18.7505 13.2861 18.2527 12.5509 17.4934 12.2471L14.8569 11.1929C14.1749 10.9201 13.3983 11.0429 12.8339 11.5132L12.1535 12.0807C11.3589 12.7429 10.1896 12.6902 9.4582 11.9588L7.54222 10.0411C6.81079 9.30962 6.75673 8.14134 7.41895 7.34668L7.98633 6.6663C8.45661 6.10195 8.58049 5.32516 8.30766 4.64309L7.25246 2.00722Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>
                            {{ $vacancy->phone_company }}
                        </span>
                    </div>
                    <div class="flex items-center gap-3 paragraph-14r text-bkkNeutral-700 mb-9">
                        <svg class="w-4 h-4 shrink-0" width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.75 1.75L7.85764 6.36227L7.85967 6.36396C8.53785 6.86128 8.87714 7.1101 9.24876 7.20621C9.57723 7.29117 9.92251 7.29117 10.251 7.20621C10.6229 7.11001 10.9632 6.86047 11.6426 6.36227C11.6426 6.36227 15.5601 3.35594 17.75 1.75M0.75 11.5502V3.9502C0.75 2.83009 0.75 2.26962 0.967987 1.8418C1.15973 1.46547 1.46547 1.15973 1.8418 0.967987C2.26962 0.75 2.83009 0.75 3.9502 0.75H15.5502C16.6703 0.75 17.2296 0.75 17.6574 0.967987C18.0337 1.15973 18.3405 1.46547 18.5322 1.8418C18.75 2.2692 18.75 2.82899 18.75 3.94691V11.5536C18.75 12.6715 18.75 13.2305 18.5322 13.6579C18.3405 14.0342 18.0337 14.3405 17.6574 14.5322C17.23 14.75 16.671 14.75 15.5531 14.75H3.94691C2.82899 14.75 2.2692 14.75 1.8418 14.5322C1.46547 14.3405 1.15973 14.0342 0.967987 13.6579C0.75 13.2301 0.75 12.6703 0.75 11.5502Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>
                            {{ $vacancy->email_company }}
                        </span>
                    </div>
                @endif
                <div class="heading-20s text-bkkNeutral-900 mb-4">Profil Perusahaan</div>
                <div class="p-6 rounded-[20px] border border-bkkNeutral-200">
                    <div class="w-11 h-11 rounded-full overflow-hidden shadow-lg mb-4">
                        <img 
                            src="{{ $vacancy->company->companies_logo 
                            ? \Illuminate\Support\Facades\Storage::url($vacancy->company->companies_logo) 
                            : asset('assets/static/partial/fallbackUser.webp') }}" 
                            class="w-full h-full object-cover object-center">
                    </div>
                    <h1 class="heading-20s text-bkkNeutral-900 mb-3">
                        {{ $vacancy->company->companies_name }}
                    </h1>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-4">
                        <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="paragraph-16r text-bkkNeutral-700">
                            {{ $vacancy->company->address }}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="paragraph-16r text-bkkNeutral-700">
                            {{ $vacancy->company->field }}
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.75 15.7499C18.75 14.0083 17.0804 12.5267 14.75 11.9775M12.75 15.75C12.75 13.5409 10.0637 11.75 6.75 11.75C3.43629 11.75 0.75 13.5409 0.75 15.75M12.75 8.75C14.9591 8.75 16.75 6.95914 16.75 4.75C16.75 2.54086 14.9591 0.75 12.75 0.75M6.75 8.75C4.54086 8.75 2.75 6.95914 2.75 4.75C2.75 2.54086 4.54086 0.75 6.75 0.75C8.95914 0.75 10.75 2.54086 10.75 4.75C10.75 6.95914 8.95914 8.75 6.75 8.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="paragraph-16r text-bkkNeutral-700">
                            {{ $vacancy->company->employee }} karyawan
                        </div>
                    </div>  
                </div>
                <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                    {{ $vacancy->company->companies_profile }}
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[40%] lg:sticky top-20">
            <div class="heading-20s text-bkkNeutral-900 mb-6">
                Lowongan Lainnya Untukmu
            </div>
            <div class="flex flex-col gap-6">
                @forelse ($otherVacancies as $otherVacancy)
                    <div class="w-full p-6 bg-white shadow-lg rounded-[20px] my-2">
                        <div class="flex gap-4 items-start mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg">
                                <img 
                                    src="{{ $otherVacancy->company->companies_logo 
                                    ? \Illuminate\Support\Facades\Storage::url($otherVacancy->company->companies_logo) 
                                    : asset('assets/static/partial/fallbackUser.webp') }}"
                                    class="w-full h-full object-cover object-center">
                            </div>
                            <div class="space-y-1">
                                <h3 class="heading-20s text-black capitalize line-clamp-1">
                                    {{ $otherVacancy->vacancy_name }}
                                </h3>
                                <div class="paragraph-14r text-bkkNeutral-700 capitalize line-clamp-1">
                                    {{ $otherVacancy->company->companies_name }}
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-4">
                                <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="paragraph-16r text-bkkNeutral-700 capitalize">
                                    {{ $otherVacancy->location }}
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="paragraph-16r text-bkkNeutral-700 line-clamp-1 ">
                                    @foreach ($vacancy->major as $major)
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
                                Lamar sebelum 
                                {{ \Carbon\Carbon::parse( $vacancy->deadline )->translatedFormat('d F Y') }}
                            </div>
                            <a 
                                href="{{ route('lowongan-detail', $otherVacancy->entryId) }}" 
                                class="w-full lg:w-auto text-center lg:text-start paragraph-16s text-bkkNeutral-50 bg-bkkBlue-700 hover:bg-bkkBlue-800 py-3 px-4 rounded-[12px] transition duration-300">
                                Detail Lowongan
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="w-full flex flex-col items-center justify-center py-20 px-6 bg-white rounded-[32px] border border-bkkNeutral-100 shadow-sm">
                            <div class="w-24 h-24 bg-bkkBlue-50 rounded-full flex items-center justify-center mb-6">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5 15.5L19 19" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 7H19C20.1046 7 21 7.89543 21 9V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7Z" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 7V5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <h2 class="heading-32s text-bkkNeutral-900 mb-2 text-center">Lowongan Belum Tersedia</h2>
                            <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm">
                                Saat ini belum ada lowongan yang sesuai. Silakan cek kembali nanti atau coba kata kunci lain.
                            </p>
                        </div>
                @endforelse
            </div>
        </div>
        </div>
    </section>
</div>
