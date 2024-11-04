<?php

namespace App\Http\Controllers\API;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function trackView($id)
    {
        $video = Video::findOrFail($id);
        $video->increment('views');

        return response()->json(['message' => 'View count updated']);
    }

    public function trackSearch(Request $request)
    {
        $query = $request->input('query');
        $videos = Video::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        foreach ($videos as $video) {
            $video->increment('search_count');
        }

        return response()->json(['message' => 'Search counts updated']);
    }
}
