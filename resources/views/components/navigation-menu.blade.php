<!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-gray-800" x-data="{ mobileMenuOpen: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg x-show="mobileMenuOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <img src="{{ asset('img/logo/logo_transparant.png') }}" alt="Your Company" class="h-8 w-auto" />
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <x-nav-link active="{{ request()->routeIs('home') }}" href="{{ route('home') }}">Home</x-nav-link>

                        @if (Auth::user()->role->slug === 'super-admin')
                            <x-nav-link active="{{ request()->routeIs('sertifikat') }}" href="{{ route('sertifikat') }}">Sertifikat</x-nav-link>
                        @endif
                        <x-nav-link active="{{ request()->routeIs('batch') }}" href="{{ route('batch') }}">Batch</x-nav-link>
                        <x-nav-link active="{{ request()->routeIs('peserta') }}" href="{{ route('peserta') }}">Peserta</x-nav-link>
                        @if (Auth::user()->role->slug === 'super-admin')
                            <!-- Only show Users link for Super Admin -->
                            <x-nav-link active="{{ request()->routeIs('users') }}" href="{{ route('users') }}">Users</x-nav-link>
                        @endif
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div class="px-4 py-3 border-b border-gray-400">
                    <p class="text-sm font-semibold text-gray-300">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-100">{{ Auth::user()->email }}</p>
                </div>
                <!-- Profile dropdown -->
                <div class="relative ml-3" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="relative flex rounded-full focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Open user menu</span>
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}" alt="" class="object-cover size-12 flex-none rounded-full bg-gray-50" />
                    </button>

                    <div x-show="open" x-transition class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline outline-1 outline-black/5">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            <p class="text-xs text-indigo-600 font-medium mt-1">{{ Auth::user()->role->name }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" x-transition class="sm:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="{{ route('home') }}" class="block rounded-md {{ request()->routeIs('home') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-base font-medium">Home</a>
            <a href="{{ route('sertifikat') }}" class="block rounded-md {{ request()->routeIs('sertifikat') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-base font-medium">Sertifikat</a>
            <a href="{{ route('batch') }}" class="block rounded-md {{ request()->routeIs('batch') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-base font-medium">Batch</a>
            <a href="{{ route('peserta') }}" class="block rounded-md {{ request()->routeIs('peserta') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-base font-medium">Peserta</a>
            <a href="{{ route('users') }}" class="block rounded-md {{ request()->routeIs('users') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-base font-medium">Users</a>
        </div>
    </div>
</nav>
