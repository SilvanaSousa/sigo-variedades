@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Editar Produto</h1>
            <p class="mt-1 text-sm text-gray-500">Atualize as informações de <span class="font-semibold text-indigo-600">{{ $product->name }}</span>.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome do Produto</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" 
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 placeholder-gray-400 sm:text-sm" 
                                placeholder="Ex: Smartphone XYZ Pro" required>
                            @error('name') <p class="mt-2 text-sm text-red-600 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
                            <div class="relative">
                                <select id="category_id" name="category_id" 
                                    class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm appearance-none cursor-pointer">
                                    <option value="">Selecione uma categoria...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Preço (R$)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">R$</div>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" 
                                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm" 
                                    placeholder="0,00" required>
                            </div>
                            @error('price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Imagem do Produto</label>
                            
                            @if($product->image_path)
                                <div class="mb-4 flex items-center space-x-4 p-4 rounded-xl border border-gray-100 bg-gray-50/50">
                                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="Imagem Atual" class="h-20 w-20 object-cover rounded-lg shadow-sm">
                                    <span class="text-xs text-gray-500">Imagem atual do produto</span>
                                </div>
                            @endif

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-2xl bg-gray-50 transition-all duration-200 hover:bg-gray-100/50">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 text-center justify-center">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 transition-all duration-200">
                                            <span>Substituir arquivo</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF até 2MB</p>
                                </div>
                            </div>
                            @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="affiliate_url" class="block text-sm font-semibold text-gray-700 mb-2">Link de Afiliado</label>
                            <input type="url" name="affiliate_url" id="affiliate_url" value="{{ old('affiliate_url', $product->affiliate_url) }}" 
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm" 
                                placeholder="https://shopee.com.br/exemplo" required>
                            @error('affiliate_url') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">Descrição Curta</label>
                            <textarea name="short_description" id="short_description" rows="2" 
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm" 
                                placeholder="Uma breve introdução sobre o produto...">{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Descrição Completa</label>
                            <textarea name="description" id="description" rows="5" 
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm" 
                                placeholder="Detalhes completos sobre o produto, benefícios, ficha técnica...">{{ old('description', $product->description) }}</textarea>
                            @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="inline-flex items-center cursor-pointer group">
                                <div class="relative">
                                    <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="sr-only">
                                    <div class="block bg-gray-200 w-12 h-7 rounded-full shadow-inner transition-colors duration-200 group-hover:bg-gray-300"></div>
                                    <div class="dot absolute left-1 top-1 bg-white w-5 h-5 rounded-full shadow-md transition-transform duration-200 transform"></div>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm font-semibold text-gray-700">Produto Ativo</span>
                                    <p class="text-xs text-gray-500">Este produto ficará visível publicamente na loja.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">Cancelar</a>
                        <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-lg shadow-indigo-200 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-95">
                            Atualizar Produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        input:checked ~ .dot {
            transform: translateX(100%);
        }
        input:checked ~ .block {
            background-color: #4F46E5;
        }
    </style>
@endsection
