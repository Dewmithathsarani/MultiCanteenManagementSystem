<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filters card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5">
                    <form method="GET"
                          action="{{ route('student.orders.index') }}"
                          class="flex flex-wrap gap-4 items-end">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700">
                                Status
                            </label>
                            <select name="status"
                                    class="mt-1 rounded-md border border-slate-300 bg-white/80
                                           px-2 py-1 text-xs text-slate-900
                                           focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                                <option value="">All</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="preparing" {{ request('status') === 'preparing' ? 'selected' : '' }}>Preparing</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700">
                                Date
                            </label>
                            <select name="date"
                                    class="mt-1 rounded-md border border-slate-300 bg-white/80
                                           px-2 py-1 text-xs text-slate-900
                                           focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                                <option value="">Any time</option>
                                <option value="today" {{ request('date') === 'today' ? 'selected' : '' }}>Today</option>
                                <option value="last7" {{ request('date') === 'last7' ? 'selected' : '' }}>Last 7 days</option>
                                <option value="month" {{ request('date') === 'month' ? 'selected' : '' }}>This month</option>
                            </select>
                        </div>

                        <div class="mt-2 sm:mt-6">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold
                                           rounded-md text-white
                                           bg-gradient-to-r from-blue-600 to-indigo-600
                                           hover:from-blue-700 hover:to-indigo-700
                                           shadow-md shadow-blue-500/40
                                           focus:outline-none focus:ring-2 focus:ring-offset-1
                                           focus:ring-blue-500">
                                Apply filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Orders table --}}
            <div class="bg-white/95 border border-blue-100 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-slate-50">
                        <tr class="text-xs font-semibold text-slate-600 uppercase tracking-wide">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Canteen</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Items</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/90">
                        @forelse ($orders as $order)
                            <tr class="border-t border-slate-100 align-top hover:bg-slate-50/60">
                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->id }}
                                </td>
                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->canteen->name }}
                                </td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($order->status === 'completed')
                                            bg-emerald-100 text-emerald-700
                                        @elseif($order->status === 'cancelled')
                                            bg-red-100 text-red-700
                                        @elseif($order->status === 'preparing')
                                            bg-amber-100 text-amber-700
                                        @else
                                            bg-slate-100 text-slate-700
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-slate-900 font-semibold">
                                    Rs {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-4 py-2 text-slate-700">
                                    @foreach ($order->items as $item)
                                        <div class="text-xs">
                                            {{ $item->menu->item_name }} × {{ $item->quantity }}
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-xs text-slate-500">
                                    {{ $order->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($order->status === 'pending')
                                        <form method="POST"
                                              action="{{ route('student.orders.cancel', $order) }}"
                                              onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 text-xs font-semibold
                                                           rounded-md text-white bg-red-600 hover:bg-red-700">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            N/A
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-4 py-4 text-center text-sm text-slate-500">
                                    No orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
