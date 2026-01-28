<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white/95 backdrop-blur-sm shadow-sm sm:rounded-lg border border-blue-100">
                <div class="px-6 py-5">
                    @if($notifications->isEmpty())
                        <p class="text-sm text-slate-500">
                            You have no notifications yet.
                        </p>
                    @else
                        <ul class="divide-y divide-slate-100 text-sm">
                            @foreach($notifications as $notification)
                                @php
                                    $data = $notification->data;
                                @endphp
                                <li class="py-3">
                                    <div class="flex justify-between gap-3">
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex h-2 w-2 rounded-full
                                                    {{ $notification->read_at ? 'bg-slate-300' : 'bg-blue-500' }}">
                                                </span>
                                                <span class="text-xs uppercase tracking-wide text-slate-500">
                                                    Order update
                                                </span>
                                            </div>

                                            <div class="mt-1">
                                                <span class="font-semibold text-blue-900">
                                                    Order #{{ $data['order_id'] ?? '' }}
                                                </span>
                                                <span class="ml-1 text-slate-700">
                                                    at {{ $data['canteen_name'] ?? 'canteen' }}
                                                </span>
                                            </div>

                                            <div class="mt-1 text-slate-700">
                                                Status changed from
                                                <span class="font-semibold">
                                                    {{ ucfirst($data['old_status'] ?? '') }}
                                                </span>
                                                to
                                                <span class="font-semibold">
                                                    {{ ucfirst($data['new_status'] ?? '') }}
                                                </span>.
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                Total: Rs {{ number_format($data['total_amount'] ?? 0, 2) }}
                                            </div>
                                        </div>

                                        <span class="text-xs text-slate-400 whitespace-nowrap">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
