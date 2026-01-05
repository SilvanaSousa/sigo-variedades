@extends('layouts.app')

@section('content')
    <div class="min-h-screen pb-12 sm:pb-24 bg-gray-50">
        <!-- Header & Search Section -->
        <div class="relative bg-indigo-600 py-12 sm:py-20 overflow-hidden">
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight mb-4">Nossa Vitrine</h1>
                    <p class="text-indigo-100 font-medium mb-10 sm:text-lg">Encontre os melhores achados selecionados para você.</p>
                    
                    <form action="{{ route('products.index') }}" method="GET" class="relative max-w-2xl mx-auto">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400 group-focus-within:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}" 
                                class="block w-full pl-14 pr-24 sm:pr-32 py-4 sm:py-5 bg-white border-transparent rounded-2xl sm:rounded-3xl focus:ring-4 focus:ring-indigo-500/20 transition-all text-base sm:text-lg font-bold placeholder-gray-400 shadow-2xl shadow-indigo-900/10" 
                                placeholder="O que você procura?">
                            
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif

                            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-indigo-600 text-white px-4 sm:px-8 rounded-xl sm:rounded-2xl font-black hover:bg-indigo-700 transition-all text-sm sm:text-base">
                                <span class="hidden sm:inline">Buscar</span>
                                <svg class="sm:hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 sm:mt-12">
            <div class="flex flex-col lg:flex-row gap-8 sm:gap-12">
                <!-- Filters Section -->
                <div class="w-full lg:w-64 shrink-0">
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm sticky top-28">
                        <h2 class="text-sm font-black text-gray-400 uppercase tracking-widest mb-6">Categorias</h2>
                        <div class="flex flex-row lg:flex-col gap-2 overflow-x-auto pb-4 lg:pb-0 lg:overflow-x-visible no-scrollbar">
                            <a href="{{ route('products.index', ['q' => request('q')]) }}" 
                                class="whitespace-nowrap flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-600 hover:bg-gray-50' }}">
                                <span>Todas</span>
                                <span class="hidden lg:inline ml-2 px-2 py-0.5 rounded-lg text-xs {{ !request('category') ? 'bg-white/20' : 'bg-gray-100' }}">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->id, 'q' => request('q')]) }}" 
                                    class="whitespace-nowrap flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request('category') == $category->id ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-gray-600 hover:bg-gray-50' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="hidden lg:inline ml-2 px-2 py-0.5 rounded-lg text-xs {{ request('category') == $category->id ? 'bg-white/20' : 'bg-gray-100' }}">{{ $category->products_count ?? $category->products()->count() }}</span>
                                </a>
                            @endforeach
                        </div>

                        @if(request()->anyFilled(['q', 'category']))
                            <div class="mt-8 pt-6 border-t border-gray-100 hidden lg:block">
                                <a href="{{ route('products.index') }}" class="flex items-center justify-center space-x-2 text-sm font-black text-red-500 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    <span>Limpar Filtros</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8">
                            @foreach($products as $product)
                                <div class="group bg-white rounded-3xl p-5 shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-500 border border-gray-100 transform hover:-translate-y-2">
                                    <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden mb-5">
                                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://via.placeholder.com/300' }}" 
                                            alt="{{ $product->name }}" 
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    </div>
                                    <h3 class="font-bold text-gray-900 line-clamp-1 mb-1">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500 font-semibold mb-6 uppercase tracking-wider">{{ $product->category->name }}</p>
                                    
                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="flex flex-col">
                                            @if($product->hasPromotion())
                                                <span class="text-xs text-gray-400 line-through">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                                <span class="text-xl font-black text-indigo-600">R$ {{ number_format($product->promo_price, 2, ',', '.') }}</span>
                                            @else
                                                <span class="text-xl font-black text-indigo-600">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $product) }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-black text-xs hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                            Detalhes
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-16">
                            {{ $products->links() }}
                        </div>
                    @else
                        <!-- Premium Empty State -->
                        <div class="bg-white rounded-[2rem] p-12 sm:p-20 text-center border border-gray-100 shadow-xl">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-4">Nenhum produto encontrado</h3>
                            <p class="text-gray-500 mb-10 max-w-sm mx-auto font-medium">Tente usar outros termos de pesquisa ou limpe os filtros para ver mais produtos.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center bg-indigo-600 text-white font-black px-10 py-4 rounded-2xl hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 transform active:scale-95">
                                Ver todas as ofertas
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-grid-pattern {
            background-image: linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
@endsection
