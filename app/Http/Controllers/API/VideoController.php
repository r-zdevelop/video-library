<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
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

        return response()->json($videos);
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video = Video::create($validated);
        return response()->json($video, 201);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'url' => 'sometimes|url',
        ]);

        $video->update($validated);
        return response()->json($video);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json(['message' => 'Video deleted successfully']);
    }
}
