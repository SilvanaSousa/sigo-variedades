<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Visits -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <span class="text-2xl">👀</span>
                    </div>
                    <div class="ml-4">
                        <p class="mb-2 text-sm font-medium text-gray-600">Total Visitas</p>
                        <p class="text-lg font-semibold text-gray-700">{{ number_format($totalVisits) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Views -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <span class="text-2xl">👁️</span>
                    </div>
                    <div class="ml-4">
                        <p class="mb-2 text-sm font-medium text-gray-600">Visualizações</p>
                        <p class="text-lg font-semibold text-gray-700">{{ number_format($totalViews) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clicks -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <span class="text-2xl">👆</span>
                    </div>
                    <div class="ml-4">
                        <p class="mb-2 text-sm font-medium text-gray-600">Clicks "Comprar"</p>
                        <p class="text-lg font-semibold text-gray-700">{{ number_format($totalClicks) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTR -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <span class="text-2xl">📈</span>
                    </div>
                    <div class="ml-4">
                        <p class="mb-2 text-sm font-medium text-gray-600">CTR</p>
                        <p class="text-lg font-semibold text-gray-700">{{ $ctr }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
