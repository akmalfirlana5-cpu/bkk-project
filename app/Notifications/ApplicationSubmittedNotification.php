<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationSubmittedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Application $application,
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
        return [
            'title' => 'Lamaran Terkirim',
            'message' => 'Lamaran Anda untuk posisi ' . $this->application->vacancy->vacancy_name
                . ' di ' . $this->application->vacancy->company->companies_name . ' telah berhasil dikirim.',
            'vacancy_id' => $this->application->id_vacancy,
            'application_id' => $this->application->id,
        ];
    }
}
