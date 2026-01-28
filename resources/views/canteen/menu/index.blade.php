<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('My Menu Items') }}
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

            {{-- Add button --}}
            <div class="flex justify-end">
                <a href="{{ route('canteen.menu.create') }}"
                   class="inline-flex items-center px-4 py-2 rounded-md text-xs font-semibold
                          text-white bg-gradient-to-r from-blue-600 to-indigo-600
                          hover:from-blue-700 hover:to-indigo-700 shadow-md shadow-blue-500/40">
                    + Add Menu Item
                </a>
            </div>

            {{-- Menu table --}}
            <div class="bg-white/95 border border-blue-100 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-slate-50">
                        <tr class="text-xs font-semibold text-slate-600 uppercase tracking-wide">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Item</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Meal Type</th>
                            <th class="px-4 py-2">Available</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white/90">
                        @forelse ($menus as $menu)
                            <tr class="border-t border-slate-100 hover:bg-slate-50/60">
                                <td class="px-4 py-2 text-slate-800">
                                    {{ $menu->id }}
                                </td>
                                <td class="px-4 py-2 text-slate-800">
                                    {{ $menu->item_name }}
                                </td>
                                <td class="px-4 py-2 text-slate-900 font-semibold">
                                    Rs {{ number_format($menu->price, 2) }}
                                </td>
                                <td class="px-4 py-2 text-slate-700">
                                    {{  ucfirst($menu->meal_type) }}
                                </td>
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $menu->availability
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-slate-100 text-slate-500' }}">
                                        {{ $menu->availability ? 'Available' : 'Unavailable' }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('canteen.menu.edit', $menu) }}"
                                       class="text-xs font-semibold text-blue-700 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('canteen.menu.destroy', $menu) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs font-semibold text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-4 text-center text-sm text-slate-500">
                                    No menu items yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
