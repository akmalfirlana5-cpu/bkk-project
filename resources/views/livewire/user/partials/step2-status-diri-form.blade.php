<div>
    <h2 class="heading-22s text-bkkNeutral-900 mb-2">
        @if($status === 'bekerja') Detail Pekerjaan
        @elseif($status === 'kuliah') Detail Pendidikan
        @elseif($status === 'wiraswasta') Detail Usaha
        @else Informasi Tambahan
        @endif
    </h2>
    <p class="paragraph-14r text-bkkNeutral-600 mb-8">
        Lengkapi informasi berikut sesuai status Anda
    </p>

    {{-- Form Bekerja --}}
    @if($status === 'bekerja')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Tanggal Mulai Bekerja <span class="text-red-500">*</span></label>
                <input type="date" wire:model="work_start_date"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('work_start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                <input type="text" wire:model="work_company_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: PT. Telkom Indonesia">
                @error('work_company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Posisi/Jabatan <span class="text-red-500">*</span></label>
                <input type="text" wire:model="work_position"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Software Engineer">
                @error('work_position') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Lokasi Kerja <span class="text-red-500">*</span></label>
                <input type="text" wire:model="work_location"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Jakarta">
                @error('work_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Gaji (Opsional)</label>
                <input type="text" wire:model="work_salary"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Rp 5.000.000">
                @error('work_salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Kesesuaian Jurusan <span class="text-red-500">*</span></label>
                <select wire:model="work_major_relevance"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="" selected hidden>Pilih kesesuaian</option>
                    <option value="sesuai">Sesuai</option>
                    <option value="tidak sesuai">Tidak Sesuai</option>
                    <option value="mungkin">Mungkin Terkait</option>
                </select>
                @error('work_major_relevance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Form Kuliah --}}
    @if($status === 'kuliah')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Tanggal Mulai Kuliah <span class="text-red-500">*</span></label>
                <input type="date" wire:model="college_start_date"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('college_start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Nama Universitas <span class="text-red-500">*</span></label>
                <input type="text" wire:model="college_university_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Universitas Brawijaya">
                @error('college_university_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                <select wire:model="college_degree"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="">Pilih jenjang</option>
                    <option value="d3">D3</option>
                    <option value="d4">D4</option>
                    <option value="s1">S1</option>
                </select>
                @error('college_degree') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                <input type="text" wire:model="college_major"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Teknik Informatika">
                @error('college_major') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Form Wiraswasta --}}
    @if($status === 'wiraswasta')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Tanggal Mulai Usaha <span class="text-red-500">*</span></label>
                <input type="date" wire:model="entrepreneur_start_date"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('entrepreneur_start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Nama Usaha <span class="text-red-500">*</span></label>
                <input type="text" wire:model="entrepreneur_company_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Toko Roti Makmur">
                @error('entrepreneur_company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Bidang Usaha <span class="text-red-500">*</span></label>
                <input type="text" wire:model="entrepreneur_field"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Kuliner">
                @error('entrepreneur_field') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Lokasi Usaha <span class="text-red-500">*</span></label>
                <input type="text" wire:model="entrepreneur_location"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Malang">
                @error('entrepreneur_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Pendapatan (Opsional)</label>
                <input type="text" wire:model="entrepreneur_salary"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: Rp 10.000.000">
                @error('entrepreneur_salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Kesesuaian Jurusan <span class="text-red-500">*</span></label>
                <select wire:model="entrepreneur_major_relevance"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="">Pilih kesesuaian</option>
                    <option value="sesuai">Sesuai</option>
                    <option value="tidak sesuai">Tidak Sesuai</option>
                    <option value="mungkin">Mungkin Terkait</option>
                </select>
                @error('entrepreneur_major_relevance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Media Sosial (Opsional)</label>
                <input type="text" wire:model="entrepreneur_sosial_media"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: @usahasaya atau www.usahasaya.com">
                @error('entrepreneur_sosial_media') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Form Menganggur --}}
    @if($status === 'menganggur')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Sudah Berapa Lama? <span class="text-red-500">*</span></label>
                <input type="text" wire:model="unemployed_timespan"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Contoh: 3 bulan">
                @error('unemployed_timespan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Alasan <span class="text-red-500">*</span></label>
                <select wire:model="unemployed_reason"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent bg-white">
                    <option value="">Pilih alasan</option>
                    <option value="menunggu informasi perekrutan">Menunggu Informasi Perekrutan</option>
                    <option value="berkecukupan">Berkecukupan</option>
                    <option value="tidak mau bekerja">Tidak Mau Bekerja</option>
                    <option value="lainnya">Lainnya</option> </select>
                @error('unemployed_reason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block paragraph-14s text-bkkNeutral-700 mb-2">Aktivitas Saat Ini <span class="text-red-500">*</span></label>
                <textarea wire:model="unemployed_activity" rows="3"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                    placeholder="Jelaskan aktivitas yang sedang dilakukan..."></textarea>
                @error('unemployed_activity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif

    {{-- Buttons --}}
    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8 pt-6 border-t border-bkkNeutral-200">
        <button type="button" wire:click="previousStep"
            class="flex items-center justify-center gap-3 py-3 px-8 border border-bkkNeutral-300 text-bkkNeutral-700 rounded-xl hover:bg-bkkNeutral-50 transition duration-300 paragraph-16s cursor-pointer" >
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 6L6 1M1 6L6 11M1 6H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Kembali</span>
        </button>
        <button type="button" wire:click="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-pointer"
            class="flex items-center justify-center gap-3 py-3 px-8 bg-primary hover:bg-primary-hover text-white rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span wire:loading.remove wire:target="submit">Kirim Data</span>
            <span wire:loading wire:target="submit">Mengirim...</span>
            <svg wire:loading.remove wire:target="submit" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 13L9 17L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
