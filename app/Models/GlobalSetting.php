<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = ['section', 'key', 'value'];

    public static function getValue(string $section, string $key, string $default = ''): string
    {
        return static::where('section', $section)->where('key', $key)->first()?->value ?? $default;
    }

    public static function getBySection(string $section): array
    {
        return static::where('section', $section)
            ->pluck('value', 'key')
            ->toArray();
    }
}
