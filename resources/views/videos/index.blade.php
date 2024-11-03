@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Video Library</h1>
    
    <!-- Search Form -->
    <form method="GET" action="{{ route('videos.index') }}" class="mb-6">
        <input type="text" name="search" placeholder="Search videos..." 
               class="p-2 border border-gray-300 rounded w-full md:w-1/2" 
               value="{{ request()->query('search') }}">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2">Search</button>
    </form>
    
    <!-- Video List -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($videos as $video)
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
                <p class="mt-2 text-gray-600">{{ $video->description }}</p>
                
                <!-- Embed YouTube video -->
                <iframe class="mt-4 w-full h-48" src="{{ $video->url }}" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500">
                No videos found.
            </div>
        @endforelse
    </div>
    
    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $videos->links() }}
    </div>
</div>
@endsection
