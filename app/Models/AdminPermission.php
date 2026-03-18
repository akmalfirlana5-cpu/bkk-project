<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminPermission extends Model
{
    protected $fillable = [
        'user_id',
        'permission',
    ];

    /**
     * Available permission keys with their labels.
     *
     * @var array<string, string>
     */
    public const PERMISSIONS = [
        // Umum
        'page.dashboard' => 'Dashboard',
        'page.tracer_study' => 'Tracer Study',
        'resource.users' => 'Pengguna',
        'resource.companies' => 'Perusahaan',
        'resource.vacancies' => 'Lowongan',
        'resource.applications' => 'Lamaran',
        'resource.announcements' => 'Pengumuman',
        'resource.contacts' => 'Kontak',
        'page.send_message' => 'Kirim Pesan',
        // Survey Kepuasan
        'resource.survey_questions' => 'Soal Survey',
        'resource.survey_responses' => 'Hasil Survey',
        // Pengaturan Halaman
        'page.global_settings' => 'Pengaturan Global',
        'page.homepage_settings' => 'Pengaturan Beranda',
        'page.profile_settings' => 'Pengaturan Profil',
        'page.information_settings' => 'Pengaturan Informasi',
        'page.faq_settings' => 'Pengaturan FAQ',
        'page.contact_settings' => 'Pengaturan Kontak',
    ];

    /**
     * Permissions grouped by navigation section.
     *
     * @var array<string, array<string, string>>
     */
    public const PERMISSION_GROUPS = [
        'Umum' => [
            'page.dashboard' => 'Dashboard',
            'page.tracer_study' => 'Tracer Study',
            'resource.users' => 'Pengguna',
            'resource.companies' => 'Perusahaan',
            'resource.vacancies' => 'Lowongan',
            'resource.applications' => 'Lamaran',
            'resource.announcements' => 'Pengumuman',
            'resource.contacts' => 'Kontak',
            'page.send_message' => 'Kirim Pesan',
        ],
        'Survey Kepuasan' => [
            'resource.survey_questions' => 'Soal Survey',
            'resource.survey_responses' => 'Hasil Survey',
        ],
        'Pengaturan Halaman' => [
            'page.global_settings' => 'Pengaturan Global',
            'page.homepage_settings' => 'Pengaturan Beranda',
            'page.profile_settings' => 'Pengaturan Profil',
            'page.information_settings' => 'Pengaturan Informasi',
            'page.faq_settings' => 'Pengaturan FAQ',
            'page.contact_settings' => 'Pengaturan Kontak',
        ],
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
