@extends('layouts.app')

@section('content')
    <!-- Hero Section with Gradient Background -->
    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 overflow-hidden mb-12 sm:mb-20">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-gradient-to-br from-pink-400/20 to-orange-400/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col lg:flex-row items-center justify-between py-12 lg:py-24 gap-12">
                <div class="w-full lg:w-1/2 text-center lg:text-left z-10">
                    <div class="inline-block mb-4 px-4 py-2 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border border-indigo-200 rounded-full">
                        <span class="text-xs sm:text-sm font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">✨ Novidades toda semana</span>
                    </div>
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-gray-900 leading-tight">
                        Encontre os melhores <br class="hidden sm:block">
                        <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent drop-shadow-sm">achados da internet</span>
                    </h1>
                    <p class="mt-6 text-base sm:text-xl text-gray-600 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Curadoria exclusiva dos melhores produtos das maiores lojas online. Economize tempo e dinheiro com nossas seleções diárias.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        <a href="{{ route('products.index') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-black rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-xl shadow-indigo-200">
                            Explorar Produtos
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative">
                    <div class="grid grid-cols-2 gap-4 sm:gap-6 animate-float relative z-10 p-4">
                        @foreach($featuredProducts->take(4) as $product)
                            <div class="bg-white/80 backdrop-blur-sm p-2 sm:p-3 rounded-2xl sm:rounded-3xl shadow-xl shadow-indigo-500/10 transform rotate-{{ [3, -3, 6, -6][$loop->index] }} hover:rotate-0 transition-all duration-500 border border-white hover:scale-105">
                                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" class="rounded-xl sm:rounded-2xl h-24 w-24 sm:h-40 sm:w-40 object-cover mx-auto">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 sm:mb-28 relative z-30">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight">Navegue por Categorias</h2>
            <div class="mt-4 h-1.5 w-20 bg-indigo-600 mx-auto rounded-full"></div>
        </div>

        <!-- Desktop Grid (md and up) - Kept exactly as original -->
        <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group relative bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl shadow-sm hover:shadow-xl hover:shadow-indigo-100 border border-gray-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-50 p-3 sm:p-4 rounded-xl text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-bold text-gray-900 truncate">{{ $category->name }}</h3>
                            <p class="text-xs text-gray-500 font-semibold">{{ $category->products_count }} produtos</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Mobile Optimized Category Selector (sm and below) -->
        <div class="md:hidden relative" x-data="{ open: false }">
            <button 
                @click="open = !open" 
                class="w-full flex items-center justify-between px-6 py-5 bg-white border-2 border-indigo-50 rounded-[2rem] shadow-sm active:scale-[0.98] transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-500/10"
                :class="{ 'border-indigo-200 shadow-xl': open }"
            >
                <div class="flex items-center gap-4">
                    <div class="p-2.5 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-0.5">Explorar por</span>
                        <span class="block text-base font-bold text-gray-900 leading-none">Escolha uma Categoria</span>
                    </div>
                </div>
                <div class="text-indigo-600 transition-transform duration-300" :class="{ 'rotate-180': open }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </button>

            <!-- Mobile Dropdown Menu -->
            <div 
                x-show="open" 
                @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="absolute z-50 left-0 right-0 mt-3 bg-white border border-indigo-50 rounded-[2rem] shadow-2xl overflow-hidden max-h-[60vh] overflow-y-auto no-scrollbar"
                style="display: none;"
            >
                <div class="p-3 space-y-1.5">
                    <a href="{{ route('products.index') }}" class="flex items-center justify-between px-5 py-4 rounded-2xl bg-gray-50 hover:bg-indigo-50 transition-colors group">
                        <span class="font-bold text-gray-900 group-hover:text-indigo-600">Ver Todas</span>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                           class="flex items-center justify-between px-5 py-4 rounded-2xl hover:bg-indigo-50 transition-colors group border border-transparent hover:border-indigo-100">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900 group-hover:text-indigo-600">{{ $category->name }}</span>
                                <span class="text-xs font-semibold text-gray-400 group-hover:text-indigo-400">{{ $category->products_count }} produtos</span>
                            </div>
                            <div class="bg-indigo-50/50 p-2 rounded-xl group-hover:bg-white group-hover:text-indigo-600 text-indigo-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="bg-gray-50 py-16 sm:py-24 mb-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-baseline justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight">Destaques da Semana</h2>
                    <p class="mt-2 text-gray-500 font-medium">Os produtos mais desejados com preços imbatíveis.</p>
                </div>
                <a href="{{ route('products.index') }}" class="flex items-center text-indigo-600 font-black hover:text-indigo-700 transition-colors group">
                    Ver tudo
                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                @foreach($featuredProducts as $product)
                    <div class="group bg-white rounded-3xl p-4 sm:p-5 shadow-sm hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 border border-transparent hover:border-indigo-100">
                        <div class="relative mb-4 sm:mb-5">
                            <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden ring-1 ring-gray-100">
                                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <span class="absolute top-3 left-3 bg-indigo-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">Novo</span>
                        </div>
                        <h3 class="font-bold text-gray-900 line-clamp-1 mb-1">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-500 font-semibold mb-4">{{ $product->category->name }}</p>
                        
                        <div class="flex items-center justify-between mt-auto pt-2">
                            <div class="flex flex-col">
                                @if($product->hasPromotion())
                                    <span class="text-xs text-gray-400 line-through">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                    <span class="text-xl font-black text-indigo-600">R$ {{ number_format($product->promo_price, 2, ',', '.') }}</span>
                                @else
                                    <span class="text-xl font-black text-indigo-600">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="bg-indigo-600 text-white p-2.5 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Newsletter/CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 sm:mb-32">
        <div class="relative bg-indigo-600 rounded-[2rem] sm:rounded-[3rem] px-6 py-12 sm:p-16 text-center overflow-hidden shadow-2xl shadow-indigo-200">
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="relative z-10">
                <h2 class="text-3xl sm:text-5xl font-black text-white mb-6">Pronto para economizar?</h2>
                <p class="text-indigo-100 text-base sm:text-xl mb-10 max-w-2xl mx-auto font-medium">Explore todos os nossos produtos selecionados e encontre o que você precisa pelo melhor preço.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('products.index') }}" class="bg-white text-indigo-600 px-8 py-4 sm:px-10 rounded-2xl font-black text-lg hover:bg-indigo-50 transition-all transform hover:scale-105 active:scale-95">
                        Ver Ofertas
                    </a>
                    <a href="#" class="bg-indigo-500 text-white border-2 border-indigo-400 px-8 py-4 sm:px-10 rounded-2xl font-black text-lg hover:bg-indigo-400 transition-all">
                        Instagram
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
        .bg-grid-pattern {
            background-image: linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
@endsection
