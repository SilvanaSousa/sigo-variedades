@extends('layouts.guest')

@section('content')
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent">
            Acesso Restrito
        </h2>
        <p class="text-sm text-gray-500 mt-3 font-medium uppercase tracking-widest leading-relaxed">
            Área exclusiva para administradores
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 transform animate-bounce">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Profissional</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username" 
                       placeholder="admin@exemplo.com"
                       class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent rounded-[1.2rem] text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all duration-300 placeholder-gray-400" />
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600 font-bold flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-6">
            <div class="flex items-center justify-between mb-2 ml-1">
                <label for="password" class="block text-xs font-black text-gray-400 uppercase tracking-widest">Senha Secreta</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-600 hover:text-indigo-900 font-black uppercase tracking-widest transition-colors" href="{{ route('password.request') }}">
                        Esqueci?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password" 
                       placeholder="••••••••"
                       class="block w-full pl-11 pr-4 py-4 bg-gray-50 border-transparent rounded-[1.2rem] text-gray-900 font-bold focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-600 transition-all duration-300 placeholder-gray-400" />
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600 font-bold flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-gray-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer transition-all">
            <label for="remember_me" class="ml-3 text-sm text-gray-500 font-bold cursor-pointer hover:text-gray-700 transition-colors">Manter conectado</label>
        </div>

        <div class="pt-4">
            <button type="submit" class="group relative w-full flex justify-center items-center px-4 py-5 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-size-200 bg-pos-0 hover:bg-pos-100 border border-transparent rounded-[1.5rem] font-black text-lg text-white transition-all duration-500 shadow-2xl shadow-indigo-200 hover:shadow-indigo-400 hover:scale-[1.02] active:scale-[0.98]">
                <span class="relative flex items-center">
                    Acessar Painel
                    <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </button>
        </div>
    </form>

    <style>
        .bg-size-200 { background-size: 200% auto; }
        .bg-pos-0 { background-position: 0% center; }
        .bg-pos-100 { background-position: 100% center; }
    </style>
@endsection
