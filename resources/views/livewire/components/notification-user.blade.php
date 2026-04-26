<div>
    <div 
        x-data="{ 
            openNotif: false, 
            showModal: false, 
            modalTitle: '', 
            modalContent: '' 
        }"
        class="text-bkkNeutral-900 relative ">
        <div  
            @click="openNotif = !openNotif"
            class="w-10 h-10 flex items-center justify-center cursor-pointer hover:bg-bkkNeutral-100 rounded-full transition relative">
            <svg width="20" height="20" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.6667 19.6667V21C15.6667 23.2091 13.8758 25 11.6667 25C9.45753 25 7.66667 23.2091 7.66667 21V19.6667M15.6667 19.6667H7.66667M15.6667 19.6667H20.454C20.964 19.6667 21.2203 19.6667 21.4268 19.597C21.8213 19.4639 22.13 19.1542 22.263 18.7597C22.333 18.5524 22.333 18.2953 22.333 17.7813C22.333 17.5563 22.3327 17.4438 22.3151 17.3366C22.2818 17.1339 22.2032 16.9418 22.0834 16.775C22.0201 16.6868 21.9397 16.6064 21.7811 16.4478L21.2617 15.9284C21.0942 15.7608 21 15.5335 21 15.2965V10.3333C21 5.17867 16.8213 0.999987 11.6667 1C6.51202 1.00001 2.33333 5.17869 2.33333 10.3333V15.2966C2.33333 15.5336 2.23899 15.7608 2.07142 15.9284L1.55208 16.4477C1.39301 16.6068 1.31339 16.6867 1.25 16.775C1.13021 16.9418 1.05086 17.1339 1.0176 17.3366C1 17.4438 1 17.5563 1 17.7813C1 18.2953 1 18.5523 1.06994 18.7597C1.203 19.1541 1.51306 19.4639 1.90755 19.597C2.11408 19.6667 2.36935 19.6667 2.87941 19.6667H7.66667" stroke="#181D25" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

            @php
              $unreadCount = collect($notifications)
                ->where('is_read', false)
                ->count();
            @endphp

            @if($unreadCount > 0)
                <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-primary text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white">
                    {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                </span>
            @endif
        </div>

        <div
            x-cloak
            x-show="openNotif"
            @click.outside="openNotif = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute top-12 -right-13 md:-right-2 bg-white shadow-2xl z-50 border border-bkkNeutral-100 rounded-3xl w-[380px] overflow-hidden">
            
            <div class="px-6 py-4 border-b border-bkkNeutral-50 flex justify-between items-center bg-bkkNeutral-50/50">
                <h3 class="heading-16s text-bkkNeutral-900">Notifikasi</h3>
                @if(count($notifications) > 0)
                    <span class="text-[11px] text-primary font-bold uppercase tracking-wider bg-bkkBlue-50 px-2 py-1 rounded-md">Baru</span>
                @endif
            </div>

            {{-- List Notifikasi --}}
            <div class="max-h-[400px] overflow-y-auto">
                @forelse ($notifications as $notification)
                        <div  
                        @click="
                            if ('{{ $notification['type'] }}' === 'admin-message') {
                                modalTitle = {{ json_encode($notification['title']) }};
                                modalContent = {{ json_encode($notification['message']) }};
                                showModal = true;
                                openNotif = false;
                            }
                            $wire.markAsRead('{{ $notification['id'] }}', '{{ $notification['link'] }}');
                        "
                        class="flex items-start gap-4 px-6 py-5 transition border-b border-bkkNeutral-50 last:border-none group cursor-pointer
                            {{ !$notification['is_read'] ? 'bg-bkkBlue-50 hover:bg-blue-100/60' : 'hover:bg-bkkNeutral-50' }}"
                    >
                        {{-- Ikon Berdasarkan Type --}}
                        <div class="mt-1 shrink-0 relative">
                            @if($notification['type'] === 'tracer-study')
                                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                </div>
                            @elseif($notification['type'] === 'admin-message')
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            {{-- Titik belum dibaca --}}
                            @if(!$notification['is_read'])
                                <span class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-primary rounded-full border-2 border-white"></span>
                            @endif
                        </div>

                        <div class="flex-1 flex flex-col gap-0.5 overflow-hidden">
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="paragraph-14s text-bkkNeutral-900 truncate {{ !$notification['is_read'] ? 'font-bold' : 'font-semibold' }}">
                                    {{ $notification['title'] }}
                                </h4>
                                @if(!$notification['is_read'])
                                    <span class="shrink-0 text-[10px] text-primary font-bold bg-primary/10 px-1.5 py-0.5 rounded-full">Baru</span>
                                @endif
                            </div>
                            <p class="text-[13px] text-bkkNeutral-600 leading-snug line-clamp-2">
                                {{ strip_tags($notification['message']) }}
                            </p>
                            <span class="text-[10px] text-bkkNeutral-400 mt-1">
                                {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 px-6">
                        <div class="w-16 h-16 bg-bkkNeutral-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-bkkNeutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <p class="paragraph-14r text-bkkNeutral-500">Tidak ada notifikasi baru</p>
                    </div>
                @endforelse
            </div>

            <div class="px-6 py-3 bg-bkkNeutral-50 text-center border-t border-bkkNeutral-100">
                <button @click="openNotif = false" class="text-[12px] text-bkkNeutral-500 hover:text-primary transition font-bold uppercase tracking-widest">Tutup</button>
            </div>
        </div>

        {{-- MODAL PESAN ADMIN --}}
        <div 
            x-cloak
            x-show="showModal" 
            class="fixed inset-0 z-[60] flex items-center justify-center p-4"
        >
            {{-- Backdrop (Bright/Cerah) --}}
            <div 
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="showModal = false"
                class="absolute inset-0 bg-white/40 backdrop-blur-md"
            ></div>

            {{-- Modal Content --}}
            <div 
                x-show="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative bg-white rounded-3xl shadow-[0_30px_100px_rgba(0,0,0,0.1)] w-full max-w-lg overflow-hidden inline-block align-middle border border-gray-100"
            >
                {{-- Header --}}
                <div class="px-8 pt-8 pb-4 flex justify-between items-start bg-white">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold text-primary uppercase tracking-[0.2em] mb-1">Pesan Sistem</span>
                        <h3 class="text-xl font-bold text-gray-900" x-text="modalTitle"></h3>
                    </div>
                    <button @click="showModal = false" class="bg-gray-50 p-2 rounded-xl text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Body --}}
                <div class="px-8 pb-8 bg-white">
                    <div class="max-h-[60vh] overflow-y-auto prose prose-sm max-w-none prose-p:text-gray-600 prose-headings:text-gray-900 prose-a:text-primary leading-relaxed" x-html="modalContent"></div>
                </div>

                {{-- Footer --}}
                <div class="px-8 py-6 border-t border-gray-50 flex justify-end bg-white">
                    <button 
                        @click="showModal = false"
                        class="w-full md:w-auto bg-primary text-white px-8 py-3 rounded-2xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-primary/20 hover:shadow-primary/30"
                    >
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>