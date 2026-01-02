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
                                        <div class="flex items-center justify-between">
                                            <span class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
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
                        <div class="bg-white/90 backdrop-blur-sm rounded-[3rem] p-16 text-center border-2 border-dashed border-gray-200 shadow-xl shadow-gray-200/50">
                            <div class="bg-gradient-to-br from-gray-50 to-indigo-50 w-24 h-24 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg shadow-gray-200">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <h3 class="text-2xl font-black bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent mb-3">Ops! Nenhum produto encontrado</h3>
                            <p class="text-gray-600 mb-10 max-w-sm mx-auto font-medium leading-relaxed">Não encontramos nenhum resultado para sua busca. Tente usar termos mais genéricos ou limpar os filtros.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black px-8 py-4 rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-xl shadow-indigo-400/50 transform hover:scale-105 active:scale-95">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Mostrar todos os produtos
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
