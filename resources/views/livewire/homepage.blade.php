<div>
<section class="pt-30 lg:pt-25">
    <div class="container mx-auto px-5 lg:px-0">
        <div class="swiper hero-swiper w-full h-[85vh] overflow-hidden rounded-[24px]">
            <div class="swiper-wrapper relative">
                @foreach ($heroSlides as $slides )
                    <div 
                    style="background-image: url('{{ asset( 'storage/' . $slides['image']) }}')"
                    class="swiper-slide bg-cover bg-center relative">
                        <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/20 z-1"></div>
                        <div class="absolute flex flex-col justify-end inset-0 z-2 px-5 lg:px-20 pb-[10vh]">
                            <h1 class="heading-48s text-bkkNeutral-50 mb-6 lg:w-[55%]">
                                {{ $slides['title'] }}
                            </h1>
                            <div class="paragraph-16r text-bkkNeutral-50 mb-6 lg:mb-16 lg:w-[65%]">
                                {{ $slides['description'] }}
                            </div>
                            <div class="flex justify-between items-center">
                                <a 
                                    href="{{ $slides['cta_link'] }}"
                                    class="flex items-center gap-3 paragraph-16s text-bkkNeutral-50 py-3 px-8 bg-bkkBlue-700 hover:bg-bkkBlue-800 rounded-[12px] transition duration-300">
                                    <span>{{ $slides['cta_text'] }}</span>
                                    <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>

                                {{-- Control Button --}}
                                <div class="hidden lg:flex items-center gap-4">
                                    <div class="heroSwiper-button-prev w-14 h-14 flex items-center justify-center text-white hover:text-black bg-white/10 hover:bg-white border border-white/60 transition duration-300 rounded-full cursor-pointer">
                                        <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.16667 17.3333L1 9.16667L9.16667 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="heroSwiper-button-next w-14 h-14 flex items-center justify-center text-white hover:text-black bg-white/10 hover:bg-white border border-white/60 transition duration-300 rounded-full cursor-pointer">
                                        <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L9.16667 9.16667L1 17.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Pagination --}}
                <div class="absolute mb-4 lg:mb-8 heroSwiper-pagination z-5 flex justify-center gap-1">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-15 md:py-20">
    <div class="container mx-auto px-5 lg:px-0 grid grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-0 w-[90%]">
         @foreach ($statisticContent as $statistic)
            <div class="flex flex-col items-center" 
                 x-data="{ 
                    current: 0, 
                    target: {{ $statistic['amount'] }}, 
                    time: 1000,
                    startCounter() {
                        let start = null;
                        const step = (timestamp) => {
                            if (!start) start = timestamp;
                            const progress = Math.min((timestamp - start) / this.time, 1);
                            this.current = Math.floor(progress * this.target);
                            if (progress < 1) {
                                window.requestAnimationFrame(step);
                            }
                        };
                        window.requestAnimationFrame(step);
                    }
                 }" 
                 x-intersect.once="startCounter()">
                
                <h2 class="heading-56s text-bkkNeutral-900 mb-2">
                    <span x-text="current.toLocaleString('id-ID')">0</span>{{ $statistic['suffix'] }}
                </h2>
                <div class="paragraph-16r text-center text-bkkNeutral-600">
                    {{ $statistic['title'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>
@if ( $homepageContent['welcome']['is_visible'] === 'true')
    <section class="py-15">
    <div class="container mx-auto px-5 lg:px-0 flex flex-col lg:flex-row items-start gap-12 lg:gap-18">
        <div class="w-full lg:w-[45%] shadow-lg rounded-[20px]">
            <img  
                class="w-full h-[250px] md:h-[324px] object-cover object-center rounded-t-[20px]"
                src="{{ asset( 'storage/' . $homepageContent['welcome']['image']) }}"/>
            <div class="p-6 space-y-2">
                <h3 class="heading-22s text-bkkNeutral-900">
                    {{ $homepageContent['welcome']['title'] }}
                </h3>
                <div class="paragraph-16r text-bkkNeutral-700">
                    {{ $homepageContent['welcome']['person_position'] }}
                </div>
            </div>
        </div>
        <div class="w-full lg:w-[55%]">
            <h2 class="heading-42s text-bkkNeutral-900 mb-4">
                {{ $homepageContent['welcome']['title'] }}
            </h2>
            <div class="paragraph-16r text-bkkNeutral-700 space-y-4">
                {{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make
                ($homepageContent['welcome']['content']) }}
            </div>
        </div>
    </div>
</section>
@endif
<section>
    <div class="container mx-auto px-5 lg:px-0 relative py-16 md:py-32">
        <h2 class="heading-42s text-bkkNeutral-900 mb-4">
            {{ $homepageContent['vacancies']['title'] }}
        </h2>
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-9 gap-6 lg:gap-0">
            <div class="paragraph-16r text-neutral-700">
                {{ $homepageContent['vacancies']['description'] }}
            </div>
            {{-- Control Button --}}
            <div class="flex items-center gap-4">
                <div class="lokerSwiper-button-prev w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.16667 17.3333L1 9.16667L9.16667 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="lokerSwiper-button-next w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L9.16667 9.16667L1 17.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="swiper loker-swiper w-full overflow-hidden rounded-[24px] mb-8">
            <div class="swiper-wrapper">
                @forelse ($vacancies as $vacancy)
                    <div class="swiper-slide p-6 bg-white shadow-lg rounded-[20px] my-2">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg">
                                <img 
                                    src="{{ asset('storage/' . $vacancy->company->companies_logo) }}" 
                                    class="w-full h-full object-cover object-center">
                            </div>
                            <div class="space-y-1">
                                <h3 class="heading-20s text-black line-clamp-1 capitalize">
                                    {{ $vacancy->vacancy_name }}
                                </h3>
                                <div class="paragraph-14r text-bkkNeutral-700">
                                    {{ $vacancy->company->companies_name }}
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-4">
                                <svg class="shrink-0 w-5 h-5" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 7.67285C0.75 12.5247 4.99448 16.5369 6.87319 18.0752C7.14206 18.2954 7.27811 18.4068 7.47871 18.4632C7.63491 18.5072 7.8648 18.5072 8.021 18.4632C8.22197 18.4067 8.35707 18.2963 8.62695 18.0754C10.5057 16.5371 14.7499 12.5251 14.7499 7.6733C14.7499 5.83718 14.0125 4.07605 12.6997 2.77772C11.387 1.47939 9.6066 0.75 7.75008 0.75C5.89357 0.75 4.11301 1.4795 2.80025 2.77783C1.4875 4.07616 0.75 5.83674 0.75 7.67285Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.75 7.75C5.75 8.85457 6.64543 9.75 7.75 9.75C8.85457 9.75 9.75 8.85457 9.75 7.75C9.75 6.64543 8.85457 5.75 7.75 5.75C6.64543 5.75 5.75 6.64543 5.75 7.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="paragraph-16r text-bkkNeutral-700">
                                    {{ $vacancy->location }}
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="shrink-0 w-5 h-5" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="paragraph-16r text-bkkNeutral-700 line-clamp-1">
                                    @foreach ($vacancy->major as $major)
                                        {{ $major }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="shrink-0 w-5 h-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.75 4.75V9.75H14.75M9.75 18.75C4.77944 18.75 0.75 14.7206 0.75 9.75C0.75 4.77944 4.77944 0.75 9.75 0.75C14.7206 0.75 18.75 4.77944 18.75 9.75C18.75 14.7206 14.7206 18.75 9.75 18.75Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="paragraph-16r text-bkkNeutral-700">
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
                                Terakhir di perbarui {{ \Carbon\Carbon::parse( $vacancy->updated_at )->translatedFormat('d F Y') }} 
                            </div>
                            <a 
                                href="{{ route('lowongan-detail', $vacancy->entryId) }}" 
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

                        <h2 class="heading-32s text-bkkNeutral-900 mb-2">Lowongan Belum Tersedia</h2>
                        <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm">
                            Saat ini belum ada lowongan yang sesuai. Silakan cek kembali nanti atau coba kata kunci lain.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
        {{-- Pagination --}}
        <div class="absolute mb-10 lokerSwiper-pagination z-5 flex justify-center gap-1">
        </div>
    </div>
</section>

<section class="py-15 md:py-24 px-5 lg:px-0">
    <div 
        style="background-image: url('{{ asset('/assets/static/background/Tracer-Home.webp') }}')"
        class="container mx-auto px-5 lg:px-16 py-8 lg:py-16 bg-white shadow-lg rounded-[24px] bg-cover bg-left">
        <h2 class="heading-42s text-bkkNeutral-900 mb-4">
            {{ $homepageContent['tracer_study']['title'] }}
        </h2>
        <div class="paragraph-16r text-bkkNeutral-700 mb-10 lg:mb-[56px]">
            {{ $homepageContent['tracer_study']['description'] }}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-14">
            <div class="flex flex-col items-start p-6 shadow-md rounded-[20px] bg-white">
                <div class="p-2 rounded-[12px] border border-bkkNeutral-100 mb-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 15L21 21M10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 13.866 13.866 17 10 17Z" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="heading-20s text-black mb-3">
                    {{ $homepageContent['tracer_study']['card_1_title'] }}
                </h3>
                <div class="paragraph-16r text-bkkNeutral-700">
                    {{ $homepageContent['tracer_study']['card_1_description'] }}
                </div>
            </div>
            <div class="flex flex-col items-start p-6 shadow-md rounded-[20px] bg-white">
                <div class="p-2 rounded-[12px] border border-bkkNeutral-100 mb-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 15.0002V16.8C3 17.9201 3 18.4798 3.21799 18.9076C3.40973 19.2839 3.71547 19.5905 4.0918 19.7822C4.5192 20 5.07899 20 6.19691 20H21.0002M3 15.0002V5M3 15.0002L6.8534 11.7891L6.85658 11.7865C7.55366 11.2056 7.90288 10.9146 8.28154 10.7964C8.72887 10.6567 9.21071 10.6788 9.64355 10.8584C10.0105 11.0106 10.3323 11.3324 10.9758 11.9759L10.9822 11.9823C11.6357 12.6358 11.9633 12.9635 12.3362 13.1153C12.7774 13.2951 13.2685 13.3106 13.7207 13.1606C14.1041 13.0334 14.4542 12.7275 15.1543 12.115L21 7" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="heading-20s text-black mb-3">
                    {{ $homepageContent['tracer_study']['card_2_title'] }}
                </h3>
                <div class="paragraph-16r text-bkkNeutral-700">
                    {{ $homepageContent['tracer_study']['card_1_description'] }}
                </div>
            </div>
            <div class="flex flex-col items-start p-6 shadow-md rounded-[20px] bg-white">
                <div class="p-2 rounded-[12px] border border-bkkNeutral-100 mb-4">
                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 17.75H2.75M2.75 17.75H12.75M2.75 17.75V3.9502C2.75 2.83009 2.75 2.26962 2.96799 1.8418C3.15973 1.46547 3.46547 1.15973 3.8418 0.967987C4.26962 0.75 4.83009 0.75 5.9502 0.75H9.5502C10.6703 0.75 11.2296 0.75 11.6574 0.967987C12.0337 1.15973 12.3405 1.46547 12.5322 1.8418C12.75 2.2692 12.75 2.82899 12.75 3.94691V9.75M12.75 17.75H18.75M12.75 17.75V9.75M18.75 17.75H20.75M18.75 17.75V9.75C18.75 8.81812 18.7499 8.35241 18.5977 7.98486C18.3947 7.49481 18.0057 7.10523 17.5156 6.90224C17.1481 6.75 16.6816 6.75 15.7497 6.75C14.8179 6.75 14.3519 6.75 13.9844 6.90224C13.4943 7.10523 13.1052 7.49481 12.9022 7.98486C12.75 8.35241 12.75 8.81812 12.75 9.75M5.75 7.75H9.75M5.75 4.75H9.75" stroke="#364153" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="heading-20s text-black mb-3">
                    {{ $homepageContent['tracer_study']['card_3_title'] }}
                </h3>
                <div class="paragraph-16r text-bkkNeutral-700">
                    {{ $homepageContent['tracer_study']['card_3_description'] }}
                </div>
            </div>
        </div>
        <a  href="{{ $homepageContent['tracer_study']['cta_link'] }}"
            class="w-full lg:w-auto justify-self-center flex justify-center items-center gap-3 py-3 px-6 bg-bkkBlue-700 hover:bg-bkkBlue-800 transition duration-300 rounded-[8px] group">
            <span class="paragraph-16s text-bkkNeutral-50">
                {{ $homepageContent['tracer_study']['cta_text'] }}
            </span>
            <svg class="shrink-0 group-hover:translate-x-1 transition duration-300" width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </a>
    </div>
</section>

<section>  
    <div class="container mx-auto px-5 lg:px-0 relative py-16 md:py-32">
        <h2 class="heading-42s text-bkkNeutral-900 mb-4">
            {{ $homepageContent['announcements']['title'] }}
        </h2>
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-9 gap-6 lg:gap-0">
            <div class="paragraph-16r text-neutral-700">
                {{ $homepageContent['announcements']['description'] }}
            </div>
            {{-- Control Button --}}
            <div class="flex items-center gap-4">
                <div class="beritaSwiper-button-prev w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.16667 17.3333L1 9.16667L9.16667 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="beritaSwiper-button-next w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L9.16667 9.16667L1 17.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="swiper berita-swiper w-full overflow-hidden mb-8">
            <div class="swiper-wrapper">
                @forelse ($announcements as $announcement)
                    <div class="swiper-slide bg-white shadow-lg overflow-hidden rounded-[20px] my-2">
                        <div class="w-full h-[256px]">
                            <img 
                                class="w-full h-full object-cover object-center"
                                src="{{ $announcement->image 
                                    ? asset('storage/' . $announcement->image)
                                    : asset('assets/static/partial/fallbackUser.webp') }}" />
                        </div>
                        <div class="p-5 lg:p-6">
                            <h3 class="heading-20s text-black line-clamp-1 mb-4">
                                {{$announcement->headline}}
                            </h3>
                            <div class="dynamic-announce line-clamp-3">
                                {{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($announcement->content) }}
                            </div>
                            {{-- Divider --}}
                            <div class="h-[1px] w-full bg-bkkNeutral-200 my-8"></div>
                            <div class="flex flex-col lg:flex-row justify-between items-start gap-8 lg:gap-0 lg:items-center ">
                                <div class="paragraph-14r text-bkkNeutral-700">
                                    Diunggah pada {{ $announcement->created_at->translatedFormat('d F Y') }}
                                </div>
                                <a  href="{{ route('pengumuman-detail', $announcement->id) }}"
                                    class="w-full lg:w-auto justify-self-center flex justify-center items-center gap-3 py-3 px-6 bg-bkkBlue-700 hover:bg-bkkBlue-800 transition duration-300 rounded-[8px] group">
                                    <span class="paragraph-16s text-bkkNeutral-50">Baca Selengkapnya</span>
                                    <svg class="shrink-0 group-hover:translate-x-1 transition duration-300" width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                <div class="w-full flex flex-col items-center justify-center py-20 px-6 bg-white rounded-[32px] border border-bkkNeutral-100 shadow-sm">
                    <div class="w-24 h-24 bg-bkkBlue-50 rounded-full flex items-center justify-center mb-6">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 6H6C4.89543 6 4 6.89543 4 8V16C4 17.1046 4.89543 18 6 18H11L15 21V3L11 6Z" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 8C20.1046 8 21 8.89543 21 10V14C21 15.1046 20.1046 16 19 16" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 12H17" stroke="#073AE4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h2 class="heading-32s text-bkkNeutral-900 mb-2">Belum Ada Pengumuman</h2>
                    <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm">
                        Saat ini tidak ada pengumuman resmi yang aktif. Pantau terus halaman ini untuk mendapatkan informasi terbaru dari BKK.
                    </p>
                </div>
                @endforelse
            </div>
        </div>
        {{-- Pagination --}}
        <div class="absolute mb-10 beritaSwiper-pagination z-5 flex justify-center gap-1">
        </div>
    </div>
</section>

<section class="py-16 md:py-24 px-5 lg:px-0">  
    <div class="container mx-auto px-5 lg:px-16 py-8 lg:py-24 bg-white shadow-lg rounded-[24px]">
        <div class="flex flex-col-reverse lg:flex-row items-center gap-5 md:gap-10">
            <div class="w-full lg:w-[50%]">
                <h2 class="heading-42s text-bkkNeutral-900 mb-4">
                    {{ $homepageContent['survey']['title'] }}
                </h2>
                <div class="paragraph-16r text-bkkNeutral-700 mb-12">
                    {{ $homepageContent['survey']['description'] }}
                </div>
                <a  href="{{ $homepageContent['tracer_study']['cta_link'] }}"
                    class="w-full lg:w-auto justify-self-start flex justify-center items-center gap-3 py-3 px-6 bg-bkkBlue-700 hover:bg-bkkBlue-800 transition duration-300 rounded-[8px] group">
                    <span class="paragraph-16s text-bkkNeutral-50">
                        {{ $homepageContent['survey']['cta_text'] }}
                    </span>
                    <svg class="shrink-0 group-hover:translate-x-1 transition duration-300" width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="w-full lg:w-[50%]">
                <img 
                    src="{{ asset('/assets/static/background/survey-bg.png') }}" 
                    class="w-full h-[250px] md:h-[350px] object-contain object-center">
            </div>
    </div>
</section>

<section>  
    <div class="container mx-auto px-5 lg:px-0 relative py-16 md:py-32">
        <h2 class="heading-42s text-bkkNeutral-900 mb-4">Testimoni Alumni</h2>
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-9 gap-6 lg:gap-0">
            <div class="paragraph-16r text-neutral-700">Cerita sukses alumni SMK Negeri 4 Malang setelah bekerja melalui BKK.</div>
            {{-- Control Button --}}
            <div class="flex items-center gap-4">
                <div class="testimoniSwiper-button-prev w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.16667 17.3333L1 9.16667L9.16667 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="testimoniSwiper-button-next w-12 h-12 flex items-center justify-center text-bkkNeutral-600 hover:text-bkkNeutral-50 bg-transparent hover:bg-bkkNeutral-600 border border-bkkNeutral-600 transition duration-300 rounded-full cursor-pointer">
                    <svg class="shrink-0" width="11" height="19" viewBox="0 0 11 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L9.16667 9.16667L1 17.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="swiper testimoni-swiper w-full overflow-hidden rounded-[24px] mb-8">
            <div class="swiper-wrapper">
                @foreach ($testimoniSwiperContent as $testimoni)
                    <div class="swiper-slide p-6 bg-white shadow-lg rounded-[16px] my-2 relative overflow-hidden">
                        <img src="{{ asset('/assets/static/partial/quote.png') }}" class="w-[240px] h-[240px] object-cover object-center absolute -top-18 -right-17 z-1"/>
                        <div class="relative z-2">
                            <div class="flex items-center gap-1 mb-4">
                                <svg class="text-bkkYellow-700" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33496 10.3368C2.02171 10.0471 2.19187 9.52339 2.61557 9.47316L8.61914 8.76107C8.79182 8.74059 8.94181 8.63215 9.01465 8.47425L11.5469 2.98446C11.7256 2.59703 12.2764 2.59695 12.4551 2.98439L14.9873 8.47413C15.0601 8.63204 15.2092 8.74077 15.3818 8.76124L21.3857 9.47316C21.8094 9.52339 21.9791 10.0472 21.6659 10.3369L17.2278 14.4419C17.1001 14.56 17.0433 14.7357 17.0771 14.9063L18.255 20.8359C18.3382 21.2544 17.8928 21.5787 17.5205 21.3703L12.2451 18.4166C12.0934 18.3317 11.9091 18.3321 11.7573 18.417L6.48144 21.3695C6.10913 21.5779 5.66294 21.2544 5.74609 20.8359L6.92414 14.9066C6.95803 14.7361 6.90134 14.5599 6.77367 14.4419L2.33496 10.3368Z" stroke="#FFBE0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="text-bkkYellow-700" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33496 10.3368C2.02171 10.0471 2.19187 9.52339 2.61557 9.47316L8.61914 8.76107C8.79182 8.74059 8.94181 8.63215 9.01465 8.47425L11.5469 2.98446C11.7256 2.59703 12.2764 2.59695 12.4551 2.98439L14.9873 8.47413C15.0601 8.63204 15.2092 8.74077 15.3818 8.76124L21.3857 9.47316C21.8094 9.52339 21.9791 10.0472 21.6659 10.3369L17.2278 14.4419C17.1001 14.56 17.0433 14.7357 17.0771 14.9063L18.255 20.8359C18.3382 21.2544 17.8928 21.5787 17.5205 21.3703L12.2451 18.4166C12.0934 18.3317 11.9091 18.3321 11.7573 18.417L6.48144 21.3695C6.10913 21.5779 5.66294 21.2544 5.74609 20.8359L6.92414 14.9066C6.95803 14.7361 6.90134 14.5599 6.77367 14.4419L2.33496 10.3368Z" stroke="#FFBE0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="text-bkkYellow-700" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33496 10.3368C2.02171 10.0471 2.19187 9.52339 2.61557 9.47316L8.61914 8.76107C8.79182 8.74059 8.94181 8.63215 9.01465 8.47425L11.5469 2.98446C11.7256 2.59703 12.2764 2.59695 12.4551 2.98439L14.9873 8.47413C15.0601 8.63204 15.2092 8.74077 15.3818 8.76124L21.3857 9.47316C21.8094 9.52339 21.9791 10.0472 21.6659 10.3369L17.2278 14.4419C17.1001 14.56 17.0433 14.7357 17.0771 14.9063L18.255 20.8359C18.3382 21.2544 17.8928 21.5787 17.5205 21.3703L12.2451 18.4166C12.0934 18.3317 11.9091 18.3321 11.7573 18.417L6.48144 21.3695C6.10913 21.5779 5.66294 21.2544 5.74609 20.8359L6.92414 14.9066C6.95803 14.7361 6.90134 14.5599 6.77367 14.4419L2.33496 10.3368Z" stroke="#FFBE0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="text-bkkYellow-700" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33496 10.3368C2.02171 10.0471 2.19187 9.52339 2.61557 9.47316L8.61914 8.76107C8.79182 8.74059 8.94181 8.63215 9.01465 8.47425L11.5469 2.98446C11.7256 2.59703 12.2764 2.59695 12.4551 2.98439L14.9873 8.47413C15.0601 8.63204 15.2092 8.74077 15.3818 8.76124L21.3857 9.47316C21.8094 9.52339 21.9791 10.0472 21.6659 10.3369L17.2278 14.4419C17.1001 14.56 17.0433 14.7357 17.0771 14.9063L18.255 20.8359C18.3382 21.2544 17.8928 21.5787 17.5205 21.3703L12.2451 18.4166C12.0934 18.3317 11.9091 18.3321 11.7573 18.417L6.48144 21.3695C6.10913 21.5779 5.66294 21.2544 5.74609 20.8359L6.92414 14.9066C6.95803 14.7361 6.90134 14.5599 6.77367 14.4419L2.33496 10.3368Z" stroke="#FFBE0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg class="text-bkkYellow-700" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.33496 10.3368C2.02171 10.0471 2.19187 9.52339 2.61557 9.47316L8.61914 8.76107C8.79182 8.74059 8.94181 8.63215 9.01465 8.47425L11.5469 2.98446C11.7256 2.59703 12.2764 2.59695 12.4551 2.98439L14.9873 8.47413C15.0601 8.63204 15.2092 8.74077 15.3818 8.76124L21.3857 9.47316C21.8094 9.52339 21.9791 10.0472 21.6659 10.3369L17.2278 14.4419C17.1001 14.56 17.0433 14.7357 17.0771 14.9063L18.255 20.8359C18.3382 21.2544 17.8928 21.5787 17.5205 21.3703L12.2451 18.4166C12.0934 18.3317 11.9091 18.3321 11.7573 18.417L6.48144 21.3695C6.10913 21.5779 5.66294 21.2544 5.74609 20.8359L6.92414 14.9066C6.95803 14.7361 6.90134 14.5599 6.77367 14.4419L2.33496 10.3368Z" stroke="#FFBE0A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="paragraph-16r text-bkkNeutral-700 mb-8 line-clamp-4">
                                {{ $testimoni['testimoni'] }}
                            </div>
                            <h3 class="heading-20s text-black line-clamp-1 mb-2">
                                {{$testimoni['person_name']}}
                            </h3>
                            <div class="flex items-center">
                                <div class="paragraph-14r text-bkkNeutral-700">Lulusan {{ $testimoni['graduate_of'] }}</div>
                                <div class="w-[1.5px] h-[16px] bg-bkkNeutral-500 mx-3"></div>
                                <div class="paragraph-14r text-bkkNeutral-700 line-clamp-1">{{ $testimoni['company_name'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Pagination --}}
        <div class="absolute mb-10 testimoniSwiper-pagination z-5 flex justify-center gap-1">
        </div>
    </div>
</section>

{{-- Pagination styling --}}
<style>

    .heroSwiper-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #C7CEDA;
        border-radius: 100px;
        opacity: 1;
    }

    .heroSwiper-pagination .swiper-pagination-bullet-active {
        width: 38px;
        height: 10px;
        background-color: #073AE4;
        border-radius: 6px;
    }

    .lokerSwiper-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #C7CEDA;
        border-radius: 100px;
        opacity: 1;
    }

    .lokerSwiper-pagination .swiper-pagination-bullet-active {
        width: 38px;
        height: 10px;
        background-color: #073AE4;
        border-radius: 6px;
    }

    .testimoniSwiper-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #C7CEDA;
        border-radius: 100px;
        opacity: 1;
    }

    .testimoniSwiper-pagination .swiper-pagination-bullet-active {
        width: 38px;
        height: 10px;
        background-color: #073AE4;
        border-radius: 6px;
    }|

    .beritaSwiper-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #C7CEDA;
        border-radius: 100px;
        opacity: 1;
    }

    .beritaSwiper-pagination .swiper-pagination-bullet-active {
        width: 38px;
        height: 10px;
        background-color: #073AE4;
        border-radius: 6px;
    }
