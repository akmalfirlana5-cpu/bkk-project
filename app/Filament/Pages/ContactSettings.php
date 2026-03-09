<?php

namespace App\Filament\Pages;

use App\Models\ContactSetting;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ContactSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    protected static ?string $navigationLabel = 'Pengaturan Kontak';

    protected static ?string $title = 'Pengaturan Kontak';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 11;

    protected string $view = 'filament.pages.contact-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $heroImg = ContactSetting::getValue('hero_image', '');
        $heroImageArray = (!empty($heroImg) && \Illuminate\Support\Facades\Storage::disk('public')->exists($heroImg))
            ? [$heroImg] : [];

        $this->form->fill([
            'hero_title' => ContactSetting::getValue('hero_title', 'Kontak'),
            'hero_description' => ContactSetting::getValue('hero_description', ''),
            'hero_image' => $heroImageArray,
            'section_title' => ContactSetting::getValue('section_title', 'Butuh Bantuan BKK?'),
            'section_description' => ContactSetting::getValue('section_description', ''),
            'map_embed_url' => ContactSetting::getValue('map_embed_url', ''),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Section::make('Header Halaman Kontak')
                ->description('Judul dan deskripsi yang tampil di bagian hero halaman kontak.')
                ->schema([
                    TextInput::make('hero_title')
                        ->label('Judul Hero')
                        ->required(),
                    Textarea::make('hero_description')
                        ->label('Deskripsi Hero')
                        ->rows(3),
                    FileUpload::make('hero_image')
                        ->label('Gambar Background Hero')
                        ->disk('public')
                        ->directory('contact')
                        ->image()
                        ->preserveFilenames(),
                ]),

            Section::make('Section Formulir Kontak')
                ->description('Judul dan deskripsi di atas formulir kontak dan peta.')
                ->schema([
                    TextInput::make('section_title')
                        ->label('Judul Section')
                        ->required(),
                    Textarea::make('section_description')
                        ->label('Deskripsi Section')
                        ->rows(2),
                ]),

            Section::make('Google Maps')
                ->description('Salin URL embed dari Google Maps dan tempel di sini.')
                ->schema([
                    TextInput::make('map_embed_url')
                        ->label('URL Embed Google Maps')
                        ->placeholder('https://www.google.com/maps/embed?pb=...')
                        ->url()
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $extractImage = fn ($key) => is_array($state[$key] ?? null)
            ? (collect($state[$key])->first() ?? '')
            : ($state[$key] ?? '');

        $heroImage = $extractImage('hero_image');

        $settingsMap = [
            ['hero_title', $state['hero_title'] ?? ''],
            ['hero_description', $state['hero_description'] ?? ''],
            ['hero_image', $heroImage],
            ['section_title', $state['section_title'] ?? ''],
            ['section_description', $state['section_description'] ?? ''],
            ['map_embed_url', $state['map_embed_url'] ?? ''],
        ];

        foreach ($settingsMap as [$key, $value]) {
            ContactSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan kontak berhasil disimpan!')
            ->success()
            ->send();
    }
}
