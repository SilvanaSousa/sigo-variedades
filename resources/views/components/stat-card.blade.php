@props([
    'title',
    'value',
    'icon' => null,
    'trend' => null,
    'trendUp' => true,
])

<div class="bg-white/90 backdrop-blur-sm rounded-[2rem] p-8 shadow-xl shadow-gray-200/50 border border-gray-100 hover:shadow-2xl hover:shadow-indigo-300/40 transition-all duration-500 hover:-translate-y-1">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ $title }}</p>
            <p class="mt-3 text-4xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                {{ $value }}
            </p>
            
            @if($trend)
                <div class="mt-4 flex items-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $trendUp ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        @if($trendUp)
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        @else
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        @endif
                        {{ $trend }}
                    </span>
                </div>
            @endif
        </div>
        
        @if($icon)
            <div class="ml-6 bg-gradient-to-br from-indigo-50 to-purple-50 p-4 rounded-2xl">
                {!! $icon !!}
            </div>
        @endif
    </div>
</div>
