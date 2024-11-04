<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoAnalytics;
use App\Services\VideoRequestService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    protected $videoRequestService;

    public function __construct(VideoRequestService $videoRequestService)
    {
        $this->videoRequestService = $videoRequestService;
    }

    public function index(Request $request)
    {
        $videos = $this->videoRequestService->handleVideoSearchRequest($request);

        return view('videos.index', compact('videos'));
    }

    public function show($id)
    {
        try {
            $video = Video::findOrFail($id);
            $video->increment('views');
            VideoAnalytics::create(['video_id' => $video->id, 'action' => 'view']);
            return view('videos.show', compact('video'));
        } catch (\Throwable $th) {
            // report the error log in production properly
            // throw $th;
            return redirect()->route('videos.index');
        }
    }


    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url|regex:/^https:\/\/www\.youtube\.com\/watch\?v=[\w-]+$/',
        ]);

        // Convert YouTube link to embed format
        $validated['url'] = str_replace("watch?v=", "embed/", $validated['url']);

        Video::create($validated);

        return redirect()->route('videos.index')->with('success', 'Video added successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        return Video::where('title', 'LIKE', "%{$query}%")->get();
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        // Ensure only admins can delete
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('videos.index')->with('error', 'Unauthorized action.');
        }

        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully!');
    }
}
