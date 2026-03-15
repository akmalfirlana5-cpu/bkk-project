<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Notifications\AdminMessageNotification;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class SendMessage extends Page implements HasForms
{
    use InteractsWithForms;

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
            'selectedUsers' => [],
            'subject' => '',
            'messageBody' => '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->statePath('data')->schema([
            Checkbox::make('sendToAll')
            ->label('Kirim ke semua user')
            ->live(),

            Select::make('selectedUsers')
            ->label('Pilih User')
            ->multiple()
            ->searchable()
            ->preload()
            ->options(function () {
            return User::where('role', 'user')
                ->pluck('full_name', 'id')
                ->toArray();
        })
            ->visible(fn(\Filament\Schemas\Components\Utilities\Get $get) => !$get('sendToAll')),

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

        if (!$sendToAll && empty($selectedUsers)) {
            Notification::make()
                ->title('Pilih minimal satu user atau centang "Kirim ke semua user".')
                ->danger()
                ->send();
            return;
        }

        $query = User::where('role', 'user');

        if (!$sendToAll) {
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
