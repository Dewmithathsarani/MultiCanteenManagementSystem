<!-- <!DOCTYPE html>
<html>
<head>
    <title>Uni Canteen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-6">Uni Canteen System</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-blue-600 underline">Log in</a>
                <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a>
            </div>
        </div>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uni Canteen</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="min-h-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/canteen-bg.jpg') }}')"
    >
        {{-- Single subtle dark overlay (no blue tint here) --}}
        <div class="min-h-screen bg-black/40 flex flex-col">

            {{-- Top Navigation (blue background) --}}
            <nav class="h-16 flex items-center justify-between px-8 text-white bg-blue-900/80 backdrop-blur-sm">
    {{-- Left: logo + brand --}}
    <div class="flex items-center space-x-2">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <img
                src="{{ asset('images/uni-canteen-logo.jpeg') }}"
                alt="Uni Canteen"
                class="h-8 w-auto"
            >
            <span class="text-xl font-bold">
                Uni Canteen
            </span>
        </a>
    </div>

    {{-- Right: auth links --}}
    <div class="space-x-6">
        <a href="{{ route('login') }}" class="hover:underline">Log in</a>
        <a href="{{ route('register') }}" class="hover:underline">Register</a>
    </div>
</nav>


            {{-- Main Layout --}}
            <div class="flex flex-1">

                {{-- Content --}}
                <main class="flex-1 flex items-center justify-center text-white px-6">
                    {{-- Center card with blue background --}}
                    <div class="text-center max-w-2xl bg-blue-900/85 p-10 rounded-lg backdrop-blur-sm shadow-lg">
                        <h1 class="text-4xl font-bold mb-4">
                            Uni Canteen Management System
                        </h1>
                        <p class="text-lg mb-6">
                            A centralized platform to manage multiple university canteens efficiently
                        </p>

                        <div class="space-x-4">
                            <a
                                href="{{ route('login') }}"
                                class="bg-green-500 px-6 py-3 rounded font-semibold hover:bg-green-600"
                            >
                                Log in
                            </a>

                            <a
                                href="{{ route('register') }}"
                                class="border border-white px-6 py-3 rounded hover:bg-white hover:text-blue-900"
                            >
                                Register
                            </a>
                        </div>
                    </div>
                </main>
            </div>

            {{-- Footer (blue background) --}}
            <footer class="h-12 flex items-center justify-center text-white text-sm bg-blue-900/80 backdrop-blur-sm">
                © {{ date('Y') }} Uni Canteen Management System
            </footer>
        </div>
    </div>

</body>
</html>