</style>
</div>

<script>
    // Hero slider
    document.addEventListener("DOMContentLoaded", function () {
        const heroSwiper = new Swiper(".hero-swiper", {
            effect: "fade",
            slidesPerView: 1,
            allowTouchMove: true,

            pagination: {
                el: ".heroSwiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".heroSwiper-button-next",
                prevEl: ".heroSwiper-button-prev",
            },
        })
    })

    // Loker Slider
    document.addEventListener("DOMContentLoaded", function () {
        const heroSwiper = new Swiper(".loker-swiper", {

            breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            1024: {
                slidesPerView: 2.5,
                spaceBetween: 24,
                allowTouchMove: true,
            },
            1500: {
                slidesPerView: 2.5,
                spaceBetween: 24,
                allowTouchMove: true,
            }

            },

            pagination: {
                el: ".lokerSwiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".lokerSwiper-button-next",
                prevEl: ".lokerSwiper-button-prev",
            },
        })
    })

    // Testimoni Slider
    document.addEventListener("DOMContentLoaded", function () {
        const heroSwiper = new Swiper(".testimoni-swiper", {

            breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
                allowTouchMove: true,
            },
            1500: {
                slidesPerView: 3,
                spaceBetween: 24,
                allowTouchMove: true,
            }

            },

            pagination: {
                el: ".testimoniSwiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".testimoniSwiper-button-next",
                prevEl: ".testimoniSwiper-button-prev",
            },
        })
    })

    // Berita Slider
    document.addEventListener("DOMContentLoaded", function () {
        const heroSwiper = new Swiper(".berita-swiper", {

            breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 16,
                allowTouchMove: true,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 24,
                allowTouchMove: true,
            },
            1500: {
                slidesPerView: 2,
                spaceBetween: 24,
                allowTouchMove: true,
            }

            },

            pagination: {
                el: ".beritaSwiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".beritaSwiper-button-next",
                prevEl: ".beritaSwiper-button-prev",
            },
        })
    })
</script>