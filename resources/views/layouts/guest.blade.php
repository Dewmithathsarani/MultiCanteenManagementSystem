<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Uni Canteen') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        {{-- Fullscreen background image --}}
        <div
            class="min-h-screen bg-cover bg-center"
            style="background-image: url('{{ asset('images/userlogin.jpg') }}')"
        >
            {{-- Dark overlay --}}
            <div class="min-h-screen bg-black/50 flex flex-col sm:justify-center items-center px-4 py-6">
                
                {{-- Logo + title --}}
                <div class="mb-4 text-center">
                    <a href="/">
                        <img
                            src="{{ asset('images/uni-canteen-logo.jpeg') }}"
                            alt="Uni Canteen"
                            class="mx-auto h-16 w-auto mb-2"
                        >
                    </a>
                    <h1 class="text-lg font-semibold text-white">
                        Uni Canteen Management System
                    </h1>
                </div>

                {{-- Auth card with Breeze slot --}}
                <div class="w-full sm:max-w-md mt-4 px-6 py-6 bg-white/95 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
