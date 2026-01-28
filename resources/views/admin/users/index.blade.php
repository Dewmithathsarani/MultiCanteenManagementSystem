<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-900 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/95 border border-blue-100 shadow-sm rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-blue-900 mb-4">
                    Users
                </h3>

                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-left text-xs font-semibold text-slate-500 uppercase">
                            <th class="py-2 pr-4">Name</th>
                            <th class="py-2 pr-4">Email</th>
                            <th class="py-2 pr-4">Role</th>
                            <th class="py-2 pr-4">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-slate-100">
                                <td class="py-2 pr-4 text-slate-900">{{ $user->name }}</td>
                                <td class="py-2 pr-4 text-slate-700">{{ $user->email }}</td>
                                <td class="py-2 pr-4 text-slate-700">{{ ucfirst($user->role) }}</td>
                                <td class="py-2 pr-4 text-slate-500 text-xs">
                                    {{ $user->created_at ? $user->created_at->format('Y-m-d') : '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-slate-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
