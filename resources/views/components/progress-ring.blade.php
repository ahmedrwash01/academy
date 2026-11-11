@props([
    'value' => 0,
    'size' => 64,
    'stroke' => 6,
    'color' => 'brand', // brand, success, warning, danger, info
    'label' => null,
])

@php
$radius = ($size - $stroke) / 2;
$circumference = 2 * pi() * $radius;
$val = max(0, min(100, (float)$value));
$offset = $circumference - ($val / 100) * $circumference;

$colorClass = [
    'brand' => 'text-[#E3131B]',
    'success' => 'text-emerald-600',
    'warning' => 'text-amber-500',
    'danger' => 'text-red-600',
    'info' => 'text-sky-500',
][$color] ?? 'text-[#E3131B]';
@endphp

<div class="relative inline-flex flex-col items-center justify-center font-arabic">
    <div class="relative" style="width: {{ $size }}px; height: {{ $size }}px;">
        <svg class="w-full h-full -rotate-90" viewBox="0 0 {{ $size }} {{ $size }}">
            <!-- Background track -->
            <circle 
                cx="{{ $size / 2 }}" 
                cy="{{ $size / 2 }}" 
                r="{{ $radius }}" 
                fill="transparent" 
                stroke="currentColor" 
                stroke-width="{{ $stroke }}" 
                class="text-gray-100 dark:text-gray-800"
            />
            <!-- Progress Arc -->
            <circle 
                cx="{{ $size / 2 }}" 
                cy="{{ $size / 2 }}" 
                r="{{ $radius }}" 
                fill="transparent" 
                stroke="currentColor" 
                stroke-width="{{ $stroke }}" 
                stroke-dasharray="{{ $circumference }}" 
                stroke-dashoffset="{{ $offset }}" 
                stroke-linecap="round" 
                class="{{ $colorClass }} transition-all duration-700 ease-out"
            />
        </svg>

        <!-- Center Value -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <span class="font-mono font-black text-xs text-[var(--text-strong)] tracking-tight">
                {{ round($val) }}%
            </span>
        </div>
    </div>

    @if($label)
        <span class="mt-1 text-[10px] font-bold text-[var(--text-muted)]">{{ $label }}</span>
    @endif
</div>

