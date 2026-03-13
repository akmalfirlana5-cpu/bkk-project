<div>
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('storage/' . $activityContent['hero']['image']) }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="#">Profil BKK</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('alur-kegiatan') }}">Alur Kegiatan</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    {{ $activityContent['hero']['title'] }}
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[60%]">
                    {{ $activityContent['hero']['description'] }}
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 md:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <h2 class="heading-48s text-bkkNeutral-900 mb-4">
                {{ $activityContent['alur_kegiatan']['section_title'] }}
            </h2>
            <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                {{ $activityContent['alur_kegiatan']['section_description'] }}
            </div>
            <div>
                <iframe 
                    class="w-full h-[350px] lg:h-[560px]"
                    src="{{ $activityContent['alur_kegiatan']['link_gdrive'] }}" allowfullscreen>
                </iframe>
            </div>
    </section>
</div>
