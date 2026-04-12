<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Notifications\AdminMessageNotification;
use BackedEnum;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SendMessage extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('page.send_message');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Kirim Pesan';

    protected static ?string $title = 'Kirim Pesan ke Alumni';

    protected static ?int $navigationSort = 8;

    protected string $view = 'filament.pages.send-message';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'sendToAll' => false,
            'major' => null,
            'graduation_year' => null,
            'selectedUsers' => [],
            'subject' => '',
            'messageBody' => '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Toggle::make('sendToAll')
                ->label('Kirim ke semua user')
                ->live()
                ->afterStateUpdated(function (\Filament\Schemas\Components\Utilities\Set $set) {
                    $set('selectedUsers', []);
                    $set('major', null);
                    $set('graduation_year', null);
                }),

            Fieldset::make('Pilih Penerima')
                ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => ! $get('sendToAll'))
                ->schema([
                    Grid::make(2)->schema([
                        Select::make('major')
                            ->label('Filter Jurusan')
                            ->placeholder('Semua Jurusan')
                            ->options(User::MAJORS)
                            ->live()
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set) => $set('selectedUsers', [])),

                        Select::make('graduation_year')
                            ->label('Filter Tahun Angkatan')
                            ->placeholder('Semua Angkatan')
                            ->options(function () {
                                return User::where('role', 'user')
                                    ->whereNotNull('graduation_year')
                                    ->distinct()
                                    ->orderBy('graduation_year', 'desc')
                                    ->pluck('graduation_year', 'graduation_year')
                                    ->toArray();
                            })
                            ->live()
                            ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set) => $set('selectedUsers', [])),
                    ]),

                    Select::make('selectedUsers')
                        ->label('Pilih User')
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->hintActions([
                            \Filament\Actions\Action::make('selectAll')
                                ->label('Pilih Semua')
                                ->action(function (\Filament\Schemas\Components\Utilities\Set $set, \Filament\Schemas\Components\Utilities\Get $get) {
                                    $query = User::where('role', 'user');

                                    if ($get('major')) {
                                        $query->where('major', $get('major'));
                                    }
                                    if ($get('graduation_year')) {
                                        $query->where('graduation_year', $get('graduation_year'));
                                    }

                                    $set('selectedUsers', $query->pluck('id')->toArray());
                                }),
                            \Filament\Actions\Action::make('deselectAll')
                                ->label('Hapus Pilihan')
                                ->color('danger')
                                ->action(fn (\Filament\Schemas\Components\Utilities\Set $set) => $set('selectedUsers', [])),
                        ])
                        ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                            $query = User::where('role', 'user');

                            if ($get('major')) {
                                $query->where('major', $get('major'));
                            }
                            if ($get('graduation_year')) {
                                $query->where('graduation_year', $get('graduation_year'));
                            }

                            return $query->orderBy('full_name')
                                ->get()
                                ->mapWithKeys(function ($user) {
                                    $label = $user->full_name;
                                    if ($user->major) {
                                        $label .= ' — ' . $user->major;
                                    }
                                    if ($user->graduation_year) {
                                        $label .= ' (' . $user->graduation_year . ')';
                                    }
                                    return [$user->id => $label];
                                })
                                ->toArray();
                        })
                        ->columnSpanFull(),
                ]),

            TextInput::make('subject')
                ->label('Judul Pesan')
                ->required()
                ->maxLength(255),

            \Filament\Forms\Components\RichEditor::make('messageBody')
                ->label('Isi Pesan')
                ->required()
                ->columnSpanFull()
                ->extraInputAttributes(['style' => 'min-height: 200px;']),
        ]);
    }

    public function send(): void
    {
        $state = $this->form->getState();

        $sendToAll = $state['sendToAll'] ?? false;
        $selectedUsers = $state['selectedUsers'] ?? [];
        $subject = $state['subject'] ?? '';
        $messageBody = $state['messageBody'] ?? '';

        if (! $sendToAll && empty($selectedUsers)) {
            Notification::make()
                ->title('Pilih minimal satu user atau centang "Kirim ke semua user".')
                ->danger()
                ->send();

            return;
        }

        $query = User::where('role', 'user');

        if (! $sendToAll) {
            $query->whereIn('id', $selectedUsers);
        }

        $users = $query->get();
        $count = 0;

        foreach ($users as $user) {
            $user->notify(new AdminMessageNotification($subject, $messageBody));
            $count++;
        }

        $this->form->fill([
            'sendToAll' => false,
            'major' => null,
            'graduation_year' => null,
            'selectedUsers' => [],
            'subject' => '',
            'messageBody' => '',
        ]);

        Notification::make()
            ->title("Pesan berhasil dikirim ke {$count} user.")
            ->success()
            ->send();
    }
}
