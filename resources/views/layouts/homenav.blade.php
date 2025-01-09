<nav x-data="{ open: false }" class="bg-green-600 text-white shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{-- home --}}
                    <x-nav-link href="#" class="text-white hover:text-green-300">
                        {{ __('Home') }}
                    </x-nav-link>
                    {{-- about us --}}
                    <x-nav-link href="#" class="text-white hover:text-green-300">
                        {{ __('About Us') }}
                    </x-nav-link>
                    {{-- contact --}}
                    <x-nav-link href="#" class="text-white hover:text-green-300">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>
            
            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                @auth
                    <x-nav-link :href="route('dashboard')" class="text-white hover:text-green-300">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('login')" class="text-white hover:text-green-300">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" class="text-white hover:text-green-300">
                        {{ __('Register') }}
                    </x-nav-link>
                @endauth
            </div>
        <div>
    </div>
</nav>