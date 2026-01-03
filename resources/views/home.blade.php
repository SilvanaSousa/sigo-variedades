@extends('layouts.app')

@section('content')
    <!-- Hero Section with Gradient Background -->
    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 overflow-hidden mb-20">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-br from-pink-400/20 to-orange-400/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        
        <div class="max-w-7xl mx-auto relative">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <div class="inline-block mb-4 px-4 py-2 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 border border-indigo-200 rounded-full">
                            <span class="text-sm font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">✨ Novidades toda semana</span>
                        </div>
                        <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl">
                            <span class="block text-gray-900 xl:inline">Encontre os melhores</span>
                            <span class="block bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent xl:inline drop-shadow-sm">achados da internet</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 font-medium leading-relaxed">
                            Curadoria exclusiva dos melhores produtos das maiores lojas online. Economize tempo e dinheiro com nossas seleções diárias.
                        </p>
                        <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                            <a href="{{ route('products.index') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-base font-black rounded-2xl text-white bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 md:py-5 md:text-lg md:px-10 transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-2xl shadow-indigo-500/50 overflow-hidden">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-pink-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative flex items-center">
                                    Explorar Produtos
                                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full flex items-center justify-center p-12 relative">
                <div class="grid grid-cols-2 gap-6 animate-float relative z-10">
                    @foreach($featuredProducts->take(4) as $product)
                        <div class="bg-white/80 backdrop-blur-sm p-3 rounded-3xl shadow-2xl shadow-indigo-500/20 transform rotate-{{ [3, -3, 6, -6][$loop->index] }} hover:rotate-0 transition-all duration-500 border border-white/50 hover:shadow-indigo-500/40 hover:scale-110">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" class="rounded-2xl h-32 w-32 object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-28">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent tracking-tight">Navegue por Categorias</h2>
            <div class="mt-4 h-1.5 w-24 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mx-auto rounded-full shadow-lg shadow-indigo-300"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group relative bg-white/80 backdrop-blur-sm p-6 rounded-3xl shadow-xl shadow-gray-200 hover:shadow-2xl hover:shadow-indigo-300/50 border border-gray-100 hover:border-indigo-300 transition-all duration-500 transform hover:-translate-y-2">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-4 rounded-2xl text-indigo-600 group-hover:from-indigo-600 group-hover:to-purple-600 group-hover:text-white transition-all duration-300 shadow-lg shadow-indigo-200/50 group-hover:shadow-indigo-400/50 group-hover:scale-110">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        </div>
                        <div>
                            <h3 class="font-black text-gray-900 group-hover:bg-gradient-to-r group-hover:from-indigo-600 group-hover:to-purple-600 group-hover:bg-clip-text group-hover:text-transparent transition-all">{{ $category->name }}</h3>
                            <p class="text-xs text-gray-500 font-semibold">{{ $category->products_count }} produtos</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="relative bg-gradient-to-br from-gray-50 via-indigo-50/30 to-purple-50/30 py-28 mb-20 overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-end justify-between mb-16">
                <div>
                    <h2 class="text-5xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent tracking-tight">Destaques da Semana</h2>
                    <p class="mt-3 text-gray-600 font-semibold text-lg">Os produtos mais desejados com preços imbatíveis.</p>
                </div>
                <a href="{{ route('products.index') }}" class="hidden sm:flex items-center text-indigo-600 font-black hover:text-purple-600 transition-colors group">
                    Ver tudo
                    <svg class="ml-2 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="group bg-white rounded-[2rem] p-5 shadow-xl shadow-gray-200 hover:shadow-2xl hover:shadow-indigo-300/40 transition-all duration-700 border border-gray-100 hover:border-indigo-200 transform hover:-translate-y-3">
                        <div class="relative mb-5">
                            <div class="aspect-square bg-gradient-to-br from-gray-50 to-indigo-50 rounded-[1.5rem] overflow-hidden ring-1 ring-gray-100 group-hover:ring-indigo-200 transition-all">
                                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <span class="absolute top-3 left-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-lg shadow-indigo-400/50">Novo</span>
                        </div>
                        <h3 class="font-black text-gray-900 group-hover:bg-gradient-to-r group-hover:from-indigo-600 group-hover:to-purple-600 group-hover:bg-clip-text group-hover:text-transparent transition-colors line-clamp-1 mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 font-semibold line-clamp-1 mb-5">{{ $product->category->name }}</p>
                        <div class="flex flex-col justify-end min-h-[3.5rem]">
                            @if($product->hasPromotion())
                                <div class="flex items-baseline gap-2">
                                    <span class="text-sm text-gray-400 line-through font-medium">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                    @if($product->discountPercentage())
                                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">-{{ $product->discountPercentage() }}%</span>
                                    @endif
                                </div>
                                <span class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">R$ {{ number_format($product->promo_price, 2, ',', '.') }}</span>
                            @else
                                <span class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-end mt-2">
                            <a href="{{ route('products.show', $product) }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-3 rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-lg shadow-indigo-400/50 hover:shadow-purple-400/50 transform active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Newsletter/CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-32">
        <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-[3rem] p-16 text-center overflow-hidden shadow-2xl shadow-indigo-500/50">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yIDItNCAyLTRzMiAyIDIgNHYxMGMwIDItMiA0LTIgNHMtMi0yLTItNHYtMTB6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-20"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <h2 class="text-5xl font-black text-white mb-6 drop-shadow-lg">Pronto para economizar?</h2>
                <p class="text-white/90 text-xl mb-12 max-w-2xl mx-auto font-medium leading-relaxed">Explore todos os nossos produtos selecionados e encontre o que você precisa pelo melhor preço.</p>
                <div class="flex justify-center flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.index') }}" class="group bg-white text-indigo-600 px-12 py-5 rounded-2xl font-black text-lg shadow-2xl shadow-white/25 hover:shadow-white/40 hover:scale-105 transition-all duration-300 transform active:scale-95">
                        Ver todos os produtos
                        <svg class="inline-block ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#" class="bg-white/10 backdrop-blur-sm border-2 border-white text-white px-12 py-5 rounded-2xl font-black text-lg hover:bg-white/20 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95">
                        Seguir no Instagram
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .bg-grid-pattern {
            background-image: linear-gradient(rgba(99, 102, 241, 0.1) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99, 102, 241, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }
    </style>
@endsection
