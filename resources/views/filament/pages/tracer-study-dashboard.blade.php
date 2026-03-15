<x-filament-panels::page>
    @php
        $tabs = [
            'semua' => ['label' => 'Semua', 'icon' => 'heroicon-o-squares-2x2'],
            'bekerja' => ['label' => 'Bekerja', 'icon' => 'heroicon-o-briefcase'],
            'kuliah' => ['label' => 'Kuliah', 'icon' => 'heroicon-o-academic-cap'],
            'wirausaha' => ['label' => 'Wirausaha', 'icon' => 'heroicon-o-building-storefront'],
            'belum_bekerja' => ['label' => 'Belum Bekerja', 'icon' => 'heroicon-o-x-circle'],
        ];
        $counts = $this->getTabCounts();
    @endphp

    <div class="fi-sc-tabs fi-contained rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-bottom: 0; margin-bottom: -2.1rem; position: relative; z-index: 10;">
        <div class="flex gap-x-1 overflow-x-auto p-2">
            @foreach($tabs as $key => $tab)
                <button 
                    wire:click="setTab('{{ $key }}')"
                    @class([
                        'fi-tabs-item flex items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium outline-none transition',
                        'fi-active bg-gray-50 dark:bg-white/5 text-primary-600 dark:text-primary-400' => $activeTab === $key,
                        'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' => $activeTab !== $key,
                    ])
                >
                    <x-filament::icon :icon="$tab['icon']" class="h-5 w-5" />
                    <span>{{ $tab['label'] }}</span>
                    <span @class([
                        'fi-badge inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs font-medium ring-1 ring-inset min-w-[1.25rem]',
                        'bg-primary-50 text-primary-600 ring-primary-600/10 dark:bg-primary-400/10 dark:text-primary-400 dark:ring-primary-400/30' => $activeTab === $key,
                        'bg-gray-50 text-gray-600 ring-gray-600/10 dark:bg-gray-400/10 dark:text-gray-400 dark:ring-gray-400/20' => $activeTab !== $key,
                    ])>
                        {{ $counts[$key] ?? 0 }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>

    @livewire($this->getActiveTableWidget(), [], key($activeTab))

    <style>
        .fi-wi-table-widget { margin-top: 0 !important; padding: 0 !important; }
        .fi-wi-table .fi-ta-ctn { border-top-left-radius: 0 !important; border-top-right-radius: 0 !important; border-top: 0 !important; }
    </style>
</x-filament-panels::page>
