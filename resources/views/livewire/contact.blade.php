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
                    <a href="{{ route('kontak') }}">Kontak</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    {{ $contactContent['hero_title'][0] }}
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[60%]">
                    {{ $contactContent['hero_description'][0] }}
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 lg:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <h2 class="heading-42s text-bkkNeutral-900 mb-4">{{ $contactContent['section_title'][0] }}</h1>
            <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                {{ $contactContent['section_description'][0] }}
            </div>
            <div class="flex flex-col lg:flex-row rounded-3xl shadow-lg bg-white overflow-hidden">
                <div class="w-full lg:w-[50%] h-[350px] lg:h-[600px]">
                    <iframe 
                        class="w-full h-full"
                        src="{{ $contactContent['map_embed_url'][0] }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div
                    x-on:scroll-to-top.window="document.getElementById('contactForm').scrollIntoView({ behavior: 'smooth' })" 
                    class="w-full lg:w-[50%] p-6">
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
                        id="contactForm"
                        class="space-y-9 scroll-mt-60"
                        wire:submit.prevent="submitContact">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                <label for="firstName" class="heading-16 text-bkkNeutral-900">Nama Depan</label>
                                <input 
                                    id="firstName"
                                    type="text" 
                                    wire:model="contact.firstName" 
                                    placeholder="Masukkan nama depan"
                                    class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                    border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                <div class="absolute -bottom-6">
                                    @error('contact.firstName')
                                        <span class="text-red-500 text-xs ">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full md:w-[50%] flex flex-col gap-3 relative">
                                <label for="lastName" class="heading-16 text-bkkNeutral-900">Nama Belakang</label>
                                <input 
                                    id="lastName"
                                    type="text" 
                                    wire:model="contact.lastName" 
                                    placeholder="Masukkan nama belakang"
                                    class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                    border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                                <div class="absolute -bottom-6">
                                    @error('contact.lastName')
                                        <span class="text-red-500 text-xs ">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-3 relative">
                            <label for="email" class="heading-16 text-bkkNeutral-900">Email</label>
                            <input 
                                    id="email"
                                    type="email" 
                                    wire:model="contact.email" 
                                    placeholder="Masukkan email"
                                    class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                    border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6"/>
                            <div class="absolute -bottom-6">
                                @error('contact.email')
                                    <span class="text-red-500 text-xs ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full flex flex-col gap-3 relative">
                            <label for="message" class="heading-16 text-bkkNeutral-900">
                                Apa yang bisa kami bantu?
                            </label>
                            <textarea 
                                    id="message"
                                    wire:model="contact.message" 
                                    placeholder="Tuliskan pesan atau masukan"
                                    rows="5"
                                    class="paragraph-14r text-bkkNeutral-900 focus:ring-primary 
                                    border border-bkkNeutral-200 rounded-2xl focus:border-primary py-3.5 px-6">
                            </textarea>
                            <div class="absolute -bottom-6">
                                @error('contact.message')
                                    <span class="text-red-500 text-xs ">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button 
                                type="submit" 
                                class="w-full lg:w-auto justify-self-end px-6 py-3 bg-primary paragraph-16s hover:bg-primary-hover text-bkkNeutral-50 rounded-lg cursor-pointer transition duration-300">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
