<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;

use function Laravel\Prompts\select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Daftar Pengguna';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'user';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            TextInput::make('nisn')->required()->unique(ignoreRecord: true)->label('NISN'),
            TextInput::make('full_name')->required()->label('Nama lengkap'),
            FileUpload::make('photo')->label('Foto Profil')->disk('public')->directory('user-photos'),
            TextInput::make('email')->email()->unique(ignoreRecord: true)->label('Email'),
            Select::make('major')->options(User::MAJORS)->required()->label('Jurusan'),
            Select::make('role')->options(User::ROLES)->label('Role'),
            TextArea::make('address')->label('Alamat'),    
            TextInput::make('birth_place')->label('Tempat Lahir'),
            TextInput::make('no_hp')->tel()->label('Nomor HP'),
            FileUpload::make('CVuser')->label('CV')->disk('public')->directory('cv-users'),
            FileUpload::make('certificate')->label('Sertifikat')->disk('public')->directory('certificates'),
            Select::make('status')->options(User::STATUSES)->label('Status'),
            DatePicker::make('graduation_year')->label('Tahun Kelulusan'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('photo')->label('Foto Profil')->disk('public')->rounded(),
            Tables\Columns\TextColumn::make('nisn')->label('NISN')->searchable(),
            Tables\Columns\TextColumn::make('full_name')->label('Nama Lengkap')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('major')->label('Jurusan')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])->actionsColumnLabel('Aksi');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'user');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    
}

