<?php

namespace Database\Seeders;

use App\Models\SurveyCategory;
use App\Models\SurveyQuestion;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    protected array $defaultOptions = [
        'Sangat Puas',
        'Puas',
        'Cukup',
        'Kurang Puas',
    ];

    public function run(): void
    {
        // ==============================
        // KATEGORI: ORANGTUA
        // ==============================
        $orangtua = SurveyCategory::updateOrCreate(
            ['slug' => 'orangtua'],
            [
                'name' => 'Survey Kepuasan Orangtua',
                'description' => 'Survey kepuasan orangtua siswa terhadap layanan SMK Negeri 4 Malang',
                'is_active' => true,
                'identity_fields' => [
                    ['key' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                    ['key' => 'nama_siswa', 'label' => 'Nama Siswa', 'type' => 'text', 'required' => true],
                    ['key' => 'kelas', 'label' => 'Kelas (Contoh: XI RPL A)', 'type' => 'text', 'required' => true],
                    ['key' => 'no_hp', 'label' => 'No HP / WA', 'type' => 'text', 'required' => true],
                ],
            ]
        );

        $this->seedQuestions($orangtua->id, [
            'Bagaimana kompetensi (pengetahuan, keterampilan) yang kini dimiliki anak Anda setelah mengikuti pendidikan di SMK NEGERI 4 Malang?',
            'Bagaimana dengan perkembangan sikap perilaku/akhlak anak Anda setelah mengikuti pendidikan di SMK NEGERI 4 Malang?',
            'Bagaimana dengan disiplin (pengaturan waktu, pengerjaan tugas-tugas) yang dimiliki anak Anda setelah mengikuti pendidikan di SMK NEGERI 4 Malang?',
            'Bagaimana dengan program/tata tertib anti narkoba yang dijalankan di SMK NEGERI 4 Malang?',
            'Bagaimana dengan program praktek kerja industri (prakerin) di luar sekolah yang selama ini dijalankan SMK NEGERI 4 Malang?',
            'Bagaimana dengan pelajaran sekolah di unit produksi untuk melatih siswa untuk bekerja mandiri?',
            'Bagaimana dengan media komunikasi dari pihak sekolah (surat laporan, kunjungan, telepon, undangan, dll.) dengan orang tua?',
        ], [
            ['question_text' => 'Kritik dan Saran yang dapat memajukan SMK Negeri 4 Malang untuk kedepannya.', 'field_type' => 'textarea', 'is_required' => false],
        ]);

        // ==============================
        // KATEGORI: DUDI
        // ==============================
        $dudi = SurveyCategory::updateOrCreate(
            ['slug' => 'dudi'],
            [
                'name' => 'Survey Kepuasan DUDI / Perusahaan',
                'description' => 'Survey kepuasan Dunia Usaha dan Dunia Industri terhadap alumni dan layanan BKK SMK Negeri 4 Malang',
                'is_active' => true,
                'identity_fields' => [
                    ['key' => 'nama_perusahaan', 'label' => 'Nama Perusahaan', 'type' => 'text', 'required' => true],
                    ['key' => 'alamat_perusahaan', 'label' => 'Alamat Perusahaan', 'type' => 'text', 'required' => true],
                    ['key' => 'nama_pimpinan', 'label' => 'Nama Pimpinan Perusahaan', 'type' => 'text', 'required' => true],
                    ['key' => 'no_kontak', 'label' => 'No Kontak HP / WA', 'type' => 'text', 'required' => true],
                    ['key' => 'email_perusahaan', 'label' => 'E-mail Perusahaan', 'type' => 'text', 'required' => false],
                    ['key' => 'jumlah_siswa_pkl', 'label' => 'Berapa jumlah Siswa PKL / Tenaga Kerja alumni SMKN 4 Malang di Perusahaan Anda?', 'type' => 'number', 'required' => true],
                ],
            ]
        );

        $this->seedQuestions($dudi->id, [
            'Ketepatan dalam merespon permintaan kebutuhan tenaga kerja',
            'Bagaimana Peranan Humas / BKK (Bursa Kerja Khusus) SMKN 4 Terhadap Program PKL / Perekrutan Tenaga Kerja',
            'Kepuasan pelanggan dalam menggunakan alumni SMKN 4 Malang dalam hal etos kerja',
            'Kepuasan pelanggan dalam menggunakan alumni SMKN 4 Malang dalam hal kedisiplinan',
            'Kepuasan pelanggan dalam menggunakan alumni SMKN 4 Malang dalam hal kerapian dan kebersihan',
            'Kepuasan pelanggan dalam menggunakan alumni SMKN 4 Malang dalam hal kompetensi yang diharapkan oleh pelanggan',
            'Kemampuan cepat tanggap terhadap keluhan yang disampaikan pelanggan',
            'Keuletan dan ketenangan alumni SMKN 4 Malang dalam menghadapi dan menyelesaikan permasalahan yang terjadi.',
        ], [
            ['question_text' => 'Saran dan kesan Kerjasama dengan SMKN 4 Malang', 'field_type' => 'textarea', 'is_required' => false],
        ]);

        // ==============================
        // KATEGORI: SISWA ALUMNI
        // ==============================
        $alumni = SurveyCategory::updateOrCreate(
            ['slug' => 'siswa-alumni'],
            [
                'name' => 'Survey Kepuasan Siswa Alumni',
                'description' => 'Survey kepuasan alumni terhadap layanan BKK SMK Negeri 4 Malang',
                'is_active' => true,
                'identity_fields' => [
                    ['key' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                    ['key' => 'email', 'label' => 'Email Aktif', 'type' => 'text', 'required' => true],
                    ['key' => 'nik', 'label' => 'NIK (Nomor Induk Kependudukan)', 'type' => 'text', 'required' => true],
                    ['key' => 'tahun_kelulusan', 'label' => 'Tahun Kelulusan', 'type' => 'text', 'required' => true],
                    ['key' => 'no_hp', 'label' => 'No WA / HP', 'type' => 'text', 'required' => true],
                    ['key' => 'tempat_tinggal', 'label' => 'Tempat Tinggal Saat Ini', 'type' => 'text', 'required' => true],
                    ['key' => 'status_saat_ini', 'label' => 'Status Saat Ini', 'type' => 'dropdown', 'required' => true, 'options' => ['Bekerja' => 'Bekerja', 'Wirausaha' => 'Wirausaha', 'Kuliah' => 'Kuliah', 'Belum Bekerja' => 'Belum Bekerja']],
                    ['key' => 'nama_instansi', 'label' => 'Nama Usaha / Nama Perusahaan Tempat Bekerja / Nama Kampus / Perguruan Tinggi', 'type' => 'text', 'required' => false],
                    ['key' => 'linier_jurusan', 'label' => 'Apakah karir Anda saat ini linier dengan jurusan dan kompetensi pada waktu di SMK?', 'type' => 'dropdown', 'required' => true, 'options' => ['Ya' => 'Ya', 'Tidak' => 'Tidak']],
                    ['key' => 'lama_bekerja', 'label' => 'Sudah berapa lama Anda bekerja / berwirausaha / Kuliah?', 'type' => 'text', 'required' => true],
                    ['key' => 'alamat_instansi', 'label' => 'Alamat Usaha / Perusahaan / Kampus / Perguruan Tinggi', 'type' => 'textarea', 'required' => false],
                ],
            ]
        );

        $this->seedQuestions($alumni->id, [
            'Ketepatan dalam memberikan informasi lowongan kerja ke Alumni dengan jelas dan cepat.',
            'Kemampuan BKK dalam menanggapi keluhan yang disampaikan Alumni',
            'Pelayanan dalam pelaksanaan seleksi industri dengan baik dan terkoordinir',
            'Melakukan komunikasi yang efektif dengan Alumni',
            'Memberikan perhatian kepada Alumni (empati), ramah, dan siap menolong',
            'Pelayanan BKK dalam mengevaluasi/memantau penempatan Alumni ke Industri',
            'Penataan eksterior dan interior kantor atau ruang Humas / BKK',
            'Kecakapan dalam memberikan solusi dan membantu alumni untuk menyelesaikan permasalahan dalam proses bursa kerja',
        ]);
    }

    /**
     * Seed dropdown questions + optional extra questions (textarea, etc.)
     */
    private function seedQuestions(int $categoryId, array $dropdownQuestions, array $extraQuestions = []): void
    {
        $order = 1;

        foreach ($dropdownQuestions as $text) {
            SurveyQuestion::updateOrCreate(
                ['category_id' => $categoryId, 'question_text' => $text],
                [
                    'field_type' => 'dropdown',
                    'options' => $this->defaultOptions,
                    'sort_order' => $order++,
                    'is_required' => true,
                    'is_active' => true,
                ]
            );
        }

        foreach ($extraQuestions as $q) {
            SurveyQuestion::updateOrCreate(
                ['category_id' => $categoryId, 'question_text' => $q['question_text']],
                [
                    'field_type' => $q['field_type'] ?? 'textarea',
                    'options' => null,
                    'sort_order' => $order++,
                    'is_required' => $q['is_required'] ?? false,
                    'is_active' => true,
                ]
            );
        }
    }
}
