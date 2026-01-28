<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    {{-- Gradient page background --}}
    <div class="min-h-screen py-10 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4.5 19.5a7.5 7.5 0 0115 0v.75H4.5v-.75z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            Welcome, Admin
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Manage canteens, monitor orders, and keep the Uni Canteen system running smoothly.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Example stats cards (optional) --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                        Canteens
                    </h4>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $canteensCount ?? '—' }}
                    </p>
                    <a href="{{ route('admin.canteens.index') }}"
                       class="mt-3 inline-flex text-sm text-blue-700 hover:text-blue-900">
                        View all canteens &rarr;
                    </a>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                        Orders
                    </h4>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $ordersCount ?? '—' }}
                    </p>
                    <a href="{{ route('admin.orders.index') }}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all orders &rarr;
                    </a>
                    <!-- <span class="mt-3 inline-flex text-sm text-blue-700">
                        Number of orders made through the system
                    </span> -->

                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5">
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                        Users
                    </h4>
                    
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $usersCount ?? '—' }}
                    </p>
                    <a href="{{ route('admin.users.index') }}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all users &rarr;
                    </a>
                    <!-- <span class="mt-3 inline-flex text-sm text-blue-700">
                        Student & canteen accounts
                    </span> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
