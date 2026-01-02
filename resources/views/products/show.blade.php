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
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-3xl p-8 mb-8 border border-indigo-100">
                            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Preço especial</p>
                            <p class="text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                        </div>

                        <!-- CTA Button -->
                        <x-button 
                            variant="primary" 
                            size="lg" 
                            href="{{ route('redirect', $product) }}" 
                            target="_blank"
                            class="w-full mb-6"
                        >
                            <svg class="-ml-1 mr-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Comprar agora
                            <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </x-button>

                        <p class="text-center text-sm text-gray-500 font-medium mb-12">
                            <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Você será redirecionado para o site oficial do vendedor
                        </p>

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
