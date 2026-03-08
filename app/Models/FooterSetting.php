<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function getValue(string $key, string $default = ''): string
    {
        return static::where('key', $key)->first()?->value ?? $default;
    }
}
