<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            Canteen Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Welcome card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5">
                    <h3 class="text-base font-semibold text-blue-900">
                        Welcome to your canteen panel
                    </h3>
                    <p class="mt-1 text-sm text-slate-700">
                        Manage your menu, receive orders from students, and update order statuses from here.
                    </p>
                </div>
            </div>

            {{-- Summary cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Pending orders
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $pendingOrdersCount ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Number of orders waiting for your action.
                    </p>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Today’s orders
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $todayOrdersCount ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Orders placed by students today.
                    </p>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Today’s revenue
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        Rs {{ number_format($todayRevenue ?? 0, 2) }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Completed orders only.
                    </p>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Active menu items
                    </p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">
                        {{ $activeMenuItemsCount  ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Total items currently on your menu.
                    </p>
                </div>
            </div>

            {{-- Latest orders + quick actions --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 bg-white/95 border border-blue-100 shadow-sm rounded-xl">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h3 class="text-sm font-semibold text-blue-900">
                            Latest orders
                        </h3>
                        <p class="mt-1 text-xs text-slate-500">
                            Most recent 5 orders from students.
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        @if($latestOrders->isEmpty())
                            <p class="text-sm text-slate-500">
                                No orders yet.
                            </p>
                        @else
                            <ul class="divide-y divide-slate-100 text-sm">
                                @foreach($latestOrders as $order)
                                    <li class="py-3 flex justify-between gap-3">
                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                Order #{{ $order->id }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                {{ $order->user->name ?? 'Student' }} ·
                                                Rs {{ number_format($order->total_amount, 2) }}
                                            </p>
                                            <p class="mt-1 text-xs">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px]
                                                    @if($order->status === 'completed')
                                                        bg-emerald-100 text-emerald-700
                                                    @elseif($order->status === 'cancelled')
                                                        bg-red-100 text-red-700
                                                    @elseif($order->status === 'accepted')
                                                        bg-blue-100 text-blue-700
                                                    @else
                                                        bg-amber-100 text-amber-700
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                                <span class="ml-2 text-slate-400">
                                                    {{ $order->created_at->diffForHumans() }}
                                                </span>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        Quick actions
                    </p>
                    <div class="mt-3 flex flex-col gap-2">
                        <a href="{{ route('canteen.orders.index') }}"
                           class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold
                                  rounded-md text-white
                                  bg-gradient-to-r from-blue-600 to-indigo-600
                                  hover:from-blue-700 hover:to-indigo-700
                                  shadow-sm shadow-blue-500/40">
                            View incoming orders →
                        </a>

                        <a href="{{ route('canteen.menu.index') }}"
                           class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold
                                  rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100">
                            Manage menu items
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
