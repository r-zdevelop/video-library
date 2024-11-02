<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;

class VideoList extends Component
{
    public $search = '';

    public function render()
    {
        $videos = Video::where('title', 'like', '%' . $this->search . '%')->get();
        return view('livewire.video-list', compact('videos'));
    }
}
