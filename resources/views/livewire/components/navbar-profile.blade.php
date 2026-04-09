<div>
    <div 
        x-data="{openUserDropdown : false}"
        class="text-bkkNeutral-900 relative hidden lg:block">
        <div  
            @click="openUserDropdown = !openUserDropdown"
            class="w-10 h-10 rounded-full overflow-hidden cursor-pointer">
            <img 
                src="{{ Auth::user()->photo 
                ? \Illuminate\Support\Facades\Storage::url(Auth::user()->photo) 
                : asset('assets/static/partial/fallbackUser.webp') }}" 
                class="w-full h-full object-cover object-center" />
        </div>
        {{-- User Dropdown --}}
        <div
            x-cloak
            @click.outside="openUserDropdown = false"
            x-show="openUserDropdown"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-12 -right-3 bg-white shadow-xl z-50 border border-bkkNeutral-100 rounded-2xl p-6 w-[250px]">
            <div class="flex flex-col gap-4">
                <a href="{{ route('data-pribadi') }}"
                    class="paragraph-16r {{ request()->routeIs('data-pribadi') ? 'text-primary' : 'text-bkkNeutral-900 hover:text-primary' }} transition duration-300 flex items-center gap-3">
                    <svg 
                        class="w-4 h-4 shrink-0"
                        width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.4167 12.75C11.4167 10.9091 9.02885 9.41667 6.08333 9.41667C3.13781 9.41667 0.75 10.9091 0.75 12.75M6.08333 7.41667C4.24238 7.41667 2.75 5.92428 2.75 4.08333C2.75 2.24238 4.24238 0.75 6.08333 0.75C7.92428 0.75 9.41667 2.24238 9.41667 4.08333C9.41667 5.92428 7.92428 7.41667 6.08333 7.41667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span>
                        Profil Saya
                    </span>
                </a>
                <a href="{{ route('riwayat-lamaran') }}"
                    class="paragraph-16r {{ request()->routeIs('riwayat-lamaran') ? 'text-primary' : 'text-bkkNeutral-900 hover:text-primary' }} transition duration-300 flex items-center gap-3">
                    <svg 
                        class="w-4 h-4 shrink-0"
                        width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.41667 10.0833H7.41667M3.41667 8.08333H7.41667M6.08358 0.750581C6.01989 0.75 5.94825 0.75 5.86648 0.75H2.88346C2.13673 0.75 1.76308 0.75 1.47786 0.895325C1.22698 1.02316 1.02316 1.22698 0.895325 1.47786C0.75 1.76308 0.75 2.13673 0.75 2.88346V10.6168C0.75 11.3635 0.75 11.7367 0.895325 12.0219C1.02316 12.2728 1.22698 12.477 1.47786 12.6048C1.7628 12.75 2.136 12.75 2.88129 12.75L7.95206 12.75C8.69734 12.75 9.06999 12.75 9.35493 12.6048C9.60581 12.477 9.81032 12.2728 9.93815 12.0219C10.0833 11.737 10.0833 11.3643 10.0833 10.6191V4.96712C10.0833 4.88535 10.0833 4.81369 10.0827 4.75M6.08358 0.750581C6.27389 0.752317 6.39381 0.759378 6.50879 0.78698C6.64483 0.819643 6.77523 0.87351 6.89453 0.946615C7.02904 1.02904 7.14454 1.14454 7.375 1.375L9.45866 3.45866C9.68926 3.68926 9.80391 3.80424 9.88637 3.9388C9.95947 4.05809 10.0136 4.18817 10.0462 4.32422C10.0738 4.43919 10.0809 4.5597 10.0827 4.75M6.08358 0.750581L6.08333 2.61681C6.08333 3.36354 6.08333 3.73677 6.22866 4.02198C6.35649 4.27287 6.56031 4.47699 6.8112 4.60482C7.09613 4.75 7.46934 4.75 8.21461 4.75H10.0827" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>
                        Riwayat Lamaran
                    </span>
                </a>
                <a href="{{ route('isi-tracer-study') }}"
                    class="paragraph-16r {{ request()->routeIs('isi-tracer-study') ? 'text-primary' : 'text-bkkNeutral-900 hover:text-primary' }} transition duration-300 flex items-center gap-3">
                    <svg 
                        class="w-4 h-4 shrink-0"
                        width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.75 7.41682V8.61667C0.75 9.3634 0.75 9.73651 0.895325 10.0217C1.02316 10.2726 1.22698 10.477 1.47786 10.6048C1.7628 10.75 2.136 10.75 2.88127 10.75H12.7501M0.75 7.41682V0.75M0.75 7.41682L3.31893 5.27604L3.32106 5.27434C3.78578 4.88707 4.01859 4.69306 4.27103 4.61426C4.56925 4.52117 4.89047 4.53589 5.17904 4.6556C5.42367 4.75708 5.63817 4.97159 6.06717 5.40059L6.07148 5.40489C6.50714 5.84056 6.72556 6.05897 6.97411 6.16023C7.26824 6.28005 7.59569 6.29037 7.89714 6.19038C8.15271 6.1056 8.38613 5.9017 8.85286 5.49331L12.75 2.08333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>
                        Isi Tracer Study
                    </span>
                </a>
                {{-- Divider --}}
                <div class="h-px w-full bg-bkkNeutral-200"></div>
                <livewire:components.logout />
            </div>
        </div>
    </div>
    {{-- Mobile view --}}
    <div 
        class="flex lg:hidden items-center gap-4 my-6">
        <div class="w-14 h-14 rounded-full overflow-hidden">
            <img 
                src="{{ Auth::user()->photo 
                ? \Illuminate\Support\Facades\Storage::url(Auth::user()->photo) 
                : asset('assets/static/partial/fallbackUser.webp') }}" 
                class="w-full h-full object-cover object-center" />
        </div>
        <div class="flex flex-col gap-2">
            <span class="paragraph-16s text-bkkNeutral-900">
                {{ Auth::user()->full_name }}
            </span>
            <span class="paragraph-14r text-bkkNeutral-900">
                {{ Auth::user()->major }}
            </span>
        </div>
    </div>
</div>
