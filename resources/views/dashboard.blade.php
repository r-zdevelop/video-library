@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <!-- Video List -->
    <h1 class="text-3xl font-bold mb-6">Video Library</h1>
    <a href="{{ route('videos.index') }}" class="bg-blue-500 text-white p-2 rounded mb-6">Videos</a>
</div>
@endsection
