<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoAnalytics extends Model
{
    protected $fillable = [
        'video_id',
        'action',
    ];
}
