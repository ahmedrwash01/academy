@props([
    'type' => 'text', // text, title, avatar, card, table-row, chart
    'count' => 1,
])

<div class="space-y-2.5 animate-pulse">
    @for($i = 0; $i < $count; $i++)
        @if($type === 'text')
            <div class="h-3 w-full rounded bg-[var(--surface-subtle)]"></div>
        @elseif($type === 'title')
            <div class="h-5 w-2/3 rounded-lg bg-[var(--surface-subtle)]"></div>
        @elseif($type === 'avatar')
            <div class="h-10 w-10 rounded-full bg-[var(--surface-subtle)] shrink-0"></div>
        @elseif($type === 'card')
            <div class="p-5 rounded-xl border border-[var(--border)] bg-[var(--surface)] space-y-4">
                <div class="h-4 w-1/3 rounded bg-[var(--surface-subtle)]"></div>
                <div class="h-8 w-1/2 rounded bg-[var(--surface-subtle)]"></div>
                <div class="h-3 w-full rounded bg-[var(--surface-subtle)]"></div>
            </div>
        @elseif($type === 'table-row')
            <div class="flex items-center gap-4 py-3 px-4 border-b border-[var(--border)]">
                <div class="h-8 w-8 rounded-lg bg-[var(--surface-subtle)] shrink-0"></div>
                <div class="h-3.5 w-1/4 rounded bg-[var(--surface-subtle)]"></div>
                <div class="h-3.5 w-1/6 rounded bg-[var(--surface-subtle)]"></div>
                <div class="h-3.5 w-1/5 rounded bg-[var(--surface-subtle)]"></div>
                <div class="ms-auto h-6 w-16 rounded bg-[var(--surface-subtle)]"></div>
            </div>
        @elseif($type === 'chart')
            <div class="p-5 rounded-xl border border-[var(--border)] bg-[var(--surface)] space-y-4">
                <div class="h-4 w-1/4 rounded bg-[var(--surface-subtle)]"></div>
                <div class="h-48 rounded bg-[var(--surface-subtle)] flex items-end gap-2 p-4">
                    <div class="h-1/3 flex-1 rounded-t bg-[var(--border)]"></div>
                    <div class="h-2/3 flex-1 rounded-t bg-[var(--border)]"></div>
                    <div class="h-1/2 flex-1 rounded-t bg-[var(--border)]"></div>
                    <div class="h-4/5 flex-1 rounded-t bg-[var(--border)]"></div>
                    <div class="h-3/4 flex-1 rounded-t bg-[var(--border)]"></div>
                </div>
            </div>
        @endif
    @endfor
</div>
