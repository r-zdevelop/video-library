<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return Video::all();
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
