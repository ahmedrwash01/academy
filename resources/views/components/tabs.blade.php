@props([
    'active' => '',
    'tabs' => [], // [['id' => 'all', 'label' => 'الكل', 'count' => 12]]
    'model' => 'activeTab',
])

<div class="inline-flex p-1 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] shadow-2xs font-arabic select-none overflow-x-auto max-w-full">
    @foreach($tabs as $tab)
        <button 
            type="button"
            @click="{{ $model }} = '{{ $tab['id'] }}'"
            :class="{{ $model }} === '{{ $tab['id'] }}' 
                ? 'bg-[var(--surface)] text-[var(--text-strong)] shadow-xs font-black' 
                : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] font-semibold'"
            class="px-3.5 py-1.5 rounded-lg text-xs transition-all duration-150 flex items-center gap-2 shrink-0 cursor-pointer"
        >
            @if(isset($tab['icon']))
                <i data-lucide="{{ $tab['icon'] }}" class="w-3.5 h-3.5"></i>
            @endif
            <span>{{ $tab['label'] }}</span>
            @if(isset($tab['count']))
                <span 
                    :class="{{ $model }} === '{{ $tab['id'] }}' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] border border-[var(--border)]'"
                    class="px-1.5 py-0.2 rounded text-[10px] font-mono font-bold"
                >
                    {{ $tab['count'] }}
                </span>
            @endif
        </button>
    @endforeach
</div>
