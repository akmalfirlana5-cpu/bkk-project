<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoSetting extends Model
{
    protected $fillable = ['section', 'key', 'value'];

    /**
     * Get a setting value by section and key with optional default.
     */
    public static function getValue(string $section, string $key, string $default = ''): string
    {
        return static::where('section', $section)->where('key', $key)->first()?->value ?? $default;
    }

    /**
     * Get all settings for a section as key-value array.
     */
    public static function getBySection(string $section): array
    {
        return static::where('section', $section)
            ->pluck('value', 'key')
            ->toArray();
    }
}
