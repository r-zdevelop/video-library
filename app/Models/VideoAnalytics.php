<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoAnalytics extends Model
{
    public function show(Video $video)
    {
        $video->increment('views');
        VideoAnalytics::create(['video_id' => $video->id, 'action' => 'view']);
        return $video;
    }
}
