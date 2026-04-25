<?php

namespace App\Filament\Dudi\Pages;

use Filament\Pages\Page;

class CompanyProfile extends Page implements \Filament\Forms\Contracts\HasForms
{
    use \Filament\Forms\Concerns\InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Profil Perusahaan';
    protected static ?string $title = 'Profil Perusahaan';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.dudi.pages.company-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $company = auth()->user()->company;
        if ($company) {
            $this->form->fill($company->toArray());
        }
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->schema([
                \Filament\Schemas\Components\Section::make('Informasi Dasar')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('companies_name')
                            ->label('Nama Perusahaan')
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('field')
                            ->label('Bidang Usaha'),
                        \Filament\Forms\Components\TextInput::make('employee')
                            ->label('Jumlah Pekerja'),
                        \Filament\Forms\Components\TextInput::make('website')
                            ->label('Website'),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Kontak & Alamat')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('email')
                            ->label('Email Perusahaan')
                            ->email(),
                        \Filament\Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon'),
                        \Filament\Forms\Components\TextInput::make('short_address')
                            ->label('Kota/Kabupaten')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Media & Deskripsi')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('companies_logo')
                            ->label('Logo Perusahaan')
                            ->image()
                            ->directory('company-logos')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\RichEditor::make('companies_profile')
                            ->label('Profil Singkat')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        auth()->user()->company->update($data);

        \Filament\Notifications\Notification::make()
            ->title('Berhasil menyimpan perubahan')
            ->success()
            ->send();
    }
}
