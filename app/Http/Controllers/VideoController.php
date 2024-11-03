<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Query to get videos, optionally filtering by search term
        $videos = Video::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->paginate(6); // Adjust the number per page as needed

        return view('videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return $video;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|url'
        ]);
        return Video::create($request->all());
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        return Video::where('title', 'LIKE', "%{$query}%")->get();
    }
}
