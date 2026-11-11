@props([
    'variant' => 'neutral', // 'success', 'warning', 'danger', 'info', 'purple', 'brand', 'neutral'
    'dot' => false,
    'size' => 'md', // 'xs', 'sm', 'md'
])

@php
$variantClasses = match($variant) {
    'success' => 'bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)]',
    'warning' => 'bg-[var(--warning-bg)] text-[var(--warning-text)] border border-[var(--warning-border)]',
    'danger', 'brand' => 'bg-[var(--danger-bg)] text-[var(--danger-text)] border border-[var(--danger-border)]',
    'info', 'blue' => 'bg-[var(--info-bg)] text-[var(--info-text)] border border-[var(--info-border)]',
    'purple' => 'bg-[var(--purple-bg)] text-[var(--purple-text)] border border-[var(--purple-border)]',
    default => 'bg-[var(--neutral-badge-bg)] text-[var(--neutral-badge-text)] border border-[var(--neutral-badge-border)]',
};

$dotClasses = match($variant) {
    'success' => 'bg-[var(--success-text)]',
    'warning' => 'bg-[var(--warning-text)]',
    'danger', 'brand' => 'bg-[var(--danger-text)]',
    'info', 'blue' => 'bg-[var(--info-text)]',
    'purple' => 'bg-[var(--purple-text)]',
    default => 'bg-[var(--neutral-badge-text)]',
};

$sizeClasses = match($size) {
    'xs' => 'text-[10px] px-1.5 py-0.5 rounded',
    'sm' => 'text-[11px] px-2 py-0.5 rounded-full',
    default => 'text-xs px-2.5 py-0.5 rounded-full',
};
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 font-bold font-arabic select-none whitespace-nowrap ' . $variantClasses . ' ' . $sizeClasses]) }}>
    @if($dot)
        <span class="h-1.5 w-1.5 rounded-full {{ $dotClasses }} shrink-0 animate-pulse"></span>
    @endif
    <span>{{ $slot }}</span>
</span>
