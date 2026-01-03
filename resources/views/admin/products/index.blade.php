@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent">Produtos</h1>
            <p class="mt-2 text-gray-600 font-medium">Gerencie todos os produtos da sua loja</p>
        </div>
        <x-button variant="primary" href="{{ route('admin.products.create') }}">
            <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Novo Produto
        </x-button>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-indigo-50">
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-gray-700 uppercase tracking-wider">Imagem</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-gray-700 uppercase tracking-wider">Produto</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-gray-700 uppercase tracking-wider">Categoria</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-gray-700 uppercase tracking-wider">Preço</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-gray-700 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-gray-700 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 transition-all duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="h-16 w-16 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-indigo-50 ring-1 ring-gray-200">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500 line-clamp-1">{{ $product->short_description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-badge variant="info">
                                    {{ $product->category->name }}
                                </x-badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-badge :variant="$product->is_active ? 'success' : 'danger'">
                                    {{ $product->is_active ? 'Ativo' : 'Inativo' }}
                                </x-badge>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <x-button variant="ghost" size="sm" href="{{ route('admin.products.edit', $product) }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </x-button>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja realmente excluir este produto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-2 text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-gradient-to-br from-gray-50 to-indigo-50 w-20 h-20 rounded-3xl flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Nenhum produto cadastrado</p>
                                    <x-button variant="primary" size="sm" href="{{ route('admin.products.create') }}" class="mt-4">
                                        Criar primeiro produto
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="border-t border-gray-100 px-6 py-4 mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </x-card>
@endsection
