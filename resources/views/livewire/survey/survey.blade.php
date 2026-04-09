<div>
    <section class="py-30 lg:py-25">
        <div class="container mx-auto px-5 lg:px-0">
            <div class="w-full bg-white shadow-lg rounded-3xl p-6 md:p-10">
                    <h1 class="heading-42s text-bkkNeutral-900 mb-4">Form Survei Kepuasan</h1>
                <div class="flex justify-center rounded-lg overflow-hidden my-8">
                    <div class="grid grid-cols-3 items-center w-full ">
                        {{-- Step 1 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 bg-primary-ultra-light">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 1, warna biru jika step >= 1 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 bg-primary border border-primary text-white">
                                    1
                                </div>
                                <span class="paragraph-16s hidden md:block text-primary">
                                    Step 1: Jenis Responden
                                </span>
                            </div>
                        </div>
                        
                        {{-- Step 2 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 bg-bkkNeutral-100">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 2, warna biru jika step >= 2 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600">
                                    2
                                </div>
                                <span class="paragraph-16s hidden md:block text-bkkNeutral-600">
                                    Step 2: Data Responden
                                </span>
                            </div>
                        </div>

                        {{-- Step 3 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 bg-bkkNeutral-100">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 2, warna biru jika step >= 2 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600">
                                    3
                                </div>
                                <span class="paragraph-16s hidden md:block text-bkkNeutral-600">
                                    Step 3: Penilaian Layanan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="paragraph-16r text-bkkNeutral-900 mb-8">
                    Pilih jenis responden untuk memulai survei kepuasan.
                </div>
                <div x-data="{ localSelected: @entangle('selectedSlug') }">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        @foreach ($participantType as $type)
                            <label 
                                class="flex flex-col items-center p-6 border-2 rounded-3xl cursor-pointer transition-all duration-300"
                                :class="localSelected === '{{ $type['slug'] }}' ? 'border-primary bg-bkkBlue-50' : 'border-bkkNeutral-200'"
                            >
                                {{-- Value diisi dengan slug --}}
                                <input type="radio" wire:model="selectedSlug" value="{{ $type['slug'] }}" class="sr-only" @click="localSelected = '{{ $type['slug'] }}'">
                                <div 
                                    class="w-16 h-16 rounded-2xl flex items-center justify-center transition-colors duration-300 mb-3"
                                    {{-- Ikon berubah warna jadi biru jika dipilih --}}
                                    :class="localSelected === '{{ $type['slug'] }}' ? 'bg-primary text-white' : 'bg-bkkNeutral-100 text-bkkNeutral-500 group-hover:text-primary'"
                                >
                                    <div class="[&>svg]:w-8 [&>svg]:h-8">
                                        {!! $type['icon'] !!}
                                    </div>
                                </div>
                                <h3 class="heading-16s text-bkkNeutral-900 ">{{ $type['label'] }}</h3>
                                <p class="paragraph-14r text-bkkNeutral-500">{{ $type['description'] }}</p>
                            </label>
                        @endforeach
                    </div>

                    <!-- Button Lanjutkan -->
                    <div class="flex justify-end mt-8">
                        <button type="button" wire:click="goToIdentity"
                            class="flex items-center gap-3 py-3 px-8 bg-primary hover:bg-primary-hover text-white rounded-xl transition duration-300 paragraph-16s cursor-pointer">
                            <span>Lanjutkan</span>
                            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
