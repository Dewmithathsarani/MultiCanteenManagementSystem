<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('All Canteens') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5">
                    <form method="GET"
                          action="{{ route('student.canteens.index') }}"
                          class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[220px]">
                            <label class="block text-xs font-semibold text-slate-700">
                                Search
                            </label>
                            <input type="text"
                                   name="q"
                                   value="{{ request('q') }}"
                                   placeholder="Search by name or location"
                                   class="mt-1 block w-full rounded-md border border-slate-300
                                          bg-white/80 px-3 py-2 text-sm text-slate-900
                                          shadow-sm focus:border-blue-500 focus:ring-2
                                          focus:ring-blue-500/40">
                        </div>

                        <div class="flex items-center mt-2 sm:mt-6">
                            <input type="checkbox"
                                   id="open_now"
                                   name="open_now"
                                   value="1"
                                   {{ request()->boolean('open_now') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                            <label for="open_now" class="ml-2 text-xs font-medium text-slate-700">
                                Show only canteens open now
                            </label>
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

            {{-- Canteens grid --}}
            <div class="bg-transparent">
                @if ($canteens->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($canteens as $canteen)
                            <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl
                                        hover:shadow-md hover:border-blue-200 transition">
                                <div class="p-5 flex flex-col h-full">
                                    <div class="flex-1">
                                        <h3 class="text-base font-semibold text-blue-900">
                                            {{ $canteen->name }}
                                        </h3>
                                        @if($canteen->location)
                                            <p class="mt-1 text-sm text-slate-600">
                                                {{ $canteen->location }}
                                            </p>
                                        @endif
                                        <p class="mt-1 text-xs text-slate-500">
                                            Open: {{ $canteen->open_time }} – {{ $canteen->close_time }}
                                        </p>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between gap-2">
                                        <a href="{{ route('student.canteens.show', $canteen) }}"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                  rounded-md text-white
                                                  bg-blue-700 hover:bg-blue-800
                                                  shadow-sm shadow-blue-500/40">
                                            View menu &rarr;
                                        </a>

                                        @auth
                                            @php
                                                $isFavorite = auth()->user()
                                                    ->favouriteCanteens()
                                                    ->where('canteen_id', $canteen->id)
                                                    ->exists();
                                            @endphp

                                            @if($isFavorite)
                                                <form action="{{ route('student.canteens.unfavorite', $canteen->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-xs font-medium text-red-500 hover:text-red-600">
                                                        ♥ Unfavourite
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('student.canteens.favorite', $canteen->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            class="text-xs font-medium text-slate-500 hover:text-blue-700">
                                                        ♡ Favourite
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/90 border border-blue-100 shadow-sm rounded-xl p-6 text-center">
                        <p class="text-sm text-slate-500">
                            No canteens available.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $canteens->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
