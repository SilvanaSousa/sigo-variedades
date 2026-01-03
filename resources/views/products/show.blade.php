@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-indigo-50/20 to-purple-50/20 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 font-medium transition-colors">Início</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('products.index') }}" class="text-gray-500 hover:text-indigo-600 font-medium transition-colors">Produtos</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-900 font-semibold truncate">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="bg-white/90 backdrop-blur-sm rounded-[3rem] shadow-2xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 p-8 lg:p-12">
                    <!-- Product Image -->
                    <div class="lg:sticky lg:top-8 lg:self-start">
                        <div class="aspect-square rounded-[2rem] overflow-hidden bg-gradient-to-br from-gray-50 to-indigo-50 ring-1 ring-gray-200 shadow-xl">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="mx-auto w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mt-4 text-sm text-gray-400 font-medium">Imagem não disponível</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="mt-10 lg:mt-0">
                        <!-- Category Badge -->
                        <x-badge variant="primary" class="mb-4">
                            {{ $product->category->name }}
                        </x-badge>
                        
                        <!-- Product Name -->
                        <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent leading-tight mb-6">
                            {{ $product->name }}
                        </h1>

                        <!-- Short Description -->
                        @if($product->short_description)
                            <p class="text-lg text-gray-600 font-medium leading-relaxed mb-8">
                                {{ $product->short_description }}
                            </p>
                        @endif

                        <!-- Price -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-3xl p-8 mb-8 border border-indigo-100 relative overflow-hidden group">
                            @if($product->hasPromotion())
                                <div class="absolute top-0 right-0 bg-gradient-to-r from-pink-500 to-red-500 text-white px-6 py-1.5 rounded-bl-3xl font-black text-sm shadow-lg tracking-wider transform translate-x-2 -translate-y-2 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform duration-300">
                                    PROMOÇÃO
                                </div>
                                <div class="flex items-baseline gap-3 mb-1">
                                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">De:</p>
                                    <p class="text-xl text-gray-400 line-through font-medium">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <p class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        R$ {{ number_format($product->promo_price, 2, ',', '.') }}
                                    </p>
                                    @if($product->discountPercentage())
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-black border border-green-200">
                                            -{{ $product->discountPercentage() }}%
                                        </span>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Preço especial</p>
                                <p class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </p>
                            @endif
                        </div>

                        <!-- CTA Button -->
                        <!-- CTA Button -->
                        <x-button 
                            variant="primary" 
                            size="lg" 
                            href="{{ route('redirect', $product) }}" 
                            target="_blank"
                            class="w-full mb-4 shadow-xl hover:shadow-2xl hover:-translate-y-1 active:translate-y-0 active:opacity-90 transition-all duration-300 group"
                        >
                            <svg class="-ml-1 mr-3 w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span class="text-xl font-bold tracking-wide">Comprar agora</span>
                            <svg class="ml-2 w-5 h-5 opacity-70 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </x-button>

                        <div class="bg-indigo-50/50 rounded-xl p-4 mb-12 border border-indigo-100 flex items-start gap-3">
                            <svg class="w-5 h-5 text-indigo-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm text-indigo-900/70 font-medium leading-relaxed">
                                Você será redirecionado para o site oficial do vendedor com segurança garantida.
                            </p>
                        </div>

                        <!-- Product Description -->
                        @if($product->description)
                            <div class="border-t border-gray-200 pt-10">
                                <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Descrição do produto
                                </h2>
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Trust Signals -->
                        <div class="mt-12 grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="bg-green-100 w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-gray-700">Produto Verificado</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-100 w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-gray-700">Compra Segura</p>
                            </div>
                            <div class="text-center">
                                <div class="bg-purple-100 w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-gray-700">Envio Rápido</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-12 text-center">
                <x-button variant="secondary" href="{{ route('products.index') }}">
                    <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar para produtos
                </x-button>
            </div>
        </div>
    </div>
@endsection
