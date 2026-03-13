<?php

namespace App\Livewire\Information;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Announcement as AnnouncementModel;
use App\Models\InfoSetting;

#[Title('Pengumuman - BKK SMKN 4 MALANG')]
#[Layout('layouts.app')]
class Announcement extends Component
{
    use WithPagination;
    #[Url('s')]
    public $filterSearch = null;
    public $announcementContent;

    public function updatedFilterSearch()
    {
        $this->resetPage();
    }

    public function mount() {
        // Ambil data announcement settings
        $this->announcementContent = InfoSetting::all()
            ->groupBy('section')
            ->map(function ($items) {
               return $items->pluck('value', 'key');
            })
            ->toArray();
    }

    public function render()
    {
        $announcements = AnnouncementModel::where('active_until', '>=', now())
        ->where(function ($query) {
            $query->where('active_until', '>=', now())
                    ->orWhereNull('active_until');
        })
        ->when($this->filterSearch, function ($query) {
            $query->where('headline', 'like', '%' . $this->filterSearch . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(2);
        
        return view('livewire.information.announcement', [
            'announcements' => $announcements,
        ]);
    }
}
