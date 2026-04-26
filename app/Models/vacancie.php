<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Vacancie extends Model
{
    protected $table = 'vacancies';

    protected $fillable = [
        'company_id',
        'major',
        'image',
        'vacancy_name',
        'location',
        'employment_classification',
        'jobdesk',
        'salary',
        'requirements',
        'deadline',
        'loker_tipe',
        'email_company',
        'phone_company',
        'entryId',
        'vacancy_number',
        'quota_status',
    ];

    protected $casts = [
    'major' => 'array',
    'requirements' => 'array',
    'deadline' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Companie::class, 'company_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($vacancy) {
            $vacancy->entryId = 'lowongan-' . date('Y') . '-' . Str::random(6);
        });
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'id_vacancy');
    }

    /**
     * Hitung jumlah lamaran yang diterima untuk lowongan ini.
     */
    public function acceptedApplicationsCount(): int
    {
        return $this->applications()->where('status', 'diterima')->count();
    }

    /**
     * Cek apakah kuota lowongan sudah penuh.
     */
    public function isQuotaFull(): bool
    {
        if (empty($this->vacancy_number)) {
            return false;
        }

        return $this->acceptedApplicationsCount() >= $this->vacancy_number;
    }

    /**
     * Cek dan update status kuota. Jika penuh, auto-reject lamaran pending.
     */
    public function checkAndUpdateQuota(): void
    {
        if (!$this->isQuotaFull()) {
            return;
        }

        $this->update(['quota_status' => 'fulfilled']);

        // Auto-reject semua lamaran yang belum memiliki keputusan final
        $pendingApplications = $this->applications()
            ->whereNotIn('status', ['diterima', 'ditolak'])
            ->with('user')
            ->get();

        foreach ($pendingApplications as $application) {
            $application->update(['status' => 'ditolak']);
        }
    }

    public const QUOTA_STATUSES = [
        'open' => 'Tersedia',
        'fulfilled' => 'Kuota Terpenuhi',
    ];

    public const MAJORS = [
        'Animasi' => 'Animasi',
        'Desain Komunikasi Visual' => 'Desain Komunikasi Visual',
        'Logistik' => 'Logistik',
        'Perhotelan' => 'Perhotelan',
        'Teknik Grafika' => 'Teknik Grafika',
        'Teknik Komputer dan Jaringan' => 'Teknik Komputer dan Jaringan',
        'Rekayasa Perangkat Lunak' => 'Rekayasa Perangkat Lunak',
        'Mekatronika' => 'Mekatronika',
    ];

    public const EMPLOYMENT_TYPES = [
        'full-time' => 'Full Time',
        'part-time' => 'Part Time',
        'kontrak' => 'Kontrak',
        'magang' => 'Magang',
        'freelance' => 'Freelance',
    ];

    public const LOKER_TYPES = [
        'keperusahaan' => 'Ke Perusahaan',
        'kebkk' => 'Ke BKK',
    ];
}
