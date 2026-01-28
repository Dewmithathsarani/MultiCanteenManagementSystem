<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('My Favourite Canteens') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Info card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5">
                    <p class="text-sm text-slate-700">
                        These are the canteens you’ve marked as favourites for quick access.
                    </p>
                </div>
            </div>

            {{-- Favourites grid --}}
            <div class="bg-transparent">
                @if ($canteens->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($canteens as $canteen)
                            <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl
                                        hover:shadow-md hover:border-blue-200 transition">
                                <div class="p-5 flex flex-col h-full">
                                    <a href="{{ route('student.canteens.show', $canteen) }}" class="flex-1 block">
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
                                    </a>

                                    @auth
                                        @php
                                            $isFavorite = auth()->user()
                                                ->favouriteCanteens()
                                                ->where('canteen_id', $canteen->id)
                                                ->exists();
                                        @endphp

                                        <div class="mt-4 flex items-center justify-between gap-2">
                                            <a href="{{ route('student.canteens.show', $canteen) }}"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                      rounded-md text-white
                                                      bg-blue-700 hover:bg-blue-800
                                                      shadow-sm shadow-blue-500/40">
                                                View canteen &rarr;
                                            </a>

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
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-6 text-center">
                        <p class="text-sm text-slate-500">
                            You have no favourite canteens yet.
                        </p>
                        <a href="{{ route('student.canteens.index') }}"
                           class="mt-3 inline-flex items-center px-3 py-1.5 text-xs font-medium
                                  rounded-md text-white bg-blue-700 hover:bg-blue-800">
                            Browse canteens &rarr;
                        </a>
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
