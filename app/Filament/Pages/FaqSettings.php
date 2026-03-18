<?php

namespace App\Filament\Pages;

use App\Models\FaqSetting;
use BackedEnum;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class FaqSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.faq_settings');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static ?string $navigationLabel = 'Pengaturan FAQ';

    protected static ?string $title = 'Pengaturan FAQ';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Halaman';

    protected static ?int $navigationSort = 10;

    protected string $view = 'filament.pages.faq-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $heroImg = FaqSetting::getValue('hero_image', '');
        $heroImageArray = (! empty($heroImg) && \Illuminate\Support\Facades\Storage::disk('public')->exists($heroImg))
            ? [$heroImg] : [];

        $this->form->fill([
            'hero_title' => FaqSetting::getValue('hero_title', 'FAQ'),
            'hero_description' => FaqSetting::getValue('hero_description', ''),
            'hero_image' => $heroImageArray,
            'section_title' => FaqSetting::getValue('section_title', 'Pertanyaan Umum BKK'),
            'section_description' => FaqSetting::getValue('section_description', ''),
            'items' => json_decode(FaqSetting::getValue('items', '[]'), true) ?? [],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Section::make('Header Halaman FAQ')
                ->description('Judul dan deskripsi yang tampil di bagian hero halaman FAQ.')
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
                        ->directory('faq')
                        ->image()
                        ->preserveFilenames(),
                ]),

            Section::make('Judul Section Pertanyaan')
                ->description('Judul dan deskripsi di atas daftar pertanyaan.')
                ->schema([
                    TextInput::make('section_title')
                        ->label('Judul Section')
                        ->required(),
                    Textarea::make('section_description')
                        ->label('Deskripsi Section')
                        ->rows(2),
                ]),

            Section::make('Daftar Pertanyaan')
                ->description('Tambah, edit, hapus, atau susun ulang pertanyaan.')
                ->schema([
                    Builder::make('items')
                        ->label('')
                        ->blocks([
                            Block::make('question')
                                ->label('Pertanyaan')
                                ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Pertanyaan')
                                        ->required(),
                                    RichEditor::make('content')
                                        ->label('Jawaban')
                                        ->required()
                                        ->columnSpan('full')
                                        ->extraInputAttributes(['style' => 'min-height: 150px;']),
                                ]),
                        ])
                        ->reorderable()
                        ->deletable()
                        ->collapsible()
                        ->blockNumbers(false)
                        ->addActionLabel('Tambah Pertanyaan Baru'),
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
            ['items', json_encode($state['items'] ?? [])],
        ];

        foreach ($settingsMap as [$key, $value]) {
            FaqSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan FAQ berhasil disimpan!')
            ->success()
            ->send();
    }
}
