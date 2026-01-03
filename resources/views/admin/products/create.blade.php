@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent">Novo Produto</h1>
            <p class="mt-2 text-gray-600 font-medium">Adicione um novo produto à sua loja</p>
        </div>
        <x-button variant="secondary" href="{{ route('admin.products.index') }}">
            <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </x-button>
    </div>

    <div class="max-w-4xl">
        <x-card>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-form-input
                            label="Nome do Produto"
                            name="name"
                            :value="old('name')"
                            placeholder="Ex: Smartphone XYZ Pro"
                            :required="true"
                            :error="$errors->first('name')"
                        />
                    </div>

                    <x-form-input
                        label="Preço"
                        name="price"
                        type="number"
                        step="0.01"
                        :value="old('price')"
                        placeholder="0.00"
                        :required="true"
                        :error="$errors->first('price')"
                        helper="Informe o preço em reais"
                    />

                    <div class="space-y-2">
                        <label for="category_id" class="block text-sm font-bold text-gray-700">
                            Categoria <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="category_id" 
                            id="category_id"
                            required
                            class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 sm:text-sm"
                        >
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    </div>
                </div>

                <!-- Promotion Section -->
                <div x-data="{ isOnSale: {{ old('is_on_sale') ? 'true' : 'false' }} }" class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <label for="is_on_sale" class="block text-sm font-bold text-gray-900">Produto em Promoção?</label>
                            <p class="text-xs text-gray-500 mt-1">Habilita o preço promocional para este produto</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="is_on_sale" 
                                id="is_on_sale" 
                                value="1" 
                                x-model="isOnSale"
                                class="sr-only peer"
                            >
                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div x-show="isOnSale" x-transition class="mt-4">
                        <x-form-input
                            label="Preço Promocional"
                            name="promo_price"
                            type="number"
                            step="0.01"
                            :value="old('promo_price')"
                            placeholder="0.00"
                            helper="Deve ser menor que o preço original"
                            class="bg-white border-purple-200 focus:border-purple-500 focus:ring-purple-500/10"
                        />
                    </div>
                </div>

                <x-form-input
                    label="URL de Afiliado"
                    name="affiliate_url"
                    type="url"
                    :value="old('affiliate_url')"
                    placeholder="https://..."
                    :required="true"
                    :error="$errors->first('affiliate_url')"
                    helper="Link para onde o cliente será redirecionado"
                />

                <x-form-input
                    label="Descrição Curta"
                    name="short_description"
                    type="textarea"
                    :value="old('short_description')"
                    placeholder="Resumo do produto"
                    :error="$errors->first('short_description')"
                />

                <x-form-input
                    label="Descrição Completa"
                    name="description"
                    type="textarea"
                    :value="old('description')"
                    placeholder="Descrição detalhada do produto"
                    :error="$errors->first('description')"
                />

                <div class="space-y-2">
                    <label for="image" class="block text-sm font-bold text-gray-700">Imagem do Produto</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image"
                        accept="image/*"
                        class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 sm:text-sm"
                    />
                    @error('image')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status Toggle -->
                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl border border-gray-200">
                    <div>
                        <label for="is_active" class="block text-sm font-bold text-gray-900">Produto Ativo</label>
                        <p class="text-xs text-gray-500 mt-1">O produto estará visível no site público</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-indigo-600 peer-checked:to-purple-600"></div>
                    </label>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" href="{{ route('admin.products.index') }}">
                        Cancelar
                    </x-button>
                    <x-button variant="primary" type="submit">
                        <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Salvar Produto
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
