<nav x-data="{ open: false }" class="bg-green-500 text-white shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                        <span class="font-semibold text-lg">Plantify</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="/"
                        class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    <x-nav-link href="{{route('explorar.especies')}}"
                        class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                        {{ __('Explorar Especies') }}
                    </x-nav-link>
                    <x-nav-link href="/nosotros"
                        class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                        {{ __('Nosotros') }}
                    </x-nav-link>
                    <x-nav-link href="/preguntas-frecuentes"
                        class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                        {{ __('Preguntas Frecuentes') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Section -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-nav-link href="{{ route('dashboard') }}"
                        class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                        <div>
                            <button @click="open = !open" class="flex items-center text-white hover:text-green-100 transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </div>

                        <div x-show="open"
                             class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                             style="display: none;">
                            <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="text-gray-700 hover:bg-gray-100">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="space-x-4">
                        <x-nav-link :href="route('login')" 
                            class="text-white hover:text-green-100 transition duration-150 ease-in-out">
                            {{ __('Iniciar Sesión') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" 
                            class="inline-flex items-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 active:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Registrarse') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-green-100 hover:bg-green-400 focus:outline-none focus:bg-green-400 focus:text-green-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/"
                class="text-white hover:bg-green-400 hover:text-white">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{route('explorar.especies')}}"
                class="text-white hover:bg-green-400 hover:text-white">
                {{ __('Explorar Especies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/nosotros"
                class="text-white hover:bg-green-400 hover:text-white">
                {{ __('Nosotros') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/preguntas-frecuentes"
                class="text-white hover:bg-green-400 hover:text-white">
                {{ __('Preguntas Frecuentes') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-green-400">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->user_nombre }}</div>
                    <div class="font-medium text-sm text-green-100">{{ Auth::user()->user_email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')"
                        class="text-white hover:bg-green-400">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="text-white hover:bg-green-400">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-white hover:bg-green-400">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')"
                        class="text-white hover:bg-green-400">
                        {{ __('Iniciar Sesión') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')"
                        class="text-white hover:bg-green-400">
                        {{ __('Registrarse') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>