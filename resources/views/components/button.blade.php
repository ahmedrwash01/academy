@props([
    'variant' => 'primary', // 'primary', 'secondary', 'dark', 'ghost', 'danger'
    'size' => 'md', // 'sm', 'md', 'lg'
    'icon' => null,
    'iconEnd' => null,
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-bold font-arabic rounded-xl transition-all duration-150 select-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-[0.98] disabled:opacity-50 disabled:pointer-events-none ';

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-xs gap-1.5 shadow-2xs ',
    'lg' => 'px-5 py-2.5 text-sm sm:text-base gap-2.5 shadow-sm ',
    default => 'px-4 py-2 text-xs sm:text-sm gap-2 shadow-2xs ',
};

$variantClasses = match($variant) {
    'primary' => 'bg-[#E3131B] hover:bg-[#c00f16] text-white focus:ring-[#E3131B]/50 shadow-xs ',
    'secondary' => 'border border-[var(--border-default)] bg-[var(--bg-surface)] hover:bg-[var(--bg-surface-subtle)] text-[var(--text-primary)] focus:ring-gray-300 ',
    'dark' => 'bg-[var(--text-strong)] hover:opacity-90 text-[var(--surface)] focus:ring-black shadow-xs ',
    'ghost' => 'text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-surface-subtle)] ',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500 shadow-xs ',
    default => 'bg-[#E3131B] text-white '
};

$classes = $baseClasses . $sizeClasses . $variantClasses;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i data-lucide="{{ $icon }}" class="w-4 h-4 shrink-0"></i>
        @endif
        <span>{{ $slot }}</span>
        @if($iconEnd)
            <i data-lucide="{{ $iconEnd }}" class="w-4 h-4 shrink-0 rtl:rotate-0 ltr:rotate-180"></i>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <i data-lucide="{{ $icon }}" class="w-4 h-4 shrink-0"></i>
        @endif
        <span>{{ $slot }}</span>
        @if($iconEnd)
            <i data-lucide="{{ $iconEnd }}" class="w-4 h-4 shrink-0 rtl:rotate-0 ltr:rotate-180"></i>
        @endif
    </button>
@endif

