@extends('layouts.admin', ['title' => __('app.nav.refunds')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.refunds')" 
        subtitle="إدارة وتسجيل طلبات استرداد الرسوم والتعويضات المالية ومطابقات فرق مقاسات الأطقم"
        badge="تسويات مالية معتمدة"
    >
        <x-slot:actions>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="receipt" class="h-4 w-4"></i>
                <span>سجل التحصيلات</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-gray-200/80 flex items-center justify-between bg-[var(--surface-subtle)]/50">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل طلبات الاسترداد والتسويات المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)]">تدقيق إداري للمبالغ المرتجعة لأولياء الأمور</p>
            </div>
            <span class="text-xs font-mono font-bold text-[var(--text)] bg-[var(--surface)] px-2.5 py-1 rounded border border-gray-200">
                إجمالي المستردات: 850 ج.م
            </span>
        </div>

        <table class="w-full text-xs text-start">
            <thead class="bg-[var(--surface-subtle)]/80 text-gray-500 uppercase text-[11px] font-bold border-b border-gray-200/80">
                <tr>
                    <th class="py-3 px-4 text-start">رقم الحركة</th>
                    <th class="py-3 px-4 text-start">اللاعب</th>
                    <th class="py-3 px-4 text-start">المبلغ المسترد</th>
                    <th class="py-3 px-4 text-start">سبب الاسترداد والتسوية</th>
                    <th class="py-3 px-4 text-start">طريقة الإرجاع</th>
                    <th class="py-3 px-4 text-start">تاريخ الاعتماد</th>
                    <th class="py-3 px-4 text-end">الحالة</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-[var(--text)]">
                @foreach($transactions as $t)
                    <tr class="hover:bg-[var(--surface-subtle)]/60 transition-colors">
                        <td class="py-3.5 px-4 font-mono font-bold text-[var(--text-strong)]">{{ $t['id'] }}</td>
                        <td class="py-3.5 px-4 font-bold text-[var(--text-strong)]">{{ $t['player_name_ar'] }}</td>
                        <td class="py-3.5 px-4 font-mono font-bold text-red-600">{{ number_format($t['amount']) }} ج.م</td>
                        <td class="py-3.5 px-4 text-gray-600">{{ $t['note'] }}</td>
                        <td class="py-3.5 px-4 font-mono text-[var(--text)]">{{ $t['method_label_ar'] }}</td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)] font-mono">{{ $t['date'] }}</td>
                        <td class="py-3.5 px-4 text-end"><x-status-badge status="refunded" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
