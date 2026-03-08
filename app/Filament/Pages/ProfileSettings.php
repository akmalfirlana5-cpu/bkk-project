<?php

namespace App\Filament\Pages;

use App\Models\ProfileSetting;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
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

class ProfileSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Pengaturan Profil';

    protected static ?string $title = 'Pengaturan Profil';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 13;

    protected string $view = 'filament.pages.profile-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $hero = ProfileSetting::getBySection('hero');
        $visiMisi = ProfileSetting::getBySection('visi_misi');
        $strukturOrg = ProfileSetting::getBySection('struktur_organisasi');
        $programKerja = ProfileSetting::getBySection('program_kerja');
        $alurKegiatan = ProfileSetting::getBySection('alur_kegiatan');
        $dokPendukung = ProfileSetting::getBySection('dokumen_pendukung');

        $this->form->fill([
            // Shared Hero
            'hero_title' => $hero['title'] ?? '',
            'hero_description' => $hero['description'] ?? '',
            'hero_image' => $this->resolveStorageImage($hero['image'] ?? ''),

            // Visi Misi
            'visi_misi_section_title' => $visiMisi['section_title'] ?? '',
            'visi_misi_section_description' => $visiMisi['section_description'] ?? '',
            'visi_icon' => $this->resolveStorageImage($visiMisi['visi_icon'] ?? ''),
            'visi_title' => $visiMisi['visi_title'] ?? '',
            'visi_content' => $visiMisi['visi_content'] ?? '',
            'misi_icon' => $this->resolveStorageImage($visiMisi['misi_icon'] ?? ''),
            'misi_title' => $visiMisi['misi_title'] ?? '',
            'misi_content' => $visiMisi['misi_content'] ?? '',

            // Struktur Organisasi
            'struktur_section_title' => $strukturOrg['section_title'] ?? '',
            'struktur_section_description' => $strukturOrg['section_description'] ?? '',
            'struktur_link_gdrive' => $strukturOrg['link_gdrive'] ?? '',

            // Program Kerja
            'program_section_title' => $programKerja['section_title'] ?? '',
            'program_section_description' => $programKerja['section_description'] ?? '',
            'program_link_gdrive' => $programKerja['link_gdrive'] ?? '',

            // Alur Kegiatan
            'alur_section_title' => $alurKegiatan['section_title'] ?? '',
            'alur_section_description' => $alurKegiatan['section_description'] ?? '',
            'alur_link_gdrive' => $alurKegiatan['link_gdrive'] ?? '',

            // Dokumen Pendukung
            'dokpen_section_title' => $dokPendukung['section_title'] ?? '',
            'dokpen_section_description' => $dokPendukung['section_description'] ?? '',
            'dokpen_items' => json_decode($dokPendukung['items'] ?? '[]', true) ?? [],
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
            Tabs::make('profile_settings')
                ->tabs([
                    // Hero (shared)
                    Tab::make('Hero')
                        ->label('Hero (Semua Halaman)')
                        ->icon(Heroicon::OutlinedPhoto)
                        ->schema([
                            Section::make('Header Semua Halaman Profil')
                                ->description('Hero ini digunakan bersama oleh semua halaman profil BKK.')
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
                                        ->directory('profile')
                                        ->image()
                                        ->preserveFilenames(),
                                ]),
                        ]),

                    // Visi Misi
                    Tab::make('VisiMisi')
                        ->label('Visi Misi')
                        ->icon(Heroicon::OutlinedEye)
                        ->schema([
                            Section::make('Section Visi Misi')
                                ->description('Judul dan deskripsi section visi misi.')
                                ->schema([
                                    TextInput::make('visi_misi_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('visi_misi_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                            Section::make('Visi')
                                ->description('Konten card visi.')
                                ->schema([
                                    FileUpload::make('visi_icon')
                                        ->label('Icon Visi')
                                        ->disk('public')
                                        ->directory('profile')
                                        ->image()
                                        ->preserveFilenames(),
                                    TextInput::make('visi_title')
                                        ->label('Judul Visi')
                                        ->required(),
                                    RichEditor::make('visi_content')
                                        ->label('Isi Visi')
                                        ->required()
                                        ->columnSpan('full'),
                                ]),
                            Section::make('Misi')
                                ->description('Konten card misi.')
                                ->schema([
                                    FileUpload::make('misi_icon')
                                        ->label('Icon Misi')
                                        ->disk('public')
                                        ->directory('profile')
                                        ->image()
                                        ->preserveFilenames(),
                                    TextInput::make('misi_title')
                                        ->label('Judul Misi')
                                        ->required(),
                                    RichEditor::make('misi_content')
                                        ->label('Isi Misi')
                                        ->required()
                                        ->columnSpan('full'),
                                ]),
                        ]),

                    // Struktur Organisasi
                    Tab::make('StrukturOrganisasi')
                        ->label('Struktur Organisasi')
                        ->icon(Heroicon::OutlinedUserGroup)
                        ->schema([
                            Section::make('Halaman Struktur Organisasi')
                                ->schema([
                                    TextInput::make('struktur_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('struktur_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                    TextInput::make('struktur_link_gdrive')
                                        ->label('Link Google Drive (Preview)')
                                        ->placeholder('https://drive.google.com/file/d/.../preview')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Program Kerja
                    Tab::make('ProgramKerja')
                        ->label('Program Kerja')
                        ->icon(Heroicon::OutlinedClipboardDocumentList)
                        ->schema([
                            Section::make('Halaman Program Kerja')
                                ->schema([
                                    TextInput::make('program_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('program_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                    TextInput::make('program_link_gdrive')
                                        ->label('Link Google Drive (Preview)')
                                        ->placeholder('https://drive.google.com/file/d/.../preview')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Alur Kegiatan
                    Tab::make('AlurKegiatan')
                        ->label('Alur Kegiatan')
                        ->icon(Heroicon::OutlinedArrowPath)
                        ->schema([
                            Section::make('Halaman Alur Kegiatan')
                                ->schema([
                                    TextInput::make('alur_section_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('alur_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                    TextInput::make('alur_link_gdrive')
                                        ->label('Link Google Drive (Preview)')
                                        ->placeholder('https://drive.google.com/file/d/.../preview')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    // Dokumen Pendukung
                    Tab::make('DokumenPendukung')
                        ->label('Dokumen Pendukung')
                        ->icon(Heroicon::OutlinedDocumentText)
                        ->schema([
                            Section::make('Section Dokumen Pendukung')
                                ->schema([
                                    TextInput::make('dokpen_section_title')
                                        ->label('Judul Section'),
                                    Textarea::make('dokpen_section_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                            Section::make('Daftar Dokumen')
                                ->description('Tambah, edit, hapus, atau susun ulang dokumen.')
                                ->schema([
                                    Builder::make('dokpen_items')
                                        ->label('')
                                        ->blocks([
                                            Block::make('gdrive')
                                                ->label('Dokumen (Google Drive)')
                                                ->icon(Heroicon::OutlinedDocument)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->label('Judul')
                                                        ->required(),
                                                    Textarea::make('description')
                                                        ->label('Deskripsi')
                                                        ->rows(2),
                                                    TextInput::make('link_gdrive')
                                                        ->label('Link Google Drive (Preview)')
                                                        ->placeholder('https://drive.google.com/file/d/.../preview')
                                                        ->required(),
                                                ]),
                                            Block::make('sarana_prasarana')
                                                ->label('Sarana & Prasarana (Gambar)')
                                                ->icon(Heroicon::OutlinedPhoto)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->label('Judul')
                                                        ->required(),
                                                    Textarea::make('description')
                                                        ->label('Deskripsi')
                                                        ->rows(2),
                                                    Repeater::make('device_items')
                                                        ->label('Daftar Perangkat / Sarana')
                                                        ->schema([
                                                            FileUpload::make('image')
                                                                ->label('Gambar')
                                                                ->disk('public')
                                                                ->directory('profile/sarana')
                                                                ->image()
                                                                ->preserveFilenames(),
                                                            TextInput::make('device_name')
                                                                ->label('Nama Perangkat')
                                                                ->required(),
                                                            Textarea::make('device_description')
                                                                ->label('Deskripsi')
                                                                ->rows(2),
                                                        ])
                                                        ->reorderable()
                                                        ->deletable()
                                                        ->collapsible()
                                                        ->addActionLabel('Tambah Perangkat')
                                                        ->defaultItems(0),
                                                ]),
                                        ])
                                        ->reorderable()
                                        ->deletable()
                                        ->collapsible()
                                        ->blockNumbers(false)
                                        ->addActionLabel('Tambah Dokumen'),
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
            // Shared Hero
            ['hero', 'title', $state['hero_title'] ?? ''],
            ['hero', 'description', $state['hero_description'] ?? ''],
            ['hero', 'image', $extractImage('hero_image')],

            // Visi Misi
            ['visi_misi', 'section_title', $state['visi_misi_section_title'] ?? ''],
            ['visi_misi', 'section_description', $state['visi_misi_section_description'] ?? ''],
            ['visi_misi', 'visi_icon', $extractImage('visi_icon')],
            ['visi_misi', 'visi_title', $state['visi_title'] ?? ''],
            ['visi_misi', 'visi_content', $state['visi_content'] ?? ''],
            ['visi_misi', 'misi_icon', $extractImage('misi_icon')],
            ['visi_misi', 'misi_title', $state['misi_title'] ?? ''],
            ['visi_misi', 'misi_content', $state['misi_content'] ?? ''],

            // Struktur Organisasi
            ['struktur_organisasi', 'section_title', $state['struktur_section_title'] ?? ''],
            ['struktur_organisasi', 'section_description', $state['struktur_section_description'] ?? ''],
            ['struktur_organisasi', 'link_gdrive', $state['struktur_link_gdrive'] ?? ''],

            // Program Kerja
            ['program_kerja', 'section_title', $state['program_section_title'] ?? ''],
            ['program_kerja', 'section_description', $state['program_section_description'] ?? ''],
            ['program_kerja', 'link_gdrive', $state['program_link_gdrive'] ?? ''],

            // Alur Kegiatan
            ['alur_kegiatan', 'section_title', $state['alur_section_title'] ?? ''],
            ['alur_kegiatan', 'section_description', $state['alur_section_description'] ?? ''],
            ['alur_kegiatan', 'link_gdrive', $state['alur_link_gdrive'] ?? ''],

            // Dokumen Pendukung
            ['dokumen_pendukung', 'section_title', $state['dokpen_section_title'] ?? ''],
            ['dokumen_pendukung', 'section_description', $state['dokpen_section_description'] ?? ''],
            ['dokumen_pendukung', 'items', json_encode($state['dokpen_items'] ?? [])],
        ];

        foreach ($settingsMap as [$section, $key, $value]) {
            ProfileSetting::updateOrCreate(
                ['section' => $section, 'key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan profil berhasil disimpan!')
            ->success()
            ->send();
    }
}
