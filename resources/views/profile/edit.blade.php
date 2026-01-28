<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- Full-page gradient background --}}
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Title + description --}}
            <div class="bg-white/90 border border-blue-100 shadow-sm rounded-2xl px-6 py-5">
                <h3 class="text-lg font-semibold text-blue-900">
                    Account settings
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    Update your name, email address, and password associated with your Uni Canteen account.
                </p>
            </div>

            {{-- Update profile information --}}
            <div class="bg-white/95 backdrop-blur border border-blue-100 shadow-sm rounded-2xl">
                <div class="px-6 py-4 border-b border-blue-50 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 19.5a7.5 7.5 0 0115 0v.75H4.5v-.75z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-blue-900">
                            Profile information
                        </h4>
                        <p class="text-xs text-gray-500">
                            Your basic information and email address.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update password --}}
            <div class="bg-white/95 backdrop-blur border border-blue-100 shadow-sm rounded-2xl">
                <div class="px-6 py-4 border-b border-blue-50 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0V10.5M6.75 10.5h10.5
                                     a1.5 1.5 0 011.5 1.5v6.75a1.5 1.5 0 01-1.5 1.5H6.75
                                     a1.5 1.5 0 01-1.5-1.5V12a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-blue-900">
                            Update password
                        </h4>
                        <p class="text-xs text-gray-500">
                            Choose a strong, unique password for your account.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete account --}}
            <div class="bg-white/95 backdrop-blur border border-red-100 shadow-sm rounded-2xl">
                <div class="px-6 py-4 border-b border-red-50 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M4.5 6.75h15
                                     M9.75 6.75L9 5.25A1.5 1.5 0 0110.5 3.75h3
                                     A1.5 1.5 0 0115 5.25l-.75 1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6.75 6.75l.75 10.5A1.5 1.5 0 009 18.75h6
                                     a1.5 1.5 0 001.5-1.5l.75-10.5" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-red-700">
                            Delete account
                        </h4>
                        <p class="text-xs text-red-500">
                            Permanently remove your account and all associated data.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-5">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
