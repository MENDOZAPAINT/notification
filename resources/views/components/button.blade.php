{{-- resources/views/components/button.blade.php --}}
@props([
    'count'=>0,
    'size' => 'md',
    'color' => '#2196F3',
])

@php
    $sizes = [
        'sm' => 20,
        'md' => 24,
        'lg' => 32,
    ];
    
    $actualSize = $sizes[$size] ?? $sizes['md'];
    $badgeSize = $actualSize * 0.4;
    $fontSize = $badgeSize * 0.6;
@endphp

<div class="relative inline-block">
    <svg xmlns="http://www.w3.org/2000/svg" width="{{ $actualSize }}" height="{{ $actualSize }}" viewBox="0 0 24 24">
        <!-- Bell Shape -->
        <path fill="{{ $color }}"
            d="M12 3.5c-3.3 0-6 2.7-6 6v4.8l-1.7 1.7c-.4.4-.6.9-.3 1.5.3.5.8.8 1.4.8h13.2c.6 0 1.1-.3 1.4-.8.3-.5.1-1.1-.3-1.5L18 14.3V9.5c0-3.3-2.7-6-6-6z" />
        <path fill="{{ $color }}" d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z" />
        
        <!-- Notification Badge -->
        <circle cx="17" cy="7" r="5" fill="#f44336" />
        <text x="17" y="8.5" text-anchor="middle" fill="white" font-size="6" font-family="Arial, sans-serif"
            font-weight="bold">{{ $count }}</text>
    </svg>
</div>