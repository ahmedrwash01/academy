@extends('layouts.admin', ['title' => __('app.nav.transactions')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.transactions')" 
        subtitle="سجل العمليات المالية والتحصيلات الصادرة والواردة لكافة قطاعات وأولياء أمور الأكاديمية"
        badge="معاملات مالية معتمدة وموثقة"
    >
        <x-slot:actions>
            <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="users" class="h-4 w-4"></i>
                <span>متابعة الاشتراكات</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                <i data-lucide="printer" class="h-4 w-4"></i>
                <span>طباعة كشف المتحصلات</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Filter & Search Toolbar -->
    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-4 shadow-2xs">
        <form method="GET" action="{{ route('payments.transactions') }}" class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-80 relative">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-[var(--text-muted)]">
                    <i data-lucide="search" class="h-4 w-4"></i>
                </div>
                <input 
                    type="search" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="ابحث برقم المعاملة أو اسم اللاعب..." 
                    class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 py-2 ps-9 pe-4 text-xs text-[var(--text-strong)] focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 transition-all font-arabic"
                >
            </div>

            <div class="flex flex-wrap items-center gap-2.5 w-full md:w-auto text-xs">
                <select name="status" onchange="this.form.submit()" class="rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 py-2 px-3 text-[var(--text)] focus:border-red-600 focus:outline-none text-xs">
                    <option value="">كافة الحالات</option>
                    <option value="successful" {{ ($status ?? '') === 'successful' ? 'selected' : '' }}>ناجحة (Successful)</option>
                    <option value="pending" {{ ($status ?? '') === 'pending' ? 'selected' : '' }}>قيد التأكيد (Pending)</option>
                    <option value="failed" {{ ($status ?? '') === 'failed' ? 'selected' : '' }}>فاشلة (Failed)</option>
                    <option value="refunded" {{ ($status ?? '') === 'refunded' ? 'selected' : '' }}>مستردة (Refunded)</option>
                </select>

                <select name="method" onchange="this.form.submit()" class="rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 py-2 px-3 text-[var(--text)] focus:border-red-600 focus:outline-none text-xs">
                    <option value="">كافة قنوات السداد</option>
                    <option value="card" {{ ($method ?? '') === 'card' ? 'selected' : '' }}>بطاقة بنكية / فيزا</option>
                    <option value="vodafone_cash" {{ ($method ?? '') === 'vodafone_cash' ? 'selected' : '' }}>إنستاباي / محفظة</option>
                    <option value="bank_transfer" {{ ($method ?? '') === 'bank_transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                    <option value="cash" {{ ($method ?? '') === 'cash' ? 'selected' : '' }}>نقدي بخزينة النادي</option>
                </select>

                <a href="{{ route('payments.transactions') }}" class="rounded-lg border border-gray-200 p-2 text-gray-500 hover:bg-gray-100 transition-colors" title="إعادة تعيين الفلاتر">
                    <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Transactions Data Table -->
    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs font-arabic">
                <thead>
                    <tr class="border-b border-gray-200/80 bg-[var(--surface-subtle)]/80 text-gray-500 uppercase text-[11px] font-bold">
                        <th class="py-3 px-4 text-start">رقم المعاملة</th>
                        <th class="py-3 px-4 text-start">اللاعب / ولي الأمر</th>
                        <th class="py-3 px-4 text-start">بند السداد</th>
                        <th class="py-3 px-4 text-start">المبلغ المحصل</th>
                        <th class="py-3 px-4 text-start">وسيلة السداد</th>
                        <th class="py-3 px-4 text-start">التاريخ والوقت</th>
                        <th class="py-3 px-4 text-start">الحالة</th>
                        <th class="py-3 px-4 text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-[var(--text)]">
                    @forelse($transactions as $txn)
                        <tr class="hover:bg-[var(--surface-subtle)]/60 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-[var(--text-strong)]">
                                {{ $txn['receipt_no'] }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-[var(--text-strong)] block">{{ $txn['player_name_ar'] }}</span>
                                <span class="text-[10px] text-[var(--text-muted)]">ولي الأمر: {{ $txn['parent_name_ar'] }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                {{ $txn['package_ar'] ?? $txn['type_ar'] ?? 'اشتراك تدريبي' }}
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-[var(--text-strong)]">
                                {{ number_format($txn['amount']) }} ج.م
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                <span class="inline-flex items-center gap-1">
                                    <i data-lucide="credit-card" class="h-3 w-3 text-[var(--text-muted)]"></i>
                                    <span>{{ $txn['method_label_ar'] }}</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-[var(--text-muted)] font-mono text-[11px]">
                                {{ $txn['date'] }}
                            </td>
                            <td class="py-3.5 px-4">
                                <x-status-badge :status="$txn['status']" />
                            </td>
                            <td class="py-3.5 px-4 text-end">
                                <a href="{{ route('payments.receipt', $txn['id']) }}" class="inline-flex items-center gap-1 rounded-md border border-gray-200 bg-[var(--surface)] px-2.5 py-1 text-[11px] font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] hover:border-gray-300 transition-colors">
                                    <i data-lucide="eye" class="h-3 w-3 text-gray-500"></i>
                                    <span>عرض الإيصال</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-[var(--text-muted)]">
                                لا توجد عمليات مطابقة لمعايير البحث المحددة
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
