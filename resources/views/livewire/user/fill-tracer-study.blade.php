<div
    x-data 
    x-on:next-step-scrolled.window="
        $nextTick(() => {
            const element = document.getElementById('form-container');
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        })
    "    
>
    <section class="pt-30 lg:pt-25 pb-20">
        <div class="container mx-auto px-5 lg:px-0">
            <div 
                id="form-container"
                class="scroll-mt-32 w-full bg-white shadow-lg rounded-3xl p-6 md:p-10">
                <div class="mb-12">
                    <h1 class="heading-42s text-bkkNeutral-900 mb-4">Form Tracer Study</h1>
                </div>
            
                <div class="flex justify-center mb-12">
                    <div class="flex items-center w-full rounded-lg overflow-hidden">
                        {{-- Step 1 Indicator --}}
                        <div class="w-[50%] py-4 px-4 lg:px-8
                            {{ $currentStep == 1 ? 'bg-primary-ultra-light' : 'bg-bkkNeutral-100' }}">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 1, warna biru jika step >= 1 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300
                                    {{ $currentStep == 1 ? 'bg-primary border border-primary text-white' : 'bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600' }}">
                                    1
                                </div>
                                <span class="paragraph-16s hidden md:block {{ $currentStep == 1 ? 'text-primary' : 'text-bkkNeutral-600' }}">
                                    Step 1: Data Diri
                                </span>
                            </div>
                        </div>
                        
                        {{-- Step 2 Indicator --}}
                        <div class="w-[50%] py-4 px-4 lg:px-8
                            {{ $currentStep == 2 ? 'bg-primary-ultra-light' : 'bg-bkkNeutral-100' }}">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 2, warna biru jika step >= 2 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300
                                    {{ $currentStep == 2 ? 'bg-primary border border-primary text-white' : 'bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600' }}">
                                    2
                                </div>
                                <span class="paragraph-16s hidden md:block {{ $currentStep == 2 ? 'text-primary' : 'text-bkkNeutral-600' }}">
                                    Step 2: Status
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- ======================================== --}}
                {{-- SUCCESS MESSAGE --}}
                {{-- Menampilkan pesan sukses jika ada --}}
                {{-- ======================================== --}}
                @if (session()->has('success'))
                    <div class="max-w-3xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div>
                    @if($currentStep === 1)
                        {{-- Mengirim data awal ke Child --}}
                        <livewire:user.partials.step1-data-diri-form :userData="$formData" wire:key="step1" />
                    @endif
                    
                    @if($currentStep === 2)
                        {{-- Mengirim status terpilih ke Child --}}
                        <livewire:user.partials.step2-status-diri-form :status="$formData['status']" wire:key="step2" />
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
