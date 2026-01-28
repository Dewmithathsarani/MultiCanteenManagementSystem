<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Browse Menus by Meal
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6">

        {{-- Meal filter + Search bar --}}
        <form method="GET" action="{{ route('student.menus.index') }}" class="mb-4 flex flex-wrap items-center gap-2">
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">Meal:</span>
                <select name="meal_type" class="border-gray-300 rounded-md text-sm">
                    <option value="breakfast" {{ $mealType == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                    <option value="lunch" {{ $mealType == 'lunch' ? 'selected' : '' }}>Lunch</option>
                    <option value="dinner" {{ $mealType == 'dinner' ? 'selected' : '' }}>Dinner</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-700">Search:</span>
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       placeholder="e.g. chicken, parippu"
                       class="border-gray-300 rounded-md text-sm px-2 py-1">
            </div>

            <button type="submit"
                    class="px-3 py-1 text-xs bg-emerald-600 text-white rounded hover:bg-emerald-700">
                Apply
            </button>
        </form>

        @forelse ($menus as $menu)
            <div class="border rounded-lg p-4 mb-3 flex justify-between items-center">
                <div>
                    <div class="font-semibold">{{ $menu->item_name }}</div>

                    <div class="text-sm text-gray-500">
                        {{ $menu->canteen->name }} – {{ ucfirst($menu->meal_type) }}
                    </div>

                    <div class="text-sm text-gray-700">
                        Rs. {{ number_format($menu->price, 2) }}
                    </div>

                    @if (!empty($menu->curries))
                        <div class="text-xs text-gray-500 mt-1">
                            Curries: {{ $menu->curries }}
                        </div>
                    @endif

                    @if (isset($menu->availability))
                        <div class="text-xs mt-1 {{ $menu->availability ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $menu->availability ? 'Available' : 'Not available' }}
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('student.orders.store', $menu) }}" class="flex items-center space-x-2">
                    @csrf
                    <input type="number" name="quantity" min="1" value="1"
                        class="w-16 border-gray-300 rounded-md text-sm">

                    <select name="payment_method" class="border-gray-300 rounded-md text-xs">
                        <option value="cash_on_delivery">Cash on delivery</option>
                        <option value="online">Online payment</option>
                    </select>

                    <button type="submit"
                        class="px-3 py-1 text-xs bg-emerald-600 text-white rounded hover:bg-emerald-700">
                        Order
                    </button>
                </form>

            </div>
        @empty
            <p class="text-gray-500 text-sm">No items found for this meal type.</p>
        @endforelse

    </div>
</x-app-layout>
