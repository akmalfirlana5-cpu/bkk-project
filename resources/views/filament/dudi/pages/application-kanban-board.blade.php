<x-filament-panels::page>
    @php
        $statuses = $this->getStatuses();
        $applicationsByStatus = $this->getApplicationsByStatus();
        $vacancies = $this->getVacancies();
        $selectedVacancyId = $this->selectedVacancyId;
        $selectedVacancy = $selectedVacancyId 
            ? $vacancies->firstWhere('id', $selectedVacancyId) 
            : null;
        $totalApplications = $applicationsByStatus->flatten()->count();
    @endphp

    {{-- TOOLBAR FILTER --}}
    <div class="flex items-center justify-between gap-4 mb-4 flex-wrap">
        <div class="flex items-center gap-2 flex-wrap">
            {{-- Tombol Semua Lowongan --}}
            <button
                wire:click="filterByVacancy(null)"
                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                    {{ is_null($selectedVacancyId) 
                        ? 'bg-primary-600 text-white shadow-sm' 
                        : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' 
                    }}"
            >
                <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                Semua Lowongan
            </button>

            {{-- Tombol per Lowongan --}}
            @foreach($vacancies as $vacancy)
                <button
                    wire:click="filterByVacancy({{ $vacancy->id }})"
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium transition-colors max-w-[220px]
                        {{ $selectedVacancyId === $vacancy->id 
                            ? 'bg-primary-600 text-white shadow-sm' 
                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' 
                        }}"
                >
                    <x-heroicon-o-briefcase class="w-4 h-4 shrink-0" />
                    <span class="truncate">{{ $vacancy->vacancy_name }}</span>
                </button>
            @endforeach
        </div>

        {{-- Info Total Pelamar --}}
        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 shrink-0">
            <x-heroicon-o-users class="w-4 h-4" />
            <span>
                {{ $totalApplications }} Pelamar
                @if($selectedVacancy)
                    &mdash; <span class="font-medium text-gray-700 dark:text-gray-200">{{ $selectedVacancy->vacancy_name }}</span>
                @endif
            </span>
        </div>
    </div>

    {{-- KANBAN BOARD --}}
    <div
        x-data="kanbanBoard()"
        class="flex gap-4 overflow-x-auto pb-4 items-start"
    >
        @foreach($statuses as $statusKey => $statusLabel)
            @php
                $statusApplications = $applicationsByStatus->get($statusKey, collect());

                $columnColor = match($statusKey) {
                    'belum_diproses' => 'border-gray-300 dark:border-gray-600',
                    'lolos_berkas'   => 'border-blue-400 dark:border-blue-500',
                    'interview'      => 'border-yellow-400 dark:border-yellow-500',
                    'diterima'       => 'border-emerald-400 dark:border-emerald-500',
                    'ditolak'        => 'border-red-400 dark:border-red-500',
                    default          => 'border-gray-300 dark:border-gray-600',
                };

                $headerColor = match($statusKey) {
                    'belum_diproses' => 'text-gray-600 dark:text-gray-300',
                    'lolos_berkas'   => 'text-blue-600 dark:text-blue-400',
                    'interview'      => 'text-yellow-600 dark:text-yellow-400',
                    'diterima'       => 'text-emerald-600 dark:text-emerald-400',
                    'ditolak'        => 'text-red-600 dark:text-red-400',
                    default          => 'text-gray-600 dark:text-gray-300',
                };

                $badgeColor = match($statusKey) {
                    'belum_diproses' => 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300',
                    'lolos_berkas'   => 'bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300',
                    'interview'      => 'bg-yellow-100 dark:bg-yellow-500/20 text-yellow-700 dark:text-yellow-300',
                    'diterima'       => 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-700 dark:text-emerald-300',
                    'ditolak'        => 'bg-red-100 dark:bg-red-500/20 text-red-700 dark:text-red-300',
                    default          => 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300',
                };
            @endphp
            
            <div 
                class="flex-shrink-0 w-72 bg-gray-50 dark:bg-gray-800/80 rounded-xl flex flex-col border-t-4 {{ $columnColor }} shadow-sm"
                x-on:dragover.prevent="onDragOver('{{ $statusKey }}')"
                x-on:drop.prevent="onDrop($event, '{{ $statusKey }}')"
            >
                {{-- Column Header --}}
                <div class="flex items-center justify-between px-4 py-3">
                    <h3 class="font-bold {{ $headerColor }} uppercase text-xs tracking-widest">
                        {{ $statusLabel }}
                    </h3>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $badgeColor }}">
                        {{ $statusApplications->count() }}
                    </span>
                </div>

                {{-- Card List --}}
                <div 
                    class="flex flex-col gap-2 overflow-y-auto min-h-[120px] max-h-[70vh] px-3 pb-3"
                    id="column-{{ $statusKey }}"
                >
                    @forelse($statusApplications as $application)
                        <div
                            draggable="true"
                            x-on:dragstart="onDragStart($event, '{{ $application->id }}')"
                            x-on:dragend="onDragEnd($event)"
                            class="bg-white dark:bg-gray-900 rounded-lg p-3 shadow-sm border border-gray-200 dark:border-gray-700 cursor-move hover:shadow-md hover:border-primary-400 dark:hover:border-primary-500 transition-all"
                        >
                            <div class="flex items-start gap-3">
                                {{-- Avatar --}}
                                <div class="w-9 h-9 rounded-full overflow-hidden shrink-0 bg-gray-100 dark:bg-gray-800 flex items-center justify-center border border-gray-200 dark:border-gray-700">
                                    @if($application->user->photo)
                                        <img src="{{ Storage::url($application->user->photo) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>

                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100 text-sm truncate">
                                        {{ $application->user->full_name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ $application->user->major ?? 'N/A' }}
                                    </p>
                                    @if(!$selectedVacancyId)
                                        {{-- Tampilkan nama lowongan hanya saat mode "semua lowongan" --}}
                                        <span class="mt-1 inline-block text-xs bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-400 py-0.5 px-2 rounded font-medium truncate max-w-full">
                                            {{ $application->vacancy->vacancy_name ?? '-' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Action Link: Lihat CV --}}
                            <div class="mt-3">
                                @if($application->user->CVuser)
                                    <a 
                                        href="{{ \App\Http\Controllers\CvController::signedCvUrl($application->user) }}"
                                        target="_blank"
                                        class="flex w-full justify-center items-center gap-1.5 bg-primary-50 hover:bg-primary-100 dark:bg-primary-500/10 dark:hover:bg-primary-500/20 text-primary-700 dark:text-primary-400 py-1.5 px-3 rounded text-xs font-medium transition border border-primary-200 dark:border-primary-500/30"
                                    >
                                        <x-heroicon-o-document-text class="w-3.5 h-3.5" />
                                        Lihat CV
                                    </a>
                                @else
                                    <span class="flex w-full justify-center items-center gap-1.5 bg-gray-50 dark:bg-gray-800 text-gray-400 dark:text-gray-600 py-1.5 px-3 rounded text-xs font-medium border border-gray-200 dark:border-gray-700 cursor-not-allowed">
                                        <x-heroicon-o-x-circle class="w-3.5 h-3.5" />
                                        CV Belum Diupload
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8 text-gray-400 dark:text-gray-600">
                            <x-heroicon-o-inbox class="w-8 h-8 mb-2" />
                            <p class="text-xs">Tidak ada pelamar</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    <!-- Alpine.js Kanban Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('kanbanBoard', () => ({
                draggingCardId: null,

                onDragStart(event, cardId) {
                    this.draggingCardId = cardId;
                    event.dataTransfer.effectAllowed = 'move';
                    event.target.style.opacity = '0.5';
                },

                onDragEnd(event) {
                    event.target.style.opacity = '1';
                    this.draggingCardId = null;
                },

                onDragOver(statusKey) {
                    // Required to allow drop
                },

                onDrop(event, statusKey) {
                    if (this.draggingCardId) {
                        @this.updateApplicationStatus(this.draggingCardId, statusKey);
                    }
                }
            }))
        })
    </script>
</x-filament-panels::page>
