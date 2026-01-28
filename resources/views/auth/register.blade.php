<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-blue-900">
            Create a Uni Canteen Account
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Register as a student or canteen to start using the system.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700" />
            <x-text-input
                id="name"
                class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 rounded-md"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" class="text-sm font-medium text-gray-700" />
            <select
                id="role"
                name="role"
                class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-900 focus:ring-blue-900 text-sm"
                required
            >
                <option value="">-- Select Role --</option>
                <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                <option value="canteen" {{ old('role') === 'canteen' ? 'selected' : '' }}>Canteen</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
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
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full border-gray-300 focus:border-blue-900 focus:ring-blue-900 rounded-md"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a
                class="text-sm text-gray-600 hover:text-blue-900"
                href="{{ route('login') }}"
            >
                {{ __('Already registered? Log in') }}
            </a>

            <x-primary-button class="ms-4 bg-blue-900 hover:bg-blue-800">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
