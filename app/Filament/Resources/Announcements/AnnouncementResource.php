<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Resources\Announcements\Pages\ListAnnouncements;
use App\Filament\Resources\Announcements\Schemas\AnnouncementForm;
use App\Filament\Resources\Announcements\Tables\AnnouncementsTable;
use App\Models\Announcement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Enums\ActionsPosition;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationLabel = 'Pengumuman';

    protected static ?string $modelLabel = 'Pengumuman';

    protected static ?int $navigationSort = 6;

    protected static ?string $pluralModelLabel = 'Daftar Pengumuman';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBellAlert;

    protected static ?string $recordTitleAttribute = 'announcement';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('headline')
            ->required()
            ->label('judul pengumuman'),
            FileUpload::make('image')
            ->required()
            ->label('gambar pengumuman')
            ->disk('public')
            ->directory('announcements')
            ->image(),
            RichEditor::make('content')
            ->required()
            ->json()
            ->label('isi pengumuman')
            ->columnSpan('full')
            ->extraInputAttributes(['style' => 'min-height: 200px;']),
            DatePicker::make('active_until')
            ->required()
            ->label('aktif hingga'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('headline')->label('Judul')->searchable(),
            Tables\Columns\ImageColumn::make('image')->label('Gambar')->disk('public'),
            Tables\Columns\TextColumn::make('active_until')->label('Aktif Sampai')->date()->sortable(),
        ])
        ->actions([
            EditAction::make()
                ->label('edit'),
            DeleteAction::make()
                ->label('Hapus'),
        ])
        ->actionsColumnLabel('Aksi')
        ->actionsAlignment('start');
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
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}

class Post extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

}