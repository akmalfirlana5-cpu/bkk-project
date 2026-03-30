<?php

namespace App\Filament\Pages;

use App\Models\HomepageSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class HomepageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->label('Lihat Tampilan')
                ->icon(Heroicon::OutlinedEye)
                ->color('gray')
                ->url(route('beranda'), shouldOpenInNewTab: true),
        ];
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.homepage_settings');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Pengaturan Beranda';

    protected static ?string $title = 'Pengaturan Beranda';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 9;

    protected string $view = 'filament.pages.homepage-settings';

    /**
     * Single data property for Filament's form state management.
     * Using fill() / getState() ensures FileUpload components
     * properly process uploads (save to disk, return clean paths).
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->loadSettings());
    }

    protected function loadSettings(): array
    {
        // Load Hero slides (stored as JSON)
        $slidesJson = HomepageSetting::getValue('hero', 'slides', '[]');
        $heroSlides = json_decode($slidesJson, true) ?? [];

        // Load Welcome section
        $welcome = HomepageSetting::getBySection('welcome');
        $welcomeImg = $welcome['image'] ?? '';
        // Only load images that exist on the storage disk
        $welcomeImageArray = (! empty($welcomeImg) && \Illuminate\Support\Facades\Storage::disk('public')->exists($welcomeImg))
            ? [$welcomeImg] : [];

        // Load Survey section
        $survey = HomepageSetting::getBySection('survey');
        $surveyImg = $survey['image'] ?? '';
        $surveyImageArray = (! empty($surveyImg) && \Illuminate\Support\Facades\Storage::disk('public')->exists($surveyImg))
            ? [$surveyImg] : [];

        // Load other sections
        $vacancies = HomepageSetting::getBySection('vacancies');
        $tracer = HomepageSetting::getBySection('tracer_study');
        $announcements = HomepageSetting::getBySection('announcements');

        return [
            // Visibility toggles
            'hero_visible' => HomepageSetting::getValue('hero', 'is_visible', 'true') === 'true',
            'statistics_visible' => HomepageSetting::getValue('statistics', 'is_visible', 'true') === 'true',
            'welcome_visible' => HomepageSetting::getValue('welcome', 'is_visible', 'true') === 'true',
            'vacancies_visible' => HomepageSetting::getValue('vacancies', 'is_visible', 'true') === 'true',
            'tracer_study_visible' => HomepageSetting::getValue('tracer_study', 'is_visible', 'true') === 'true',
            'announcements_visible' => HomepageSetting::getValue('announcements', 'is_visible', 'true') === 'true',
            'survey_visible' => HomepageSetting::getValue('survey', 'is_visible', 'true') === 'true',
            'testimonials_visible' => HomepageSetting::getValue('testimonials', 'is_visible', 'true') === 'true',

            // Hero slides
            'hero_slides' => $heroSlides,

            // Welcome
            'welcome_title' => $welcome['title'] ?? '',
            'welcome_person_name' => $welcome['person_name'] ?? '',
            'welcome_person_position' => $welcome['person_position'] ?? '',
            'welcome_image' => $welcomeImageArray,
            'welcome_content' => $welcome['content'] ?? '',

            // Vacancies
            'vacancies_title' => $vacancies['title'] ?? '',
            'vacancies_description' => $vacancies['description'] ?? '',

            // Tracer Study
            'tracer_study_title' => $tracer['title'] ?? '',
            'tracer_study_description' => $tracer['description'] ?? '',
            'tracer_study_card_1_title' => $tracer['card_1_title'] ?? '',
            'tracer_study_card_1_icon' => $tracer['card_1_icon'] ?? '',
            'tracer_study_card_1_description' => $tracer['card_1_description'] ?? '',
            'tracer_study_card_2_title' => $tracer['card_2_title'] ?? '',
            'tracer_study_card_2_icon' => $tracer['card_2_icon'] ?? '',
            'tracer_study_card_2_description' => $tracer['card_2_description'] ?? '',
            'tracer_study_card_3_title' => $tracer['card_3_title'] ?? '',
            'tracer_study_card_3_icon' => $tracer['card_3_icon'] ?? '',
            'tracer_study_card_3_description' => $tracer['card_3_description'] ?? '',
            'tracer_study_cta_text' => $tracer['cta_text'] ?? '',
            'tracer_study_cta_link' => $tracer['cta_link'] ?? '',

            // Announcements
            'announcements_title' => $announcements['title'] ?? '',
            'announcements_description' => $announcements['description'] ?? '',

            // Survey
            'survey_title' => $survey['title'] ?? '',
            'survey_description' => $survey['description'] ?? '',
            'survey_cta_text' => $survey['cta_text'] ?? '',
            'survey_cta_link' => $survey['cta_link'] ?? '',
            'survey_image' => $surveyImageArray,
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Tabs::make('homepage_settings')
                ->tabs([
                    Tab::make('Visibility')
                        ->label('Tampilkan / Sembunyikan')
                        ->icon(Heroicon::OutlinedEye)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_beranda')
                                    ->label('Lihat Halaman Beranda')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda'), shouldOpenInNewTab: true),
                            ]),
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
                        ->icon(Heroicon::OutlinedPhoto)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_hero')
                                    ->label('Lihat Section Hero')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#hero', shouldOpenInNewTab: true),
                            ]),
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
                                                        ->preserveFilenames()
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
                                        ->deletable()
                                        ->collapsible()
                                        ->blockNumbers(false)
                                        ->addActionLabel('Tambah Slide Baru'),
                                ]),
                        ]),

                    Tab::make('Sambutan')
                        ->label('Sambutan Kepsek')
                        ->icon(Heroicon::OutlinedUser)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_sambutan')
                                    ->label('Lihat Section Sambutan')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#sambutan', shouldOpenInNewTab: true),
                            ]),
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
                                        ->image()
                                        ->preserveFilenames(),
                                    RichEditor::make('welcome_content')
                                        ->label('Isi Sambutan')
                                        ->json()
                                        ->required()
                                        ->columnSpan('full')
                                        ->extraInputAttributes(['style' => 'min-height: 200px;']),
                                ]),
                        ]),

                    Tab::make('Lowongan')
                        ->label('Lowongan Kerja')
                        ->icon(Heroicon::OutlinedBriefcase)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_lowongan')
                                    ->label('Lihat Section Lowongan')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#lowongan', shouldOpenInNewTab: true),
                            ]),
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
                        ->icon(Heroicon::OutlinedChartBar)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_tracer')
                                    ->label('Lihat Section Tracer Study')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#tracer-study', shouldOpenInNewTab: true),
                            ]),
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
                                    FileUpload::make('tracer_study_card_1_icon')
                                        ->label('Icon Card 1')
                                        ->disk('public')
                                        ->directory('homepage')
                                        ->image()
                                        ->preserveFilenames(),
                                    Textarea::make('tracer_study_card_1_description')
                                        ->label('Deskripsi Card 1')
                                        ->rows(2),
                                ])->columns(2),
                            Section::make('Card 2')
                                ->schema([
                                    TextInput::make('tracer_study_card_2_title')
                                        ->label('Judul Card 2'),
                                    FileUpload::make('tracer_study_card_2_icon')
                                        ->label('Icon Card 2')
                                        ->disk('public')
                                        ->directory('homepage')
                                        ->image()
                                        ->preserveFilenames(),
                                    Textarea::make('tracer_study_card_2_description')
                                        ->label('Deskripsi Card 2')
                                        ->rows(2),
                                ])->columns(2),
                            Section::make('Card 3')
                                ->schema([
                                    TextInput::make('tracer_study_card_3_title')
                                        ->label('Judul Card 3'),
                                    FileUpload::make('tracer_study_card_3_icon')
                                        ->label('Icon Card 3')
                                        ->disk('public')
                                        ->directory('homepage')
                                        ->image()
                                        ->preserveFilenames(),
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
                        ->icon(Heroicon::OutlinedBellAlert)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_pengumuman')
                                    ->label('Lihat Section Pengumuman')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#pengumuman', shouldOpenInNewTab: true),
                            ]),
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
                        ->icon(Heroicon::OutlinedClipboardDocumentCheck)
                        ->schema([
                            \Filament\Schemas\Components\Actions::make([
                                Action::make('preview_survey')
                                    ->label('Lihat Section Survei')
                                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                                    ->color('gray')
                                    ->size('sm')
                                    ->url(route('beranda').'#survey', shouldOpenInNewTab: true),
                            ]),
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
        // getState() triggers Filament's form processing pipeline:
        // - FileUpload components save files to disk and return clean paths
        // - Builder data gets properly structured with resolved file paths
        $state = $this->form->getState();

        // Extract image paths from FileUpload arrays
        $extractImage = fn ($key) => is_array($state[$key] ?? null)
            ? (collect($state[$key])->first() ?? '')
            : ($state[$key] ?? '');

        $welcomeImage = $extractImage('welcome_image');
        $surveyImage = $extractImage('survey_image');
        $tracerIcon = $extractImage('tracer_study_icon');
        $tracerCard1Icon = $extractImage('tracer_study_card_1_icon');
        $tracerCard2Icon = $extractImage('tracer_study_card_2_icon');
        $tracerCard3Icon = $extractImage('tracer_study_card_3_icon');

        $settingsMap = [
            // Visibility
            ['hero', 'is_visible', ($state['hero_visible'] ?? true) ? 'true' : 'false'],
            ['statistics', 'is_visible', ($state['statistics_visible'] ?? true) ? 'true' : 'false'],
            ['welcome', 'is_visible', ($state['welcome_visible'] ?? true) ? 'true' : 'false'],
            ['vacancies', 'is_visible', ($state['vacancies_visible'] ?? true) ? 'true' : 'false'],
            ['tracer_study', 'is_visible', ($state['tracer_study_visible'] ?? true) ? 'true' : 'false'],
            ['announcements', 'is_visible', ($state['announcements_visible'] ?? true) ? 'true' : 'false'],
            ['survey', 'is_visible', ($state['survey_visible'] ?? true) ? 'true' : 'false'],
            ['testimonials', 'is_visible', ($state['testimonials_visible'] ?? true) ? 'true' : 'false'],

            // Hero slides (saved as JSON with processed image paths)
            ['hero', 'slides', json_encode($state['hero_slides'] ?? [])],

            // Welcome
            ['welcome', 'title', $state['welcome_title'] ?? ''],
            ['welcome', 'person_name', $state['welcome_person_name'] ?? ''],
            ['welcome', 'person_position', $state['welcome_person_position'] ?? ''],
            ['welcome', 'image', $welcomeImage],
            ['welcome', 'content', $state['welcome_content'] ?? ''],

            // Vacancies
            ['vacancies', 'title', $state['vacancies_title'] ?? ''],
            ['vacancies', 'description', $state['vacancies_description'] ?? ''],

            // Tracer Study
            ['tracer_study', 'title', $state['tracer_study_title'] ?? ''],
            ['tracer_study', 'description', $state['tracer_study_description'] ?? ''],
            ['tracer_study', 'card_1_title', $state['tracer_study_card_1_title'] ?? ''],
            ['tracer_study', 'card_1_icon', $tracerCard1Icon],
            ['tracer_study', 'card_1_description', $state['tracer_study_card_1_description'] ?? ''],
            ['tracer_study', 'card_2_title', $state['tracer_study_card_2_title'] ?? ''],
            ['tracer_study', 'card_2_icon', $tracerCard2Icon],
            ['tracer_study', 'card_2_description', $state['tracer_study_card_2_description'] ?? ''],
            ['tracer_study', 'card_3_title', $state['tracer_study_card_3_title'] ?? ''],
            ['tracer_study', 'card_3_icon', $tracerCard3Icon],
            ['tracer_study', 'card_3_description', $state['tracer_study_card_3_description'] ?? ''],
            ['tracer_study', 'cta_text', $state['tracer_study_cta_text'] ?? ''],
            ['tracer_study', 'cta_link', $state['tracer_study_cta_link'] ?? ''],

            // Announcements
            ['announcements', 'title', $state['announcements_title'] ?? ''],
            ['announcements', 'description', $state['announcements_description'] ?? ''],

            // Survey
            ['survey', 'title', $state['survey_title'] ?? ''],
            ['survey', 'description', $state['survey_description'] ?? ''],
            ['survey', 'cta_text', $state['survey_cta_text'] ?? ''],
            ['survey', 'cta_link', $state['survey_cta_link'] ?? ''],
            ['survey', 'image', $surveyImage],
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
