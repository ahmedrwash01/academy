@props([
    'align' => 'end',
    'width' => '48',
    'contentClasses' => 'py-1 bg-[var(--surface)]',
])

@php
$alignmentClasses = [
    'start' => 'start-0 origin-top-start',
    'end' => 'end-0 origin-top-end',
][$align] ?? 'end-0 origin-top-end';

$widthClasses = [
    '40' => 'w-40',
    '48' => 'w-48',
    '56' => 'w-56',
    '64' => 'w-64',
    '80' => 'w-80',
][$width] ?? 'w-48';
@endphp

<div class="relative inline-block text-start font-arabic" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div 
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClasses }} rounded-xl border border-[var(--border)] shadow-xl {{ $alignmentClasses }}"
        @click="open = false"
    >
        <div class="rounded-xl {{ $contentClasses }} divide-y divide-[var(--border-subtle)]">
            {{ $content }}
        </div>
    </div>
</div>
