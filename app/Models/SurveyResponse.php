<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyResponse extends Model
{
    protected $table = 'survey_responses';

    protected $fillable = [
        'category_id',
        'phone',
        'identity_data',
    ];

    protected $casts = [
        'identity_data' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SurveyCategory::class, 'category_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'response_id');
    }
}
