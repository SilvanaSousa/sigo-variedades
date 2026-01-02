<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased">
    <div class="min-h-full">
        <!-- Sidebar -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-b from-indigo-600 via-purple-600 to-indigo-700 px-6 pb-4 shadow-2xl">
                <!-- Logo -->
                <div class="flex h-20 shrink-0 items-center border-b border-indigo-500/30">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/10 backdrop-blur-sm p-2.5 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black text-white tracking-tight">SIGO</h1>
                            <p class="text-xs font-semibold text-indigo-200 -mt-1">Admin Panel</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="group flex gap-x-3 rounded-2xl p-3 text-sm font-bold leading-6 transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white shadow-lg' : 'text-indigo-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="group flex gap-x-3 rounded-2xl p-3 text-sm font-bold leading-6 transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-white/20 text-white shadow-lg' : 'text-indigo-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Produtos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="group flex gap-x-3 rounded-2xl p-3 text-sm font-bold leading-6 transition-all duration-300 {{ request()->routeIs('admin.categories.*') ? 'bg-white/20 text-white shadow-lg' : 'text-indigo-100 hover:text-white hover:bg-white/10' }}">
                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Categorias
                            </a>
                        </li>
                    </ul>

                    <!-- Bottom section -->
                    <div class="mt-auto pt-6 border-t border-indigo-500/30">
                        <a href="{{ route('home') }}" target="_blank" class="group flex gap-x-3 rounded-2xl p-3 text-sm font-bold leading-6 text-indigo-100 hover:text-white hover:bg-white/10 transition-all duration-300">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Ver Site
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:pl-72">
            <!-- Top Bar -->
            <div class="sticky top-0 z-40 flex h-20 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white/80 backdrop-blur-md px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="relative flex flex-1 items-center">
                        <!-- Page Indicator -->
                        <div class="flex items-center space-x-3">
                            <div class="h-2 w-2 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                            <span class="text-sm font-bold text-gray-600">Painel Administrativo</span>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <div class="relative group">
                            <button type="button" class="flex items-center gap-x-3 px-4 py-2 rounded-2xl hover:bg-gray-100 transition-all duration-300">
                                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-black shadow-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">Administrador</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-56 origin-top-right rounded-2xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden">
                                <div class="p-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left flex items-center gap-x-3 px-4 py-3 text-sm font-bold text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-xl transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Sair
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
