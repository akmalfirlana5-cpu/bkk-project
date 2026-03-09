<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with optional default.
     */
    public static function getValue(string $key, string $default = ''): string
    {
        return static::where('key', $key)->first()?->value ?? $default;
    }
}
