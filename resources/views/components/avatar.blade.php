@props([
    'src' => null,
    'name' => '',
    'size' => 'md', // 'sm', 'md', 'lg', 'xl'
    'status' => null, // 'online', 'offline', 'busy', 'injured'
])

@php
$sizeClasses = match($size) {
    'sm' => 'h-7 w-7 text-[10px]',
    'lg' => 'h-12 w-12 text-sm',
    'xl' => 'h-16 w-16 text-base',
    default => 'h-9 w-9 text-xs',
};

$statusClasses = match($status) {
    'online' => 'bg-emerald-500',
    'busy' => 'bg-amber-500',
    'injured', 'offline' => 'bg-red-500',
    default => null
};

$initials = mb_substr($name, 0, 2);
@endphp

<div class="relative shrink-0 inline-flex">
    @if($src)
        <img 
            src="{{ $src }}" 
            alt="{{ $name }}" 
            class="{{ $sizeClasses }} rounded-xl object-cover border border-[var(--border-default)] shadow-2xs"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >
        <div style="display: none;" class="{{ $sizeClasses }} rounded-xl bg-[var(--bg-surface-subtle)] border border-[var(--border-default)] font-black text-[#E3131B] items-center justify-center select-none">
            {{ $initials }}
        </div>
    @else
        <div class="{{ $sizeClasses }} rounded-xl bg-[var(--bg-surface-subtle)] border border-[var(--border-default)] font-black text-[#E3131B] flex items-center justify-center select-none shadow-2xs">
            {{ $initials }}
        </div>
    @endif

    @if($statusClasses)
        <span class="absolute -bottom-0.5 -end-0.5 h-2.5 w-2.5 rounded-full border-2 border-[var(--bg-surface)] {{ $statusClasses }}"></span>
    @endif
</div>

