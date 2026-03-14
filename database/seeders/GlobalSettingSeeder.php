<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Navbar ──
            ['section' => 'navbar', 'key' => 'logo', 'value' => ''],

            // ── Footer ──
            ['section' => 'footer', 'key' => 'logo', 'value' => ''],
            ['section' => 'footer', 'key' => 'description', 'value' => 'Unit layanan informasi lowongan kerja dan penyaluran tenaga kerja bagi Alumni SMK Negeri 4 Malang.'],

            // Social Media
            ['section' => 'footer', 'key' => 'social_telegram', 'value' => 'https://t.me/bkksmkn4malang'],
            ['section' => 'footer', 'key' => 'social_facebook', 'value' => 'https://m.facebook.com/bkksmkn4malang/?tsid=0.4424916632749889&source=result'],
            ['section' => 'footer', 'key' => 'social_instagram', 'value' => 'https://instagram.com/bkksmkn4malang?utm_medium=copy_link'],

            // Link Terkait
            ['section' => 'footer', 'key' => 'related_links', 'value' => json_encode([
                ['label' => 'Laman Utama SMKN 4 Malang', 'url' => '/'],
                ['label' => 'Disnakertrans Provinsi Jawa Timur', 'url' => 'https://disnakertrans.jatimprov.go.id/'],
                ['label' => 'Dinas Tenaga Kerja Kota Malang', 'url' => 'https://disnakerpmptsp.malangkota.go.id/'],
                ['label' => 'Kemendikbudristek', 'url' => 'https://www.kemendikbudristek.com/'],
                ['label' => 'Lulusan', 'url' => '#'],
            ])],

            // Layanan Kami
            ['section' => 'footer', 'key' => 'service_links', 'value' => json_encode([
                ['label' => 'Lowongan Kerja', 'url' => '/lowongan'],
                ['label' => 'Tracer Study', 'url' => '/tracer-study'],
                ['label' => 'Pengumuman', 'url' => '/pengumuman'],
                ['label' => 'Tentang Kami', 'url' => '/visi-misi'],
                ['label' => 'FAQ', 'url' => '/faq'],
            ])],

            // Kontak
            ['section' => 'footer', 'key' => 'contact_address', 'value' => 'Jalan Tanimbar Nomor 22, Kota Malang, Jawa Timur, kode pos 65117'],
            ['section' => 'footer', 'key' => 'contact_address_url', 'value' => 'https://maps.app.goo.gl/dQCR7sXjnCsp1QXS8'],
            ['section' => 'footer', 'key' => 'contact_email', 'value' => 'mail@smkn4malang.sch.id'],
            ['section' => 'footer', 'key' => 'contact_phone', 'value' => '(0341) 353798'],

            // Copyright & Bottom Links
            ['section' => 'footer', 'key' => 'copyright', 'value' => '© 2026 BKK SMKN 4 Malang. All rights reserved.'],
            ['section' => 'footer', 'key' => 'privacy_policy_url', 'value' => '#'],
            ['section' => 'footer', 'key' => 'terms_url', 'value' => '#'],

            // ── Tema ──
            ['section' => 'theme', 'key' => 'primary_color', 'value' => '#073AE4'],
        ];

        foreach ($settings as $setting) {
            GlobalSetting::updateOrCreate(
                ['section' => $setting['section'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
