<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'BKK SMKN 4 MALANG' }}</title>

        {{-- Icon --}}
        <link rel="icon" type="image/png" href="/assets/static/logo/icon/logo-bkk-crop.webp">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"
        >
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            /* Disable overscroll */
            html {
                height: 100%;
            }

            body {
                height: 100%;
                overflow: auto;
                background-color: #FBFCFD;
            }
        </style>
    </head>
    <body>
        <div
            x-data="{openModalLogin: {{ session('showLoginModal') ? 'true' : 'false' }}}"
            x-on:close-modal.window="openModalLogin = false"
            x-on:open-login-modal="openModalLogin = true"
            class="relative">
            {{-- Navbar Dekstop --}}
            <nav class="bg-bkkNeutral-50 fixed top-0 z-[99] w-full">
                <div 
                    x-data="{openDropdown : null}"
                    @mouseleave="openDropdown = null"
                    class="container mx-auto hidden lg:flex justify-between items-center lg:px-0 px-5 my-5">
                    <a href="{{ route('beranda') }}" class="w-[124px] group">
                        <img 
                            class="group-hover:scale-110 transition duration-300 w-full h-full object-contain object-center"
                            src="{{ asset('/assets/static/logo/logo-bkk.png') }}"/>
                    </a>
                    <div 
                        class="flex items-center gap-6">
                        <a 
                            @mouseenter="openDropdown = null"
                            href="{{ route('beranda') }}" 
                            class="paragraph-16s {{ request()->routeIs('beranda') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                            Beranda
                        </a>
                        <div class="relative">
                            <a 
                                href="#" 
                                class="flex items-center gap-3 paragraph-16s transition duration-300"
                                :class="openDropdown === 'profilBkk' ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700'"
                                @mouseenter="openDropdown = 'profilBkk'">
                                <span>
                                    Profil BKK
                                </span>
                                <svg 
                                    class="transition duration-300"
                                    :class=" openDropdown === 'profilBkk' ? 'transform rotate-180' : ''"
                                width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            {{-- DropdownMenu --}}

                            <div
                                x-cloak
                                x-show="openDropdown === 'profilBkk'"
                                class="absolute top-8 -left-3  bg-white shadow-xl z-50 border border-bkkNeutral-100 rounded-2xl p-5 w-[200px]">
                                <div class="flex flex-col gap-4">
                                    <a href="{{ route('visi-misi') }}" 
                                        class="paragraph-16r {{ request()->routeIs('visi-misi') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Visi & Misi
                                    </a>
                                    <a href="{{ route('struktur-organisasi') }}" 
                                        class="paragraph-16r {{ request()->routeIs('struktur-organisasi') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Struktur Organisasi
                                    </a>
                                    <a href="{{ route('program-kerja') }}" 
                                        class="paragraph-16r {{ request()->routeIs('program-kerja') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Program Kerja
                                    </a>
                                    <a href="{{ route('alur-kegiatan') }}" 
                                        class="paragraph-16r {{ request()->routeIs('alur-kegiatan') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Alur Kegiatan
                                    </a>
                                    <a href="{{ route('dokumen-pendukung') }}" 
                                        class="paragraph-16r {{ request()->routeIs('dokumen-pendukung') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Dokumen Pendukung
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a 
                            href="{{ route('lowongan') }}" 
                            class="paragraph-16s {{ request()->routeIs('lowongan') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300"
                            @mouseenter="openDropdown = null">
                            Lowongan
                        </a>
                        <div class="relative">
                            <a 
                                href="#" 
                                class="flex items-center gap-3 paragraph-16s transition duration-300"
                                :class="openDropdown === 'informasiPengumuman' ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700'"
                                @mouseenter="openDropdown = 'informasiPengumuman'">
                                <span>
                                    Informasi & Pengumuman
                                </span>
                                <svg 
                                    class="transition duration-300"
                                    :class=" openDropdown === 'informasiPengumuman' ? 'transform rotate-180' : ''"
                                 width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            {{-- DropdownMenu --}}

                            <div
                                x-cloak
                                x-show="openDropdown === 'informasiPengumuman'"
                                class="absolute top-8 -left-3  bg-white shadow-xl z-50 border border-bkkNeutral-100 rounded-2xl p-5 w-[234px]">
                                <div class="flex flex-col gap-4">
                                    <a href="{{ route('pengumuman') }}"
                                        class="paragraph-16r {{ request()->routeIs('pengumuman') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                        Pengumuman
                                    </a>
                                    <a href="{{ route('tracer-study') }}"
                                        class="paragraph-16r {{ request()->routeIs('tracer-study') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">Tracer Study
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a 
                            href="{{ route('faq') }}" 
                            class="paragraph-16s {{ request()->routeIs('faq') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300"
                            @mouseenter="openDropdown = null">
                            FAQ
                        </a>
                        <a 
                            href="{{ route('kontak') }}" 
                            class="paragraph-16s {{ request()->routeIs('kontak') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300"
                            @mouseenter="openDropdown = null">
                            Kontak
                        </a>
                    </div>

                    @auth
                        <livewire:components.navbar-profile />
                    @else
                        <div class="flex items-center gap-3">
                            <a 
                                @click="openModalLogin = true"
                                class="bg-bkkBlue-700 hover:bg-bkkBlue-800 px-4 py-2 paragraph-16s text-bkkNeutral-50 transition duration-300 rounded-[8px] border-[1px] border-bkkBlue-700 cursor-pointer">Masuk sebagai Alumni</a>
                        </div>
                    @endauth
                </div>
            </nav>
            {{-- Navbar Mobile --}}
            <nav x-data="{open: false}" class="lg:hidden bg-bkkNeutral-50 fixed top-0 z-[99] w-full">
                <div class="relative z-50 bg-bkkNeutral-50 py-8 shadow-sm">
                    <div class="container mx-auto flex justify-between items-center px-5">
                        <a href="{{ route('beranda') }}" class="w-[124px] overflow-hidden group">
                            <img class="group-hover:scale-110 transition duration-300 w-full h-full object-contain" src="{{ asset('/assets/static/logo/logo-bkk.png') }}"/>
                        </a>
                        
                        <button @click="open = !open" class="focus:outline-none cursor-pointer">
                            <svg x-show="!open" class="w-7 h-7 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                            </svg>
                            <svg x-show="open" x-cloak class="w-7 h-7 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div 
                    x-show="open" 
                    x-data="{openMobile: false, openDropdownMobile : null}"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="-translate-y-full" 
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="translate-y-0" 
                    x-transition:leave-end="-translate-y-full" 
                    x-cloak
                    class="fixed top-0 left-0 pt-30 w-full h-full bg-bkkNeutral-50 z-40 flex flex-col p-5 space-y-2">
                    @auth
                        <livewire:components.navbar-profile />
                        {{-- Divider --}}
                        <div class="h-px w-full bg-bkkNeutral-200 my-4"></div>
                        <div 
                        @click="openMobile = !openMobile; openDropdownMobile = 'userPage'"
                        :class="openMobile && openDropdownMobile === 'userPage' ? 'text-bkkBlue-700' : 'text-bkkNeutral-900'"
                        class="py-2">
                            <div class="flex items-center justify-between">
                                <div 
                                    class="paragraph-16s transition duration-300">
                                    User page
                                </div>
                                <svg 
                                    class="transition duration-300"
                                    :class="openMobile && openDropdownMobile === 'userPage' ? 'transform rotate-180' : ''"
                                    width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div 
                                x-collapse
                                x-show="openMobile && openDropdownMobile == 'userPage'"
                                class="pt-4 flex flex-col gap-2">
                                <a href="{{ route('data-pribadi') }}"
                                    class="paragraph-16r {{ request()->routeIs('data-pribadi') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 flex items-center gap-3">
                                    <span>
                                        Profil Saya
                                    </span>
                                </a>
                                <a href="{{ route('riwayat-lamaran') }}"
                                    class="paragraph-16r {{ request()->routeIs('riwayat-lamaran') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 flex items-center gap-3">
                                    <span>
                                        Riwayat Lamaran
                                    </span>
                                </a>
                                <a href="{{ route('isi-tracer-study') }}"
                                    class="paragraph-16r {{ request()->routeIs('isi-tracer-study') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 flex items-center gap-3">
                                    <span>
                                        Isi Tracer Study
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endauth
                    <a 
                        href="{{ route('beranda') }}" 
                        class="paragraph-16s {{ request()->routeIs('beranda') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-2">
                        Beranda
                    </a>
                    {{-- Profil Menu Mobile --}}
                    <div 
                        @click="openMobile = !openMobile; openDropdownMobile = 'profilBkk'"
                        :class="openMobile && openDropdownMobile === 'profilBkk' ? 'text-bkkBlue-700' : 'text-bkkNeutral-900'"
                        class="py-2">
                        <div class="flex items-center justify-between">
                            <div 
                                class="paragraph-16s transition duration-300">
                                Profil BKK
                            </div>
                            <svg 
                                class="transition duration-300"
                                :class="openMobile && openDropdownMobile === 'profilBkk' ? 'transform rotate-180' : ''"
                                width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div 
                            x-collapse
                            x-show="openMobile && openDropdownMobile == 'profilBkk'"
                            class="pt-4 flex flex-col gap-2">
                            <a href="{{ route('visi-misi') }}" 
                                class="paragraph-16r {{ request()->routeIs('visi-misi') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-1">
                                Visi & Misi
                            </a>
                            <a href="{{ route('struktur-organisasi') }}" 
                                class="paragraph-16r {{ request()->routeIs('struktur-organisasi') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-1">
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('program-kerja') }}" 
                                class="paragraph-16r {{ request()->routeIs('program-kerja') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-1">
                                Program Kerja
                            </a>
                            <a href="{{ route('alur-kegiatan') }}" 
                                class="paragraph-16r {{ request()->routeIs('alur-kegiatan') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-1">
                                Alur Kegiatan
                            </a>
                            <a href="{{ route('dokumen-pendukung') }}" 
                                class="paragraph-16r {{ request()->routeIs('dokumen-pendukung') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300 py-1">
                                Dokumen Pendukung
                            </a>
                        </div>
                    </div>
                    <a 
                        href="{{ route('lowongan') }}" 
                        class="paragraph-16s {{ request()->routeIs('lowongan') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                        Lowongan
                    </a>
                    {{-- Informasi & Berita --}}
                    <div 
                        @click="openMobile = !openMobile; openDropdownMobile = 'informasi'"
                        :class="openMobile && openDropdownMobile === 'informasi' ? 'text-bkkBlue-700' : 'text-bkkNeutral-900'"
                        class="py-2">
                        <div class="flex items-center justify-between">
                            <div 
                                class="paragraph-16s transition duration-300">
                                Informasi & Berita
                            </div>
                            <svg 
                                class="transition duration-300"
                                :class="openMobile && openDropdownMobile === 'informasi' ? 'transform rotate-180' : ''"
                                width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 1L5 5L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div 
                            x-collapse
                            x-show="openMobile && openDropdownMobile == 'informasi'"
                            class="pt-4 flex flex-col gap-2">
                            <a href="{{ route('pengumuman') }}"
                                class="paragraph-16r {{ request()->routeIs('pengumuman') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                Pengumuman & Informasi
                            </a>
                            <a 
                                href="{{ route('tracer-study') }}"
                                class="paragraph-16r {{ request()->routeIs('tracer-study') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                                Tracer Study
                            </a>
                        </div>
                    </div>
                    <a 
                        href="{{ route('faq') }}" 
                        class="paragraph-16s {{ request()->routeIs('faq') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                        FAQ
                    </a>
                    <a 
                        href="{{ route('kontak') }}" 
                        class="paragraph-16s {{ request()->routeIs('kontak') ? 'text-bkkBlue-700' : 'text-bkkNeutral-900 hover:text-bkkBlue-700' }} transition duration-300">
                        Kontak
                    </a>
                </div>
            </nav>

            {{-- Modal Login --}}
            <div 
                x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black/50 z-99"
                x-show="openModalLogin === true">
                <div 
                    @click.outside = "openModalLogin = false"
                    class="w-full md:w-[500px] min-h-[400px] px-16 pt-15 pb-8 bg-bkkNeutral-50 rounded-2xl relative mx-5 lg:mx-0">
                    <livewire:components.login />
                </div>
            </div>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            {{-- Footer --}}
            <footer class="bg-bkkNeutral-800">
                <div class="container mx-auto lg:px-0 px-5 pt-20 ">
                    <div class="flex flex-col lg:flex-row lg:justify-between items-start border-b-[1px] border-bkkNeutral-500 pb-10 lg:pb-20">
                        <div class="w-full md:w-[60%] lg:w-[35%] text-bkkNeutral-50 mb-12 lg:mb-0">
                            <div class="w-[170px] mb-7">
                                <img 
                                    class="w-full h-full object-contain object-center"
                                    src="{{ asset('/assets/static/logo/logo-bkk-white.png') }}"/>
                            </div>
                            <div class="paragraph-14r mb-4 w-full lg:w-[75%]">
                                Unit layanan informasi lowongan kerja dan penyaluran tenaga kerja bagi Alumni SMK Negeri 4 Malang.
                            </div>
                            <div class="flex items-center gap-3">
                                {{-- Telegram --}}
                                <a href="https://t.me/bkksmkn4malang">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM10.3583 7.38245C9.38569 7.78701 7.44176 8.62434 4.52656 9.89445C4.05318 10.0827 3.8052 10.2669 3.78262 10.4469C3.74447 10.7513 4.12558 10.8711 4.64454 11.0343C4.71513 11.0565 4.78828 11.0795 4.86326 11.1039C5.37385 11.2698 6.06067 11.464 6.41772 11.4717C6.7416 11.4787 7.10309 11.3452 7.50218 11.0711C10.2259 9.23251 11.632 8.30319 11.7202 8.28315C11.7825 8.26902 11.8688 8.25125 11.9273 8.30322C11.9858 8.35519 11.98 8.45361 11.9738 8.48002C11.9361 8.64096 10.4401 10.0318 9.66592 10.7515C9.42457 10.9759 9.25338 11.135 9.21838 11.1714C9.13998 11.2528 9.06009 11.3298 8.9833 11.4039C8.50895 11.8611 8.15324 12.204 9.00299 12.764C9.41134 13.0331 9.7381 13.2556 10.0641 13.4776C10.4201 13.7201 10.7752 13.9619 11.2347 14.2631C11.3517 14.3398 11.4635 14.4195 11.5724 14.4971C11.9867 14.7925 12.3589 15.0579 12.8188 15.0155C13.086 14.991 13.362 14.7397 13.5022 13.9903C13.8335 12.2193 14.4847 8.38206 14.6352 6.80082C14.6483 6.66229 14.6318 6.48499 14.6184 6.40716C14.6051 6.32932 14.5773 6.21843 14.4761 6.13634C14.3563 6.03912 14.1713 6.01862 14.0886 6.02008C13.7125 6.0267 13.1354 6.22736 10.3583 7.38245Z" fill="#FBFCFD"/>
                                    </svg>
                                </a>
                                {{-- Facebook --}}
                                <a href="https://m.facebook.com/bkksmkn4malang/?tsid=0.4424916632749889&source=result">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 10.0607C20 4.504 15.5233 0 10 0C4.47667 0 0 4.504 0 10.0607C0 15.0833 3.656 19.2453 8.43733 20V12.9693H5.89867V10.06H8.43733V7.844C8.43733 5.32267 9.93 3.92933 12.2147 3.92933C13.308 3.92933 14.4533 4.126 14.4533 4.126V6.602H13.1913C11.9493 6.602 11.5627 7.378 11.5627 8.174V10.0607H14.336L13.8927 12.9687H11.5627V20C16.344 19.2453 20 15.0833 20 10.0607Z" fill="#FBFCFD"/>
                                    </svg>
                                </a>
                                {{-- Instagram --}}
                                <a href="https://instagram.com/bkksmkn4malang?utm_medium=copy_link">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.72892 5.72893C6.59647 4.86138 7.77311 4.374 9 4.374C10.2269 4.374 11.4035 4.86138 12.2711 5.72893C13.1386 6.59647 13.626 7.77311 13.626 9C13.626 10.2269 13.1386 11.4035 12.2711 12.2711C11.4035 13.1386 10.2269 13.626 9 13.626C7.77311 13.626 6.59647 13.1386 5.72892 12.2711C4.86138 11.4035 4.374 10.2269 4.374 9C4.374 7.77311 4.86138 6.59647 5.72892 5.72893ZM7.8508 11.7744C8.21514 11.9253 8.60564 12.003 9 12.003C9.79644 12.003 10.5603 11.6866 11.1234 11.1234C11.6866 10.5603 12.003 9.79645 12.003 9C12.003 8.20356 11.6866 7.43973 11.1234 6.87656C10.5603 6.31339 9.79644 5.997 9 5.997C8.60564 5.997 8.21514 6.07468 7.8508 6.22559C7.48646 6.37651 7.15541 6.59771 6.87656 6.87656C6.5977 7.15542 6.3765 7.48646 6.22559 7.8508C6.07467 8.21515 5.997 8.60564 5.997 9C5.997 9.39436 6.07467 9.78486 6.22559 10.1492C6.3765 10.5135 6.5977 10.8446 6.87656 11.1234C7.15541 11.4023 7.48646 11.6235 7.8508 11.7744Z" fill="#FBFCFD"/>
                                    <path d="M14.6515 5.06322C14.8566 4.85815 14.9718 4.58002 14.9718 4.29C14.9718 3.99999 14.8566 3.72185 14.6515 3.51678C14.4464 3.31171 14.1683 3.1965 13.8783 3.1965C13.5883 3.1965 13.3101 3.31171 13.1051 3.51678C12.9 3.72185 12.7848 3.99999 12.7848 4.29C12.7848 4.58002 12.9 4.85815 13.1051 5.06322C13.3101 5.2683 13.5883 5.3835 13.8783 5.3835C14.1683 5.3835 14.4464 5.2683 14.6515 5.06322Z" fill="#FBFCFD"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.2896 0.0539999C6.2496 0.0102 6.5556 0 9 0C11.445 0 11.7504 0.0107999 12.7098 0.0539999C13.668 0.0978 14.3232 0.2508 14.8956 0.4722C15.4959 0.698315 16.0397 1.05253 16.4892 1.5102C16.947 1.95979 17.3012 2.50384 17.5272 3.1044C17.7498 3.6768 17.9022 4.3314 17.946 5.2896C17.9898 6.2496 18 6.5556 18 9C18 11.4444 17.9898 11.7504 17.946 12.7104C17.9022 13.6686 17.7498 14.3232 17.5278 14.8956C17.3017 15.4959 16.9475 16.0397 16.4898 16.4892C16.0398 16.9476 15.4956 17.3016 14.8956 17.5272C14.3232 17.7498 13.6686 17.9022 12.7104 17.946C11.7504 17.9898 11.4444 18 9 18C6.5556 18 6.2496 17.9898 5.2896 17.946C4.3314 17.9022 3.6768 17.7498 3.1044 17.5278C2.50411 17.3017 1.96029 16.9475 1.5108 16.4898C1.0524 16.0398 0.6984 15.4956 0.4728 14.8956C0.2502 14.3232 0.0978 13.6686 0.0539999 12.7104C0.0102 11.7504 0 11.445 0 9C0 6.555 0.0107999 6.2496 0.0539999 5.2902C0.0978 4.332 0.2508 3.6768 0.4722 3.1044C0.698315 2.5041 1.05253 1.96028 1.5102 1.5108C1.9602 1.0524 2.5044 0.6984 3.1044 0.4728C3.6768 0.2502 4.3314 0.0978 5.2896 0.0539999ZM12.6372 1.674C11.688 1.6308 11.403 1.6218 9 1.6218C6.597 1.6218 6.312 1.6308 5.3628 1.674C4.4856 1.7142 4.0092 1.8606 3.6918 1.9842C3.30085 2.12819 2.94716 2.35803 2.6568 2.6568C2.3424 2.9718 2.1468 3.2718 1.9842 3.6918C1.86 4.0092 1.7142 4.4856 1.674 5.3628C1.6308 6.312 1.6218 6.597 1.6218 9C1.6218 11.403 1.6308 11.688 1.674 12.6372C1.7142 13.5144 1.8606 13.9908 1.9842 14.3082C2.12828 14.6991 2.35811 15.0528 2.6568 15.3432C2.9472 15.6419 3.30087 15.8718 3.6918 16.0158C4.0092 16.14 4.4856 16.2858 5.3628 16.326C6.312 16.3692 6.5964 16.3782 9 16.3782C11.4036 16.3782 11.688 16.3692 12.6372 16.326C13.5144 16.2858 13.9908 16.1394 14.3082 16.0158C14.6992 15.8718 15.0528 15.642 15.3432 15.3432C15.6419 15.0528 15.8718 14.6991 16.0158 14.3082C16.14 13.9908 16.2858 13.5144 16.326 12.6372C16.3692 11.688 16.3782 11.403 16.3782 9C16.3782 6.597 16.3692 6.312 16.326 5.3628C16.2858 4.4856 16.1394 4.0092 16.0158 3.6918C15.8532 3.2718 15.6582 2.9718 15.3432 2.6568C15.0282 2.3424 14.7282 2.1468 14.3082 1.9842C13.9908 1.86 13.5144 1.7142 12.6372 1.674Z" fill="#FBFCFD"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="w-full lg:w-[65%] flex justify-between gap-0 lg:gap-16 flex-wrap lg:flex-nowrap">
                        <div class="w-1/2 lg:w-1/3">
                                <div class="space-y-6">
                                    <h3 class="paragraph-16s text-bkkNeutral-50">Link Terkait</h3>
                                    <div class="space-y-4">
                                        <a href="{{ route('beranda') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Laman Utama SMKN 4 Malang</a>
                                        <a href="https://disnakertrans.jatimprov.go.id/" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Disnakertrans Provinsi Jawa Timur</a>
                                        <a href="https://disnakerpmptsp.malangkota.go.id/" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Dinas Tenaga Kerja Kota Malang</a>
                                        <a href="https://www.kemendikbudristek.com/" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Kemendikbudristek</a>
                                        <a href="#" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Lulusan</a>
                                    </div>
                                </div>
                        </div>
                        <div class="w-1/2 lg:w-1/3">
                            <div class="space-y-6">
                                    <h3 class="paragraph-16s text-bkkNeutral-50">Layanan Kami</h3>
                                    <div class="space-y-4">
                                        <a href="{{ route('lowongan') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Lowongan Kerja</a>
                                        <a href="{{ route('tracer-study') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Tracer Study</a>
                                        <a href="{{ route('pengumuman') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Pengumuman</a>
                                        <a href="{{ route('visi-misi') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">Tentang Kami</a>
                                        <a href="{{ route('faq') }}" class="paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 block">FAQ</a>
                                    </div>
                                </div>
                        </div>
                        <div class="w-full lg:w-1/3 mt-10 lg:mt-0">
                            <div class="space-y-6">
                                    <h3 class="paragraph-16s text-bkkNeutral-50">Kontak</h3>
                                    <div class="space-y-4">
                                        <a href="https://maps.app.goo.gl/dQCR7sXjnCsp1QXS8" class="flex  gap-3 paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 ">
                                            <svg class="shrink-0" width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 6.51904C0.75 10.5622 4.28706 13.9058 5.85266 15.1877C6.07672 15.3711 6.19009 15.464 6.35726 15.511C6.48742 15.5477 6.679 15.5477 6.80916 15.511C6.97664 15.4639 7.08922 15.372 7.31413 15.1878C8.87972 13.9059 12.4166 10.5626 12.4166 6.51941C12.4166 4.98932 11.8021 3.52171 10.7081 2.43977C9.61413 1.35783 8.1305 0.75 6.5834 0.75C5.0363 0.75 3.55251 1.35792 2.45854 2.43986C1.36458 3.5218 0.75 4.98895 0.75 6.51904Z" stroke="#FBFCFD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4.91667 6.58333C4.91667 7.50381 5.66286 8.25 6.58333 8.25C7.50381 8.25 8.25 7.50381 8.25 6.58333C8.25 5.66286 7.50381 4.91667 6.58333 4.91667C5.66286 4.91667 4.91667 5.66286 4.91667 6.58333Z" stroke="#FBFCFD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Jalan Tanimbar Nomor 22, Kota Malang, Jawa Timur, kode pos 65117</span>
                                        </a>
                                        <a href="mailto:mail@smkn4malang.sch.id" class="flex items-center gap-3 paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 ">
                                            <svg class="shrink-0" width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.58333 1.58333L6.67303 5.42689L6.67473 5.4283C7.23987 5.84274 7.52261 6.05008 7.8323 6.13018C8.10602 6.20098 8.39376 6.20098 8.66748 6.13018C8.97744 6.05001 9.261 5.84206 9.82715 5.42689C9.82715 5.42689 13.0917 2.92162 14.9167 1.58333M0.75 9.75016V3.41683C0.75 2.48341 0.75 2.01635 0.931656 1.65983C1.09144 1.34623 1.34623 1.09144 1.65983 0.931656C2.01635 0.75 2.48341 0.75 3.41683 0.75H13.0835C14.0169 0.75 14.483 0.75 14.8395 0.931656C15.1531 1.09144 15.4087 1.34623 15.5685 1.65983C15.75 2.016 15.75 2.4825 15.75 3.41409V9.75298C15.75 10.6846 15.75 11.1504 15.5685 11.5066C15.4087 11.8202 15.1531 12.0754 14.8395 12.2352C14.4833 12.4167 14.0175 12.4167 13.0859 12.4167H3.41409C2.48249 12.4167 2.016 12.4167 1.65983 12.2352C1.34623 12.0754 1.09144 11.8202 0.931656 11.5066C0.75 11.15 0.75 10.6836 0.75 9.75016Z" stroke="#FBFCFD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>mail@smkn4malang.sch.id</span>
                                        </a>
                                        <a href="tel:0341353798" class="flex items-center gap-3 paragraph-14r text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300 ">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.16872 1.79768C5.91561 1.16492 5.30276 0.75 4.62126 0.75H2.32895C1.45692 0.75 0.75 1.45675 0.75 2.32878C0.75 9.74102 6.75898 15.75 14.1712 15.75C15.0433 15.75 15.75 15.043 15.75 14.171L15.7504 11.8783C15.7504 11.1968 15.3356 10.584 14.7028 10.3309L12.5058 9.45245C11.9374 9.22509 11.2902 9.32741 10.82 9.71932L10.2529 10.1922C9.59072 10.7441 8.61636 10.7002 8.00683 10.0907L6.41018 8.49255C5.80066 7.88302 5.75561 6.90945 6.30745 6.24724L6.78027 5.68025C7.17218 5.20996 7.27541 4.56263 7.04805 3.99424L6.16872 1.79768Z" stroke="#FBFCFD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>(0341) 353798</span>
                                        </a>
                                    </div>
                                </div>
                        </div>
                        </div>
                    </div>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-between py-8 paragraph-14r text-bkkNeutral-50 gap-6 md:gap-0">
                        <div>© 2026 BKK SMKN 4 Malang. All rights reserved.</div>
                        <div class="flex items-center gap-5 md:gap-10">
                            <a 
                            href="#"
                            class="text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300">Kebijakan Privasi</a>
                            <a 
                            href="#"
                            class="text-bkkNeutral-50 hover:text-bkkNeutral-200 transition duration-300">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @livewireScripts
    </body>
</html>
