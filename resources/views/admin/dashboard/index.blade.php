@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-black bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent">Dashboard</h1>
                <p class="mt-2 text-gray-600 font-medium">Acompanhe as métricas e desempenho da sua loja</p>
            </div>
        </div>

        <!-- 1. Stats Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <x-stat-card 
                title="Total de Visitas"
                :value="number_format($totalVisits, 0, ',', '.')"
            >
                <x-slot name="icon">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </x-slot>
            </x-stat-card>

            <x-stat-card 
                title="Visualizações"
                :value="number_format($totalProductViews, 0, ',', '.')"
            >
                <x-slot name="icon">
                    <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </x-slot>
            </x-stat-card>

            <x-stat-card 
                title="Cliques"
                :value="number_format($totalClicks, 0, ',', '.')"
            >
                <x-slot name="icon">
                    <svg class="w-8 h-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/>
                    </svg>
                </x-slot>
            </x-stat-card>

            <x-stat-card 
                title="CTR"
                :value="number_format($ctr, 2, ',', '.') . '%'"
            >
                <x-slot name="icon">
                    <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </x-slot>
            </x-stat-card>
        </div>

        <!-- 2. Daily Metrics Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Desempenho Diário (Últimos 7 dias)</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500">
                        <tr>
                            <th class="px-6 py-4">Data</th>
                            <th class="px-6 py-4">Visitas Únicas</th>
                            <th class="px-6 py-4">Visualizações</th>
                            <th class="px-6 py-4">Cliques</th>
                            <th class="px-6 py-4">CTR Diário</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($dailyMetrics as $metric)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $metric['date'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $metric['visits'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $metric['views'] }}</td>
                                <td class="px-6 py-4">{{ $metric['clicks'] }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $dailyCtr = $metric['views'] > 0 ? ($metric['clicks'] / $metric['views']) * 100 : 0;
                                    @endphp
                                    <span class="{{ $dailyCtr > 0 ? 'text-green-600 font-medium' : 'text-gray-400' }}">
                                        {{ number_format($dailyCtr, 1, ',', '.') }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Strategic Product Insights -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            
            <!-- A. High Performance (CTR) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-green-50 to-emerald-50/50">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-green-100 rounded-lg text-green-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Alta Conversão</h3>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 ml-11">Produtos que convertem muito bem</p>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($highCtrProducts as $product)
                                <tr class="group hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($product->image_url)
                                                <img src="{{ $product->image_url }}" class="h-8 w-8 rounded-lg object-cover" alt="">
                                            @else
                                                <div class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                            <span class="font-medium text-gray-700 truncate max-w-[120px]">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-700">
                                            {{ number_format($product->ctr, 1) }}%
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="px-4 py-4 text-center text-gray-500 text-xs">Dados insuficientes</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- B. Most Clicked -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50/50">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Mais Clicados</h3>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 ml-11">Produtos com maior volume de saída</p>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-gray-100">
                            @forelse($topClickedProducts as $product)
                                <tr class="group hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($product->image_url)
                                                <img src="{{ $product->image_url }}" class="h-8 w-8 rounded-lg object-cover" alt="">
                                            @else
                                                <div class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-700 truncate max-w-[120px]">{{ $product->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex flex-col items-end">
                                            <span class="font-bold text-gray-900">{{ $product->clicks_count }}</span>
                                            <span class="text-[10px] text-gray-400">cliques</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="px-4 py-4 text-center text-gray-500 text-xs">Sem cliques ainda</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- C. Opportunities (Low CTR) -->
            <div class="bg-white runounded-2xl shadow-sm border border-red-100 overflow-hidden flex flex-col ring-1 ring-red-50">
                <div class="p-6 border-b border-red-50 bg-gradient-to-r from-red-50 to-orange-50/50">
                    <div class="flex items-center gap-2">
                        <div class="p-2 bg-red-100 rounded-lg text-red-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-red-700">Atenção Necessária</h3>
                    </div>
                    <p class="text-xs text-red-500/80 mt-1 ml-11">Muitas views, poucos cliques</p>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <tbody class="divide-y divide-red-50">
                            @forelse($lowConversionProducts as $product)
                                <tr class="group hover:bg-red-50/50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            @if($product->image_url)
                                                <img src="{{ $product->image_url }}" class="h-8 w-8 rounded-lg object-cover grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all" alt="">
                                            @else
                                                <div class="h-8 w-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-700 truncate max-w-[120px]">{{ $product->name }}</span>
                                                <span class="text-[10px] text-gray-400">{{ $product->product_views_count }} views</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-bold bg-red-100 text-red-700">
                                            {{ number_format($product->ctr, 1) }}%
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="px-4 py-4 text-center text-gray-500 text-xs">Nenhum alerta crítico</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 4. Bottom Section (Actions & Reset) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- How it works / Actions -->
            <x-card>
                <div class="flex items-start space-x-4">
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-2xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">Ações rápidas</h3>
                        <div class="flex flex-wrap gap-3 mt-4">
                            <x-button variant="secondary" size="sm" href="{{ route('admin.products.create') }}">
                                + Novo Produto
                            </x-button>
                            <x-button variant="ghost" size="sm" href="{{ route('admin.categories.create') }}">
                                + Nova Categoria
                            </x-button>
                        </div>
                    </div>
                </div>
            </x-card>

            <!-- Danger Zone -->
            <x-card>
                <div class="flex items-start space-x-4">
                    <div class="bg-gradient-to-br from-red-50 to-rose-50 p-4 rounded-2xl">
                        <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-900 mb-2">Zona de Perigo</h3>
                        <p class="text-sm text-gray-600 mb-4">Resetar todas as métricas para validação.</p>
                        <form action="{{ route('admin.reset-metrics') }}" method="POST" onsubmit="return confirm('Tem certeza? Isso apagará todo o histórico de visitas, views e cliques.');">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 font-medium text-sm transition-colors duration-200 cursor-pointer">
                                Resetar Métricas
                            </button>
                        </form>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
@endsection
