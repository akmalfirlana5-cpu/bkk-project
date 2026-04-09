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
    <section class="py-30 lg:py-25">
        <div class="container mx-auto px-5 lg:px-0">
            <div 
                id="form-container"
                class="scroll-mt-32 w-full bg-white shadow-lg rounded-3xl p-6 md:p-10">
                    <h1 class="heading-42s text-bkkNeutral-900 mb-4">Form Survei Kepuasan</h1>
                <div class="flex justify-center rounded-lg overflow-hidden my-8">
                    <div class="grid grid-cols-3 items-center w-full ">
                        {{-- Step 1 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 
                            {{ $currentStep == 1 ? 'bg-primary-ultra-light' : 'bg-bkkNeutral-100' }}">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 1, warna biru jika step >= 1 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 
                                    {{ $currentStep == 1 ? 'bg-primary border border-primary text-white' : 'bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600'}}">
                                    1
                                </div>
                                <span class="paragraph-16s hidden md:block 
                                    {{ $currentStep == 1 ? 'text-primary' : 'text-bkkNeutral-600' }}">
                                    Step 1: Jenis Responden
                                </span>
                            </div>
                        </div>
                        
                        {{-- Step 2 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 
                            {{ $currentStep == 2 ? 'bg-primary-ultra-light' : 'bg-bkkNeutral-100' }}">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 2, warna biru jika step >= 2 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 
                                    {{ $currentStep == 2 ? 'bg-primary border border-primary text-white' : 'bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600'}}">
                                    2
                                </div>
                                <span class="paragraph-16s hidden md:block 
                                    {{ $currentStep == 2 ? 'text-primary' : 'text-bkkNeutral-600' }}">
                                    Step 2: Data Responden
                                </span>
                            </div>
                        </div>

                        {{-- Step 3 Indicator --}}
                        <div class="py-4 px-4 lg:px-8 
                            {{ $currentStep == 3 ? 'bg-primary-ultra-light' : 'bg-bkkNeutral-100' }}">
                            <div class="flex flex-col lg:flex-row items-center gap-3">
                                {{-- Circle dengan angka 2, warna biru jika step >= 2 --}}
                                <div class="w-10 h-10 rounded-full flex items-center justify-center paragraph-16s transition-all duration-300 
                                    {{ $currentStep == 3 ? 'bg-primary border border-primary text-white' : 'bg-transparent border border-bkkNeutral-300 text-bkkNeutral-600'}}">
                                    3
                                </div>
                                <span class="paragraph-16s hidden md:block
                                    {{ $currentStep == 3 ? 'text-primary' : 'text-bkkNeutral-600' }}">
                                    Step 3: Penilaian Layanan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($currentStep === 2)
                    <livewire:user.partials.survey.step2-data-responden-form :type="$type" wire:key="step2" />
                @endif
                @if ($currentStep === 3)
                    <livewire:user.partials.survey.step3-penilaian-layanan-form :type="$type"
                    :data="$formData" wire:key="step3" />
                @endif
            </div>
        </div>
    </section> 
</div>
