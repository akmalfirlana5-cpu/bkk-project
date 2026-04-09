<?php

namespace App\Providers;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('global_settings')) 
        {
            $settings = GlobalSetting::all()
                ->groupBy('section')
                ->map(function ($items) {
                    return $items->pluck('value', 'key')
                    ->map(function ($value) {
                        if (is_string($value) && 
                        (str_starts_with($value, '[') || str_starts_with($value, '{'))) {
                            $decoded = json_decode($value, true);
                            // Jika decode berhasil, kembalikan hasil decode, jika gagal kembalikan aslinya
                            return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $value;
                        }
                        return $value;
                    });
                })
                ->toArray();

            View::share('Global_settings', $settings);
        }

        // dump($settings);
    }
}
