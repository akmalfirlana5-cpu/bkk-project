<div>
    <h2 class="heading-22s text-bkkNeutral-900 mb-6">Data Diri</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nama Lengkap -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                Nama Lengkap <span class="text-red-500">*</span>
            </label>
            <input type="text" wire:model="full_name"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                placeholder="Masukkan nama lengkap">
            @error('full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- NISN -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                NISN <span class="text-red-500">*</span>
            </label>
            <input type="text" wire:model="nisn"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl bg-bkkNeutral-100 text-bkkNeutral-500 cursor-not-allowed"
                readonly>
        </div>

        <!-- NIK -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                NIK <span class="text-red-500">*</span>
            </label>
            <input type="text" wire:model="nik"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                placeholder="Masukkan NIK">
            @error('nik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nomor HP -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                Nomor HP <span class="text-red-500">*</span>
            </label>
            <input type="tel" wire:model="no_hp"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                placeholder="08xxxxxxxxxx">
            @error('no_hp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Jurusan -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                Jurusan <span class="text-red-500">*</span>
            </label>
            <select wire:model="major"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                <option value="" selected hidden>Pilih jurusan</option>
                <option value="Animasi">Animasi</option>
                <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                <option value="Logistik">Logistik</option>
                <option value="Perhotelan">Perhotelan</option>
                <option value="Teknik Grafika">Teknik Grafika</option>
                <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
            </select>
            @error('major') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Tahun Lulus -->
        <div>
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                Tahun<span class="text-red-500">*</span>
            </label>
            <input type="date" wire:model="graduation_year"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
            @error('graduation_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Alamat -->
        <div class="md:col-span-2">
            <label class="block paragraph-14s text-bkkNeutral-700 mb-2">
                Alamat <span class="text-red-500">*</span>
            </label>
            <textarea wire:model="address" rows="3"
                class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                placeholder="Masukkan alamat lengkap"></textarea>
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div class="md:col-span-2" x-data="{ localStatus: @entangle('status') }"> 
            <label class="block paragraph-14s text-bkkNeutral-700 mb-4">
                Status Saat Ini <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $statusOptions = [
                        'bekerja' => ['label' => 'Bekerja'],
                        'kuliah' => ['label' => 'Kuliah'],
                        'wiraswasta' => ['label' => 'Wiraswasta'],
                        'menganggur' => ['label' => 'Belum Bekerja']
                    ];
                @endphp
                
                @foreach($statusOptions as $value => $data)
                    <label 
                        {{-- Gunakan logika Alpine (localStatus) bukan Blade/Livewire ($status) untuk Class --}}
                        class="flex flex-col items-center gap-2 p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200"
                        :class="localStatus === '{{ $value }}' ? 'border-primary bg-bkkBlue-50 shadow-md' : 'border-bkkNeutral-200 hover:border-bkkBlue-300'"
                    >
                        {{-- Ganti wire:model.live menjadi wire:model biasa --}}
                        <input type="radio" wire:model="status" value="{{ $value }}" class="sr-only" @click="localStatus = '{{ $value }}'">
                        
                        <span class="paragraph-14s text-center"
                            :class="localStatus === '{{ $value }}' ? 'text-primary' : 'text-bkkNeutral-700'">
                            {{ $data['label'] }}
                        </span>

                        {{-- Icon Checkmark dengan Alpine --}}
                        <template x-if="localStatus === '{{ $value }}'">
                            <div class="w-5 h-5 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </template>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Button Lanjutkan -->
    <div class="flex justify-end mt-8 pt-6 border-t border-bkkNeutral-200">
        <button type="button" wire:click="nextStep"
            class="flex items-center gap-3 py-3 px-8 bg-primary hover:bg-primary-hover text-white rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span>Lanjutkan</span>
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
