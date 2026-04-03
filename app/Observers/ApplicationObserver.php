<?php

namespace App\Observers;

use App\Models\Application;
use App\Notifications\ApplicationSubmittedNotification;
use App\Notifications\ApplicationStatusChangedNotification;

class ApplicationObserver
{
    public function created(Application $application): void
    {
        $application->load(['vacancy.company', 'user']);

        if ($application->user) {
            $application->user->notify(new ApplicationSubmittedNotification($application));
        }
    }

    public function updating(Application $application): void
    {
        if ($application->isDirty('status')) {
            $application->load(['vacancy.company', 'user']);

            $oldStatus = $application->getOriginal('status');
            $newStatus = $application->status;

            if ($application->user) {
                $application->user->notify(
                    new ApplicationStatusChangedNotification($application, $oldStatus, $newStatus)
                );
            }

            // Jika status baru adalah "diterima", cek kuota lowongan
            if ($newStatus === 'diterima') {
                $vacancy = $application->vacancy;

                if ($vacancy) {
                    $vacancy->checkAndUpdateQuota();
                }
            }
        }
    }
}
