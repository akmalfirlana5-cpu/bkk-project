<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NotificationUser extends Component
{
    public $notifications = [];

    public function mount()
    {
        
        $this->checkIsTracerStudyFilled();

        
        $dbNotifs = DB::table('notifications')
            ->where('notifiable_id', auth()->id())
            ->where('notifiable_type', 'App\Models\User')
            ->orderBy('created_at', 'desc')
            ->get();

        
        foreach ($dbNotifs as $notif) {
           
            $payload = json_decode($notif->data, true);

            $this->notifications[] = [
                'id' => $notif->id,
                'type' => 'job-notif',
                'title' => $payload['title'] ?? 'Info Lowongan',
                'message' => $payload['message'] ?? '',
                'link' => isset($payload['vacancy_id']) ? route('lowongan-detail', $payload['vacancy_id']) : '#',
                'created_at' => $notif->created_at,
                'is_read' => !is_null($notif->read_at),
            ];
        }
    }

    public function checkIsTracerStudyFilled() 
    {
        $user = auth()->user();
        if ($user && $user->status === null) {
            $this->notifications[] = [
                'id' => null,
                'type' => 'tracer-study',
                'title' => 'Tracer Study',
                'message' => 'Anda belum mengisi tracer study. Isi sekarang.',
                'link' => route('isi-tracer-study'),
                'created_at' => now(),
                'is_read' => false,
            ];
        }
    }

    public function render()
    {
        return view('livewire.components.notification-user');
    }
}