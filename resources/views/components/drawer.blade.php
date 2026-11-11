@props([
    'name' => 'drawer',
    'title' => null,
    'side' => 'end', // start or end (RTL friendly)
    'width' => 'md',
])

@php
$widthClasses = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
][$width] ?? 'max-w-md';

$enterStartClass = $side === 'end' ? 'translate-x-full' : '-translate-x-full';
$leaveEndClass = $side === 'end' ? 'translate-x-full' : '-translate-x-full';
$positionClass = $side === 'end' ? 'end-0' : 'start-0';
@endphp

<div 
    x-data="{ show: false }"
    x-show="show"
    x-on:open-drawer.window="if ($event.detail === '{{ $name }}') show = true"
    x-on:close-drawer.window="if ($event.detail === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-cloak
    class="fixed inset-0 z-50 overflow-hidden font-arabic"
    role="dialog"
    aria-modal="true"
>
    <!-- Backdrop Blur -->
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-250"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
        @click="show = false"
    ></div>

    <!-- Slide-in Drawer Container -->
    <div 
        x-show="show" 
        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="{{ $enterStartClass }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="{{ $leaveEndClass }}"
        class="fixed inset-y-0 {{ $positionClass }} flex w-full {{ $widthClasses }} flex-col bg-[var(--surface)] border-s border-[var(--border)] shadow-2xl z-50 text-start"
    >
        <!-- Drawer Header -->
        <div class="flex items-center justify-between border-b border-[var(--border)] px-5 py-4 bg-[var(--surface-subtle)]">
            @if(isset($header))
                {{ $header }}
            @else
                <h3 class="text-base font-bold text-[var(--text)]">{{ $title ?? 'تفاصيل العنصر' }}</h3>
            @endif
            <button 
                type="button" 
                @click="show = false"
                class="rounded-lg p-1 text-[var(--text-muted)] hover:bg-[var(--surface-subtle)] hover:text-[var(--text-strong)] transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Drawer Body -->
        <div class="flex-1 overflow-y-auto p-5 sm:p-6 text-xs sm:text-sm text-[var(--text)]">
            {{ $slot }}
        </div>

        @if(isset($footer))
            <div class="border-t border-[var(--border)] px-5 py-3.5 bg-[var(--surface-subtle)] flex items-center justify-end gap-2.5">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

