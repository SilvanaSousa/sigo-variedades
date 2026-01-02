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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center space-x-8">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="group flex items-center space-x-2">
                                <span class="bg-indigo-600 text-white p-2 rounded-lg transform group-hover:rotate-12 transition-transform duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </span>
                                <span class="font-black text-2xl tracking-tighter">
                                    SIGO<span class="text-indigo-600">VARIEDADES</span>
                                </span>
                            </a>
                        </div>

                        <!-- Desktop Links -->
                        <div class="hidden sm:flex sm:space-x-8">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-bold transition-all duration-200">
                                Início
                            </a>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-bold transition-all duration-200">
                                Produtos
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition-colors">Admin</a>
                        
                        <!-- Mobile menu button -->
                        <div class="sm:hidden flex items-center">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition-colors" aria-expanded="false">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
