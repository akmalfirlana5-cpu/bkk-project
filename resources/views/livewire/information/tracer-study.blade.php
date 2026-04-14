<div>
    <section class="pt-30 lg:pt-25">
        <div 
            style="background-image: url('{{ asset('storage/' . $tracerContent['tracer_study']['hero_image']) }}')"
            class="container mx-auto px-5 lg:px-0 rounded-3xl bg-cover bg-center relative h-[50vh] overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-t from-bkkNeutral-900/90 to-88% to-bkkNeutral-900/45 z-1"></div>
            <div class="relative z-2 w-full h-full flex flex-col justify-center mx-0 lg:mx-14">
                <div class="flex items-center gap-2.5 paragraph-16s text-bkkNeutral-50 mb-7">
                    <a href="{{ route('beranda') }}">Beranda</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="#">Informasi & Pengumuman</a>
                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L5 5L1 9" stroke="#FBFCFD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a href="{{ route('tracer-study') }}">Tracer Study</a>
                </div>
                <h1 class="heading-48s text-bkkNeutral-50 mb-3 lg:w-[55%]">
                    {{ $tracerContent['tracer_study']['hero_title'] }}
                </h1>
                <div class="paragraph-16r text-bkkNeutral-100 w-full lg:w-[50%]">
                    {{ $tracerContent['tracer_study']['hero_description'] }}
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 lg:py-20">
        <div class="container mx-auto px-5 lg:px-0">
            <h2 class="heading-42s text-bkkNeutral-900 mb-2">
                {{ $tracerContent['tracer_study']['section_title'] }}
            </h2>
            <div class="paragraph-16r text-bkkNeutral-700 mb-9">
                    {{ $tracerContent['tracer_study']['section_description'] }}
            </div>
            {{-- Chart js cdn --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-3xl shadow-lg" wire:ignore>
                    <h2 class="heading-32s text-bkkNeutral-900 mb-6">Distribusi Status Alumni</h2>
                    <div class="h-[300px]">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-3xl shadow-lg">
                    <h2 class="heading-32s text-bkkNeutral-900 mb-6">Tren Status Alumni per Tahun</h2>
                    <div class="h-[300px]">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-15 lg:py-20">
        <div class="container flex flex-col-reverse lg:flex-row items-center mx-auto px-5 lg:px-0 gap-5 lg:gap-0">
            <div class="w-full lg:w-[50%]">
                <h2 class="heading-42s text-bkkNeutral-900 mb-4">
                {{ $tracerContent['tracer_study']['cta_title'] }}
                </h2>
                <div class="paragraph-16r text-bkkNeutral-700 mb-12">
                    {{ $tracerContent['tracer_study']['cta_description'] }}
                </div>
                <a  href="{{ route('isi-tracer-study') }}"
                    class="w-full lg:w-auto justify-self-start flex justify-center items-center gap-3 py-3 px-6 bg-primary hover:bg-primary-hover transition duration-300 rounded-[8px] group">
                    <span class="paragraph-16s text-bkkNeutral-50">
                        {{ $tracerContent['tracer_study']['cta_text'] }}
                    </span>
                    <svg class="shrink-0 group-hover:translate-x-1 transition duration-300" width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <div class="w-full lg:w-[50%]">
                <img 
                    class="w-full h-full object-contain object-center"
                    src="{{ asset('storage/' . $tracerContent['tracer_study']['cta_image']) }}"
                />
            </div>
        </div>
    </section>
</div>

<script>
    function renderTracerCharts() {
        const elPie = document.getElementById("pieChart");
        if (elPie) {
            const existingChart = Chart.getChart("pieChart");
            if (existingChart) existingChart.destroy();

            new Chart(elPie, {
                type: "pie",
                data: {
                    labels: ['Bekerja', 'Kuliah', 'Wiraswasta', 'Mencari Kerja'],
                    datasets: [{
                        data: @json($pieData),
                        backgroundColor: ['#073AE4', '#FFBE0A', '#3261F9', '#DFE4EA'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 50,
                            top: 20,
                            bottom: 20
                        }
                    },
                    plugins: {
                        legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 22,
                            font: {
                                size: 12,
                                family: 'Poppins',
                            },
                            // --- LOGIKA MENAMPILKAN PERSENTASE ---
                            generateLabels: (chart) => {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    const dataset = data.datasets[0];
                                    const total = dataset.data.reduce((sum, val) => sum + val, 0);

                                    return data.labels.map((label, i) => {
                                        const value = dataset.data[i];
                                        const percentage = total > 0 
                                        ? ((value / total) * 100).toFixed(1) + '%'
                                        : '0%';
                                        
                                        return {
                                            text: `${label} (${percentage})`, 
                                            fillStyle: dataset.backgroundColor[i], 
                                            strokeStyle: dataset.backgroundColor[i],
                                            pointStyle: 'circle',
                                            hidden: chart.getDatasetMeta(0).data[i].hidden, 
                                            index: i 
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                        tooltip: {
                            callbacks: {
                                label: function(item) {
                                    let sum = item.dataset.data.reduce((a, b) => a + b, 0);
                                    let value = item.raw;
                                    let percent = ((value / sum) * 100).toFixed(1);
                                    return ` ${item.label}: ${value} orang (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        const elBar = document.getElementById("barChart");
        if (elBar) {
            const existingChart = Chart.getChart("barChart");
            if (existingChart) existingChart.destroy();

            new Chart(elBar, {
                type: "bar",
                data: {
                    labels: @json($barLabels),
                    datasets: [
                        {
                            label: 'Bekerja',
                            data: @json($barDatasets[0]['data']), 
                            backgroundColor: '#073AE4', 
                            borderRadius: 6,
                        },
                        {
                            label: 'Wirausaha',
                            data: @json($barDatasets[1]['data']), 
                            backgroundColor: '#3261F9',
                            borderRadius: 6,
                        },
                        {
                            label: 'Kuliah',
                            data: @json($barDatasets[2]['data']), 
                            backgroundColor: '#FFBE0A', 
                            borderRadius: 6,
                        },
                        {
                            label: 'Lain-lain',
                            data: @json($barDatasets[3]['data']), 
                            backgroundColor: '#DFE4EA', 
                            borderRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                boxWidth: 12,
                                boxHeight: 12,
                                padding: 20,
                                font: {
                                    family: 'Poppins',
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false 
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 100 
                            }
                        }
                    }
                }
            });
        }
    }

    document.addEventListener("DOMContentLoaded", renderTracerCharts);

    document.addEventListener("livewire:navigated", renderTracerCharts);
</script>
