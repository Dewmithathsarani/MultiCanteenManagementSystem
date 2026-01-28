<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Messages --}}
            @if(isset($message))
                <p class="px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
                    {{ $message }}
                </p>
            @endif

            @if (session('success'))
                <div class="px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filter card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-4">
                    <form method="GET"
                          action="{{ route('canteen.orders.index') }}"
                          class="flex flex-wrap items-end gap-3">
                        <div>
                            <label for="status"
                                   class="block text-xs font-semibold text-slate-700">
                                Filter by status
                            </label>
                            <select name="status" id="status"
                                    class="mt-1 rounded-md border border-slate-300 bg-white/80
                                           px-2 py-1 text-xs text-slate-900
                                           focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                                <option value="">All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                                Apply
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
                            <th class="px-4 py-2">Student</th>
                            <th class="px-4 py-2">Canteen</th>
                            <th class="px-4 py-2">Items</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Change</th>
                            <th class="px-4 py-2">Payment</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/90">
                        @forelse ($orders as $order)
                            <tr class="border-t border-slate-100 align-top hover:bg-slate-50/60">
                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->id }}
                                </td>

                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->user->name }}<br>
                                    <span class="text-xs text-slate-500">
                                        {{ $order->user->email }}
                                    </span>
                                </td>

                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->canteen->name }}
                                </td>

                                <td class="px-4 py-2 text-slate-700">
                                    @foreach ($order->items as $item)
                                        <div class="text-xs">
                                            {{ $item->menu->item_name }} × {{ $item->quantity }}
                                        </div>
                                    @endforeach
                                </td>

                                <td class="px-4 py-2 text-slate-900 font-semibold">
                                    Rs {{ number_format($order->total_amount, 2) }}
                                </td>

                                <td class="px-4 py-2 capitalize">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($order->status === 'completed')
                                            bg-emerald-100 text-emerald-700
                                        @elseif($order->status === 'cancelled')
                                            bg-red-100 text-red-700
                                        @elseif($order->status === 'accepted')
                                            bg-blue-100 text-blue-700
                                        @else
                                            bg-amber-100 text-amber-700
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-2">
                                    <form method="POST"
                                          action="{{ route('canteen.orders.updateStatus', $order) }}">
                                        @csrf
                                        <select name="status"
                                                class="border-slate-300 rounded-md text-xs px-2 py-1">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                                                pending
                                            </option>
                                            <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>
                                                accepted
                                            </option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                completed
                                            </option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                                cancelled
                                            </option>
                                        </select>
                                        <button type="submit"
                                                class="mt-1 inline-flex items-center px-3 py-1.5 text-xs font-semibold
                                                       rounded-md text-white bg-emerald-600 hover:bg-emerald-700">
                                            Update
                                        </button>
                                    </form>
                                </td>

                                <td class="px-4 py-2 text-slate-800">
                                    {{ $order->payment_method === 'cash_on_delivery' ? 'Cash on delivery' : 'Online payment' }}
                                    <span class="block text-xs text-slate-500">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8"
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
                @if(method_exists($orders, 'links'))
                    {{ $orders->links() }}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
