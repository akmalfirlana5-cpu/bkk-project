<?php

namespace App\Filament\Pages;

use App\Models\FooterSetting;
use BackedEnum;
use UnitEnum;
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

class FooterSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3BottomLeft;

    protected static ?string $navigationLabel = 'Pengaturan Footer';

    protected static ?string $title = 'Pengaturan Footer';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 15;

    protected string $view = 'filament.pages.footer-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $logoPath = FooterSetting::getValue('logo', '');

        $this->form->fill([
            'logo' => $this->resolveStorageImage($logoPath),
            'description' => FooterSetting::getValue('description', ''),

            // Social Media
            'social_telegram' => FooterSetting::getValue('social_telegram', ''),
            'social_facebook' => FooterSetting::getValue('social_facebook', ''),
            'social_instagram' => FooterSetting::getValue('social_instagram', ''),

            // Link Terkait
            'related_links' => json_decode(FooterSetting::getValue('related_links', '[]'), true) ?? [],

            // Layanan Kami
            'service_links' => json_decode(FooterSetting::getValue('service_links', '[]'), true) ?? [],

            // Kontak
            'contact_address' => FooterSetting::getValue('contact_address', ''),
            'contact_address_url' => FooterSetting::getValue('contact_address_url', ''),
            'contact_email' => FooterSetting::getValue('contact_email', ''),
            'contact_phone' => FooterSetting::getValue('contact_phone', ''),

            // Copyright
            'copyright' => FooterSetting::getValue('copyright', ''),

            // Bottom Links
            'privacy_policy_url' => FooterSetting::getValue('privacy_policy_url', ''),
            'terms_url' => FooterSetting::getValue('terms_url', ''),
        ]);
    }

    protected function resolveStorageImage(string $path): array
    {
        if (!empty($path) && Storage::disk('public')->exists($path)) {
            return [$path];
        }
        return [];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Section::make('Logo & Deskripsi')
                ->description('Logo dan deskripsi singkat yang tampil di footer.')
                ->schema([
                    FileUpload::make('logo')
                        ->label('Logo Footer (versi putih)')
                        ->disk('public')
                        ->directory('footer')
                        ->image()
                        ->preserveFilenames(),
                    Textarea::make('description')
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
                ->description('Daftar link terkait yang tampil di footer. Bisa ditambah, dihapus, atau diurutkan ulang.')
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
                ->description('Daftar link layanan yang tampil di footer. Bisa ditambah, dihapus, atau diurutkan ulang.')
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
            ['logo', $extractImage('logo')],
            ['description', $state['description'] ?? ''],
            ['social_telegram', $state['social_telegram'] ?? ''],
            ['social_facebook', $state['social_facebook'] ?? ''],
            ['social_instagram', $state['social_instagram'] ?? ''],
            ['related_links', json_encode($state['related_links'] ?? [])],
            ['service_links', json_encode($state['service_links'] ?? [])],
            ['contact_address', $state['contact_address'] ?? ''],
            ['contact_address_url', $state['contact_address_url'] ?? ''],
            ['contact_email', $state['contact_email'] ?? ''],
            ['contact_phone', $state['contact_phone'] ?? ''],
            ['copyright', $state['copyright'] ?? ''],
            ['privacy_policy_url', $state['privacy_policy_url'] ?? ''],
            ['terms_url', $state['terms_url'] ?? ''],
        ];

        foreach ($settingsMap as [$key, $value]) {
            FooterSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan footer berhasil disimpan!')
            ->success()
            ->send();
    }
}
