@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4">{{ $video->title }}</h1>

    <div class="mb-6">
        <p class="text-gray-700">{{ $video->description }}</p>
    </div>

    <!-- Embedded YouTube Video -->
    <div class="mb-8">
        <iframe class="w-full h-64 md:h-96" src="{{ $video->url }}" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <!-- Back to Video List Button -->
    <a href="{{ route('videos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Back to Video List
    </a>
</div>
@endsection
