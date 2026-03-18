<?php

namespace App\Filament\Pages;

use App\Models\GlobalSetting;
use BackedEnum;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class GlobalSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.global_settings');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Pengaturan Global';

    protected static ?string $title = 'Pengaturan Global';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.global-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $navbar = GlobalSetting::getBySection('navbar');
        $footer = GlobalSetting::getBySection('footer');
        $theme = GlobalSetting::getBySection('theme');

        $this->form->fill([
            // Navbar
            'navbar_logo' => $this->resolveStorageImage($navbar['logo'] ?? ''),

            // Footer
            'footer_logo' => $this->resolveStorageImage($footer['logo'] ?? ''),
            'footer_description' => $footer['description'] ?? '',
            'social_telegram' => $footer['social_telegram'] ?? '',
            'social_facebook' => $footer['social_facebook'] ?? '',
            'social_instagram' => $footer['social_instagram'] ?? '',
            'related_links' => json_decode($footer['related_links'] ?? '[]', true) ?? [],
            'service_links' => json_decode($footer['service_links'] ?? '[]', true) ?? [],
            'contact_address' => $footer['contact_address'] ?? '',
            'contact_address_url' => $footer['contact_address_url'] ?? '',
            'contact_email' => $footer['contact_email'] ?? '',
            'contact_phone' => $footer['contact_phone'] ?? '',
            'copyright' => $footer['copyright'] ?? '',
            'privacy_policy_url' => $footer['privacy_policy_url'] ?? '',
            'terms_url' => $footer['terms_url'] ?? '',

            // Theme
            'primary_color' => $theme['primary_color'] ?? '#073AE4',
        ]);
    }

    protected function resolveStorageImage(string $path): array
    {
        if (! empty($path) && Storage::disk('public')->exists($path)) {
            return [$path];
        }

        return [];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            // ── Tema ──
            Section::make('Warna Tema')
                ->icon(Heroicon::OutlinedSwatch)
                ->description('Atur warna utama website.')
                ->schema([
                    ColorPicker::make('primary_color')
                        ->label('Warna Utama')
                        ->required(),
                ]),

            // ── Navbar ──
            Section::make('Logo Navbar')
                ->icon(Heroicon::OutlinedBars3)
                ->description('Logo yang tampil di navigasi atas website.')
                ->schema([
                    FileUpload::make('navbar_logo')
                        ->label('Logo Navbar')
                        ->disk('public')
                        ->directory('global')
                        ->image()
                        ->preserveFilenames(),
                ]),

            // ── Footer ──
            Section::make('Logo & Deskripsi Footer')
                ->icon(Heroicon::OutlinedBars3BottomLeft)
                ->description('Logo dan deskripsi singkat yang tampil di footer.')
                ->schema([
                    FileUpload::make('footer_logo')
                        ->label('Logo Footer (versi putih)')
                        ->disk('public')
                        ->directory('global')
                        ->image()
                        ->preserveFilenames(),
                    Textarea::make('footer_description')
                        ->label('Deskripsi')
                        ->rows(3),
                ]),

            Section::make('Media Sosial')
                ->description('Link akun media sosial yang tampil di footer.')
                ->schema([
                    TextInput::make('social_telegram')
                        ->label('Telegram')
                        ->placeholder('https://t.me/...'),
                    TextInput::make('social_facebook')
                        ->label('Facebook')
                        ->placeholder('https://facebook.com/...'),
                    TextInput::make('social_instagram')
                        ->label('Instagram')
                        ->placeholder('https://instagram.com/...'),
                ]),

            Section::make('Link Terkait')
                ->description('Daftar link terkait yang tampil di footer.')
                ->schema([
                    Repeater::make('related_links')
                        ->label('')
                        ->schema([
                            TextInput::make('label')
                                ->label('Label')
                                ->required(),
                            TextInput::make('url')
                                ->label('URL')
                                ->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->reorderable()
                        ->deletable()
                        ->addActionLabel('Tambah Link')
                        ->collapsible()
                        ->defaultItems(0),
                ]),

            Section::make('Layanan Kami')
                ->description('Daftar link layanan yang tampil di footer.')
                ->schema([
                    Repeater::make('service_links')
                        ->label('')
                        ->schema([
                            TextInput::make('label')
                                ->label('Label')
                                ->required(),
                            TextInput::make('url')
                                ->label('URL')
                                ->required(),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->reorderable()
                        ->deletable()
                        ->addActionLabel('Tambah Link')
                        ->collapsible()
                        ->defaultItems(0),
                ]),

            Section::make('Kontak')
                ->description('Informasi kontak yang tampil di footer.')
                ->schema([
                    Textarea::make('contact_address')
                        ->label('Alamat')
                        ->rows(2),
                    TextInput::make('contact_address_url')
                        ->label('URL Google Maps')
                        ->placeholder('https://maps.app.goo.gl/...'),
                    TextInput::make('contact_email')
                        ->label('Email'),
                    TextInput::make('contact_phone')
                        ->label('Telepon'),
                ]),

            Section::make('Bagian Bawah Footer')
                ->description('Copyright dan link kebijakan.')
                ->schema([
                    TextInput::make('copyright')
                        ->label('Teks Copyright'),
                    TextInput::make('privacy_policy_url')
                        ->label('URL Kebijakan Privasi'),
                    TextInput::make('terms_url')
                        ->label('URL Syarat & Ketentuan'),
                ]),
        ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $extractImage = fn ($key) => is_array($state[$key] ?? null)
            ? (collect($state[$key])->first() ?? '')
            : ($state[$key] ?? '');

        $settingsMap = [
            // Navbar
            ['navbar', 'logo', $extractImage('navbar_logo')],

            // Footer
            ['footer', 'logo', $extractImage('footer_logo')],
            ['footer', 'description', $state['footer_description'] ?? ''],
            ['footer', 'social_telegram', $state['social_telegram'] ?? ''],
            ['footer', 'social_facebook', $state['social_facebook'] ?? ''],
            ['footer', 'social_instagram', $state['social_instagram'] ?? ''],
            ['footer', 'related_links', json_encode($state['related_links'] ?? [])],
            ['footer', 'service_links', json_encode($state['service_links'] ?? [])],
            ['footer', 'contact_address', $state['contact_address'] ?? ''],
            ['footer', 'contact_address_url', $state['contact_address_url'] ?? ''],
            ['footer', 'contact_email', $state['contact_email'] ?? ''],
            ['footer', 'contact_phone', $state['contact_phone'] ?? ''],
            ['footer', 'copyright', $state['copyright'] ?? ''],
            ['footer', 'privacy_policy_url', $state['privacy_policy_url'] ?? ''],
            ['footer', 'terms_url', $state['terms_url'] ?? ''],

            // Theme
            ['theme', 'primary_color', $state['primary_color'] ?? ''],
        ];

        foreach ($settingsMap as [$section, $key, $value]) {
            GlobalSetting::updateOrCreate(
                ['section' => $section, 'key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan global berhasil disimpan!')
            ->success()
            ->send();
    }
}
