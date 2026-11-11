@extends('layouts.admin', ['title' => __('app.nav.complaints')])

@section('content')
<div class="space-y-6 font-arabic" x-data="{ tickets: {{ json_encode($complaints) }} }">
    <x-page-header 
        :title="__('app.nav.complaints')" 
        subtitle="متابعة مقترحات وملاحظات أولياء الأمور واللاعبين والرد الفوري عليها لضمان جودة الأداء"
        badge="خدمة أولياء الأمور واللاعبين"
    />

    <div class="space-y-4">
        @foreach($complaints as $c)
            <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs space-y-4 hover:border-gray-300 transition-colors">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs font-bold text-[var(--text-muted)] bg-[var(--surface-subtle)] px-2 py-0.5 rounded border border-gray-200">{{ $c['ticket_no'] }}</span>
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold {{ $c['type'] === 'suggestion' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                            {{ $c['type'] === 'suggestion' ? 'اقتراح تطوير' : 'شكوى وملاحظة' }}
                        </span>
                        <h4 class="font-bold text-[var(--text-strong)] text-sm">{{ $c['title_ar'] }}</h4>
                    </div>
                    <span class="text-xs text-[var(--text-muted)] font-mono">{{ $c['date'] }}</span>
                </div>

                <div class="text-xs space-y-1">
                    <span class="text-[var(--text-muted)] font-semibold text-[11px]">مرسل الرسالة:</span>
                    <span class="font-bold text-[var(--text-strong)] ms-1">{{ $c['author_ar'] }}</span>
                    <div class="bg-[var(--surface-subtle)]/80 border border-gray-200/60 p-3 rounded-lg mt-2 text-[var(--text)] leading-relaxed text-xs">
                        {{ $c['description_ar'] }}
                    </div>
                </div>

                @if(!empty($c['reply_ar']))
                    <div class="p-3.5 rounded-lg bg-red-50/40 border border-red-100 text-xs space-y-1">
                        <div class="flex items-center justify-between text-red-800 font-bold">
                            <span>رد الإدارة المعتمد (المسؤول: {{ $c['assigned_to_ar'] }}):</span>
                            <span class="text-emerald-700 font-bold bg-[var(--surface)] px-2 py-0.5 rounded border border-emerald-200 text-[11px]">{{ $c['status_label_ar'] }}</span>
                        </div>
                        <p class="text-[var(--text)] leading-relaxed pt-1">{{ $c['reply_ar'] }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
