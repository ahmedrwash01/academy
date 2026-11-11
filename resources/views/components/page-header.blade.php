@props([
    'title' => '',
    'subtitle' => '',
    'badge' => null,
])

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between border-b border-[var(--border)] pb-4 font-arabic">
    <div>
        <div class="flex items-center gap-2.5">
            <h1 class="text-xl sm:text-2xl font-black tracking-tight text-[var(--text-strong)]">
                {{ $title }}
            </h1>
            @if($badge)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] text-xs font-bold text-[var(--text-secondary)] shadow-2xs font-mono">
                    {{ $badge }}
                </span>
            @endif
        </div>
        @if($subtitle)
            <p class="mt-1 text-xs sm:text-sm text-[var(--text-muted)]">
                {{ $subtitle }}
            </p>
        @endif
    </div>

    @if(isset($actions))
        <div class="flex flex-wrap items-center gap-2.5">
            {{ $actions }}
        </div>
    @endif
</div>