<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Hero section visibility
            ['section' => 'hero', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'hero', 'key' => 'slides', 'value' => json_encode([
                [
                    'type' => 'slide',
                    'data' => [
                        'title' => 'Selamat Datang di BKK SMK Negeri 4 Malang',
                        'description' => 'Bursa Kerja Khusus yang menghubungkan lulusan SMK Negeri 4 Malang dengan dunia industri.',
                        'image' => null,
                        'cta_text' => 'Lihat Lowongan',
                        'cta_link' => '/lowongan',
                    ],
                ],
                [
                    'type' => 'slide',
                    'data' => [
                        'title' => 'Raih Karier Impianmu',
                        'description' => 'Temukan peluang kerja terbaik sesuai kompetensi keahlianmu bersama BKK SMKN 4 Malang.',
                        'image' => null,
                        'cta_text' => 'Daftar Sekarang',
                        'cta_link' => '/register',
                    ],
                ],
            ])],
            
            // Statistics visibility (data computed dynamically)
            ['section' => 'statistics', 'key' => 'is_visible', 'value' => 'true'],
            
            // Welcome / Sambutan
            ['section' => 'welcome', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'welcome', 'key' => 'title', 'value' => 'Sambutan Kepala Sekolah'],
            ['section' => 'welcome', 'key' => 'person_name', 'value' => 'Dr. Drs. Gunawan Dwiyono, S.ST., M.Pd.'],
            ['section' => 'welcome', 'key' => 'person_position', 'value' => 'Kepala SMK Negeri 4 Malang'],
            ['section' => 'welcome', 'key' => 'image', 'value' => '/assets/static/partial/Principal.png'],
            ['section' => 'welcome', 'key' => 'content', 'value' => 'Selamat datang di laman BKK SMK Negeri 4 Malang, yang menjadi sumber informasi bagi warga sekolah maupun masyarakat umum. Di sini, berbagai informasi terkait Bursa Kerja Khusus (BKK) dapat diakses dengan mudah dan terstruktur, termasuk pengumuman, panduan, serta kegiatan BKK yang bermanfaat bagi siswa dan alumni.<br><br>Seiring perkembangan teknologi dan internet, informasi kini dapat diperoleh lebih cepat dan luas dibandingkan sumber konvensional. SMK Negeri 4 Malang memanfaatkan jaringan internet sekolah untuk mendukung peningkatan kualitas sumber daya manusia serta mutu pendidikan secara berkelanjutan. Pemanfaatan teknologi ini juga memudahkan guru, siswa, dan alumni mengakses referensi, materi, dan informasi pendidikan secara efektif.<br><br>Website ini berfungsi sebagai sarana komunikasi antara sekolah dengan guru, siswa, orang tua/wali murid, alumni, dan pemangku kepentingan lainnya. Kehadiran website ini membuat penyebaran informasi lebih cepat, interaktif, dan mendukung tercapainya pendidikan yang lebih berkualitas di SMK Negeri 4 Malang.'],
            
            // Vacancies
            ['section' => 'vacancies', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'vacancies', 'key' => 'title', 'value' => 'Lowongan Kerja Terbaru'],
            ['section' => 'vacancies', 'key' => 'description', 'value' => 'Temukan peluang kerja sesuai dengan kompetensi keahlianmu.'],
            
            // Tracer Study
            ['section' => 'tracer_study', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'tracer_study', 'key' => 'title', 'value' => 'Tracer Study'],
            ['section' => 'tracer_study', 'key' => 'description', 'value' => 'Kami melacak karier alumni untuk meningkatkan mutu pembelajaran dan relevansi dengan industri.'],
            ['section' => 'tracer_study', 'key' => 'card_1_title', 'value' => 'Jejak Karier'],
            ['section' => 'tracer_study', 'key' => 'card_1_description', 'value' => 'Memantau jejak karier alumni secara berkelanjutan setelah lulus.'],
            ['section' => 'tracer_study', 'key' => 'card_2_title', 'value' => 'Evaluasi Sekolah'],
            ['section' => 'tracer_study', 'key' => 'card_2_description', 'value' => 'Data alumni membantu sekolah melakukan evaluasi dan perbaikan.'],
            ['section' => 'tracer_study', 'key' => 'card_3_title', 'value' => 'Relevansi Industri'],
            ['section' => 'tracer_study', 'key' => 'card_3_description', 'value' => 'Memastikan lulusan tetap relevan dengan kebutuhan industri.'],
            ['section' => 'tracer_study', 'key' => 'cta_text', 'value' => 'Lihat Laporan Tracer Study'],
            ['section' => 'tracer_study', 'key' => 'cta_link', 'value' => '#'], // link disesuaikan nanti
            
            // Announcements
            ['section' => 'announcements', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'announcements', 'key' => 'title', 'value' => 'Pengumuman & Informasi'],
            ['section' => 'announcements', 'key' => 'description', 'value' => 'Update terbaru terkait kegiatan, seleksi, dan program BKK.'],
            
            // Survey
            ['section' => 'survey', 'key' => 'is_visible', 'value' => 'true'],
            ['section' => 'survey', 'key' => 'title', 'value' => 'Survei Kepuasan'],
            ['section' => 'survey', 'key' => 'description', 'value' => 'Bantu kami meningkatkan layanan BKK dengan mengisi survei kepuasan. Partisipasi anda sangat berarti untuk kemajuan sekolah kami.'],
            ['section' => 'survey', 'key' => 'cta_text', 'value' => 'Isi Survei Kepuasan'],
            ['section' => 'survey', 'key' => 'cta_link', 'value' => '#'],
            ['section' => 'survey', 'key' => 'image', 'value' => '/assets/static/background/survey-bg.png'],
        ];

        foreach ($settings as $setting) {
            \App\Models\HomepageSetting::updateOrCreate(
                ['section' => $setting['section'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
