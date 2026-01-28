<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
                        {{-- student icon --}}
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 14.25L4.5 10.5 12 6.75 19.5 10.5 12 14.25z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.5 12.75L12 16.5l7.5-3.75M6.75 17.25L12 19.5l5.25-2.25" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            Welcome, {{ Auth::user()->name }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Browse canteens, mark your favourites, and keep track of your recent orders.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Quick stats + shortcuts --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {{-- Canteens --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Canteens
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $canteensCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Canteens available for ordering.
                        </p>
                    </div>
                    <a href="{{ route('student.canteens.index') }}"
                       class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        Browse canteens &rarr;
                    </a>
                </div>

                {{-- Favourite canteens --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Favourite canteens
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $favoritesCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Canteens you’ve marked as favourites.
                        </p>
                    </div>
                    <a href="{{ route('student.canteens.favorites') }}"
                       class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View favourites &rarr;
                    </a>
                </div>

                {{-- Your orders --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            My orders
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $ordersCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Total orders you’ve placed.
                        </p>
                    </div>
                    <a href="{{ route('student.orders.index') }}"
                       class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all orders &rarr;
                    </a>
                </div>
            </div>

            {{-- Notifications CTA --}}
            <div class="bg-blue-900 rounded-2xl px-5 py-4 flex items-center justify-between shadow-md shadow-blue-900/40">
                <div>
                    <p class="text-sm font-semibold text-white">
                        Stay updated
                    </p>
                    <p class="text-xs text-blue-100">
                        Check your latest order updates and notifications.
                    </p>
                </div>
                <a href="{{ route('student.notifications.index') }}"
                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md
                          bg-white/10 text-blue-50 border border-blue-200/50
                          hover:bg-white/20 transition">
                    🔔 View notifications
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
