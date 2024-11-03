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
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>

    <!-- Back to Video List Button -->
    <a href="{{ route('videos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Back to Video List
    </a>
    @can('is-admin')
    <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete this video?');" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-2 ml-2">
            Delete
        </button>
    </form>
    @endcan
</div>
@endsection