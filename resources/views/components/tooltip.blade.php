@props([
    'text' => '',
    'position' => 'top',
])

@php
$posClasses = [
    'top' => 'bottom-full start-1/2 -translate-x-1/2 mb-2',
    'bottom' => 'top-full start-1/2 -translate-x-1/2 mt-2',
    'start' => 'end-full top-1/2 -translate-y-1/2 me-2',
    'end' => 'start-full top-1/2 -translate-y-1/2 ms-2',
][$position] ?? 'bottom-full start-1/2 -translate-x-1/2 mb-2';
@endphp

<div class="relative inline-flex group" x-data="{ tooltip: false }">
    <div @mouseenter="tooltip = true" @mouseleave="tooltip = false" @focus="tooltip = true" @blur="tooltip = false">
        {{ $slot }}
    </div>

    <div 
        x-show="tooltip" 
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="pointer-events-none absolute {{ $posClasses }} z-50 whitespace-nowrap rounded-md bg-[#111214] dark:bg-black px-2.5 py-1 text-[11px] font-medium text-white shadow-xl border border-white/10 font-arabic"
    >
        {{ $text }}
    </div>
</div>

