<nav x-data="{ open: false }" class="bg-blue-900/90 border-b border-blue-900 text-white backdrop-blur-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / App Name -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <img
                            src="{{ asset('images/uni-canteen-logo.jpeg') }}"
                            alt="Uni Canteen"
                            class="h-8 w-auto"
                        >
                        <span class="text-xl font-bold text-white">
                            Uni Canteen
                        </span>
                    </a>
                </div>

                <!-- Navigation Links (left side) -->
                @auth
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-white">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        @if(auth()->user()->role === 'admin')
                            <x-nav-link href="{{ url('/admin/canteens') }}" :active="request()->is('admin/canteens*')">
                                {{ __('Canteens') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.*')">
                                {{ __('Orders') }}
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'canteen')
                            <x-nav-link href="{{ url('/canteen/menu') }}" :active="request()->is('canteen/menu*')">
                                {{ __('My Menu') }}
                            </x-nav-link>
                            <x-nav-link href="{{ url('/canteen/orders') }}" :active="request()->is('canteen/orders*')">
                                {{ __('Incoming Orders') }}
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'student')
                            <x-nav-link href="{{ route('student.canteens.index') }}" :active="request()->routeIs('student.canteens.*')">
                                {{ __('Canteens') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('student.canteens.favorites') }}" :active="request()->routeIs('student.canteens.favorites')">
                                {{ __('My Favourite Canteens') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('student.orders.index') }}" :active="request()->routeIs('student.orders.*')">
                                {{ __('My Orders') }}
                            </x-nav-link>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    @php
                        $user = auth()->user();
                        $unreadCount = $user->role === 'student'
                            ? $user->unreadNotifications()->count()
                            : 0;
                    @endphp

                    @if($user->role === 'student')
                        <a href="{{ route('student.notifications.index') }}"
                           class="relative inline-flex items-center mr-4 text-gray-100 hover:text-white">
                            <span>🔔</span>
                            @if($unreadCount > 0)
                                <span class="ml-1 inline-flex items-center justify-center
                                             px-1.5 py-0.5 text-xs font-semibold
                                             rounded-full bg-red-500 text-white">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-2 border border-transparent
                                    text-sm leading-4 font-medium rounded-md text-blue-50
                                    bg-blue-900/90 hover:text-white focus:outline-none transition">

                                {{-- Circle avatar with person icon --}}
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full
                                            bg-gradient-to-br from-blue-500 to-indigo-600
                                            shadow-md shadow-blue-500/40">
                                    <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.25a7.25 7.25 0 0115 0v.25a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75v-.25z" />
                                    </svg>
                                </span>

                                {{-- Name + role --}}
                                <span class="flex flex-col items-start">
                                    <span class="text-xs font-semibold leading-tight">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <span class="text-[11px] text-blue-100 leading-tight">
                                        {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </span>

                                {{-- Caret --}}
                                <svg class="ml-1 h-4 w-4 text-blue-100" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9.75L12 13.5l3.75-3.75" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- User summary --}}
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ Auth::user()->email }}
                                </p>
                                <p class="mt-1 text-[11px] font-semibold uppercase tracking-wide text-blue-600">
                                    Role: {{ ucfirst(Auth::user()->role) }}
                                </p>
                            </div>

                            {{-- Profile link --}}
                            <x-dropdown-link href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>


                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-100 hover:text-white">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="text-sm text-emerald-300 hover:text-emerald-200">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-200 hover:text-white hover:bg-blue-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900/95 border-t border-blue-800 text-white">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @php
                    $user = auth()->user();
                    $unreadCount = $user->role === 'student'
                        ? $user->unreadNotifications()->count()
                        : 0;
                @endphp

                @if($user->role === 'student')
                    <x-responsive-nav-link href="{{ route('student.notifications.index') }}">
                        🔔 Notifications
                        @if($unreadCount > 0)
                            <span class="ml-1 inline-flex items-center justify-center
                                         px-1.5 py-0.5 text-xs font-semibold
                                         rounded-full bg-red-500 text-white">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link href="{{ url('/admin/canteens') }}">
                        {{ __('Canteens') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ url('/admin/orders') }}">
                        {{ __('Orders') }}
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->role === 'canteen')
                    <x-responsive-nav-link href="{{ url('/canteen/menu') }}">
                        {{ __('My Menu') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('canteen.orders.index') }}">
                        {{ __('Incoming Orders') }}
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->role === 'student')
                    <x-responsive-nav-link href="{{ route('student.canteens.index') }}">
                        {{ __('Canteens') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('student.orders.index') }}">
                        {{ __('My Orders') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-blue-800">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-emerald-100">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
