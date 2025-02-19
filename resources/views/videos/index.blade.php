@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Video Library</h1>

    @can('is-admin')
    <a href="{{ route('videos.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Add New Video
    </a>
    @endcan

    <!-- Search Form -->
    <form method="GET" action="{{ route('videos.index') }}" class="my-6">
        <input type="text" name="search" placeholder="Search videos..."
            class="p-2 border border-gray-300 rounded w-full md:w-1/2" value="{{ request()->query('search') }}">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded ml-2">Search</button>
    </form>



    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- Video List -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
        @forelse ($videos as $video)
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold">{{ $video->title }}</h2>
            <p class="mt-2 text-gray-600">{{ $video->description }}</p>

            <!-- Embed YouTube video -->
            <iframe class="mt-4 w-full h-48" src="{{ $video->url }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <a href="{{ route('videos.show', $video->id) }}" class="text-blue-500 hover:text-blue-700">View Video</a>

            @can('is-admin')
            <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this video?');" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-2 ml-2">
                    Delete
                </button>
            </form>
            @endcan
            <div>
                <p>Search Count: {{ $video->search_count }}</p>
                <p>Views: {{ $video->views }}</p>
            </div>

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