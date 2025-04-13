
@props([
    'type' => 'button',
    'href' => null,
    'method' => 'GET',
    'confirm' => null,
    'color' => 'blue',
    'size' => 'md',
])

@php
    // Define color classes
    $colors = [
        'blue' => [
            'base' => 'bg-blue-600 hover:bg-blue-700',
            'light' => 'bg-blue-400 hover:bg-blue-500',
        ],
        'red' => [
            'base' => 'bg-red-600 hover:bg-red-700',
        ],
        'green' => [
            'base' => 'bg-green-600 hover:bg-green-700',
        ],
        'gray' => [
            'base' => 'bg-gray-600 hover:bg-gray-700',
        ],
    ];
    
    // Define size classes
    $sizes = [
        'xs' => 'px-4 py-1 text-xs',
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-2 text-base',
        'lg' => 'px-8 py-3 text-lg',
    ];
    
    $baseClasses = 'inline-block font-medium text-white rounded focus:outline-none';
    $colorClass = $colors[$color]['base'] ?? $colors['blue']['base'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

@if($href)
    @if($method === 'GET')
        <a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClasses $colorClass $sizeClass"]) }}>
            {{ $slot }}
        </a>
    @else
        <form action="{{ $href }}" method="POST" class="inline">
            @csrf
            @method($method)
            <button type="submit" 
                    {{ $attributes->merge(['class' => "$baseClasses $colorClass $sizeClass"]) }}
                    @if($confirm) onclick="return confirm('{{ $confirm }}')" @endif>
                {{ $slot }}
            </button>
        </form>
    @endif
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $colorClass $sizeClass"]) }}>
        {{ $slot }}
    </button>
@endif