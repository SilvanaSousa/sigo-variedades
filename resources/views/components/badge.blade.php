@props([
    'variant' => 'default',
])

@php
$variants = [
    'default' => 'bg-gray-100 text-gray-700',
    'success' => 'bg-green-100 text-green-700',
    'warning' => 'bg-yellow-100 text-yellow-700',
    'danger' => 'bg-red-100 text-red-700',
    'info' => 'bg-blue-100 text-blue-700',
    'primary' => 'bg-gradient-to-r from-indigo-500 to-purple-500 text-white',
];

$classes = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold ' . $variants[$variant];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
