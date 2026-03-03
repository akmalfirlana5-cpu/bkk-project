<div>
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
                    <a href="#">Profil BKK</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('dokumen-pendukung') }}">Dokumen Pendukung</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    Profil BKK
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[60%]">
                    Mengenal Bursa Kerja Khusus (BKK) lebih dekat melalui informasi seputar peran, program, dan kegiatan yang diselenggarakan sebagai upaya mendukung kesiapan lulusan memasuki dunia kerja secara terarah dan berkelanjutan.
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 md:py-20">
        <div 
            x-data="{
                selectedContent: '{{ $documentContent[0]['title'] }}',
                 init() {
                    this.$watch('selectedContent', () => {
                        const target = document.getElementById('main-container');
                        if (target) {
                            target.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'start' 
                            });
                        }
                    })
                }
                }"
            id="main-container"
            class="container flex flex-col lg:flex-row gap-10 mx-auto px-5 lg:px-0 relative scroll-mt-30">
            <div 
                class="w-full lg:w-[25%] flex flex-row lg:flex-col gap-2 lg:gap-0 overflow-auto rounded-2xl shadow-lg py-4 lg:py-6 lg:sticky top-30 self-start hidescroll">
                <h2 class="hidden lg:block border-l-4 border-l-transparent border-b border-b-bkkNeutral-200 px-6 heading-20s text-bkkNeutral-900 pb-6">Daftar Isi</h2>
                @foreach ($documentContent as $document)
                    <div 
                        @click="selectedContent = '{{ $document['title'] }}'"
                        class="min-w-max border-l-4 border-l-transparent border-b border-b-bkkNeutral-200 py-4 px-6 paragraph-16s cursor-pointer transition duration-300 last:border-b-0"
                        :class="selectedContent === '{{ $document['title'] }}' ? 'border-l-bkkBlue-700! text-bkkBlue-700 bg-bkkBlue-100' : ' text-bkkNeutral-700 bg-transparent'">
                        {{ $document['title'] }}
                    </div>
                @endforeach
            </div>
            <div class="w-full lg:w-[75%]">
                @foreach ($documentContent as $document)
                    <div 
                        x-cloak
                        x-show="selectedContent === '{{ $document['title'] }}'">
                        {{-- Sarpras --}}
                        @if ($document['type'] === 'manyContent')  
                            <div>
                                <h2 class="heading-48s text-bkkNeutral-900 mb-4">
                                    {{ $document['title'] }}
                                </h2>
                                <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                                    {{ $document['content'] }}
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    @foreach ($document['device_items'] as $device )
                                        <div class="bg-white shadow-lg overflow-hidden rounded-[20px] my-2">
                                            <div class="w-full h-[180px]">
                                                <img 
                                                    class="w-full h-full object-cover object-center"
                                                    src="{{ asset($device['image']) }}" />
                                            </div>
                                            <div class="p-5 lg:p-6">
                                                <h3 class="heading-20s text-black line-clamp-1 mb-4">
                                                    {{$device['device_name']}}
                                                </h3>
                                                <div class="paragraph-16r text-bkkNeutral-700 line-clamp-3">
                                                    {{ $device['device_description'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        
                        @elseif ($document['type'] === 'singleContent')
                        <div>
                            <h2 class="heading-48s text-bkkNeutral-900 mb-4">
                                    {{ $document['title'] }}
                            </h2>
                            <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                                {{ $document['content'] }}
                            </div>
                            <div>
                                <iframe 
                                    class="w-full h-[350px] lg:h-[560px]"
                                    src="{{ $document['link_gdrive'] }}" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
