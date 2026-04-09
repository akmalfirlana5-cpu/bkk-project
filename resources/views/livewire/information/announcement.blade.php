<div>
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('storage/' . $announcementContent['pengumuman']['hero_image']) }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="#" class="line-clamp-1">Informasi & Pengumuman</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('pengumuman') }}">Pengumuman</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    {{ $announcementContent['pengumuman']['hero_title'] }}
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[50%]">
                    {{ $announcementContent['pengumuman']['hero_description'] }}
                </div>
            </div>
        </div>
    </section>

    <section class="py-15 lg:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <h2 class="heading-42s text-bkkNeutral-900">
                {{ $announcementContent['pengumuman']['section_title'] }}
            </h2>
            <div class="flex flex-col lg:flex-row items-end justify-between mb-9 gap-6 lg:gap-0">
                <div class="paragraph-16r text-bkkNeutral-700 w-full lg:w-[65%]">
                    {{ $announcementContent['pengumuman']['section_description'] }}
                </div>
                <div class="flex justify-end gap-3 w-full lg:w-[35%]">
                    <input 
                        class="w-full lg:w-[300px] py-3 px-6 border border-bkkNeutral-200 rounded-xl focus:ring-primary focus:border-primary paragraph-14r"
                        type="text"
                        wire:model.live.debounce.500ms="filterSearch"
                        placeholder="Masukkan kata kunci"
                    />
                    <button 
                        class="py-3 px-6 bg-primary rounded-xl text-bkkNeutral-50 paragraph-16s cursor-pointer hover:bg-primary-hover transition duration-300">
                        Cari
                    </button>
                </div>
            </div>
            <div 
                wire:loading.class="opacity-50 pointer-events-none"
                id="pengumuman" 
                class="grid grid-cols-1 md:grid-cols-2 gap-8 scroll-mt-25 mb-16">
                @forelse ($announcements as $announcement)
                    <div class=" bg-white shadow-lg overflow-hidden rounded-[20px] my-2">
                        <div class="w-full h-[256px]">
                            <img 
                                class="w-full h-full object-cover object-center"
                                src="{{ $announcement->image ? asset('storage/' . $announcement->image) : asset('/assets/static/partial/image-fallback.webp') }}" />
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
                                    class="w-full lg:w-auto justify-self-center flex justify-center items-center gap-3 py-3 px-6 bg-primary hover:bg-primary-hover transition duration-300 rounded-[8px] group">
                                    <span class="paragraph-16s text-bkkNeutral-50">Baca Selengkapnya</span>
                                    <svg class="shrink-0 group-hover:translate-x-1 transition duration-300" width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 flex flex-col items-center justify-center py-20 px-6 bg-white rounded-[32px] border border-bkkNeutral-100 shadow-sm">
                        <div class="w-24 h-24 bg-bkkBlue-50 text-primary rounded-full flex items-center justify-center mb-6">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 6H6C4.89543 6 4 6.89543 4 8V16C4 17.1046 4.89543 18 6 18H11L15 21V3L11 6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 8C20.1046 8 21 8.89543 21 10V14C21 15.1046 20.1046 16 19 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 12H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <h2 class="heading-32s text-bkkNeutral-900 mb-2">Belum Ada Pengumuman</h2>
                        <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm">
                            Saat ini tidak ada pengumuman resmi yang aktif. Pantau terus halaman ini untuk mendapatkan informasi terbaru dari BKK.
                        </p>
                    </div>
                @endforelse
            </div>
            {{ $announcements->links(data: ['scrollTo' => '#pengumuman']) }}
        </div>
    </section>
</div>
