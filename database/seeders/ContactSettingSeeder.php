<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'Kontak'],
            ['key' => 'hero_description', 'value' => 'Menyediakan informasi dan sarana komunikasi bagi siswa, alumni, maupun mitra industri untuk menghubungi BKK terkait layanan, kerja sama, serta informasi lebih lanjut secara mudah dan responsif.'],
            ['key' => 'hero_image', 'value' => ''],
            ['key' => 'section_title', 'value' => 'Butuh Bantuan BKK?'],
            ['key' => 'section_description', 'value' => 'Silakan hubungi BKK SMK Negeri 4 Malang untuk mendapatkan informasi dan bantuan terkait layanan, program, dan kerja sama.'],
            ['key' => 'map_embed_url', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.088191723806!2d112.62473577415871!3d-7.98982897968068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6281b75ea5485%3A0x90fd5c6fcedf6acf!2sSMK%20Negeri%204%20Kota%20Malang!5e0!3m2!1sid!2sid!4v1769496969328!5m2!1sid!2sid'],
        ];

        foreach ($settings as $setting) {
            ContactSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
