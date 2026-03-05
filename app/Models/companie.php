<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class companie extends Model
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
    ];

    public function vacancies(): HasMany
    {
        return $this->hasMany(vacancie::class, 'company_id');
    }
      
}
