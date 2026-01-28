<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ $canteen->name }} – {{ __('Menu') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Canteen info card --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            {{ $canteen->name }}
                        </h3>
                        @if($canteen->description)
                            <p class="mt-1 text-sm text-slate-700">
                                {{ $canteen->description }}
                            </p>
                        @endif
                        <p class="mt-1 text-xs text-slate-500">
                            Location: {{ $canteen->location ?? 'N/A' }} ·
                            Open: {{ $canteen->open_time }} – {{ $canteen->close_time }}
                        </p>
                    </div>

                    @auth
                        @php
                            $isFavorite = auth()->user()
                                ->favouriteCanteens()
                                ->where('canteen_id', $canteen->id)
                                ->exists();
                        @endphp

                        <div class="flex items-center gap-3">
                            @if($isFavorite)
                                <form action="{{ route('student.canteens.unfavorite', $canteen->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                   rounded-md border border-red-200 bg-red-50 text-red-600
                                                   hover:bg-red-100">
                                        ♥ Remove from favourites
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('student.canteens.favorite', $canteen->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium
                                                   rounded-md border border-blue-200 bg-blue-50 text-blue-700
                                                   hover:bg-blue-100">
                                        ♡ Add to favourites
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>

            {{-- Menu items --}}
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-slate-800 tracking-wide uppercase">
                    Menu items
                </h3>

                {{-- Filters --}}
                <form method="GET"
                      action="{{ route('student.canteens.show', $canteen) }}"
                      class="mb-4 flex flex-col sm:flex-row gap-3 sm:items-end">
                    <div class="flex-1">
                        <label class="block text-xs font-medium text-slate-700">
                            Search items
                        </label>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search by name..."
                               class="mt-1 block w-full rounded-md border border-slate-300 bg-white/80
                                      px-3 py-2 text-sm text-slate-900
                                      focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-700">
                            Meal type
                        </label>
                        <select name="meal_type"
                                class="mt-1 block w-full rounded-md border border-slate-300 bg-white/80
                                       px-3 py-2 text-sm text-slate-900
                                       focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                            <option value="">All</option>
                            <option value="breakfast" {{ request('meal_type') == 'breakfast' ? 'selected' : '' }}>Breakfast</option>
                            <option value="lunch" {{ request('meal_type') == 'lunch' ? 'selected' : '' }}>Lunch</option>
                            <option value="dinner" {{ request('meal_type') == 'dinner' ? 'selected' : '' }}>Dinner</option>
                            <option value="evening_snacks" {{ request('meal_type') == 'evening_snacks' ? 'selected' : '' }}>Evening Snacks</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="mt-5 inline-flex items-center px-4 py-2 text-xs font-semibold
                                       rounded-md text-white
                                       bg-gradient-to-r from-blue-600 to-indigo-600
                                       hover:from-blue-700 hover:to-indigo-700
                                       shadow-sm shadow-blue-500/40">
                            Apply
                        </button>
                        @if(request('search') || request('meal_type'))
                            <a href="{{ route('student.canteens.show', $canteen) }}"
                               class="mt-5 inline-flex items-center px-3 py-2 text-xs font-semibold
                                      rounded-md border border-slate-300 text-slate-700 bg-white hover:bg-slate-50">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                @if($menus->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($menus as $item)
                            <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl flex flex-col justify-between">
                                @if(!empty($item->photo_path))
                                    <div class="h-32 w-full overflow-hidden rounded-t-xl border-b border-slate-100">
                                        <img src="{{ asset('storage/'.$item->photo_path) }}"
                                             alt="{{ $item->item_name }}"
                                             class="h-full w-full object-cover">
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h4 class="text-sm font-semibold text-blue-900">
                                        {{ $item->item_name }}
                                    </h4>
                                    <p class="mt-1 text-sm font-bold text-emerald-700">
                                        Rs {{ number_format($item->price, 2) }}
                                    </p>

                                    @if (!empty($item->curries))
                                        <p class="mt-1 text-xs text-slate-500">
                                            Curries: {{ $item->curries }}
                                        </p>
                                    @endif

                                    <p class="mt-2 text-xs font-medium
                                       {{ $item->availability ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $item->availability ? 'Available' : 'Not available' }}
                                    </p>
                                </div>

                                <div class="px-4 pb-4 border-t border-slate-100">
                                    <form method="POST"
                                          action="{{ route('student.orders.store', $item) }}"
                                          class="mt-3 flex items-center gap-2">
                                        @csrf

                                        <input type="number"
                                               name="quantity"
                                               min="1"
                                               value="1"
                                               class="w-16 rounded-md border border-slate-300
                                                      bg-white/80 px-2 py-1 text-xs text-slate-900
                                                      focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">

                                        <select name="payment_method"
                                                class="rounded-md border border-slate-300 bg-white/80
                                                       px-2 py-1 text-xs text-slate-900
                                                       focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                                            <option value="cash_on_delivery">Cash on delivery</option>
                                            <option value="online">Online payment</option>
                                        </select>

                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-semibold
                                                       rounded-md text-white
                                                       bg-gradient-to-r from-blue-600 to-indigo-600
                                                       hover:from-blue-700 hover:to-indigo-700
                                                       shadow-sm shadow-blue-500/40">
                                            Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/95 border border-blue-100 shadow-sm rounded-xl p-6 text-center">
                        <p class="text-sm text-slate-500">
                            No menu items for this canteen yet.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Rating & Reviews --}}
            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100 p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800 tracking-wide uppercase">
                            Rating & reviews
                        </h3>
                        <p class="mt-1 text-sm text-slate-700">
                            Average rating:
                            {{ $canteen->averageRating() ? number_format($canteen->averageRating(), 1) : 'No ratings yet' }} / 5
                        </p>
                    </div>
                </div>

                @auth
                    <form action="{{ route('student.canteens.reviews.store', $canteen) }}"
                          method="POST"
                          class="mt-2 space-y-3">
                        @csrf
                        <div class="flex flex-wrap gap-4">
                            <div>
                                <label class="block text-xs font-medium text-slate-700">
                                    Your rating (1–5)
                                </label>
                                <select name="rating"
                                        class="mt-1 rounded-md border border-slate-300 bg-white/80
                                               px-2 py-1 text-xs text-slate-900
                                               focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="flex-1 min-w-[220px]">
                                <label class="block text-xs font-medium text-slate-700">
                                    Comment (optional)
                                </label>
                                <textarea name="comment"
                                          rows="2"
                                          class="mt-1 block w-full rounded-md border border-slate-300
                                                 bg-white/80 px-3 py-2 text-xs text-slate-900
                                                 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50"></textarea>
                            </div>
                        </div>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold
                                       rounded-md text-white
                                       bg-blue-700 hover:bg-blue-800
                                       shadow-sm shadow-blue-500/40">
                            Submit review
                        </button>
                    </form>
                @endauth

                <div class="mt-4 space-y-3">
                    @forelse($canteen->reviews as $review)
                        <div class="border-b border-slate-100 pb-2">
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $review->user->name }} · {{ $review->rating }} / 5
                            </p>
                            @if($review->comment)
                                <p class="text-sm text-slate-700">
                                    {{ $review->comment }}
                                </p>
                            @endif
                            <p class="text-xs text-slate-500">
                                {{ $review->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">
                            No reviews yet.
                        </p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
