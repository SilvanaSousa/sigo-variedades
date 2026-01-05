@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-6 sm:mb-8 overflow-x-auto no-scrollbar">
                <ol class="flex items-center space-x-2 text-xs sm:text-sm whitespace-nowrap">
                    <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 font-bold transition-colors">Início</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('products.index') }}" class="text-gray-500 hover:text-indigo-600 font-bold transition-colors">Produtos</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-900 font-black truncate max-w-[150px] sm:max-w-none">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="bg-white rounded-3xl sm:rounded-[3rem] shadow-xl sm:shadow-2xl shadow-indigo-100 border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 p-6 sm:p-8 lg:p-12">
                    <!-- Product Image -->
                    <div class="lg:sticky lg:top-8 lg:self-start">
                        <div class="aspect-square rounded-2xl sm:rounded-[2rem] overflow-hidden bg-gray-50 ring-1 ring-gray-100 shadow-inner">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="mx-auto w-16 h-16 sm:w-24 sm:h-24 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mt-4 text-xs sm:text-sm text-gray-400 font-bold">Imagem não disponível</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="flex flex-col">
                        <!-- Category Badge -->
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-indigo-50 text-indigo-600 border border-indigo-100 uppercase tracking-widest">
                                {{ $product->category->name }}
                            </span>
                        </div>
                        
                        <!-- Product Name -->
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gray-900 leading-tight mb-6">
                            {{ $product->name }}
                        </h1>

                        <!-- Short Description -->
                        @if($product->short_description)
                            <p class="text-base sm:text-lg text-gray-600 font-medium leading-relaxed mb-8">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <!-- Price -->
                        <div class="bg-indigo-600 rounded-3xl p-6 sm:p-8 mb-8 text-white shadow-xl shadow-indigo-200 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                            
                            @if($product->hasPromotion())
                                <div class="flex items-baseline gap-2 mb-1 opacity-80">
                                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider">De:</span>
                                    <span class="text-lg sm:text-xl line-through font-bold text-indigo-200">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <p class="text-4xl sm:text-5xl font-black">
                                        R$ {{ number_format($product->promo_price, 2, ',', '.') }}
                                    </p>
                                    @if($product->discountPercentage())
                                        <span class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-lg text-sm font-black border border-white/30">
                                            -{{ $product->discountPercentage() }}%
                                        </span>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs sm:text-sm font-bold uppercase tracking-widest opacity-80 mb-2 block">Preço Imperdível</span>
                                <p class="text-4xl sm:text-5xl font-black">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <!-- CTA Button -->
                        <a href="{{ route('redirect', $product) }}" 
                           target="_blank"
                           class="group w-full flex items-center justify-center space-x-3 bg-gray-900 text-white py-5 rounded-2xl font-black text-lg sm:text-xl hover:bg-indigo-600 transition-all duration-300 shadow-xl shadow-gray-200 transform active:scale-95 mb-4"
                        >
                            <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Comprar agora</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>

                        <div class="bg-gray-50 rounded-2xl p-4 mb-10 flex items-start gap-3 border border-gray-100 transition-all hover:bg-indigo-50/50">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-xs sm:text-sm text-gray-500 font-bold leading-relaxed">
                                Redirecionamento seguro para a plataforma oficial do vendedor.
                            </p>
                        </div>

                        <!-- Description -->
                        @if($product->description)
                            <div class="border-t border-gray-100 pt-8 sm:pt-10">
                                <h2 class="text-xl sm:text-2xl font-black text-gray-900 mb-6 flex items-center italic">
                                    <span class="w-2 h-8 bg-indigo-600 rounded-full mr-4"></span>
                                    Descrição Completa
                                </h2>
                                <div class="prose prose-indigo max-w-none text-gray-600 font-medium leading-relaxed">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        @endif

                        <!-- Trust Signals -->
                        <div class="mt-12 pt-10 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="flex flex-col items-center text-center group">
                                <div class="bg-indigo-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Verificado</p>
                            </div>
                            <div class="flex flex-col items-center text-center group">
                                <div class="bg-indigo-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Compra Segura</p>
                            </div>
                            <div class="flex flex-col items-center text-center group">
                                <div class="bg-indigo-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Entrega Rápida</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-500 hover:text-indigo-600 font-black text-sm transition-all group">
                    <svg class="mr-2 w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Voltar para a vitrine
                </a>
            </div>
        </div>
    </div>
    
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection
