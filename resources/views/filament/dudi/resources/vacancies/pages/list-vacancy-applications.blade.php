<x-filament-panels::page>
    {{-- Info Lowongan --}}
    <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Posisi</p>
                <p class="text-base font-semibold text-gray-950 dark:text-white">{{ $record->vacancy_name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Tenggat Waktu</p>
                <p class="text-base font-semibold text-gray-950 dark:text-white">{{ $record->deadline ? $record->deadline->format('d M Y') : '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Lokasi</p>
                <p class="text-base font-semibold text-gray-950 dark:text-white">{{ $record->location ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kuota</p>
                <p class="text-base font-semibold text-gray-950 dark:text-white">{{ $record->vacancy_number ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Pelamar</p>
                <p class="text-base font-semibold text-gray-950 dark:text-white">{{ $record->applications()->count() }}</p>
            </div>
        </div>
    </div>

    {{ $this->table }}
</x-filament-panels::page>
