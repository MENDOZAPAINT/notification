@props([
    'title' => 'Operación exitosa',
    'message' => 'La acción se completó correctamente.',
    'type' => 'success',
    'dismissible' => true,
    'duration' => null,
    'icon' => true,
    'rounded' => 'lg',
    'width' => 'full',
    'position' => 'bottom' // top, bottom
])

@php
    $types = [
        'success' => [
            'bg' => 'bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/60 dark:to-emerald-800/60',
            'icon' => 'text-emerald-500 dark:text-emerald-300',
            'title' => 'text-emerald-800 dark:text-emerald-100',
            'message' => 'text-emerald-700 dark:text-emerald-200',
            'button' => 'text-emerald-500 hover:bg-emerald-200/50 dark:text-emerald-300 dark:hover:bg-emerald-700/50',
            'border' => 'border-l-4 border-emerald-500 dark:border-emerald-400',
            'ring' => 'ring-1 ring-emerald-500/10 dark:ring-emerald-400/20',
            'path' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z'
        ],
        'warning' => [
            'bg' => 'bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/60 dark:to-amber-800/60',
            'icon' => 'text-amber-500 dark:text-amber-300',
            'title' => 'text-amber-800 dark:text-amber-100',
            'message' => 'text-amber-700 dark:text-amber-200',
            'button' => 'text-amber-500 hover:bg-amber-200/50 dark:text-amber-300 dark:hover:bg-amber-700/50',
            'border' => 'border-l-4 border-amber-500 dark:border-amber-400',
            'ring' => 'ring-1 ring-amber-500/10 dark:ring-amber-400/20',
            'path' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z'
        ],
        'info' => [
            'bg' => 'bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/60 dark:to-blue-800/60',
            'icon' => 'text-blue-500 dark:text-blue-300',
            'title' => 'text-blue-800 dark:text-blue-100',
            'message' => 'text-blue-700 dark:text-blue-200',
            'button' => 'text-blue-500 hover:bg-blue-200/50 dark:text-blue-300 dark:hover:bg-blue-700/50',
            'border' => 'border-l-4 border-blue-500 dark:border-blue-400',
            'ring' => 'ring-1 ring-blue-500/10 dark:ring-blue-400/20',
            'path' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z'
        ],
        'error' => [
            'bg' => 'bg-gradient-to-r from-rose-50 to-rose-100 dark:from-rose-900/60 dark:to-rose-800/60',
            'icon' => 'text-rose-500 dark:text-rose-300',
            'title' => 'text-rose-800 dark:text-rose-100',
            'message' => 'text-rose-700 dark:text-rose-200',
            'button' => 'text-rose-500 hover:bg-rose-200/50 dark:text-rose-300 dark:hover:bg-rose-700/50',
            'border' => 'border-l-4 border-rose-500 dark:border-rose-400',
            'ring' => 'ring-1 ring-rose-500/10 dark:ring-rose-400/20',
            'path' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z'
        ]
    ][$type];

    $roundedClasses = [
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full'
    ][$rounded] ?? 'rounded-lg';

    $isFloating = in_array($width, ['auto', 'sm', 'md', 'lg', 'xl', '2xl']);
    
    $widthClasses = [
        'full' => 'w-full',
        'auto' => 'w-auto',
        'sm' => 'w-full max-w-sm',
        'md' => 'w-full max-w-md',
        'lg' => 'w-full max-w-lg',
        'xl' => 'w-full max-w-xl',
        '2xl' => 'w-full max-w-2xl'
    ][$width] ?? 'w-full';

    $positionClasses = $isFloating 
        ? match($position) {
            'top' => 'fixed top-4 right-4 z-50 shadow-xl shadow-black/5 dark:shadow-black/20',
            default => 'fixed bottom-4 right-4 z-50 shadow-xl shadow-black/5 dark:shadow-black/20'
        }
        : '';

    $transitionClasses = match($position) {
        'top' => [
            'enter' => 'transform ease-out duration-300 transition',
            'enter-start' => '-translate-y-2 opacity-0',
            'enter-end' => 'translate-y-0 opacity-100',
            'leave' => 'transition ease-in duration-200',
            'leave-start' => 'opacity-100',
            'leave-end' => 'opacity-0 -translate-y-2'
        ],
        default => [
            'enter' => 'transform ease-out duration-300 transition',
            'enter-start' => 'translate-y-2 opacity-0',
            'enter-end' => 'translate-y-0 opacity-100',
            'leave' => 'transition ease-in duration-200',
            'leave-start' => 'opacity-100',
            'leave-end' => 'opacity-0 translate-y-2'
        ]
    };
@endphp

<div x-data="{ 
        show: true,
        init() {
            if ({{ $duration ?? 'null' }}) {
                setTimeout(() => this.show = false, {{ $duration }})
            }
        }
    }"
    x-show="show"
    x-transition:enter="{{ $transitionClasses['enter'] }}"
    x-transition:enter-start="{{ $transitionClasses['enter-start'] }}"
    x-transition:enter-end="{{ $transitionClasses['enter-end'] }}"
    x-transition:leave="{{ $transitionClasses['leave'] }}"
    x-transition:leave-start="{{ $transitionClasses['leave-start'] }}"
    x-transition:leave-end="{{ $transitionClasses['leave-end'] }}"
    {{ $attributes->merge(['class' => "{$widthClasses} {$types['bg']} {$roundedClasses} {$types['border']} {$types['ring']} backdrop-blur-sm p-4 {$positionClasses}"]) }}
    role="alert"
>
    <div class="flex items-start gap-4">
        @if($icon)
            <div class="flex-shrink-0">
                <div class="p-2 rounded-full bg-white/50 dark:bg-black/5 backdrop-blur-sm">
                    <svg class="w-5 h-5 {{ $types['icon'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="{{ $types['path'] }}" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        @endif

        <div class="flex-1 pt-[2px]">
            @if($title)
                <h3 class="text-sm font-semibold {{ $types['title'] }}">
                    {{ $title }}
                </h3>
            @endif

            <div class="text-sm {{ $types['message'] }} mt-1">
                {{ $message }}
            </div>

            @if($slot->isNotEmpty())
                <div class="mt-3 space-y-2">
                    {{ $slot }}
                </div>
            @endif
        </div>

        @if($dismissible)
            <div class="flex-shrink-0">
                <button
                    @click="show = false"
                    type="button"
                    class="rounded-lg p-1.5 {{ $types['button'] }} transition-colors duration-200"
                >
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>

{{--  
<x-notificacion type="info" title="Actualización disponible" message="Hay una nueva versión disponible del sistema."
    :duration="3000" width="sm" position="top" />


--}}

