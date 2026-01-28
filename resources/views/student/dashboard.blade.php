<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Quick stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-medium text-slate-500 uppercase">
                        Favourite canteens
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ auth()->user()->favouriteCanteens()->count() }}
                    </p>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-medium text-slate-500 uppercase">
                        Orders placed
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ auth()->user()->orders()->count() }}
                    </p>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-medium text-slate-500 uppercase">
                        Pending orders
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ auth()->user()->orders()->where('status', 'pending')->count() }}
                    </p>
                </div>
            </div>

            {{-- Shortcuts --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('student.canteens.index') }}"
                   class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-5 flex items-center justify-between hover:bg-blue-50 transition">
                    <div>
                        <h3 class="text-sm font-semibold text-blue-900">
                            Browse canteens
                        </h3>
                        <p class="mt-1 text-xs text-slate-600">
                            See all canteens and their menus.
                        </p>
                    </div>
                    <span class="text-blue-500 text-lg">&rarr;</span>
                </a>

                <a href="{{ route('student.orders.index') }}"
                   class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-5 flex items-center justify-between hover:bg-blue-50 transition">
                    <div>
                        <h3 class="text-sm font-semibold text-blue-900">
                            Your orders
                        </h3>
                        <p class="mt-1 text-xs text-slate-600">
                            Track your current and past orders.
                        </p>
                    </div>
                    <span class="text-blue-500 text-lg">&rarr;</span>
                </a>
            </div>

            {{-- Recent notifications (optional) --}}
            <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-5">
                <h3 class="text-sm font-semibold text-slate-800 tracking-wide uppercase">
                    Notifications
                </h3>
                <p class="mt-2 text-xs text-slate-600">
                    Check your notifications page for order status updates and canteen announcements.
                </p>
                <a href="{{ route('student.notifications.index') }}"
                   class="mt-3 inline-flex items-center px-3 py-1.5 text-xs font-semibold
                          rounded-md text-white
                          bg-gradient-to-r from-blue-600 to-indigo-600
                          hover:from-blue-700 hover:to-indigo-700
                          shadow-sm shadow-blue-500/40">
                    Go to notifications
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
