<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class vacancie extends Model
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
    ];

    protected $casts = [
    'major' => 'array',
    'requirements' => 'array',
    'deadline' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(companie::class, 'company_id');
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
