@props([
    'status' => 'active',
    'label' => null,
])

@php
$config = match(strtolower($status)) {
    'active', 'paid', 'successful', 'completed', 'present', 'accepted', 'in_stock' => [
        'bg' => 'bg-emerald-50',
        'text' => 'text-emerald-700',
        'dot' => 'bg-emerald-600',
        'border' => 'border-emerald-200',
        'default_label' => __('app.status.active'),
    ],
    'pending', 'partial', 'under_review', 'scheduled', 'excused' => [
        'bg' => 'bg-amber-50',
        'text' => 'text-amber-700',
        'dot' => 'bg-amber-600',
        'border' => 'border-amber-200',
        'default_label' => __('app.status.pending'),
    ],
    'expired', 'unpaid', 'failed', 'absent', 'rejected', 'out_of_stock' => [
        'bg' => 'bg-red-50',
        'text' => 'text-[#E3131B]',
        'dot' => 'bg-[#E3131B]',
        'border' => 'border-red-200',
        'default_label' => __('app.status.failed'),
    ],
    'refunded' => [
        'bg' => 'bg-[var(--neutral-badge-bg)]',
        'text' => 'text-[var(--neutral-badge-text)]',
        'dot' => 'bg-[var(--neutral-badge-text)]',
        'border' => 'border-[var(--neutral-badge-border)]',
        'default_label' => __('app.status.refunded'),
    ],
    default => [
        'bg' => 'bg-[var(--neutral-badge-bg)]',
        'text' => 'text-[var(--neutral-badge-text)]',
        'dot' => 'bg-[var(--neutral-badge-text)]',
        'border' => 'border-[var(--neutral-badge-border)]',
        'default_label' => $status,
    ]
};
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} font-arabic">
    <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
    {{ $label ?? $config['default_label'] }}
</span>