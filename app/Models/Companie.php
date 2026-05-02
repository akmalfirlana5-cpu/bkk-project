<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Companie extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'companies_name',
        'companies_logo',
        'companies_profile',
        'address',
        'field',
        'employee',
        'short_address',
        'mou',
        'phone',
        'email',
        'website',
        'description',
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancie::class, 'company_id');
    }

    public function dudiUsers(): HasMany
    {
        return $this->hasMany(DudiUser::class, 'company_id');
    }
}
