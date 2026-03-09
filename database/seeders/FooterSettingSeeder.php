<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Logo
            ['key' => 'logo', 'value' => ''],

            // Description
            ['key' => 'description', 'value' => 'Unit layanan informasi lowongan kerja dan penyaluran tenaga kerja bagi Alumni SMK Negeri 4 Malang.'],

            // Social Media
            ['key' => 'social_telegram', 'value' => 'https://t.me/bkksmkn4malang'],
            ['key' => 'social_facebook', 'value' => 'https://m.facebook.com/bkksmkn4malang/?tsid=0.4424916632749889&source=result'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/bkksmkn4malang?utm_medium=copy_link'],

            // Link Terkait
            ['key' => 'related_links', 'value' => json_encode([
                ['label' => 'Laman Utama SMKN 4 Malang', 'url' => '/'],
                ['label' => 'Disnakertrans Provinsi Jawa Timur', 'url' => 'https://disnakertrans.jatimprov.go.id/'],
                ['label' => 'Dinas Tenaga Kerja Kota Malang', 'url' => 'https://disnakerpmptsp.malangkota.go.id/'],
                ['label' => 'Kemendikbudristek', 'url' => 'https://www.kemendikbudristek.com/'],
                ['label' => 'Lulusan', 'url' => '#'],
            ])],

            // Kontak
            ['key' => 'contact_address', 'value' => 'Jalan Tanimbar Nomor 22, Kota Malang, Jawa Timur, kode pos 65117'],
            ['key' => 'contact_address_url', 'value' => 'https://maps.app.goo.gl/dQCR7sXjnCsp1QXS8'],
            ['key' => 'contact_email', 'value' => 'mail@smkn4malang.sch.id'],
            ['key' => 'contact_phone', 'value' => '(0341) 353798'],

            // Layanan Kami
            ['key' => 'service_links', 'value' => json_encode([
                ['label' => 'Lowongan Kerja', 'url' => '/lowongan'],
                ['label' => 'Tracer Study', 'url' => '/tracer-study'],
                ['label' => 'Pengumuman', 'url' => '/pengumuman'],
                ['label' => 'Tentang Kami', 'url' => '/visi-misi'],
                ['label' => 'FAQ', 'url' => '/faq'],
            ])],

            // Copyright
            ['key' => 'copyright', 'value' => '© 2026 BKK SMKN 4 Malang. All rights reserved.'],

            // Bottom Links
            ['key' => 'privacy_policy_url', 'value' => '#'],
            ['key' => 'terms_url', 'value' => '#'],
        ];

        foreach ($settings as $setting) {
            FooterSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
