@props([
    'striped' => false,
    'hover' => true,
    'dense' => false,
    'bordered' => true,
])

<div class="w-full overflow-hidden rounded-xl {{ $bordered ? 'border border-[var(--border)]' : '' }} bg-[var(--surface)] shadow-2xs font-arabic">
    <div class="overflow-x-auto">
        <table class="w-full text-start text-xs border-collapse">
            @if(isset($head))
                <thead class="border-b border-[var(--border)] bg-[var(--surface-subtle)] text-[var(--text-muted)] text-[11px] font-bold uppercase tracking-wider">
                    {{ $head }}
                </thead>
            @endif

            <tbody class="divide-y divide-[var(--border)] text-[var(--text)] {{ $striped ? '[&>tr:nth-child(even)]:bg-[var(--surface-subtle)]' : '' }} {{ $hover ? '[&>tr]:hover:bg-[var(--surface-subtle)] [&>tr]:transition-colors' : '' }}">
                @if(isset($body))
                    {{ $body }}
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>

    @if(isset($empty))
        <div class="p-8 text-center text-[var(--text-muted)]">
            {{ $empty }}
        </div>
    @endif

    @if(isset($footer))
        <div class="border-t border-[var(--border)] bg-[var(--surface-subtle)] p-3 text-xs text-[var(--text-muted)]">
            {{ $footer }}
        </div>
    @endif
</div>
