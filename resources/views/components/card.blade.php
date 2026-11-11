@props([
    'title' => null,
    'subtitle' => null,
    'badge' => null,
    'hover' => false,
    'compact' => false,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] shadow-2xs ' . ($hover ? 'hover:border-[var(--border-strong)] hover:shadow-xs transition-all duration-200 ' : '') . ($compact ? 'p-3.5 sm:p-4' : 'p-5 sm:p-6')]) }}>
    @if($title || isset($header) || isset($actions))
        <div class="flex items-center justify-between pb-3.5 mb-4 border-b border-[var(--border-subtle)] gap-3">
            @if(isset($header))
                {{ $header }}
            @else
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm sm:text-base font-black tracking-tight text-[var(--text-primary)] truncate">
                            {{ $title }}
                        </h3>
                        @if($badge)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--bg-surface-subtle)] text-[var(--text-secondary)] border border-[var(--border-subtle)]">
                                {{ $badge }}
                            </span>
                        @endif
                    </div>
                    @if($subtitle)
                        <p class="text-xs text-[var(--text-muted)] mt-0.5 truncate font-arabic">
                            {{ $subtitle }}
                        </p>
                    @endif
                </div>
            @endif

            @if(isset($actions))
                <div class="flex items-center gap-2 shrink-0">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="min-w-0">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="mt-4 pt-3.5 border-t border-[var(--border-subtle)] text-xs text-[var(--text-muted)]">
            {{ $footer }}
        </div>
    @endif
</div>

