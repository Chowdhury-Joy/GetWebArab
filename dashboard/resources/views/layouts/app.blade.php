<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-200 bg-[#0B0F19] selection:bg-cyan-500/30">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-[#0B0F19]/60 backdrop-blur-xl border-b border-white/5 shadow-lg shadow-black/20 sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Global Toast Notification -->
            @if (session('success'))
                <div x-data="{ show: true }" 
                     x-show="show"
                     x-init="setTimeout(() => show = false, 3000)"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="translate-x-full opacity-0"
                     x-transition:enter-end="translate-x-0 opacity-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="translate-x-0 opacity-100"
                     x-transition:leave-end="translate-x-full opacity-0"
                     class="fixed top-20 right-6 z-50 flex items-center px-6 py-4 bg-[#1E293B]/90 backdrop-blur-md border border-emerald-100 shadow-xl shadow-emerald-500/10 rounded-xl"
                     style="display: none;">
                    
                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600 mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="text-sm font-semibold text-emerald-800">
                        {{ session('success') }}
                    </div>
                    
                    <button @click="show = false" class="ml-6 text-slate-500 hover:text-gray-600 focus:outline-none transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif
        </div>
    </body>
</html>
