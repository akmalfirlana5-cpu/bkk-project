<?php

namespace Database\Seeders;

use App\Models\ProfileSetting;
use Illuminate\Database\Seeder;

class ProfileSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Shared Hero (same for all 5 profile pages)
            ['section' => 'hero', 'key' => 'title', 'value' => 'Profil BKK'],
            ['section' => 'hero', 'key' => 'description', 'value' => 'Mengenal Bursa Kerja Khusus (BKK) lebih dekat melalui informasi seputar peran, program, dan kegiatan yang diselenggarakan sebagai upaya mendukung kesiapan lulusan memasuki dunia kerja secara terarah dan berkelanjutan.'],
            ['section' => 'hero', 'key' => 'image', 'value' => ''],

            // Visi Misi
            ['section' => 'visi_misi', 'key' => 'section_title', 'value' => 'Visi Misi'],
            ['section' => 'visi_misi', 'key' => 'section_description', 'value' => 'Visi dan misi BKK menjadi landasan dalam menetapkan arah dan tujuan kegiatan. Berikut adalah visi dan misi BKK SMK Negeri 4 Malang:'],
            ['section' => 'visi_misi', 'key' => 'visi_icon', 'value' => ''],
            ['section' => 'visi_misi', 'key' => 'visi_title', 'value' => 'Visi BKK SMK Negeri 4 Malang'],
            ['section' => 'visi_misi', 'key' => 'visi_content', 'value' => '<p>"Menjadikan unit kerja yang dapat menyediakan dan menyalurkan informasi tenaga kerja yang cepat, tepat dan akurat sesuai dengan kebutuhan dunia Industri"</p>'],
            ['section' => 'visi_misi', 'key' => 'misi_icon', 'value' => ''],
            ['section' => 'visi_misi', 'key' => 'misi_title', 'value' => 'Misi BKK SMK Negeri 4 Malang'],
            ['section' => 'visi_misi', 'key' => 'misi_content', 'value' => '<ol><li>Memberikan layanan informasi dunia kerja yang sesuai dengan kebutuhan.</li><li>Mempromosikan tenaga kerja lulusan SMK ke dunia industri.</li><li>Merekrut dan menyalurkan calon tenaga kerja ke perusahaan-perusahaan.</li><li>Memberikan pelayanan pelatihan untuk pemantapan memasuki dunia kerja.</li><li>Mengadakan kerjasama dengan masyarakat, dunia usaha dan dunia industri.</li><li>Penelusuran alumni.</li></ol>'],

            // Struktur Organisasi
            ['section' => 'struktur_organisasi', 'key' => 'section_title', 'value' => 'Struktur Organisasi'],
            ['section' => 'struktur_organisasi', 'key' => 'section_description', 'value' => 'Berikut merupakan struktur organisasi BKK SMK Negeri 4 Malang sebagai berikut:'],
            ['section' => 'struktur_organisasi', 'key' => 'link_gdrive', 'value' => 'https://drive.google.com/file/d/1n5YX-M78YRUX0Xpf6kyU4VgmicTzKmZi/preview'],

            // Program Kerja
            ['section' => 'program_kerja', 'key' => 'section_title', 'value' => 'Program Kerja'],
            ['section' => 'program_kerja', 'key' => 'section_description', 'value' => 'Berikut merupakan program kerja BKK SMK Negeri 4 Malang:'],
            ['section' => 'program_kerja', 'key' => 'link_gdrive', 'value' => 'https://drive.google.com/file/d/1xvD7VYZ4D2Mfr68oUo8gdaxH6OegkgMb/preview?usp=embed_googleplus'],

            // Alur Kegiatan
            ['section' => 'alur_kegiatan', 'key' => 'section_title', 'value' => 'Alur Kegiatan'],
            ['section' => 'alur_kegiatan', 'key' => 'section_description', 'value' => 'Berikut merupakan alur kegiatan BKK SMK Negeri 4 Malang:'],
            ['section' => 'alur_kegiatan', 'key' => 'link_gdrive', 'value' => 'https://drive.google.com/file/d/1mDHMOi1q4VeYeXIHuLP-e0ehsKBRMHud/preview'],

            // Dokumen Pendukung
            ['section' => 'dokumen_pendukung', 'key' => 'items', 'value' => json_encode([
                [
                    'type' => 'sarana_prasarana',
                    'data' => [
                        'title' => 'Sarana dan Prasarana',
                        'description' => 'Berikut merupakan sarana dan prasarana penunjang kegiatan BKK SMK Negeri 4 Malang:',
                        'device_items' => [
                            [
                                'image' => '',
                                'device_name' => 'Alat Komunikasi (Tablet)',
                                'device_description' => 'Mempermudah interaksi dan komunikasi dalam pelayanan',
                            ],
                            [
                                'image' => '',
                                'device_name' => 'Smart TV / Android TV',
                                'device_description' => 'Menampilkan informasi dan lowongan kerja kepada siswa',
                            ],
                            [
                                'image' => '',
                                'device_name' => 'Laptop dan Printer',
                                'device_description' => 'Mendukung kegiatan administrasi dan pengolahan data BKK',
                            ],
                            [
                                'image' => '',
                                'device_name' => 'Loker / Almari Arsip BKK',
                                'device_description' => 'Tempat penyimpanan dokumen dan arsip BKK',
                            ],
                            [
                                'image' => '',
                                'device_name' => 'Papan Informasi (Mading)',
                                'device_description' => 'Media informasi lowongan kerja dan informasi industri bagi siswa dan alumni',
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Izin Pendirian',
                        'description' => 'Berikut merupakan dokumen izin pendirian BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1xognVZz0rcAToXlQ8JDKbQGavoM2Yjw2/preview',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Uraian Tugas',
                        'description' => 'Berikut merupakan uraian tugas pengelola BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1M-eMLa1FxsmLqOzbnO6nQ7UepaUOadlR/preview?usp=embed_googleplus',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Logo dan Motto',
                        'description' => 'Berikut merupakan logo dan motto BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1ZYd9q3mBSywq3tbNxrkHKmbE1eW81lGZ/preview',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Rekapitulasi MoU',
                        'description' => 'Berikut merupakan rekapitulasi MoU BKK SMK Negeri 4 Malang dengan dunia usaha dan dunia industri:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1l8m6LEgMOMq7WF0zFfp1OsqSTlB88rwu/preview',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Linieritas Jurusan',
                        'description' => 'Berikut merupakan data linieritas jurusan dengan bidang kerja di dunia usaha dan dunia industri BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/19tkGPVvsna3IBTXIJvCwLwfpLKZZTDpr/preview?usp=embed_googleplus',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Industri Pasangan',
                        'description' => 'Berikut merupakan daftar industri pasangan BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1adql2idJj_vxHrxgoKaP-oYC9o6Okv10/preview?usp=embed_googleplus',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Dokumentasi Kegiatan',
                        'description' => 'Berikut merupakan dokumentasi kegiatan BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1ZGyCuD3xvi1MrNT1El97C9UvKUCQsV6T/preview?usp=embed_googleplus',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Evaluasi Kinerja',
                        'description' => 'Berikut merupakan hasil evaluasi kinerja BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1AxiyB9KqdVm_mB5bo1Wr7zv7uh7EvhJA/preview?usp=embed_googleplus',
                    ],
                ],
                [
                    'type' => 'gdrive',
                    'data' => [
                        'title' => 'Sharing Praktik Baik',
                        'description' => 'Berikut merupakan sharing praktik baik yang dilaksanakan oleh BKK SMK Negeri 4 Malang:',
                        'link_gdrive' => 'https://drive.google.com/file/d/1hRH034eSkcyB0zEdk0wSD0eLOl57UyCE/preview?usp=embed_googleplus',
                    ],
                ],
            ])],
        ];

        foreach ($settings as $setting) {
            ProfileSetting::updateOrCreate(
                ['section' => $setting['section'], 'key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
