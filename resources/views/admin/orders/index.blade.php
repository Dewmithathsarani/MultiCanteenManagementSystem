<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-blue-900 leading-tight">
                {{ __('Orders') }}
            </h2>
        </div>
    </x-slot>

    {{-- Themed background --}}
    <div class="min-h-screen py-8 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/95 shadow-sm sm:rounded-lg border border-blue-100 overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-blue-900/5 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 font-semibold">#</th>
                            <th class="px-4 py-3 font-semibold">Student</th>
                            <th class="px-4 py-3 font-semibold">Canteen</th>
                            <th class="px-4 py-3 font-semibold">Total</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Payment</th>
                            <th class="px-4 py-3 font-semibold">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-blue-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->id }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->payment_method }} ({{ $order->payment_status }})

                                    @if($order->payment_method === 'cash_on_delivery')
                                    <form method="POST"
                                        action="{{ route('canteen.orders.updatePaymentStatus', $order) }}"
                                        class="inline ml-2">
                                        @csrf
                                        <input type="hidden" name="payment_status"
                                            value="{{ $order->payment_status === 'paid' ? 'unpaid' : 'paid' }}">
                                            <button type="submit"
                                                class="text-xs px-2 py-1 rounded
                                                    {{ $order->payment_status === 'paid'
                                                        ? 'bg-emerald-100 text-emerald-700'
                                                        : 'bg-amber-100 text-amber-700' }}">
                                            {{ $order->payment_status === 'paid' ? 'Mark as unpaid' : 'Mark as paid' }}
                                        </button>
                                    </form>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{-- adjust relation: student/user based on your model --}}
                                    {{ $order->student->name ?? $order->user->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->canteen->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->total_amount ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ ucfirst($order->status) }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->payment_method }} ({{ $order->payment_status }})
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $order->created_at }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                    No orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
