<div>
    <div class="grid grid-cols-1 gap-6">
        @foreach ($question as $q)
        <!-- Pertanyaan -->
                <div>
                    <label class="block paragraph-14s text-bkkNeutral-700 mb-4">
                        {{ $q->question_text }}<span class="text-red-500">*</span>
                    </label>
                    @if ($q->field_type === 'dropdown')
                        <select wire:model="questionData.{{ $q->id }}"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                            <option value="" selected hidden>Pilih</option>
                                {{-- soal dropdown --}}
                                    @foreach ($q->options as $option)
                                        <option 
                                            value="{{ $option }}"
                                            >
                                            {{ $option }}
                                        </option>
                                    @endforeach
                        </select>
                    @endif
                    {{-- soal input text --}}
                    @if ($q->field_type === 'textarea')
                        <textarea  
                            wire:model="questionData.{{ $q->id }}"
                            rows="3"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                            placeholder="Jawaban Anda">
                        </textarea>
                    @endif
                    @error('questionData.' . $q->id) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        @endforeach
    </div>
    <!-- Button Lanjutkan -->
    <div class="flex justify-end gap-4 mt-8">
        <button type="button" wire:click="goToPrevious"
            class="flex items-center gap-3 py-3 px-8 bg-white border border-bkkNeutral-500 text-bkkNeutral-700 rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span>Sebelumnya</span>
        </button>
        <button type="button" wire:click="submit"
            class="flex items-center gap-3 py-3 px-8 bg-primary hover:bg-primary-hover text-white rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span>Lanjutkan</span>
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
