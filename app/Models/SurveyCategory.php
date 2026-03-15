<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyCategory extends Model
{
    protected $table = 'survey_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'identity_fields',
        'is_active',
    ];

    protected $casts = [
        'identity_fields' => 'array',
        'is_active' => 'boolean',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class, 'category_id')->orderBy('sort_order');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class, 'category_id');
    }
}
