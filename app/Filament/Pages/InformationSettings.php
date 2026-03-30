<?php

namespace App\Filament\Pages;

use App\Models\InfoSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class InformationSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('preview_lowongan')
                    ->label('Halaman Lowongan')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(route('lowongan'), shouldOpenInNewTab: true),
                Action::make('preview_pengumuman')
                    ->label('Halaman Pengumuman')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(route('pengumuman'), shouldOpenInNewTab: true),
                Action::make('preview_tracer')
                    ->label('Halaman Tracer Study')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(route('tracer-study'), shouldOpenInNewTab: true),
            ])
                ->label('Lihat Tampilan')
                ->icon(Heroicon::OutlinedEye)
                ->color('gray'),
        ];
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.information_settings');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Pengaturan Informasi';

    protected static ?string $title = 'Pengaturan Informasi';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 12;

    protected string $view = 'filament.pages.information-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $lowongan = InfoSetting::getBySection('lowongan');
        $pengumuman = InfoSetting::getBySection('pengumuman');
        $tracer = InfoSetting::getBySection('tracer_study');

        $this->form->fill([
            // Lowongan
            'lowongan_hero_title' => $lowongan['hero_title'] ?? '',
            'lowongan_hero_description' => $lowongan['hero_description'] ?? '',
            'lowongan_hero_image' => $this->resolveStorageImage($lowongan['hero_image'] ?? ''),
            'lowongan_section_title' => $lowongan['section_title'] ?? '',
            'lowongan_section_description' => $lowongan['section_description'] ?? '',

            // Pengumuman
            'pengumuman_hero_title' => $pengumuman['hero_title'] ?? '',
            'pengumuman_hero_description' => $pengumuman['hero_description'] ?? '',
            'pengumuman_hero_image' => $this->resolveStorageImage($pengumuman['hero_image'] ?? ''),
            'pengumuman_section_title' => $pengumuman['section_title'] ?? '',
            'pengumuman_section_description' => $pengumuman['section_description'] ?? '',

            // Tracer Study
            'tracer_hero_title' => $tracer['hero_title'] ?? '',
            'tracer_hero_description' => $tracer['hero_description'] ?? '',
            'tracer_hero_image' => $this->resolveStorageImage($tracer['hero_image'] ?? ''),
            'tracer_section_title' => $tracer['section_title'] ?? '',
            'tracer_section_description' => $tracer['section_description'] ?? '',
            'tracer_cta_title' => $tracer['cta_title'] ?? '',
            'tracer_cta_description' => $tracer['cta_description'] ?? '',
            'tracer_cta_text' => $tracer['cta_text'] ?? '',
            'tracer_cta_image' => $this->resolveStorageImage($tracer['cta_image'] ?? ''),
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
            Tabs::make('information_settings')
                ->tabs([
                    Tab::make('Lowongan')
                        ->label('Lowongan Kerja')
                        ->icon(Heroicon::OutlinedBriefcase)
                        ->schema([
                            Section::make('Header Halaman Lowongan')
                                ->description('Judul dan deskripsi yang tampil di bagian hero halaman lowongan.')
                                ->schema([
                                    TextInput::make('lowongan_hero_title')
                                        ->label('Judul Hero')
                                        ->required(),
                                    Textarea::make('lowongan_hero_description')
                                        ->label('Deskripsi Hero')
                                        ->rows(3),
                                    FileUpload::make('lowongan_hero_image')
                                        ->label('Gambar Background Hero')
                                        ->disk('public')
                                        ->directory('info-pages')
                                        ->image()
                                        ->preserveFilenames(),
                                ]),
                            Section::make('Section Lowongan')
                                ->description('Judul dan deskripsi di atas daftar lowongan.')
                                ->schema([
                                    TextInput::make('lowongan_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('lowongan_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                        ]),

                    Tab::make('Pengumuman')
                        ->label('Pengumuman')
                        ->icon(Heroicon::OutlinedBellAlert)
                        ->schema([
                            Section::make('Header Halaman Pengumuman')
                                ->description('Judul dan deskripsi yang tampil di bagian hero halaman pengumuman.')
                                ->schema([
                                    TextInput::make('pengumuman_hero_title')
                                        ->label('Judul Hero')
                                        ->required(),
                                    Textarea::make('pengumuman_hero_description')
                                        ->label('Deskripsi Hero')
                                        ->rows(3),
                                    FileUpload::make('pengumuman_hero_image')
                                        ->label('Gambar Background Hero')
                                        ->disk('public')
                                        ->directory('info-pages')
                                        ->image()
                                        ->preserveFilenames(),
                                ]),
                            Section::make('Section Pengumuman')
                                ->description('Judul dan deskripsi di atas daftar pengumuman.')
                                ->schema([
                                    TextInput::make('pengumuman_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('pengumuman_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                        ]),

                    Tab::make('TracerStudy')
                        ->label('Tracer Study')
                        ->icon(Heroicon::OutlinedChartBar)
                        ->schema([
                            Section::make('Header Halaman Tracer Study')
                                ->description('Judul dan deskripsi yang tampil di bagian hero halaman tracer study.')
                                ->schema([
                                    TextInput::make('tracer_hero_title')
                                        ->label('Judul Hero')
                                        ->required(),
                                    Textarea::make('tracer_hero_description')
                                        ->label('Deskripsi Hero')
                                        ->rows(3),
                                    FileUpload::make('tracer_hero_image')
                                        ->label('Gambar Background Hero')
                                        ->disk('public')
                                        ->directory('info-pages')
                                        ->image()
                                        ->preserveFilenames(),
                                ]),
                            Section::make('Section Hasil Tracer Study')
                                ->description('Judul dan deskripsi di atas grafik hasil tracer study.')
                                ->schema([
                                    TextInput::make('tracer_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('tracer_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                            Section::make('Section CTA Isi Tracer Study')
                                ->description('Section ajakan untuk mengisi tracer study, dengan gambar ilustrasi.')
                                ->schema([
                                    TextInput::make('tracer_cta_title')
                                        ->label('Judul')
                                        ->required(),
                                    Textarea::make('tracer_cta_description')
                                        ->label('Deskripsi')
                                        ->rows(2),
                                    TextInput::make('tracer_cta_text')
                                        ->label('Teks Tombol CTA'),
                                    FileUpload::make('tracer_cta_image')
                                        ->label('Gambar Ilustrasi')
                                        ->disk('public')
                                        ->directory('info-pages')
                                        ->image()
                                        ->preserveFilenames(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $extractImage = fn ($key) => is_array($state[$key] ?? null)
            ? (collect($state[$key])->first() ?? '')
            : ($state[$key] ?? '');

        $settingsMap = [
            // Lowongan
            ['lowongan', 'hero_title', $state['lowongan_hero_title'] ?? ''],
            ['lowongan', 'hero_description', $state['lowongan_hero_description'] ?? ''],
            ['lowongan', 'hero_image', $extractImage('lowongan_hero_image')],
            ['lowongan', 'section_title', $state['lowongan_section_title'] ?? ''],
            ['lowongan', 'section_description', $state['lowongan_section_description'] ?? ''],

            // Pengumuman
            ['pengumuman', 'hero_title', $state['pengumuman_hero_title'] ?? ''],
            ['pengumuman', 'hero_description', $state['pengumuman_hero_description'] ?? ''],
            ['pengumuman', 'hero_image', $extractImage('pengumuman_hero_image')],
            ['pengumuman', 'section_title', $state['pengumuman_section_title'] ?? ''],
            ['pengumuman', 'section_description', $state['pengumuman_section_description'] ?? ''],

            // Tracer Study
            ['tracer_study', 'hero_title', $state['tracer_hero_title'] ?? ''],
            ['tracer_study', 'hero_description', $state['tracer_hero_description'] ?? ''],
            ['tracer_study', 'hero_image', $extractImage('tracer_hero_image')],
            ['tracer_study', 'section_title', $state['tracer_section_title'] ?? ''],
            ['tracer_study', 'section_description', $state['tracer_section_description'] ?? ''],
            ['tracer_study', 'cta_title', $state['tracer_cta_title'] ?? ''],
            ['tracer_study', 'cta_description', $state['tracer_cta_description'] ?? ''],
            ['tracer_study', 'cta_text', $state['tracer_cta_text'] ?? ''],
            ['tracer_study', 'cta_link', $state['tracer_cta_link'] ?? ''],
            ['tracer_study', 'cta_image', $extractImage('tracer_cta_image')],
        ];

        foreach ($settingsMap as [$section, $key, $value]) {
            InfoSetting::updateOrCreate(
                ['section' => $section, 'key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan informasi berhasil disimpan!')
            ->success()
            ->send();
    }
}
