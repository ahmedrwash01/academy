@props([
    'title' => '',
    'value' => '0',
    'prefix' => '',
    'suffix' => '',
    'change' => null,
    'changeDirection' => 'up', // 'up', 'down', 'neutral'
    'changeSemantic' => 'success', // 'success', 'danger', 'neutral'
    'subtext' => null,
    'footnote' => null,
    'icon' => null,
    'accent' => 'blue', // 'blue', 'pitch', 'brand', 'purple'
    'sparkline' => [24, 28, 26, 32, 30, 36, 42],
    'tooltip' => null,
])

@php
// Semantic border and distinct sparkline color per card via CSS Tokens (Item 1)
$accentConfig = match($accent) {
    'pitch', 'green' => [
        'border' => 'border-s-[3px] border-s-[var(--pitch-green)]',
        'spark' => 'var(--pitch-green)',
        'icon' => 'text-[var(--pitch-green)]',
    ],
    'brand', 'red' => [
        'border' => 'border-s-[3px] border-s-[var(--brand-red)]',
        'spark' => 'var(--brand-red)',
        'icon' => 'text-[var(--brand-red)]',
    ],
    'purple' => [
        'border' => 'border-s-[3px] border-s-[var(--color-purple)]',
        'spark' => 'var(--color-purple)',
        'icon' => 'text-[var(--color-purple)]',
    ],
    default => [ // Blue for Card 1
        'border' => 'border-s-[3px] border-s-[var(--color-blue)]',
        'spark' => 'var(--color-blue)',
        'icon' => 'text-[var(--color-blue)]',
    ],
};

// SVG sparkline full width calculations (Fixed 32px height, 100% width)
$sparkPoints = is_array($sparkline) && count($sparkline) > 0 ? $sparkline : [20, 24, 22, 28, 32, 30, 36];
$min = min($sparkPoints);
$max = max($sparkPoints);
$range = ($max - $min) > 0 ? ($max - $min) : 1;
$w = 100;
$h = 32;
$pts = [];
$step = count($sparkPoints) > 1 ? $w / (count($sparkPoints) - 1) : $w;

$lastX = 100;
$lastY = 16;
foreach ($sparkPoints as $i => $val) {
    $x = round($i * $step, 1);
    $y = round($h - (($val - $min) / $range * ($h - 10) + 5), 1);
    $pts[] = "$x,$y";
    if ($i === count($sparkPoints) - 1) {
        $lastX = $x;
        $lastY = $y;
    }
}
$polyline = implode(' ', $pts);
$areaPoints = "0,$h " . $polyline . " $w,$h";
$uniqueGradId = 'spark-grad-' . substr(md5($title . json_encode($sparkPoints)), 0, 8);
@endphp

<div 
    x-data="{ showTooltip: false }"
    class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-3.5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all duration-200 {{ $accentConfig['border'] }} relative group font-arabic"
