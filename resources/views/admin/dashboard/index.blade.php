@extends('layouts.admin')

@section('content')
<div class="mb-6 focus:outline-none">
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
</div>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Visits -->
    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total de Visitas</dt>
                        <dd class="text-lg font-bold text-gray-900">{{ number_format($totalVisits, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Views -->
    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Visualizações de Produtos</dt>
                        <dd class="text-lg font-bold text-gray-900">{{ number_format($totalProductViews, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Clicks -->
    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Cliques de Afiliados</dt>
                        <dd class="text-lg font-bold text-gray-900">{{ number_format($totalClicks, 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- CTR -->
    <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Taxa de Clique (CTR)</dt>
                        <dd class="text-lg font-bold text-gray-900">{{ number_format($ctr, 2, ',', '.') }}%</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white shadow rounded-lg border border-gray-100 p-6">
    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informações do Sistema</h3>
    <p class="text-gray-600">Este é o painel de controle do SIGO Variedades. Aqui você pode acompanhar o desempenho das suas ofertas e cliques de afiliados em tempo real.</p>
</div>
@endsection
