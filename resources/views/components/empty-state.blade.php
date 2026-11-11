@props([
    'icon' => 'folder-open',
    'title' => 'لا توجد بيانات متاحة',
    'description' => 'لم يتم تسجيل أي عناصر في هذا القسم حتى الآن.',
    'actionLabel' => null,
    'actionUrl' => null,
])

<div class="flex flex-col items-center justify-center py-12 px-4 text-center font-arabic">
    <div class="w-14 h-14 rounded-2xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center text-[var(--text-muted)] mb-4 shadow-2xs">
        <i data-lucide="{{ $icon }}" class="w-7 h-7 stroke-[1.5]"></i>
    </div>

    <h3 class="text-sm sm:text-base font-bold text-[var(--text-strong)]">{{ $title }}</h3>
    <p class="mt-1 text-xs text-[var(--text-muted)] max-w-sm">{{ $description }}</p>

    @if(isset($action))
        <div class="mt-5">
            {{ $action }}
        </div>
    @elseif($actionLabel && $actionUrl)
        <div class="mt-5">
            <a 
                href="{{ $actionUrl }}" 
                class="inline-flex items-center gap-2 rounded-xl bg-[#E3131B] px-4 py-2 text-xs font-bold text-white shadow-xs hover:bg-[#c00f16] transition-colors"
            >
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>{{ $actionLabel }}</span>
            </a>
        </div>
    @endif
</div>
