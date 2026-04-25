<?php

namespace App\Filament\Resources\Announcements;

use App\Filament\Resources\Announcements\Pages\CreateAnnouncement;
use App\Filament\Resources\Announcements\Pages\EditAnnouncement;
use App\Filament\Resources\Announcements\Pages\ListAnnouncements;
use App\Models\Announcement;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    public static function canAccess(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $user->isSuperAdmin() || $user->hasAdminPermission('resource.announcements');
    }

    protected static ?string $navigationLabel = 'Pengumuman';

    protected static ?string $modelLabel = 'Pengumuman';

    protected static ?int $navigationSort = 6;

    protected static ?string $pluralModelLabel = 'Daftar Pengumuman';

    protected static string|\UnitEnum|null $navigationGroup = 'Informasi & Pengumuman';

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
            Tables\Columns\ImageColumn::make('image')->label('Gambar')->disk('public'),
            Tables\Columns\TextColumn::make('headline')->label('Judul')->searchable(),
            Tables\Columns\TextColumn::make('active_until')->label('Aktif Sampai')->date()->sortable()
                ->color(fn ($record) => $record->active_until && \Carbon\Carbon::parse($record->active_until)->isPast() ? 'danger' : null),
        ])
            ->modifyQueryUsing(fn ($query) => $query->orderByRaw('CASE WHEN active_until < NOW() THEN 1 ELSE 0 END DESC, active_until DESC'))
            ->actions([
                EditAction::make()
                    ->label('edit'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->actionsColumnLabel('Aksi')
            ->actionsAlignment('start')
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
                    BulkAction::make('extendActiveUntil')
                        ->label('Sesuaikan Tanggal Aktif')
                        ->icon('heroicon-o-calendar')
                        ->color('primary')
                        ->form([
                            DatePicker::make('new_active_until')
                                ->label('Atur Tanggal Aktif Baru')
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $newDate = $data['new_active_until'];
                            $records->each(function ($record) use ($newDate) {
                                $record->update(['active_until' => $newDate]);
                            });
                        })
                        ->deselectRecordsAfterCompletion(),

                ])->label('Aksi'),
            ]);
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
