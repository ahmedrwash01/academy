@props([
    'name' => 'modal',
    'title' => null,
    'maxWidth' => 'lg',
])

@php
$maxWidthClasses = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-lg';
@endphp

<div 
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 font-arabic"
    role="dialog"
    aria-modal="true"
>
    <!-- Backdrop Blur -->
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
        @click="show = false"
    ></div>

    <!-- Modal Box -->
    <div 
        x-show="show" 
        x-transition:enter="ease-out duration-250"
        x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
        class="relative mx-auto my-8 w-full {{ $maxWidthClasses }} rounded-2xl bg-[var(--surface)] border border-[var(--border)] shadow-2xl overflow-hidden text-start"
    >
        @if($title || isset($header))
            <div class="flex items-center justify-between border-b border-[var(--border)] px-5 py-4 bg-[var(--surface-subtle)]">
                @if(isset($header))
                    {{ $header }}
                @else
                    <h3 class="text-base font-bold text-[var(--text)]">{{ $title }}</h3>
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
        @endif

        <div class="p-5 sm:p-6 text-xs sm:text-sm text-[var(--text)]">
            {{ $slot }}
        </div>

        @if(isset($footer))
            <div class="flex items-center justify-end gap-2.5 border-t border-[var(--border)] px-5 py-3.5 bg-[var(--surface-subtle)]">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

