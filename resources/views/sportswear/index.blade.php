@extends('layouts.admin', ['title' => __('app.nav.sportswear')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.sportswear')" 
        subtitle="كتالوج الأطقم الرسمية، المهمات الرياضية، ومراقبة رصيد المستودع والمخزون"
        badge="الموسم الرياضي 2026"
    >
        <x-slot:actions>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="printer" class="h-4 w-4"></i>
                <span>جرد المستودع</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($products as $p)
            <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs hover:border-gray-300 hover:shadow-xs transition-all flex flex-col justify-between">
                <div>
                    <div class="relative overflow-hidden rounded-lg bg-[var(--surface-subtle)] h-48 w-full border border-gray-200/60">
                        <img src="{{ $p['image'] }}" alt="{{ $p['name_ar'] }}" class="h-full w-full object-cover">
                        <span class="absolute top-2 start-2 px-2 py-0.5 rounded bg-black/80 backdrop-blur text-white text-[10px] font-mono font-bold">
                            {{ $p['sku'] }}
                        </span>
                        <span class="absolute bottom-2 end-2 px-2.5 py-1 rounded bg-red-600 text-white text-xs font-mono font-black shadow-xs">
                            {{ number_format($p['price']) }} ج.م
                        </span>
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-wider">{{ $p['category_ar'] }}</span>
                            <span class="text-[11px] font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                بالمخزن: {{ $p['stock'] }} قطعة
                            </span>
                        </div>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">{{ $p['name_ar'] }}</h3>

                        <div class="pt-2 flex flex-wrap gap-1 text-[10px]">
                            @foreach($p['sizes'] as $sz)
                                <span class="px-2 py-0.5 rounded border border-gray-200 bg-[var(--surface-subtle)] text-[var(--text)] font-bold font-mono">
                                    {{ $sz }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-[var(--text-muted)] text-[11px]">معتمد رسمياً لفرق الأكاديمية</span>
                    <button class="inline-flex items-center gap-1 font-bold text-red-600 hover:text-red-700 transition-colors">
                        <i data-lucide="package-check" class="h-3.5 w-3.5"></i>
                        <span>صرف واستلام لاعب</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
