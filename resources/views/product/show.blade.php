<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-500 ml-4">{{ $product->category->name }}</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-900 font-medium ml-4 truncate max-w-xs">{{ $product->name }}</span>
                    </li>
                </ol>
            </nav>

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                <!-- Product Image -->
                <div class="aspect-w-4 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden flex items-center justify-center shadow-lg">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                    @else
                        <span class="text-9xl text-gray-400">📷</span>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $product->name }}</h1>
                    
                    <div class="mt-4">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <p class="text-3xl text-gray-900">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 space-y-6">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <div class="mt-10 flex">
                        <a href="{{ route('products.go', $product) }}" target="_blank" rel="noopener noreferrer" class="max-w-xs flex-1 bg-green-600 border border-transparent rounded-md py-4 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-green-500 sm:w-full transition-transform transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                            <span class="mr-2">🛒</span> Comprar Agora
                        </a>
                    </div>
                    
                    <p class="mt-4 text-sm text-gray-500 text-center sm:text-left">
                        Você será redirecionado para a loja parceira com segurança.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
