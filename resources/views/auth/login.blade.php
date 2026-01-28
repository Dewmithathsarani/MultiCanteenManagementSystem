<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4.5 19.5a7.5 7.5 0 0115 0v.75H4.5v-.75z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-blue-900">
            Uni Canteen Login
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Sign in to your Uni Canteen account to manage your orders and canteens.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
            <x-text-input
                id="email"
                class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 rounded-md"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
            <x-text-input
                id="password"
                class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 rounded-md"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me + Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-900"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-sm text-blue-900 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900"
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit + link to register -->
        <div class="flex items-center justify-between pt-2">
            <a
                href="{{ route('register') }}"
                class="text-sm text-gray-600 hover:text-blue-900"
            >
                {{ __("Don't have an account? Register") }}
            </a>

            <x-primary-button class="ms-3 bg-blue-900 hover:bg-blue-800">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
