<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoRequestService
{
    public function handleVideoSearchRequest(Request $request)
    {
        $search = $request->query('search');
        // Query to get videos, optionally filtering by search term
        $videos = Video::scopeSearch($search);
        return $videos;
    }
}
