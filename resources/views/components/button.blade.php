@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-black rounded-2xl transition-all duration-300 transform focus:outline-none focus:ring-4 focus:ring-offset-2 active:scale-95';

$variants = [
    'primary' => 'bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white shadow-xl shadow-indigo-400/50 hover:shadow-indigo-500/60 focus:ring-indigo-500',
    'secondary' => 'bg-white text-indigo-600 border-2 border-indigo-200 hover:border-indigo-300 hover:bg-indigo-50 shadow-lg shadow-gray-200 hover:shadow-xl focus:ring-indigo-500',
    'danger' => 'bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white shadow-xl shadow-red-400/50 hover:shadow-red-500/60 focus:ring-red-500',
    'ghost' => 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 focus:ring-gray-500',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
];

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
