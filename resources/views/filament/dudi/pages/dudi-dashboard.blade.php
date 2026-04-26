<x-filament-panels::page>
    {{-- WIDGETS (Stats + Chart side by side) --}}
    <x-filament-widgets::widgets
        :widgets="$this->getVisibleWidgets()"
        :columns="$this->getColumns()"
    />

    {{-- QUICK NAVIGATION BUTTONS --}}
    <div class="mt-8 mb-2">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Navigasi Halaman</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Akses cepat ke menu utama perusahaan Anda</p>
    </div>
    
    <div class="flex flex-wrap md:flex-nowrap gap-4">
        {{-- Lowongan --}}
        <a 
            href="{{ route('filament.dudi.resources.vacancies.index') }}"
            class="group relative flex-1 flex flex-row items-center justify-between gap-3 rounded-2xl bg-white dark:bg-gray-900 p-5 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 hover:shadow-md hover:ring-emerald-400 dark:hover:ring-emerald-500 transition-all overflow-hidden"
        >
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/60 to-transparent dark:from-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform flex-shrink-0">
                    <x-heroicon-o-briefcase class="w-5 h-5" />
                </span>
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Kelola Lowongan</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 hidden lg:block">Buat & kelola lowongan</p>
                </div>
            </div>
            <x-heroicon-o-arrow-right class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400 group-hover:translate-x-1 transition-transform" />
        </a>

        {{-- Kanban Board --}}
        <a 
            href="{{ route('filament.dudi.pages.pelacakan-pendaftar') }}"
            class="group relative flex-1 flex flex-row items-center justify-between gap-3 rounded-2xl bg-white dark:bg-gray-900 p-5 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 hover:shadow-md hover:ring-indigo-400 dark:hover:ring-indigo-500 transition-all overflow-hidden"
        >
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/60 to-transparent dark:from-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform flex-shrink-0">
                    <x-heroicon-o-view-columns class="w-5 h-5" />
                </span>
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Kanban Pelamar</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 hidden lg:block">Pelacakan kandidat</p>
                </div>
            </div>
            <x-heroicon-o-arrow-right class="w-5 h-5 flex-shrink-0 text-indigo-600 dark:text-indigo-400 group-hover:translate-x-1 transition-transform" />
        </a>

        {{-- Profil Perusahaan --}}
        <a 
            href="{{ route('filament.dudi.pages.company-profile') }}"
            class="group relative flex-1 flex flex-row items-center justify-between gap-3 rounded-2xl bg-white dark:bg-gray-900 p-5 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 hover:shadow-md hover:ring-amber-400 dark:hover:ring-amber-500 transition-all overflow-hidden"
        >
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50/60 to-transparent dark:from-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform flex-shrink-0">
                    <x-heroicon-o-building-office-2 class="w-5 h-5" />
                </span>
                <div>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Profil Perusahaan</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 hidden lg:block">Perbarui profil</p>
                </div>
            </div>
            <x-heroicon-o-arrow-right class="w-5 h-5 flex-shrink-0 text-amber-600 dark:text-amber-400 group-hover:translate-x-1 transition-transform" />
        </a>
    </div>
</x-filament-panels::page>
