<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    {{-- Full-page gradient background --}}
    <div class="min-h-screen py-10 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="p-6 sm:p-8 flex items-start space-x-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-900/10 text-blue-900">
                        {{-- Admin icon --}}
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
                            Overview of Uni Canteen activity. Use the cards below to jump to key management areas.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Stats cards (hook up real data in controller) --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                {{-- Total Canteens --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Canteens
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $canteensCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Active canteens registered in the system.
                        </p>
                    </div>
                    <a href="{{ route('admin.canteens.index') }}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all canteens &rarr;
                    </a>
                </div>

                {{-- Total Orders --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Orders
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $ordersCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            All orders placed through Uni Canteen.
                        </p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all orders &rarr;
                    </a>
                </div>

                {{-- Users --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Users
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $usersCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Students and canteen accounts.
                        </p>
                    </div>
                    <a href="{{ route('admin.users.index') }}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View all users &rarr;
                    </a>
                    {{-- Replace with real admin users route when you have one --}}
                    <!-- <span class="mt-3 inline-flex text-sm text-blue-700">
                        User management coming soon
                    </span> -->
                </div>

                {{-- Today’s Orders (optional placeholder) --}}
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-lg p-5 flex flex-col justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">
                            Today’s Orders
                        </h4>
                        <p class="mt-2 text-2xl font-bold text-blue-900">
                            {{ $todayOrdersCount ?? '—' }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Orders placed since midnight.
                        </p>
                    </div>
                    <a href="{{ route('admin.orders.index', ['date' => 'today'])}}"
                        class="mt-3 inline-flex text-sm font-medium text-blue-700 hover:text-blue-900">
                        View today's orders &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
