<?php

namespace App\Filament\Pages;

use App\Models\HomepageSetting;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class HomepageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Pengaturan Beranda';

    protected static ?string $title = 'Pengaturan Beranda';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Beranda';

    protected static ?int $navigationSort = 9;

    protected string $view = 'filament.pages.homepage-settings';

    // Section visibility toggles
    public bool $hero_visible = true;
    public bool $statistics_visible = true;
    public bool $welcome_visible = true;
    public bool $vacancies_visible = true;
    public bool $tracer_study_visible = true;
    public bool $announcements_visible = true;
    public bool $survey_visible = true;
    public bool $testimonials_visible = true;

    // Hero slides (Builder data stored as JSON)
    public ?array $hero_slides = [];

    // Welcome / Sambutan section
    public string $welcome_title = '';
    public string $welcome_person_name = '';
    public string $welcome_person_position = '';
    public ?array $welcome_image = [];
    public string $welcome_content = '';

    // Vacancies section
    public string $vacancies_title = '';
    public string $vacancies_description = '';

    // Tracer Study section
    public string $tracer_study_title = '';
    public string $tracer_study_description = '';
    public string $tracer_study_card_1_title = '';
    public string $tracer_study_card_1_description = '';
    public string $tracer_study_card_2_title = '';
    public string $tracer_study_card_2_description = '';
    public string $tracer_study_card_3_title = '';
    public string $tracer_study_card_3_description = '';
    public string $tracer_study_cta_text = '';
    public string $tracer_study_cta_link = '';

    // Announcements section
    public string $announcements_title = '';
    public string $announcements_description = '';

    // Survey section
    public string $survey_title = '';
    public string $survey_description = '';
    public string $survey_cta_text = '';
    public string $survey_cta_link = '';
    public ?array $survey_image = [];

    public function mount(): void
    {
        $this->loadSettings();
    }

    protected function loadSettings(): void
    {
        // Load visibility toggles
        $this->hero_visible = HomepageSetting::getValue('hero', 'is_visible', 'true') === 'true';
        $this->statistics_visible = HomepageSetting::getValue('statistics', 'is_visible', 'true') === 'true';
        $this->welcome_visible = HomepageSetting::getValue('welcome', 'is_visible', 'true') === 'true';
        $this->vacancies_visible = HomepageSetting::getValue('vacancies', 'is_visible', 'true') === 'true';
        $this->tracer_study_visible = HomepageSetting::getValue('tracer_study', 'is_visible', 'true') === 'true';
        $this->announcements_visible = HomepageSetting::getValue('announcements', 'is_visible', 'true') === 'true';
        $this->survey_visible = HomepageSetting::getValue('survey', 'is_visible', 'true') === 'true';
        $this->testimonials_visible = HomepageSetting::getValue('testimonials', 'is_visible', 'true') === 'true';

        // Load Hero slides (stored as JSON)
        $slidesJson = HomepageSetting::getValue('hero', 'slides', '[]');
        $this->hero_slides = json_decode($slidesJson, true) ?? [];

        // Load Welcome section
        $welcome = HomepageSetting::getBySection('welcome');
        $this->welcome_title = $welcome['title'] ?? '';
        $this->welcome_person_name = $welcome['person_name'] ?? '';
        $this->welcome_person_position = $welcome['person_position'] ?? '';
        $this->welcome_image = !empty($welcome['image']) ? [$welcome['image']] : [];
        $this->welcome_content = $welcome['content'] ?? '';

        // Load Vacancies section
        $vacancies = HomepageSetting::getBySection('vacancies');
        $this->vacancies_title = $vacancies['title'] ?? '';
        $this->vacancies_description = $vacancies['description'] ?? '';

        // Load Tracer Study section
        $tracer = HomepageSetting::getBySection('tracer_study');
        $this->tracer_study_title = $tracer['title'] ?? '';
        $this->tracer_study_description = $tracer['description'] ?? '';
        $this->tracer_study_card_1_title = $tracer['card_1_title'] ?? '';
        $this->tracer_study_card_1_description = $tracer['card_1_description'] ?? '';
        $this->tracer_study_card_2_title = $tracer['card_2_title'] ?? '';
        $this->tracer_study_card_2_description = $tracer['card_2_description'] ?? '';
        $this->tracer_study_card_3_title = $tracer['card_3_title'] ?? '';
        $this->tracer_study_card_3_description = $tracer['card_3_description'] ?? '';
        $this->tracer_study_cta_text = $tracer['cta_text'] ?? '';
        $this->tracer_study_cta_link = $tracer['cta_link'] ?? '';

        // Load Announcements section
        $announcements = HomepageSetting::getBySection('announcements');
        $this->announcements_title = $announcements['title'] ?? '';
        $this->announcements_description = $announcements['description'] ?? '';

        // Load Survey section
        $survey = HomepageSetting::getBySection('survey');
        $this->survey_title = $survey['title'] ?? '';
        $this->survey_description = $survey['description'] ?? '';
        $this->survey_cta_text = $survey['cta_text'] ?? '';
        $this->survey_cta_link = $survey['cta_link'] ?? '';
        $this->survey_image = !empty($survey['image']) ? [$survey['image']] : [];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('homepage_settings')
                ->tabs([
                    Tab::make('Visibility')
                        ->label('Tampilkan / Sembunyikan')
                        ->schema([
                            Section::make('Atur Section yang Ditampilkan')
                                ->description('Aktifkan atau nonaktifkan section yang tampil di halaman beranda.')
                                ->schema([
                                    Toggle::make('hero_visible')->label('Hero Carousel'),
                                    Toggle::make('statistics_visible')->label('Statistik'),
                                    Toggle::make('welcome_visible')->label('Sambutan Kepala Sekolah'),
                                    Toggle::make('vacancies_visible')->label('Lowongan Kerja'),
                                    Toggle::make('tracer_study_visible')->label('Tracer Study'),
                                    Toggle::make('announcements_visible')->label('Pengumuman & Informasi'),
                                    Toggle::make('survey_visible')->label('Survei Kepuasan'),
                                    Toggle::make('testimonials_visible')->label('Testimoni Alumni'),
                                ]),
                        ]),

                    Tab::make('HeroCarousel')
                        ->label('Hero Carousel')
                        ->schema([
                            Section::make('Kelola Slide Hero Carousel')
                                ->description('Tambah, edit, atau hapus slide yang tampil di bagian atas halaman beranda.')
                                ->schema([
                                    Builder::make('hero_slides')
                                        ->label('')
                                        ->blocks([
                                            Block::make('slide')
                                                ->label('Slide')
                                                ->icon(Heroicon::OutlinedPhoto)
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->label('Judul Slide')
                                                        ->required(),
                                                    Textarea::make('description')
                                                        ->label('Deskripsi')
                                                        ->rows(3)
                                                        ->required(),
                                                    FileUpload::make('image')
                                                        ->label('Gambar Background')
                                                        ->disk('public')
                                                        ->directory('hero-slides')
                                                        ->image()
                                                        ->required(),
                                                    TextInput::make('cta_text')
                                                        ->label('Teks Tombol CTA')
                                                        ->placeholder('Lihat Selengkapnya'),
                                                    TextInput::make('cta_link')
                                                        ->label('Link Tombol CTA')
                                                        ->placeholder('/lowongan'),
                                                ])
                                                ->columns(2),
                                        ])
                                        ->reorderable()
                                        ->collapsible()
                                        ->blockNumbers(false)
                                        ->addActionLabel('Tambah Slide Baru'),
                                ]),
                        ]),

                    Tab::make('Sambutan')
                        ->label('Sambutan Kepsek')
                        ->schema([
                            Section::make('Konten Sambutan Kepala Sekolah')
                                ->schema([
                                    TextInput::make('welcome_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    TextInput::make('welcome_person_name')
                                        ->label('Nama Kepala Sekolah')
                                        ->required(),
                                    TextInput::make('welcome_person_position')
                                        ->label('Jabatan')
                                        ->required(),
                                    FileUpload::make('welcome_image')
                                        ->label('Foto Kepala Sekolah')
                                        ->disk('public')
                                        ->directory('homepage')
                                        ->image(),
                                    Textarea::make('welcome_content')
                                        ->label('Isi Sambutan')
                                        ->rows(8)
                                        ->required(),
                                ]),
                        ]),

                    Tab::make('Lowongan')
                        ->label('Lowongan Kerja')
                        ->schema([
                            Section::make('Judul & Deskripsi Section Lowongan')
                                ->description('Data lowongan diambil dari database. Anda hanya bisa mengatur judul dan deskripsi section.')
                                ->schema([
                                    TextInput::make('vacancies_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('vacancies_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                        ]),

                    Tab::make('TracerStudy')
                        ->label('Tracer Study')
                        ->schema([
                            Section::make('Konten Section Tracer Study')
                                ->schema([
                                    TextInput::make('tracer_study_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('tracer_study_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                            Section::make('Card 1')
                                ->schema([
                                    TextInput::make('tracer_study_card_1_title')
                                        ->label('Judul Card 1'),
                                    Textarea::make('tracer_study_card_1_description')
                                        ->label('Deskripsi Card 1')
                                        ->rows(2),
                                ])->columns(2),
                            Section::make('Card 2')
                                ->schema([
                                    TextInput::make('tracer_study_card_2_title')
                                        ->label('Judul Card 2'),
                                    Textarea::make('tracer_study_card_2_description')
                                        ->label('Deskripsi Card 2')
                                        ->rows(2),
                                ])->columns(2),
                            Section::make('Card 3')
                                ->schema([
                                    TextInput::make('tracer_study_card_3_title')
                                        ->label('Judul Card 3'),
                                    Textarea::make('tracer_study_card_3_description')
                                        ->label('Deskripsi Card 3')
                                        ->rows(2),
                                ])->columns(2),
                            Section::make('Tombol CTA')
                                ->schema([
                                    TextInput::make('tracer_study_cta_text')
                                        ->label('Teks Tombol'),
                                    TextInput::make('tracer_study_cta_link')
                                        ->label('Link Tombol'),
                                ])->columns(2),
                        ]),

                    Tab::make('Pengumuman')
                        ->label('Pengumuman')
                        ->schema([
                            Section::make('Judul & Deskripsi Section Pengumuman')
                                ->description('Data pengumuman diambil dari database. Anda hanya bisa mengatur judul dan deskripsi section.')
                                ->schema([
                                    TextInput::make('announcements_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('announcements_description')
                                        ->label('Deskripsi Section')
                                        ->rows(2),
                                ]),
                        ]),

                    Tab::make('Survei')
                        ->label('Survei Kepuasan')
                        ->schema([
                            Section::make('Konten Section Survei Kepuasan')
                                ->schema([
                                    TextInput::make('survey_title')
                                        ->label('Judul Section')
                                        ->required(),
                                    Textarea::make('survey_description')
                                        ->label('Deskripsi Section')
                                        ->rows(3),
                                    TextInput::make('survey_cta_text')
                                        ->label('Teks Tombol CTA'),
                                    TextInput::make('survey_cta_link')
                                        ->label('Link Tombol CTA'),
                                    FileUpload::make('survey_image')
                                        ->label('Gambar Survei')
                                        ->disk('public')
                                        ->directory('homepage')
                                        ->image(),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $settingsMap = [
            // Visibility
            ['hero', 'is_visible', $this->hero_visible ? 'true' : 'false'],
            ['statistics', 'is_visible', $this->statistics_visible ? 'true' : 'false'],
            ['welcome', 'is_visible', $this->welcome_visible ? 'true' : 'false'],
            ['vacancies', 'is_visible', $this->vacancies_visible ? 'true' : 'false'],
            ['tracer_study', 'is_visible', $this->tracer_study_visible ? 'true' : 'false'],
            ['announcements', 'is_visible', $this->announcements_visible ? 'true' : 'false'],
            ['survey', 'is_visible', $this->survey_visible ? 'true' : 'false'],
            ['testimonials', 'is_visible', $this->testimonials_visible ? 'true' : 'false'],

            // Hero slides (stored as JSON)
            ['hero', 'slides', json_encode($this->hero_slides)],

            // Welcome
            ['welcome', 'title', $this->welcome_title],
            ['welcome', 'person_name', $this->welcome_person_name],
            ['welcome', 'person_position', $this->welcome_person_position],
            ['welcome', 'image', is_array($this->welcome_image) ? ($this->welcome_image[0] ?? '') : $this->welcome_image],
            ['welcome', 'content', $this->welcome_content],

            // Vacancies
            ['vacancies', 'title', $this->vacancies_title],
            ['vacancies', 'description', $this->vacancies_description],

            // Tracer Study
            ['tracer_study', 'title', $this->tracer_study_title],
            ['tracer_study', 'description', $this->tracer_study_description],
            ['tracer_study', 'card_1_title', $this->tracer_study_card_1_title],
            ['tracer_study', 'card_1_description', $this->tracer_study_card_1_description],
            ['tracer_study', 'card_2_title', $this->tracer_study_card_2_title],
            ['tracer_study', 'card_2_description', $this->tracer_study_card_2_description],
            ['tracer_study', 'card_3_title', $this->tracer_study_card_3_title],
            ['tracer_study', 'card_3_description', $this->tracer_study_card_3_description],
            ['tracer_study', 'cta_text', $this->tracer_study_cta_text],
            ['tracer_study', 'cta_link', $this->tracer_study_cta_link],

            // Announcements
            ['announcements', 'title', $this->announcements_title],
            ['announcements', 'description', $this->announcements_description],

            // Survey
            ['survey', 'title', $this->survey_title],
            ['survey', 'description', $this->survey_description],
            ['survey', 'cta_text', $this->survey_cta_text],
            ['survey', 'cta_link', $this->survey_cta_link],
            ['survey', 'image', is_array($this->survey_image) ? ($this->survey_image[0] ?? '') : $this->survey_image],
        ];

        foreach ($settingsMap as [$section, $key, $value]) {
            HomepageSetting::updateOrCreate(
                ['section' => $section, 'key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }
}
