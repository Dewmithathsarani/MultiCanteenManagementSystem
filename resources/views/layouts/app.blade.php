<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Uni Canteen') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">
        {{-- Top navigation --}}
        @include('layouts.navigation')

        {{-- Page heading --}}
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- Page content --}}
        <main class="flex-1">
            {{-- flash message (optional) --}}
            {{-- @if(session('success'))
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="mb-4 px-4 py-2 bg-emerald-100 text-emerald-800 text-sm rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif --}}

            {{ $slot }}
        </main>

        {{-- Footer on all pages --}}
        @include('layouts.footer')
    </div>
</body>

</html>
