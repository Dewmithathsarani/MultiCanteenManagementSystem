<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-blue-900 leading-tight">
                    {{ __('Edit Menu Item') }}
                </h2>
                <a href="{{ route('canteen.menu.index') }}"
                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md
                            bg-blue-900/40 text-blue-800 border border-blue-300/40
                            hover:bg-blue-900/60 transition">
                        ← Back to list
                </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/95 border border-blue-100 shadow-sm sm:rounded-lg p-6">

                <form method="POST"
                      action="{{ route('canteen.menu.update', $menu) }}"
                      enctype="multipart/form-data"
                      class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Canteen ID (read-only or hidden in future) --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Canteen ID
                        </label>
                        <input
                            type="number"
                            name="canteen_id"
                            value="{{ old('canteen_id', $menu->canteen_id) }}"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-white/80
                                   text-sm text-slate-900
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"
                            required
                        >
                        <p class="text-xs text-slate-500 mt-1">
                            From admin canteen list (can be automated later).
                        </p>
                        @error('canteen_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Item name --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Item name
                        </label>
                        <input
                            type="text"
                            name="item_name"
                            value="{{ old('item_name', $menu->item_name) }}"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-white/80
                                   text-sm text-slate-900
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"
                            required
                        >
                        @error('item_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Price (Rs)
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price', $menu->price) }}"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-white/80
                                   text-sm text-slate-900
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"
                            required
                        >
                        @error('price')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Meal type --}}
                    <div>
                        <label for="meal_type" class="block text-sm font-semibold text-slate-700">
                            Meal type
                        </label>
                        <select
                            name="meal_type"
                            id="meal_type"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-white/80
                                   text-sm text-slate-900
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"
                            required
                        >
                            <option value="breakfast" {{ old('meal_type', $menu->meal_type) == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                            <option value="lunch" {{ old('meal_type', $menu->meal_type) == 'lunch' ? 'selected' : '' }}>Lunch</option>
                            <option value="dinner" {{ old('meal_type', $menu->meal_type) == 'dinner' ? 'selected' : '' }}>Dinner</option>
                            <option value="evening_snacks" {{ old('meal_type', $menu->meal_type) == 'evening_snacks' ? 'selected' : '' }}>Evening Snacks</option>
                        </select>
                    </div>

                    {{-- Curries description --}}
                    <div>
                        <label for="curries" class="block text-sm font-semibold text-slate-700">
                            Curries in this menu
                        </label>
                        <textarea
                            name="curries"
                            id="curries"
                            rows="3"
                            class="mt-1 block w-full rounded-md border-slate-300 bg-white/80
                                   text-sm text-slate-900
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"
                            placeholder="E.g. Parippu, Bean curry, Brinjal moju, Potato curry"
                        >{{ old('curries', $menu->curries) }}</textarea>
                        <p class="text-xs text-slate-400 mt-1">
                            Students will see this list when browsing menus.
                        </p>
                    </div>

                    {{-- Menu photo (current + upload new) --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">
                            Menu photo
                        </label>

                        @if(!empty($menu->photo_path))
                            <div class="mt-1 mb-3">
                                <img src="{{ asset('storage/'.$menu->photo_path) }}"
                                     alt="Menu photo"
                                     class="h-24 rounded-md border border-slate-200 object-cover">
                            </div>
                        @endif

                        <input
                            type="file"
                            name="photo"
                            accept="image/*"
                            class="mt-1 block w-full text-sm text-slate-500
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-blue-50 file:text-blue-700
                                   hover:file:bg-blue-100"
                        >
                        <p class="text-xs text-slate-400 mt-1">
                            Leave empty to keep the current photo. JPG, PNG, or WEBP, up to 2 MB.
                        </p>
                        @error('photo')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Availability --}}
                    <div class="flex items-center">
                        <input
                            id="availability"
                            type="checkbox"
                            name="availability"
                            value="1"
                            class="h-4 w-4 text-emerald-600 border-slate-300 rounded"
                            {{ old('availability', $menu->availability) ? 'checked' : '' }}
                        >
                        <label for="availability" class="ml-2 text-sm text-slate-700">
                            Available
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('canteen.menu.index') }}"
                           class="px-4 py-2 border border-slate-300 rounded-md text-xs font-semibold
                                  text-slate-700 bg-white hover:bg-slate-50">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-4 py-2 rounded-md text-xs font-semibold text-white
                                       bg-gradient-to-r from-blue-600 to-indigo-600
                                       hover:from-blue-700 hover:to-indigo-700
                                       shadow-md shadow-blue-500/40">
                            Save changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
