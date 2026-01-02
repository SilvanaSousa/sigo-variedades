@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'error' => null,
    'helper' => null,
])

<div class="space-y-2">
    <label for="{{ $name }}" class="block text-sm font-bold text-gray-700">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    
    @if($type === 'textarea')
        <textarea 
            name="{{ $name }}" 
            id="{{ $name }}"
            rows="4"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 placeholder-gray-400 sm:text-sm']) }}
            placeholder="{{ $placeholder }}"
        >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'block w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 text-gray-900 focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 placeholder-gray-400 sm:text-sm']) }}
            placeholder="{{ $placeholder }}"
        />
    @endif
    
    @if($helper)
        <p class="text-xs text-gray-500">{{ $helper }}</p>
    @endif
    
    @if($error)
        <p class="mt-2 text-sm text-red-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $error }}
        </p>
    @endif
</div>
