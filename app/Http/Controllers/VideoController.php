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

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
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
