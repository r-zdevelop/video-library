<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Video Library</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-gray-100">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start">
                <h1 class="text-5xl font-bold text-gray-400">Welcome to the Video Library</h1>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-4.553a1 1 0 10-1.414-1.414L13 8.586V7a1 1 0 10-2 0v3a1 1 0 001 1h3zM6 9v6a1 1 0 001 1h10a1 1 0 001-1V9a1 1 0 10-2 0v6H8V9a1 1 0 00-2 0z"></path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ route('videos.index') }}" class="underline text-gray-900 dark:text-white">Browse Videos</a></div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Discover our curated video library and find videos that suit your interests.
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                        @if (Route::has('login'))
                        <div class="flex items-center">
                            @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-400 text-lg leading-7 font-semibold">Dashboard</a>
                            @else
                            <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-400 text-lg leading-7 font-semibold">Log in</a>
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 dark:text-gray-400 text-lg leading-7 font-semibold">Register</a>
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>