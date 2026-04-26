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
            $type = $payload['type'] ?? 'job-notif';

            // Retroactive check for older admin messages that don't have vacancy_id or application_id
            if ($type === 'job-notif' && !isset($payload['vacancy_id']) && !isset($payload['application_id'])) {
                $type = 'admin-message';
            }

            $this->notifications[] = [
                'id' => $notif->id,
                'type' => $type,
                'title' => $payload['title'] ?? 'Info Lowongan',
                'message' => $payload['message'] ?? '',
                'link' => $type === 'admin-message' ? '#' : (isset($payload['application_id']) ? route('riwayat-lamaran') : (isset($payload['vacancy_id']) ? route('lowongan-detail', $payload['vacancy_id']) : '#')),
                'created_at' => $notif->created_at,
                'is_read' => !is_null($notif->read_at),
            ];
        }
    }

    public function checkIsTracerStudyFilled() 
    {
        $user = auth()->user();
        if ($user && $user->status === null && !session('tracer-study-notif-shown')) {
            $this->notifications[] = [
                'id' => 'tracer-study',
                'type' => 'tracer-study',
                'title' => 'Tracer Study',
                'message' => 'Anda belum mengisi tracer study. Isi sekarang.',
                'link' => route('isi-tracer-study'),
                'created_at' => now(),
                'is_read' => false,
            ];
        }
    }

    public function markAsRead($id, $link)
    {
        if ($id === 'tracer-study') {
            session(['tracer-study-notif-shown' => true]);
        } else {
            DB::table('notifications')
                ->where('id', $id)
                ->update(['read_at' => now()]);
        }

        if ($link !== '#') {
            return redirect($link);
        }
    }
    
    public function render()
    {
        return view('livewire.components.notification-user');
    }
}