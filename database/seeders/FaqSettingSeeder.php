<?php

namespace Database\Seeders;

use App\Models\FaqSetting;
use Illuminate\Database\Seeder;

class FaqSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'FAQ'],
            ['key' => 'hero_description', 'value' => 'Temukan jawaban atas pertanyaan yang sering diajukan terkait layanan, program, dan mekanisme BKK, guna membantu siswa, alumni, dan mitra industri memperoleh informasi yang dibutuhkan.'],
            ['key' => 'section_title', 'value' => 'Pertanyaan Umum BKK'],
            ['key' => 'section_description', 'value' => 'Jawaban atas berbagai pertanyaan umum terkait layanan BKK yang sering dibutuhkan guna membantu memahami layanan BKK.'],
            ['key' => 'items', 'value' => json_encode([
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Apa itu BKK SMK Negeri 4 Malang dan apa perannya bagi siswa dan alumni?',
                        'content' => '<p>BKK SMK Negeri 4 Malang merupakan Bursa Kerja Khusus yang berada di lingkungan sekolah dan berperan sebagai penghubung antara siswa dan alumni dengan dunia usaha dan dunia industri. BKK membantu menyediakan informasi lowongan kerja, memfasilitasi proses rekrutmen, serta mendukung kesiapan siswa dan alumni agar lebih siap dan kompeten dalam memasuki dunia kerja.</p>',
                    ],
                ],
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Siapa saja yang dapat memanfaatkan layanan BKK?',
                        'content' => '<p>Layanan BKK SMK Negeri 4 Malang dapat dimanfaatkan oleh siswa SMK Negeri 4 Malang, khususnya siswa tingkat akhir, alumni, serta mitra dunia usaha dan dunia industri yang menjalin kerja sama dengan sekolah.</p>',
                    ],
                ],
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Mengapa BKK penting bagi siswa dan alumni SMK Negeri 4 Malang?',
                        'content' => '<p>BKK penting bagi siswa dan alumni SMK Negeri 4 Malang karena berperan dalam memberikan akses informasi dunia kerja, menjembatani lulusan dengan dunia usaha dan dunia industri, serta membantu meningkatkan kesiapan dan daya saing siswa dan alumni sebelum memasuki dunia kerja.</p>',
                    ],
                ],
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Kapan siswa dan alumni dapat mengikuti layanan dan program BKK?',
                        'content' => '<p>Siswa dan alumni dapat mengikuti layanan dan program BKK sesuai dengan jadwal dan informasi resmi yang diumumkan oleh BKK SMK Negeri 4 Malang, baik selama masa sekolah maupun setelah siswa dinyatakan lulus.</p>',
                    ],
                ],
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Di mana siswa dan alumni dapat memperoleh informasi resmi BKK?',
                        'content' => '<p>Siswa dan alumni dapat memperoleh informasi resmi BKK SMK Negeri 4 Malang melalui website resmi sekolah, media sosial resmi BKK, papan pengumuman di lingkungan sekolah, serta melalui kontak yang disediakan oleh BKK SMK Negeri 4 Malang.</p>',
                    ],
                ],
                [
                    'type' => 'question',
                    'data' => [
                        'title' => 'Bagaimana cara mendaftar dan mengikuti lowongan kerja melalui BKK?',
                        'content' => '<p>Siswa dan alumni dapat mendaftar dan mengikuti lowongan kerja melalui BKK dengan memantau informasi lowongan yang diumumkan oleh BKK SMK Negeri 4 Malang, kemudian melengkapi data dan persyaratan yang dibutuhkan sesuai ketentuan.</p>',
                    ],
                ],
            ])],
        ];

        foreach ($settings as $setting) {
            FaqSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
