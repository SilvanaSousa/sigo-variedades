<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 h-full overflow-x-hidden">
    <div class="min-h-screen flex flex-col" x-data="{ mobileMenuOpen: false }">
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
                                <span class="font-black text-xl sm:text-2xl tracking-tighter">
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
                        <div class="hidden sm:flex items-center space-x-4">
                            @guest
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition-colors">Entrar</a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm font-bold text-red-600 hover:text-red-700 transition-colors ml-4">
                                        Sair
                                    </button>
                                </form>
                            @endguest
                        </div>
                        
                        <!-- Mobile menu button -->
                        <div class="sm:hidden flex items-center">
                            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-indigo-600 hover:bg-gray-100 focus:outline-none transition-colors" aria-expanded="false">
                                <span class="sr-only">Abrir menu</span>
                                <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="sm:hidden bg-white border-b border-gray-100" x-cloak>
                <div class="pt-2 pb-6 space-y-1 px-4">
                    <a href="{{ route('home') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->routeIs('home') ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-bold transition-all">
                        Início
                    </a>
                    <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-3 border-l-4 {{ request()->routeIs('products.*') ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-bold transition-all">
                        Produtos
                    </a>
                    <div class="pt-4 pb-1 border-t border-gray-100 mt-4">
                        @guest
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-bold text-gray-600 hover:text-indigo-600">Entrar</a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-bold text-gray-600">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 text-base font-bold text-red-600">
                                    Sair
                                </button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto px-4 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center space-x-2">
                        <span class="bg-indigo-600 text-white p-1.5 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </span>
                        <span class="font-black text-lg tracking-tighter uppercase">SIGO<span class="text-indigo-600">VARIEDADES</span></span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
