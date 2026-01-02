@props([
    'padding' => 'p-6',
    'shadow' => 'shadow-xl',
])

<div {{ $attributes->merge(['class' => "bg-white/90 backdrop-blur-sm rounded-[2rem] border border-gray-100 {$shadow} shadow-gray-200/50 hover:shadow-2xl hover:shadow-indigo-300/40 transition-all duration-700 {$padding}"]) }}>
    {{ $slot }}
</div>
