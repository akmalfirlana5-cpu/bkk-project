<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $fillable = [
        'section',
        'key',
        'value',
    ];

    /**
     * Helper method to get setting value by section and key.
     */
    public static function getValue($section, $key, $default = null)
    {
        $setting = self::where('section', $section)->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Helper method to get all settings for a specific section as key-value pairs.
     */
    public static function getBySection($section)
    {
        return self::where('section', $section)->pluck('value', 'key')->toArray();
    }
}
