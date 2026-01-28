<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-blue-900 leading-tight">
                Canteens
            </h2>
            <a href="{{ route('admin.canteens.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold
                      text-white bg-blue-900 hover:bg-blue-800 shadow-sm">
                + Add Canteen
            </a>
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
                            <th class="px-4 py-3 font-semibold">Name</th>
                            <th class="px-4 py-3 font-semibold">Location</th>
                            <th class="px-4 py-3 font-semibold">Open</th>
                            <th class="px-4 py-3 font-semibold">Close</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($canteens as $canteen)
                            <tr class="hover:bg-blue-50">
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $canteen->id }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $canteen->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $canteen->location }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $canteen->open_time }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $canteen->close_time }}
                                </td>
                                <td class="px-4 py-3 text-right space-x-3">
                                    <a href="{{ route('admin.canteens.edit', $canteen) }}"
                                       class="text-blue-700 hover:text-blue-900 text-sm font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.canteens.destroy', $canteen) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Delete this canteen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-sm font-medium text-red-600 hover:text-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    No canteens yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $canteens->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
