<div class="px-4">
    {{-- Section Orang Tua --}}
    @if ($type == 'orangtua')
        <div class="paragraph-16s text-bkkNeutral-900 mb-4 w-full md:w-[50%]">
            Yth. Bapak/Ibu Orang Tua/Wali Murid 
            SMK NEGERI 4 Malang
        </div>
        <div class="paragraph-16r text-bkkNeutral-900 mb-6 w-full md:w-[90%]">
            Dalam rangka meningkatkan mutu pelayanan pendidikan di SMK Negeri 4 Malang, kami memohon kesediaan Bapak/Ibu untuk mengisi survei kepuasan ini.
            Masukan yang diberikan akan menjadi bahan evaluasi bagi sekolah untuk meningkatkan kualitas layanan secara berkelanjutan.
            Atas partisipasi Bapak/Ibu, kami ucapkan terima kasih.
        </div>
        <div class="grid grid-cols-1 gap-6">
            <!-- Nama Lengkap -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.full_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nama lengkap">
                @error('identity_data.full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nama Siswa -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Nama Siswa <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.student_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nama siswa">
                @error('identity_data.student_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror   
            </div>

            <!-- Kelas -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Kelas <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.class"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan kelas (contoh: XII RPL B) ">
                @error('identity_data.class') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    No. Telepon / WhatsApp Aktif<span class="text-red-500">*</span>
                </label>
                <input type="tel" wire:model="phone"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nomor HP / WhatsApp aktif">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif
    {{-- Section DUDI --}}
    @if ($type == 'dudi')
        <div class="paragraph-16s text-bkkNeutral-900 mb-4 w-full md:w-[50%]">
            Yth. Bapak/Ibu Pimpinan Industri Mitra SMK Negeri 4 Malang
        </div>
        <div class="paragraph-16r text-bkkNeutral-900 mb-6 w-full md:w-[90%]">
            Dengan hormat,Melalui survei ini, Humas / Bursa Kerja Khusus (BKK) SMK Negeri 4 Malang memohon kesediaan Bapak/Ibu untuk memberikan saran dan masukan yang berharga bagi manajemen sekolah, khususnya pada bidang Humas / BKK.
        </div>
        <div class="paragraph-16r text-bkkNeutral-900 mb-6 w-full md:w-[90%]">
            Masukan yang Bapak/Ibu berikan akan menjadi umpan balik bagi kami dalam melakukan evaluasi serta meningkatkan kualitas pelayanan kepada mitra industri.
            Atas kesediaan dan kerja sama Bapak/Ibu dalam mengisi survei ini, kami ucapkan terima kasih.
        </div>
        <div class="grid grid-cols-1 gap-6">
            <!-- Nama Perusahaan -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Nama Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.company_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nama lengkap">
                @error('identity_data.company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Alamat Perusahaan -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Alamat Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.address"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan alamat perusahaan">
                @error('identity_data.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror   
            </div>

            <!-- Nama Pimpinan -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Nama Pimpinan Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.leader_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nama pimpinan perusahaan">
                @error('identity_data.leader_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    No. WhatsApp Aktif<span class="text-red-500">*</span>
                </label>
                <input type="tel" wire:model="phone"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nomor HP / WhatsApp aktif">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    E-mail Perusahaan<span class="text-red-500">*</span>
                </label>
                <input type="email" wire:model="identity_data.email"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan email perusahaan">
                @error('identity_data.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Jumlah siswa pkl -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Berapa jumlah siswa PKL atau alumni SMK Negeri 4 Malang yang saat ini berada di perusahaan Anda? <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.student_count"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan jumlah siswa">
                @error('identity_data.student_count') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    @endif
    {{-- Section Alumni --}}
    @if ($type == 'siswa-alumni')
        <div class="paragraph-16s text-bkkNeutral-900 mb-4 w-full md:w-[50%]">
            Yth. Alumni SMK Negeri 4 Malang
        </div>
        <div class="paragraph-16r text-bkkNeutral-900 mb-6 w-full md:w-[90%]">
            Humas / Bursa Kerja Khusus (BKK) SMK Negeri 4 Malang memohon kesediaan Alumni untuk memberikan saran dan masukan melalui survei ini sebagai bentuk umpan balik dalam upaya peningkatan kualitas pelayanan kepada alumni.
            Atas kesediaan dan partisipasi Alumni dalam mengisi survei ini, kami ucapkan terima kasih.
        </div>
        <div 
            class="grid grid-cols-1 gap-6"
            x-data="{currentStatus: @entangle('identity_data.status')}">
            <!-- Nama Lengkap -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.full_name"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nama lengkap">
                @error('identity_data.full_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- NIK -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Masukkan NIK <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.nik"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan NIK">
                @error('identity_data.nik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror   
            </div>

            <!-- Tahun Kelulusan -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Tahun Kelulusan <span class="text-red-500">*</span>
                </label>
                <input type="date" wire:model="identity_data.graduation_year"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan tahun kelulusan">
                @error('identity_data.graduation_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    E-mail Aktif<span class="text-red-500">*</span>
                </label>
                <input type="email" wire:model="identity_data.email"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan email aktif">
                @error('identity_data.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tempat Tinggal -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    Tempat Tinggal Saat Ini<span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="identity_data.address"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan tempat tinggal saat ini">
                @error('identity_data.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nomor HP -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-2">
                    No. Telepon / WhatsApp Aktif<span class="text-red-500">*</span>
                </label>
                <input type="tel" wire:model="phone"
                    class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Masukkan nomor HP / WhatsApp aktif">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block paragraph-16r text-bkkNeutral-800 mb-3">
                    Status Karier Anda Saat Ini<span class="text-red-500">*</span>
                </label>
                <div class="space-y-3">
                    @foreach ($statusOptions as $status)
                        <div class="flex items-center gap-3">
                            <input 
                                type="radio" 
                                wire:model="identity_data.status" 
                                x-model="currentStatus"
                                value="{{ $status['value'] }}" 
                                id="status-{{ $loop->index }}">
                            <label for="status-{{ $loop->index }}" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                {{ $status['label'] }}
                            </label>
                        </div>
                    @endforeach
                    @error('identity_data.status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Pertanyaan tambahan berkerja --}}

                <!-- Karir linier? -->
                <div 
                    x-show="currentStatus === 'bekerja'" 
                    x-cloak 
                    x-collapse 
                    >
                    <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                        Apakah karier Anda saat ini linier dengan jurusan dan kompetensi yang dipelajari saat di SMK?<span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 mb-3">
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_career_linier" value="true" id="is_career_linier-true">
                            <label for="is_career_linier-true" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Ya
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_career_linier" value="false" id="is_career_linier-false">
                            <label for="is_career_linier-false" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Tidak
                            </label>
                        </div>
                        @error('identity_data.is_career_linier"') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Nama usaha --}}
                    <div class="my-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Nama Perusahaan Tempat Bekerja<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.company_name"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: PT Telkom Indonesia">
                        @error('identity_data.company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Berapa lama --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Sudah berapa lama Anda bekerja?<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.how_long"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: 1 tahun 6 bulan">
                        @error('identity_data.how_long') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Alamat perusahaan --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Alamat Perusahaan<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.company_address"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Jl. Soekarno Hatta No. 12, Malang">
                        @error('identity_data.company_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

            {{-- Pertanyaan tambahan kuliah --}}

                <!-- Karir linier? -->
                <div 
                    x-show="currentStatus === 'kuliah'" 
                    x-cloak 
                    x-collapse 
                    >
                    <label class="block paragraph-16r text-bkkNeutral-800 mb-3">
                        Apakah program studi yang Anda ambil linier dengan jurusan saat di SMK?<span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_study_linier" value="true" id="is_study_linier-true">
                            <label for="is_study_linier-true" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Ya
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_study_linier" value="false" id="is_study_linier-false">
                            <label for="is_study_linier-false" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Tidak
                            </label>
                        </div>
                        @error('identity_data.is_study_linier"') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Nama kampus --}}
                    <div class="my-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Nama Kampus / Perguruan Tinggi<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.college_name"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Universitas Brawijaya">
                        @error('identity_data.college_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Berapa lama --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Sudah berapa lama Anda menempuh pendidikan di perguruan tinggi?<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.how_long"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: 1 tahun 6 bulan">
                        @error('identity_data.how_long') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Alamat kampus --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Alamat Kampus<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.college_address"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Jl. Soekarno Hatta No. 12, Malang">
                        @error('identity_data.college_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            {{-- Pertanyaan tambahan wirausaha --}}

                <!-- Karir linier? -->
                <div 
                    x-show="currentStatus === 'berwirausaha'" 
                    x-cloak 
                    x-collapse 
                    >
                    <label class="block paragraph-16r text-bkkNeutral-800 mb-3">
                        Apakah karier Anda saat ini linier dengan jurusan dan kompetensi yang dipelajari saat di SMK?<span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_career_linier" value="true" id="is_career_linier-true">
                            <label for="is_career_linier-true" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Ya
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_career_linier" value="false" id="is_career_linier-false">
                            <label for="is_career_linier-false" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Tidak
                            </label>
                        </div>
                        @error('identity_data.is_career_linier"') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Nama usaha --}}
                    <div class="my-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Tuliskan nama usaha Anda<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.business_name"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Toko Elektronik Maju Jaya">
                        @error('identity_data.business_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Berapa lama --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Sudah berapa lama Anda menjalankan usaha ini?<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.how_long"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: 1 tahun 6 bulan">
                        @error('identity_data.how_long') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Alamat kampus --}}
                    <div class="mb-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Alamat Usaha<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.business_address"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Jl. Soekarno Hatta No. 12, Malang">
                        @error('identity_data.business_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            {{-- Pertanyaan tambahan menganggur --}}

                <!-- Karir linier? -->
                <div 
                    x-show="currentStatus === 'menganggur'" 
                    x-cloak 
                    x-collapse 
                    >
                    <label class="block paragraph-16r text-bkkNeutral-800 mb-3">
                        Apakah Anda sedang mencari pekerjaan saat ini?<span class="text-red-500">*</span>
                    </label>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_looking_for_job" value="true" id="is_looking_for_job-true">
                            <label for="is_looking_for_job-true" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Ya
                            </label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" wire:model="identity_data.is_looking_for_job" value="false" id="is_looking_for_job-false">
                            <label for="is_looking_for_job-false" class="block paragraph-16r text-bkkNeutral-800 cursor-pointer">
                                Tidak
                            </label>
                        </div>
                        @error('identity_data.is_looking_for_job"') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    {{-- Kendala dalam mencari pekerjaan --}}
                    <div class="my-6">
                        <label class="block paragraph-16r text-bkkNeutral-800 mb-4">
                            Jika berkenan, tuliskan kendala yang Anda alami dalam mencari pekerjaan<span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="identity_data.constraint"
                            class="w-full px-4 py-3 border border-bkkNeutral-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Belum mendapatkan informasi lowongan yang sesuai">
                        @error('identity_data.constraint') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
        </div>
    @endif
    <!-- Button Lanjutkan -->
    <div class="flex justify-end gap-4 mt-8">
        <button type="button" wire:click="goToPrevious"
            class="flex items-center gap-3 py-3 px-8 bg-white border border-bkkNeutral-500 text-bkkNeutral-700 rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span>Sebelumnya</span>
        </button>
        <button type="button" wire:click="goToSurvey"
            class="flex items-center gap-3 py-3 px-8 bg-primary hover:bg-primary-hover text-white rounded-xl transition duration-300 paragraph-16s cursor-pointer">
            <span>Lanjutkan</span>
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 6L14 1M19 6L14 11M19 6H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
