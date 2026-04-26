<?php

namespace App\Models;

use App\Observers\ApplicationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ApplicationObserver::class])]
class Application extends Model
{
    protected $fillable = [
        'id_vacancy',
        'id_user',
        'id_company',
        'status',
    ];

    public const STATUSES = [
        "belum_diproses" => "Belum Diproses",
        "lolos_berkas" => "Lolos Berkas",
        "interview" => "Interview",
        "diterima" => "Diterima",
        "ditolak" => "Ditolak",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancie::class, 'id_vacancy');
    }
    public function company()
    {
        return $this->belongsTo(Companie::class, 'id_company');
    }
}