>
    <div>
        <!-- Top Row: Full Title + Tooltip & Icon (No Ellipsis, min 12px font) -->
        <div class="flex items-center justify-between text-xs text-[var(--text-muted)] gap-2">
            <span class="font-bold text-[var(--text-secondary)]">{{ $title }}</span>
            <div class="flex items-center gap-1.5 shrink-0">
                @if($tooltip)
                    <div 
                        class="relative" 
                        @mouseenter="showTooltip = true" 
                        @mouseleave="showTooltip = false" 
                        @focus="showTooltip = true" 
                        @blur="showTooltip = false"
                        @click.outside="showTooltip = false"
                    >
                        <i data-lucide="info" class="w-3.5 h-3.5 text-[var(--text-muted)] hover:text-[var(--text-strong)] cursor-help transition-colors"></i>
                        <div 
                            x-show="showTooltip" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute bottom-full end-0 mb-1.5 w-52 p-2.5 rounded-lg bg-[var(--text-strong)] text-[var(--surface)] text-xs shadow-xl z-50 pointer-events-none text-start font-medium leading-relaxed"
                        >
                            {{ $tooltip }}
                        </div>
                    </div>
                @endif
                @if($icon)
                    <i data-lucide="{{ $icon }}" class="w-4 h-4 {{ $accentConfig['icon'] }}"></i>
                @endif
            </div>
        </div>

        <!-- Metric Number Row (High Contrast >= 7:1 via --text-strong) -->
        <div class="mt-2 flex items-baseline gap-1 animate-count-up">
            @if($prefix)
                <span class="text-xs font-bold text-[var(--text-muted)]">{{ $prefix }}</span>
            @endif
            <span class="text-2xl sm:text-3xl font-black text-[var(--text-strong)] tabular-nums tracking-tight">
                {{ $value }}
            </span>
            @if($suffix)
                <span class="text-xs font-bold text-[var(--text-muted)]">{{ $suffix }}</span>
            @endif
        </div>

        <!-- Item 5: Full-Width Sparkline Row with Area Gradient, Dot & Draw Animation -->
        <div class="w-full h-8 my-2 pt-1">
            <svg viewBox="0 0 {{ $w }} {{ $h }}" preserveAspectRatio="none" class="w-full h-8 overflow-visible">
                <defs>
                    <linearGradient id="{{ $uniqueGradId }}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="{{ $accentConfig['spark'] }}" stop-opacity="0.32" />
                        <stop offset="100%" stop-color="{{ $accentConfig['spark'] }}" stop-opacity="0.02" />
                    </linearGradient>
                </defs>

                <!-- Area gradient under polyline (Punchy & Vibrant) -->
                <polygon
                    points="{{ $areaPoints }}"
                    fill="url(#{{ $uniqueGradId }})"
                />

                <!-- Animated polyline (Saturated & Sharp) -->
                <polyline
                    fill="none"
                    stroke="{{ $accentConfig['spark'] }}"
                    stroke-width="2.6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    points="{{ $polyline }}"
                    class="sparkline-draw"
                />

                <!-- Saturated circular dot at the last value -->
                <circle
                    cx="{{ $lastX }}"
                    cy="{{ $lastY }}"
                    r="3.2"
                    fill="{{ $accentConfig['spark'] }}"
                    stroke="var(--surface)"
                    stroke-width="1.8"
                />
            </svg>
        </div>
    </div>

    <!-- Item 2: Fixed Height 2-Line Footer Across All Cards (h-12 / 48px) -->
    <div class="pt-2 border-t border-[var(--border-subtle)] h-12 flex flex-col justify-between text-xs overflow-hidden">
        <!-- Line 1: Semantic delta value - single line without wrap -->
        <div class="flex items-center justify-between gap-1 whitespace-nowrap min-w-0">
            @if($change)
                <span class="inline-flex items-center gap-0.5 font-bold whitespace-nowrap shrink-0 {{ $changeSemantic === 'success' ? 'text-[var(--success-text)]' : ($changeSemantic === 'danger' ? 'text-[var(--danger-text)]' : 'text-[var(--text-muted)]') }}">
                    @if($changeDirection === 'up')
                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 shrink-0"></i>
                    @elseif($changeDirection === 'down')
                        <i data-lucide="arrow-down-right" class="w-3.5 h-3.5 shrink-0"></i>
                    @endif
                    <span>{{ $change }}</span>
                </span>
            @endif

            @if($subtext)
                <span class="text-[var(--text-muted)] font-medium tabular-nums whitespace-nowrap shrink-0 truncate">{{ $subtext }}</span>
            @endif
        </div>

        <!-- Line 2: Short description in muted color with text-overflow & title attribute -->
        @if($footnote)
            <div class="text-xs text-[var(--text-muted)] truncate block" title="{{ $footnote }}">
                {{ $footnote }}
            </div>
        @endif
    </div>
</div>
