@extends('layouts.app')

@section('content')
    <div class="min-h-screen pb-24 bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20">
        <!-- Header & Search Section -->
        <div class="relative bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border-b border-indigo-400/20 mb-12 overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDM0YzAtMiAyLTQgMi00czIgMiAyIDR2MTBjMCAyLTIgNC0yIDRzLTItMi0yLTR2LTEweiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-5xl font-black text-white tracking-tight mb-4 drop-shadow-lg">Nossa Vitrine</h1>
                    <p class="text-white/90 font-semibold mb-10 text-lg">Encontre exatamente o que você procura entre nossas seleções exclusivas.</p>
                    
                    <form action="{{ route('products.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-7 w-7 text-gray-400 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}" 
                            class="block w-full pl-14 pr-4 py-5 bg-white/95 backdrop-blur-sm border-transparent rounded-3xl focus:bg-white focus:ring-4 focus:ring-white/30 focus:border-white transition-all duration-300 text-lg font-medium shadow-2xl shadow-indigo-900/20 placeholder-gray-400" 
                            placeholder="Pesquisar por nome do produto...">
                        
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        <button type="submit" class="absolute right-2 top-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-2xl font-black hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-xl shadow-indigo-500/50 hover:shadow-purple-500/50 transform active:scale-95">
                            Buscar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Filters Sidebar -->
                <div class="w-full lg:w-72 shrink-0">
                    <div class="bg-white/80 backdrop-blur-sm rounded-[2rem] p-8 border border-gray-100 shadow-2xl shadow-gray-200/50 sticky top-28">
                        <h2 class="text-xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Filtrar por
                        </h2>

                        <div class="space-y-8">
                            <div>
                                <h3 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-5">Categorias</h3>
                                <div class="space-y-2.5">
                                    <a href="{{ route('products.index', ['q' => request('q')]) }}" 
                                        class="flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-black transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-xl shadow-indigo-400/30 scale-105' : 'text-gray-600 hover:bg-gradient-to-r hover:from-gray-50 hover:to-indigo-50' }}">
                                        <span>Todas</span>
                                        <span class="px-2 py-0.5 rounded-lg text-xs {{ !request('category') ? 'bg-white/20' : 'bg-gray-100 text-gray-500' }}">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
                                    </a>
                                    @foreach($categories as $category)
                                        <a href="{{ route('products.index', ['category' => $category->id, 'q' => request('q')]) }}" 
                                            class="flex items-center justify-between px-4 py-3 rounded-2xl text-sm font-black transition-all duration-300 {{ request('category') == $category->id ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-xl shadow-indigo-400/30 scale-105' : 'text-gray-600 hover:bg-gradient-to-r hover:from-gray-50 hover:to-indigo-50' }}">
                                            <span class="truncate">{{ $category->name }}</span>
                                            <span class="px-2 py-0.5 rounded-lg text-xs shrink-0 ml-2 {{ request('category') == $category->id ? 'bg-white/20' : 'bg-gray-100 text-gray-500' }}">{{ $category->products_count ?? $category->products()->count() }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if(request()->anyFilled(['q', 'category']))
                            <div class="mt-10 pt-8 border-t border-gray-100">
                                <a href="{{ route('products.index') }}" class="flex items-center justify-center space-x-2 text-sm font-black text-red-500 hover:text-red-600 bg-red-50 hover:bg-red-100 px-4 py-3 rounded-2xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>Limpar filtros</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10">
                            @foreach($products as $product)
                                <div class="group bg-white/90 backdrop-blur-sm rounded-[2rem] p-6 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-indigo-300/40 transition-all duration-700 border border-gray-100 hover:border-indigo-200 transform hover:-translate-y-3">
                                    <div class="relative mb-5">
                                        <div class="aspect-square bg-gradient-to-br from-gray-50 to-indigo-50 rounded-[1.5rem] overflow-hidden ring-1 ring-gray-100 group-hover:ring-indigo-200 transition-all">
                                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" 
                                                alt="{{ $product->name }}" 
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                        </div>
                                    </div>
                                    <div class="px-2">
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
                                            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-black rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-lg shadow-indigo-400/50 hover:shadow-purple-400/50 transform active:scale-95">
                                                Detalhes
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-16">
                            {{ $products->links() }}
                        </div>
                    @else
                        <!-- Premium Empty State -->
                        <div class="bg-white/90 backdrop-blur-md rounded-[3rem] p-12 lg:p-16 text-center border border-white shadow-2xl shadow-indigo-200/50 relative overflow-hidden group">
                            <!-- Background Decor -->
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                            <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-100/50 rounded-full blur-3xl group-hover:bg-purple-200/50 transition-colors duration-1000"></div>
                            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-100/50 rounded-full blur-3xl group-hover:bg-indigo-200/50 transition-colors duration-1000"></div>

                            <div class="relative z-10">
                                <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 w-32 h-32 rounded-[2.5rem] flex items-center justify-center mx-auto mb-8 shadow-xl shadow-indigo-100 ring-4 ring-white transform group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-16 h-16 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                
                                <h3 class="text-3xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent mb-4">
                                    Ops! Nada por aqui...
                                </h3>
                                
                                <p class="text-gray-600 mb-8 max-w-md mx-auto font-medium text-lg leading-relaxed">
                                    Não encontramos produtos com esse termo. Que tal tentar algo diferente?
                                </p>

                                <div class="flex flex-wrap justify-center gap-3 mb-10">
                                    <span class="px-4 py-2 bg-gray-50 rounded-xl text-sm text-gray-500 border border-gray-100">Verifique a ortografia</span>
                                    <span class="px-4 py-2 bg-gray-50 rounded-xl text-sm text-gray-500 border border-gray-100">Use termos mais gerais</span>
                                    <span class="px-4 py-2 bg-gray-50 rounded-xl text-sm text-gray-500 border border-gray-100">Limpe os filtros</span>
                                </div>

                                <a href="{{ route('products.index') }}" class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-lg px-10 py-4 rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-xl shadow-indigo-400/40 hover:shadow-purple-400/50 transform hover:-translate-y-1 active:scale-95">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/>
                                    </svg>
                                    Ver todas as ofertas
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
