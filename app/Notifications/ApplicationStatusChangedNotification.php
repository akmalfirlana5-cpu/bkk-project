<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationStatusChangedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Application $application,
        public string $oldStatus,
        public string $newStatus,
    ) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $statusLabels = Application::STATUSES;

        return [
            'title' => 'Status Lamaran Telah Diperbarui',
            'message' => 'Status lamaran Anda untuk posisi ' . $this->application->vacancy->vacancy_name
                . ' di ' . $this->application->vacancy->company->companies_name
                . ' berubah dari "' . ($statusLabels[$this->oldStatus] ?? $this->oldStatus)
                . '" menjadi "' . ($statusLabels[$this->newStatus] ?? $this->newStatus) . '".',
            'vacancy_id' => $this->application->id_vacancy,
            'application_id' => $this->application->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }
}
