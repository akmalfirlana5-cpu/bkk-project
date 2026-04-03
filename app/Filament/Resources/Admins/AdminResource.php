<?php

namespace App\Filament\Resources\Admins;

use App\Filament\Resources\Admins\Pages\CreateAdmin;
use App\Filament\Resources\Admins\Pages\EditAdmin;
use App\Filament\Resources\Admins\Pages\ListAdmins;
use App\Models\AdminPermission;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Kelola Admin';

    protected static ?string $modelLabel = 'Admin';

    protected static ?string $pluralModelLabel = 'Daftar Admin';

    protected static ?int $navigationSort = 0;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Admin';

    protected static ?string $slug = 'admins';

    public static function canAccess(): bool
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->isSuperAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Admin')
                ->schema([
                    TextInput::make('full_name')
                        ->required()
                        ->label('Nama Lengkap'),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->label('Email'),
                    TextInput::make('password')
                        ->password()
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->label('Password')
                        ->helperText('Kosongkan jika tidak ingin mengubah password'),
                ]),

            Section::make('Hak Akses')
                ->description('Pilih halaman yang bisa diakses oleh admin ini.')
                ->schema([
                    Section::make('Umum')
                        ->schema([
                            CheckboxList::make('perm_umum')
                                ->label('')
                                ->options(AdminPermission::PERMISSION_GROUPS['Umum'])
                                ->bulkToggleable()
                                ->columns(2)
                                ->dehydrated(false),
                        ])
                        ->collapsible(),

                    Section::make('Survey Kepuasan')
                        ->schema([
                            CheckboxList::make('perm_survey_kepuasan')
                                ->label('')
                                ->options(AdminPermission::PERMISSION_GROUPS['Survey Kepuasan'])
                                ->bulkToggleable()
                                ->columns(2)
                                ->dehydrated(false),
                        ])
                        ->collapsible(),

                    Section::make('Pengaturan Halaman')
                        ->schema([
                            CheckboxList::make('perm_pengaturan_halaman')
                                ->label('')
                                ->options(AdminPermission::PERMISSION_GROUPS['Pengaturan Halaman'])
                                ->bulkToggleable()
                                ->columns(2)
                                ->dehydrated(false),
                        ])
                        ->collapsible(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('admin_permissions_count')
                    ->counts('adminPermissions')
                    ->label('Jumlah Hak Akses')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->actionsColumnLabel('Aksi')
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('deleteSelected')
                        ->label('Hapus Pilihan')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function (Collection $records) {
                            $records->each->delete();
                        })
                        ->deselectRecordsAfterCompletion(),
                ])->label('Aksi'),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'admin');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}
