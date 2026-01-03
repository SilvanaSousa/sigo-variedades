@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent">Editar Categoria</h1>
            <p class="mt-2 text-gray-600 font-medium">Atualize as informações de <span class="font-bold text-indigo-600">{{ $category->name }}</span></p>
        </div>
        <x-button variant="secondary" href="{{ route('admin.categories.index') }}">
            <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </x-button>
    </div>

    <div class="max-w-2xl">
        <x-card>
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <x-form-input
                    label="Nome da Categoria"
                    name="name"
                    :value="old('name', $category->name)"
                    placeholder="Ex: Eletrônicos, Calçados..."
                    :required="true"
                    :error="$errors->first('name')"
                    helper="O slug será atualizado automaticamente"
                />

                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" href="{{ route('admin.categories.index') }}">
                        Cancelar
                    </x-button>
                    <x-button variant="primary" type="submit">
                        <svg class="-ml-1 mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Atualizar Categoria
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
