<?php

namespace App\Filament\Resources\Vacancies\Pages;

use App\Filament\Resources\Vacancies\VacancieResource;
use App\Models\Application;
use App\Models\vacancie;
use App\Notifications\AdminMessageNotification;
use App\Notifications\ApplicationStatusChangedNotification;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\RichEditor;

class ListVacancyApplications extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = VacancieResource::class;

    protected string $view = 'filament.resources.vacancies.pages.list-vacancy-applications';

    public vacancie $record;

    public function getTitle(): string|Htmlable
    {
        $vacancyName = $this->record->vacancy_name ?? 'Lowongan';
        $accepted = $this->record->acceptedApplicationsCount();
        $quota = $this->record->vacancy_number;

        $quotaInfo = $quota ? " (Kuota: {$accepted}/{$quota})" : '';

        return "Lamaran: {$vacancyName}{$quotaInfo}";
    }

    public function getBreadcrumbs(): array
    {
        return [
            VacancieResource::getUrl() => 'Daftar Lowongan',
            '#' => $this->record->vacancy_name ?? 'Lowongan',
            '' => 'Lamaran',
        ];
    }

    protected function makeTable(): Table
    {
        return Table::make($this)
            ->query(
            Application::query()
            ->where('id_vacancy', $this->record->getKey())
            ->with(['user', 'vacancy.company'])
        )
            ->columns([
            Tables\Columns\TextColumn::make('user.full_name')
            ->label('Nama')
            ->searchable(),

            Tables\Columns\SelectColumn::make('status')
            ->options(Application::STATUSES)
            ->label('Status'),

            Tables\Columns\TextColumn::make('created_at')
            ->label('Tanggal Daftar')
            ->date()
            ->sortable(),
        ])
            ->recordUrl(null)
            ->filters([
            Tables\Filters\SelectFilter::make('status')
            ->label('Status')
            ->options(Application::STATUSES),
        ])
            ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make()->label('Hapus Pilihan'),

                BulkAction::make('updateStatus')
                ->label('Ubah Status')
                ->icon('heroicon-o-arrow-path')
                ->form([
                    Select::make('status')
                    ->label('Status Baru')
                    ->options(Application::STATUSES)
                    ->required(),
                ])
                ->action(function (Collection $records, array $data): void {
            $records->each(function ($record) use ($data) {
                    $record->update(['status' => $data['status']]);
                }
                    );
            })
                ->deselectRecordsAfterCompletion(),

                BulkAction::make('sendMessage')
                ->label('Kirim Pesan')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('info')
                ->form([
                    TextInput::make('subject')
                    ->label('Judul Pesan')
                    ->required()
                    ->maxLength(255),
                    RichEditor::make('message')
                    ->label('Isi Pesan')
                    ->required()
                    ->columnSpanFull()
                    ->extraInputAttributes(['style' => 'min-height: 200px;']),
                ])
                ->action(function (Collection $records, array $data): void {
            $notifiedUserIds = [];
            $records->each(function ($record) use ($data, &$notifiedUserIds) {
                    $record->load('user');
                    if ($record->user && !in_array($record->user->id, $notifiedUserIds)) {
                        $record->user->notify(
                                new AdminMessageNotification($data['subject'], $data['message'])
                            );
                        $notifiedUserIds[] = $record->user->id;
                    }
                }
                    );
            })
                ->requiresConfirmation()
                ->modalHeading('Kirim Pesan ke Pelamar')
                ->modalDescription('Pesan akan dikirim ke semua pelamar yang dipilih.')
                ->deselectRecordsAfterCompletion(),

                BulkAction::make('export')
                ->label('Export Terpilih')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function (Collection $records) {
            $firstApp = $records->first();
            if (!$firstApp || !$firstApp->vacancy) {
                return;
            }

            $service = new \App\Services\ApplicationExportService();
            $zipPath = $service->exportToZip(
                    $records,
                    $firstApp->vacancy->vacancy_name ?? 'Lowongan',
                    $firstApp->vacancy->company->companies_name ?? 'Perusahaan'
                );

            return response()->download($zipPath)->deleteFileAfterSend(true);
        })
                ->requiresConfirmation()
                ->modalHeading('Export Lamaran')
                ->modalDescription('Download data kandidat terpilih beserta CV dan Sertifikat sebagai ZIP?')
                ->deselectRecordsAfterCompletion(),
            ])->label('Aksi'),
        ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
            EmbeddedTable::make(),
        ]);
    }
}
