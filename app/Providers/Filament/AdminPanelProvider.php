<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $logo = \App\Models\GlobalSetting::getValue('navbar', 'logo');
        $logoUrl = $logo ? \Illuminate\Support\Facades\Storage::url($logo) : asset('assets/static/logo/logo-bkk.png');

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->favicon(asset('assets/static/logo/icon/logo-bkk-crop.webp'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->darkMode(true)
            ->brandLogo($logoUrl)
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->navigationGroups([
                'Lowongan & Lamaran',
                'Informasi & Pengumuman',
                'Survey & Tracer Study',
                'Manajemen Pengguna',
                'Pengaturan Halaman',
            ])
            ->globalSearch(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                /* AccountWidget::class,
                FilamentInfoWidget::class, */
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
