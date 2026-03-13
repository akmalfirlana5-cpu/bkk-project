<?php

namespace Database\Seeders;

use App\Models\InfoSetting;
use Illuminate\Database\Seeder;

class InfoSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Lowongan - Hero
            ['section' => 'lowongan', 'key' => 'hero_title', 'value' => 'Lowongan Kerja'],
            ['section' => 'lowongan', 'key' => 'hero_description', 'value' => 'Informasi lowongan kerja terbaru dari berbagai perusahaan mitra yang telah bekerja sama dengan BKK, guna membantu siswa dan alumni memperoleh kesempatan kerja yang sesuai dengan kompetensi dan minat, dan kualifikasi yang dimiliki.'],
            ['section' => 'lowongan', 'key' => 'hero_image', 'value' => ''],
            // Lowongan - Section
            ['section' => 'lowongan', 'key' => 'section_title', 'value' => 'Cari Lowongan Kerja'],
            ['section' => 'lowongan', 'key' => 'section_description', 'value' => ''],

            // Pengumuman - Hero
            ['section' => 'pengumuman', 'key' => 'hero_title', 'value' => 'Pengumuman'],
            ['section' => 'pengumuman', 'key' => 'hero_description', 'value' => 'Memuat pengumuman resmi dan pemberitahuan penting dari BKK dan sekolah sebagai sarana penyampaian informasi terkini kepada siswa, alumni, dan mitra terkait kegiatan, jadwal, dan layanan.'],
            ['section' => 'pengumuman', 'key' => 'hero_image', 'value' => ''],
            // Pengumuman - Section
            ['section' => 'pengumuman', 'key' => 'section_title', 'value' => 'Pengumuman Resmi BKK'],
            ['section' => 'pengumuman', 'key' => 'section_description', 'value' => 'Pengumuman resmi dan informasi terbaru dari BKK untuk siswa dan alumni terkait kegiatan dan layanan.'],

            // Tracer Study - Hero
            ['section' => 'tracer_study', 'key' => 'hero_title', 'value' => 'Tracer Study'],
            ['section' => 'tracer_study', 'key' => 'hero_description', 'value' => 'Informasi dan pendataan Tracer Study alumni sebagai sarana pelacakan kelanjutan karier, pendidikan, dan relevansi kompetensi lulusan, guna mendukung evaluasi dan peningkatan mutu sekolah.'],
            ['section' => 'tracer_study', 'key' => 'hero_image', 'value' => ''],
            // Tracer Study - Section
            ['section' => 'tracer_study', 'key' => 'section_title', 'value' => 'Hasil Tracer Study Alumni'],
            ['section' => 'tracer_study', 'key' => 'section_description', 'value' => 'Menyajikan ringkasan kondisi alumni setelah lulus, termasuk status pekerjaan, pendidikan, dan kegiatan lainnya.'],
            // Tracer Study - CTA Section
            ['section' => 'tracer_study', 'key' => 'cta_title', 'value' => 'Hasil Tracer Study Alumni'],
            ['section' => 'tracer_study', 'key' => 'cta_description', 'value' => 'Partisipasi Anda dalam Tracer Study membantu sekolah meningkatkan kualitas pendidikan dan layanan karier.'],
            ['section' => 'tracer_study', 'key' => 'cta_text', 'value' => 'Isi Tracer Study Sekarang'],
            ['section' => 'tracer_study', 'key' => 'cta_image', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            InfoSetting::updateOrCreate(
                ['section' => $setting['section'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
