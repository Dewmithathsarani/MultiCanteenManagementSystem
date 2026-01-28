<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-blue-900 leading-tight">
                {{ __('Add Canteen') }}
            </h2>
            <a href="{{ route('admin.canteens.index') }}"
                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md
                    bg-blue-900/40 text-blue-800 border border-blue-300/40
                    hover:bg-blue-900/60 transition">
                    ← Back to list
                </a> 
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/95 backdrop-blur border border-blue-100 shadow-xl
                        shadow-slate-900/10 rounded-2xl overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/80 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            New canteen
                        </h3>
                        <p class="mt-1 text-sm text-slate-600">
                            Register a new canteen to the Uni Canteen system.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <form method="POST"
                      action="{{ route('admin.canteens.store') }}"
                      class="px-6 py-6 space-y-6">
                    @csrf

                    {{-- Basic info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700">
                                Canteen name
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-lg border border-slate-300
                                          bg-white/70 px-3 py-2 text-sm text-slate-900
                                          shadow-sm focus:border-blue-500 focus:ring-2
                                          focus:ring-blue-500/40"
                                   required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">
                                Location
                            </label>
                            <input type="text"
                                   name="location"
                                   value="{{ old('location') }}"
                                   class="mt-1 block w-full rounded-lg border border-slate-300
                                          bg-white/70 px-3 py-2 text-sm text-slate-900
                                          shadow-sm focus:border-blue-500 focus:ring-2
                                          focus:ring-blue-500/40">
                            @error('location')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700">
                                Owner (canteen user)
                            </label>
                            <select name="user_id"
                                    class="mt-1 block w-full rounded-lg border border-slate-300
                                           bg-white/70 px-3 py-2 text-sm text-slate-900
                                           shadow-sm focus:border-blue-500 focus:ring-2
                                           focus:ring-blue-500/40">
                                <option value="">-- No owner yet --</option>
                                @foreach($owners ?? [] as $owner)
                                    <option value="{{ $owner->id }}"
                                            {{ old('user_id') == $owner->id ? 'selected' : '' }}>
                                        {{ $owner->name }} ({{ $owner->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Description
                        </label>
                        <textarea name="description"
                                  rows="3"
                                  class="mt-1 block w-full rounded-lg border border-slate-300
                                         bg-white/70 px-3 py-2 text-sm text-slate-900
                                         shadow-sm focus:border-blue-500 focus:ring-2
                                         focus:ring-blue-500/40">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Opening hours --}}
                    <div>
                        <h4 class="text-sm font-semibold text-slate-800 mb-3">
                            Operating hours
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-600">
                                    Open time
                                </label>
                                <input type="time"
                                       name="open_time"
                                       value="{{ old('open_time') }}"
                                       class="mt-1 block w-full rounded-lg border border-slate-300
                                              bg-white/70 px-3 py-2 text-sm text-slate-900
                                              shadow-sm focus:border-blue-500 focus:ring-2
                                              focus:ring-blue-500/40">
                                @error('open_time')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-slate-600">
                                    Close time
                                </label>
                                <input type="time"
                                       name="close_time"
                                       value="{{ old('close_time') }}"
                                       class="mt-1 block w-full rounded-lg border border-slate-300
                                              bg-white/70 px-3 py-2 text-sm text-slate-900
                                              shadow-sm focus:border-blue-500 focus:ring-2
                                              focus:ring-blue-500/40">
                                @error('close_time')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('admin.canteens.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium
                                  rounded-md border border-slate-300 text-slate-700
                                  bg-white hover:bg-slate-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-semibold
                                       rounded-md text-white
                                       bg-gradient-to-r from-blue-600 to-indigo-600
                                       hover:from-blue-700 hover:to-indigo-700
                                       shadow-md shadow-blue-500/40
                                       focus:outline-none focus:ring-2 focus:ring-offset-1
                                       focus:ring-blue-500">
                            Add canteen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
