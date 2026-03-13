<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Data Identitas --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6">
            <h3 class="text-lg font-semibold text-gray-950 dark:text-white mb-4">Data Identitas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($record->identity_data as $key => $value)
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ str_replace('_', ' ', ucwords($key, '_')) }}</p>
                        <p class="text-base font-medium text-gray-950 dark:text-white">{{ $value ?: '-' }}</p>
                    </div>
                @endforeach
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No HP</p>
                    <p class="text-base font-medium text-gray-950 dark:text-white">{{ $record->phone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Pengisian</p>
                    <p class="text-base font-medium text-gray-950 dark:text-white">{{ $record->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Jawaban Survey --}}
        <div class="fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 p-6">
            <h3 class="text-lg font-semibold text-gray-950 dark:text-white mb-4">Jawaban Survey</h3>
            <div class="space-y-4">
                @foreach ($record->answers->sortBy('question.sort_order') as $index => $answer)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-3 last:border-b-0">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $index + 1 }}. {{ $answer->question->question_text ?? 'Soal tidak ditemukan' }}</p>
                        <p class="text-base font-medium text-gray-950 dark:text-white">{{ $answer->answer ?: '-' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page>
