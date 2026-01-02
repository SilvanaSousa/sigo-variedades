@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Editar Categoria</h1>
            <p class="mt-1 text-sm text-gray-500">Atualize as informações de <span class="font-semibold text-indigo-600">{{ $category->name }}</span>.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-xl shadow-gray-200/50 rounded-2xl overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome da Categoria</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" 
                            class="block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 placeholder-gray-400 sm:text-sm" 
                            placeholder="Ex: Eletrônicos, Calçados..." required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">Cancelar</a>
                        <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-lg shadow-indigo-200 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-95">
                            Atualizar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
