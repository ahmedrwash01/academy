@extends('layouts.admin', ['title' => __('app.nav.sponsors')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.sponsors')" 
        subtitle="الشركاء الاستراتيجيين والرعاة الرسميين الداعمين لمسيرة أكاديمية النسور وتطوير الناشئين"
        badge="4 رعاة رئيسيين"
    >
        <x-slot:actions>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="printer" class="h-4 w-4"></i>
                <span>تقرير عقود الرعاية</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($sponsors as $s)
            <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs hover:border-gray-300 hover:shadow-xs transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-red-50 text-red-700 border border-red-100">
                            {{ $s['badge'] }}
                        </span>
                        <span class="text-xs text-[var(--text-muted)] font-mono font-medium">سارٍ حتى {{ $s['contract_period'] }}</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <img src="{{ $s['logo_url'] }}" alt="{{ $s['name_ar'] }}" class="h-16 w-16 rounded-lg object-cover ring-1 ring-gray-200 shrink-0">
                        <div>
                            <h3 class="text-base font-black text-[var(--text-strong)]">{{ $s['name_ar'] }}</h3>
                            <p class="text-xs text-red-600 font-semibold mt-0.5">{{ $s['type_ar'] }}</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3.5 border-t border-gray-100 grid grid-cols-2 gap-2 text-xs">
                        <div class="p-3 bg-[var(--surface-subtle)]/80 rounded-lg border border-gray-200/60">
                            <span class="text-[var(--text-muted)] text-[10px] font-semibold block">قيمة الرعاية السنوية:</span>
                            <span class="font-bold text-[var(--text-strong)] block mt-0.5 font-mono text-sm">{{ $s['annual_value'] }}</span>
                        </div>
                        <div class="p-3 bg-[var(--surface-subtle)]/80 rounded-lg border border-gray-200/60">
                            <span class="text-[var(--text-muted)] text-[10px] font-semibold block">الوضعية القانونية:</span>
                            <span class="font-bold text-emerald-600 block mt-0.5 text-xs flex items-center gap-1">
                                <i data-lucide="check" class="h-3 w-3"></i>
                                <span>عقد موثق ومعتمد</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-[var(--text-muted)] text-[11px]">تجديد سنوي تلقائي</span>
                    <button class="inline-flex items-center gap-1 font-bold text-red-600 hover:text-red-700 transition-colors">
                        <span>مراجعة بنود العقد</span>
                        <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
