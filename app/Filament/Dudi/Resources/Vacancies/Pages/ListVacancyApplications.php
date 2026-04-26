<?php

namespace App\Filament\Dudi\Resources\Vacancies\Pages;

use App\Filament\Dudi\Resources\Vacancies\VacancieResource;
use App\Models\Application;
use App\Models\Vacancie;
use App\Notifications\ApplicationStatusChangedNotification;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Collection;

class ListVacancyApplications extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = VacancieResource::class;

    protected string $view = 'filament.dudi.resources.vacancies.pages.list-vacancy-applications';

    public Vacancie $record;

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
                    ->label('Nama Pelamar')
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
                                $oldStatus = $record->status;
                                $record->update(['status' => $data['status']]);

                                // Kirim notifikasi ke user jika status berubah
                                if ($record->user && $oldStatus !== $data['status']) {
                                    $record->user->notify(
                                        new ApplicationStatusChangedNotification($record, $data['status'])
                                    );
                                }
                            });
                        })
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
