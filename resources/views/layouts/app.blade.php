<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')    
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-green-50">    

            @auth
                @include('layouts.navigation')
            @else
                @include('layouts.homenav')
            @endauth
            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            
            <div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-24 sm:items-start z-50">
                @if (session('success'))
                    <div x-data="{ show: true }" 
                        x-init="setTimeout(() => show = false, 3000)"
                        x-show="show">                    
                        <x-notification type="success" :message="session('success')" />
                    </div>
                @endif
                @if (session('error'))
                    <div x-data="{ show: true }" 
                        x-init="setTimeout(() => show = false, 3000)"                        
                        x-show="show">                    
                        <x-notification type="error" :message="session('error')" />
                    </div>
                @endif
                @if (session('warning'))
                    <div x-data="{ show: true }" 
                        x-init="setTimeout(() => show = false, 3000)"                        
                        x-show="show">                    
                        <x-notification type="warning" :message="session('warning')" />
                    </div>
                @endif
                @if (session('status'))
                    <div x-data="{ show: true }" 
                        x-init="setTimeout(() => show = false, 3000)"                        
                        x-show="show">                    
                        <x-notification type="info" :message="session('status')" />
                    </div>
                @endif
            </div>         
            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
