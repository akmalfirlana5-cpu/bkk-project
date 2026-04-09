<div>
    <section class="py-30 lg:py-25">
        <div class="container mx-auto px-5 lg:px-0">
            <h1 class="heading-42s text-bkkNeutral-900 mb-9">Riwayat Lamaran</h1>
            <div class="flex flex-col md:flex-row items-start md:items-end gap-3 mb-12">
                <div class="w-full md:w-[90%]">
                    <div class="heading-16 mb-3">Kata Kunci Pekerjaan</div>
                    <div class="relative">
                        <input 
                            class="py-3 px-6 border border-bkkNeutral-200 rounded-xl w-full focus:ring-primary focus:border-primary paragraph-14r"
                            wire:model.live.debounce.500ms="filterSearch"
                            type="text"
                            placeholder="Masukkan kata kunci"
                        />
                    </div>
                </div>
                <div class=" md:w-[10%]">
                    <button 
                        class="md:w-full py-3 px-6 bg-primary rounded-xl text-bkkNeutral-50 paragraph-16s cursor-pointer hover:bg-primary-hover transition duration-300"
                    >
                        Cari
                    </button>
                </div>
            </div>
            <div id="lamaran" class="space-y-6 scroll-mt-25">
                @forelse ( $applications as $application )
                    <a  href="{{ route('lowongan-detail', $application->vacancy->entryId) }}" 
                        class="w-full flex justify-between items-start p-6 shadow-lg rounded-2xl bg-white">
                        <div class="flex items-center">
                            <div class="w-16 lg:w-22 h-16 lg:h-22 rounded-full overflow-hidden mr-6">
                                <img 
                                    src="{{ $application->company->companies_logo 
                                    ? \Illuminate\Support\Facades\Storage::url($application->company->companies_logo) 
                                    : asset('assets/static/partial/fallbackUser.webp') }}" 
                                    class="w-full h-full object-cover object-center"
                                />
                            </div>
                            <div class="flex flex-col justify-between h-full gap-3">
                                <div>
                                    <h2 class="heading-24s text-bkkNeutral-900 capitalize">
                                        {{ $application->vacancy->vacancy_name }}
                                    </h2>
                                    <div class="paragraph-14r text-bkkNeutral-800 capitalize">
                                        {{ $application->company->companies_name }}
                                    </div>
                                </div>
                                <div class="paragraph-12r text-bkkNeutral-700">
                                    Melamar pada 
                                    {{ \Carbon\Carbon::parse( $application->created_at )->translatedFormat('d F Y') }}
                                </div>
                            </div>
                        </div>
                        <div 
                            class="paragraph-12s capitalize justify-self-end px-2.5 py-1 flex items-center gap-2 rounded-lg 
                            @if ( $application->status == 'diterima' )
                                text-[#007A56]
                                bg-[#C8FFEF]

                            @elseif ( $application->status == 'ditolak' )
                                text-[#C70035]
                                bg-[#FFB1C6]
                            @elseif ( $application->status == 'diproses' || $application->status == 'dikirim' )
                                text-[#926B00]
                                bg-[#FFCD44]
                            @else
                                text-bkkNeutral-600
                            @endif
                            ">
                            @if ( $application->status == 'diterima' )
                                <svg class="w-3.5 h-3.5 shrink-0" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.75 5.41667L6.08333 8.08333L4.75 6.75M6.75 12.75C3.43629 12.75 0.75 10.0637 0.75 6.75C0.75 3.43629 3.43629 0.75 6.75 0.75C10.0637 0.75 12.75 3.43629 12.75 6.75C12.75 10.0637 10.0637 12.75 6.75 12.75Z" stroke="#007A56" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            @elseif ( $application->status == 'ditolak' )
                                <svg class="w-3.5 h-3.5 shrink-0" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.75 4.75L6.74996 6.74996M6.74996 6.74996L8.74992 8.74992M6.74996 6.74996L4.75 8.74992M6.74996 6.74996L8.74992 4.75M6.75 12.75C3.43629 12.75 0.75 10.0637 0.75 6.75C0.75 3.43629 3.43629 0.75 6.75 0.75C10.0637 0.75 12.75 3.43629 12.75 6.75C12.75 10.0637 10.0637 12.75 6.75 12.75Z" stroke="#C70035" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @elseif ( $application->status == 'diproses' || $application->status == 'dikirim' )
                                <svg class="w-3.5 h-3.5 shrink-0" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.75 3.41667V6.75H10.0833M6.75 12.75C3.43629 12.75 0.75 10.0637 0.75 6.75C0.75 3.43629 3.43629 0.75 6.75 0.75C10.0637 0.75 12.75 3.43629 12.75 6.75C12.75 10.0637 10.0637 12.75 6.75 12.75Z" stroke="#926B00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            @endif
                            {{ $application->status }}
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 px-6 bg-white rounded-[32px] border border-bkkNeutral-100 shadow-sm">
                    <div class="w-24 h-24 bg-bkkBlue-50 text-primary rounded-full flex items-center justify-center mb-6">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 13H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 17H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h2 class="heading-32s text-bkkNeutral-900 mb-2 text-center">Belum Ada Lamaran</h2>
                    <p class="paragraph-16r text-bkkNeutral-600 text-center max-w-sm mb-8">
                        Sepertinya Anda belum melamar pekerjaan apa pun. Mulai bangun karier Anda dengan menjelajahi lowongan yang tersedia.
                    </p>

                    <a href="{{ route('lowongan') }}" 
                    class="px-8 py-3 bg-primary hover:bg-primary-hover text-white rounded-xl paragraph-16s transition duration-300 shadow-lg shadow-bkkBlue-200 cursor-pointer">
                        Cari Lowongan Sekarang
                    </a>
                </div>
                @endforelse
            </div>
            <div class="mt-16 flex justify-center w-full">
                {{ $applications->links(data: ['scrollTo' => '#lamaran']) }}
            </div>
        </div>
    </section>
</div>
