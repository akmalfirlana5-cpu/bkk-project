<?php

namespace App\Filament\Dudi\Pages;

use App\Models\Application;
use App\Models\Vacancie;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;

class ApplicationKanbanBoard extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-view-columns';

    protected string $view = 'filament.dudi.pages.application-kanban-board';

    protected static ?string $navigationLabel = 'Pelacakan Pendaftar';
    
    protected static ?string $title = 'Kanban Board Pelamar';

    protected static ?string $slug = 'pelacakan-pendaftar';
    
    protected static ?int $navigationSort = 3;

    // State filter lowongan yang dipilih (null = semua lowongan)
    public ?int $selectedVacancyId = null;

    public function getStatuses(): array
    {
        return Application::STATUSES;
    }

    /**
     * Ambil daftar lowongan milik perusahaan yang sedang login,
     * untuk ditampilkan sebagai pilihan filter.
     */
    public function getVacancies(): Collection
    {
        $dudiUser = auth()->user();
        if (!$dudiUser || !$dudiUser->company_id) {
            return collect();
        }

        return Vacancie::where('company_id', $dudiUser->company_id)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'vacancy_name']);
    }

    public function getApplicationsByStatus(): Collection
    {
        $dudiUser = auth()->user();
        if (!$dudiUser || !$dudiUser->company_id) {
            return collect();
        }

        $query = Application::with(['user', 'vacancy'])
            ->where('id_company', $dudiUser->company_id)
            ->orderBy('updated_at', 'desc');

        // Terapkan filter lowongan jika dipilih
        if ($this->selectedVacancyId) {
            $query->where('id_vacancy', $this->selectedVacancyId);
        }

        return $query->get()->groupBy('status');
    }

    public function filterByVacancy(?int $vacancyId): void
    {
        $this->selectedVacancyId = $vacancyId;
    }

    public function updateApplicationStatus($applicationId, $newStatus)
    {
        $application = Application::find($applicationId);
        
        $dudiUser = auth()->user();
        if (!$application || !$dudiUser || $application->id_company !== $dudiUser->company_id) {
            return;
        }

        $validStatuses = array_keys($this->getStatuses());
        if (!in_array($newStatus, $validStatuses)) {
            return;
        }

        $oldStatus = $application->status;
        if ($oldStatus === $newStatus) {
            return;
        }

        $application->update([
            'status' => $newStatus
        ]);

        Notification::make()
            ->title('Status Diperbarui')
            ->body("Status lamaran {$application->user->full_name} berhasil diubah.")
            ->success()
            ->send();
            
        $companyName = config('app.name');
        if ($dudiUser->company) {
            $companyName = $dudiUser->company->companies_name ?? 'Perusahaan';
        }
        
        \Filament\Notifications\Notification::make()
            ->title("Status Lamaran Anda Diperbarui")
            ->body("Status lamaran Anda untuk posisi {$application->vacancy->vacancy_name} di {$companyName} telah diubah menjadi: " . Application::STATUSES[$newStatus])
            ->icon('heroicon-o-briefcase')
            ->sendToDatabase($application->user);
    }
}
