<div>
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <hr>

    @if (session()->has('error'))
        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        <h3>Identitas Responden</h3>
        @foreach($category->identity_fields as $field)
            <div style="margin-bottom: 10px;">
                <label>{{ $field['label'] }} {{ $field['required'] ? '*' : '' }}</label><br>
                @if($field['type'] === 'number')
                    <input type="number" wire:model.defer="identity.{{ $field['key'] }}">
                @else
                    <input type="text" wire:model.defer="identity.{{ $field['key'] }}">
                @endif
                @error('identity.'.$field['key']) <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
            </div>
        @endforeach

        <hr>

        <h3>Pertanyaan Survey</h3>
        @foreach($category->questions as $index => $question)
            <div style="margin-bottom: 20px;">
                <p>{{ $index + 1 }}. {{ $question->question_text }} {{ $question->is_required ? '*' : '' }}</p>
                
                @if($question->field_type === 'dropdown')
                    <select wire:model.defer="answers.{{ $question->id }}">
                        <option value="">-- Pilih Jawaban --</option>
                        @foreach($question->options as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @else
                    <textarea wire:model.defer="answers.{{ $question->id }}" rows="3" style="width: 100%; max-width: 500px;"></textarea>
                @endif
                @error('answers.'.$question->id) <br><span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
            </div>
        @endforeach

        <div style="margin-top: 20px;">
            <button type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>Kirim Survey</span>
                <span wire:loading>Mengirim...</span>
            </button>
        </div>
    </form>
</div>
