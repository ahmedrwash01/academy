@extends('layouts.admin', ['title' => __('app.nav.payments_overview')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.payments_overview')" 
        subtitle="الرقابة المالية وتتبع نسب التحصيل والمتحصلات الشهرية ورصد المتأخرات والمتبقيات"
        badge="متابعة مالية ورقابة تحصيل"
    >
        <x-slot:actions>
            <a href="{{ route('payments.checkout') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#E3131B] px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-[#C70F16] transition-colors">
                <i data-lucide="credit-card" class="h-4 w-4"></i>
                <span>بوابة التحصيل والسداد التجريبي</span>
            </a>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-2 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="receipt" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>سجل المقبوضات</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="printer" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>طباعة التقرير</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Payment KPIs: Clean High-Density Metric Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. Total Collections -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">إجمالي المتحصلات الشهرية</span>
            <div class="flex items-baseline gap-1.5 mt-1">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">{{ number_format($stats['monthly_revenue']) }}</span>
                <span class="text-xs font-bold text-[var(--text-muted)]">{{ __('app.currency') }}</span>
            </div>
            <div class="mt-2 text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                <i data-lucide="trending-up" class="h-3 w-3"></i>
                <span>+12.4% نمو وتيرة التحصيل مقارنة بالشهر السابق</span>
            </div>
        </div>

        <!-- 2. Audited Collections -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">العمليات المحققة والمعتمدة</span>
            <div class="flex items-baseline gap-1.5 mt-1">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">182</span>
                <span class="text-xs font-bold text-[var(--text-muted)]">عملية سداد</span>
            </div>
            <div class="mt-2 text-[11px] text-emerald-600 font-semibold flex items-center gap-1">
                <i data-lucide="check-circle" class="h-3 w-3"></i>
                <span>نسبة تسوية مصرفية 98.2%</span>
            </div>
        </div>

        <!-- 3. Outstanding Payments / Dues -->
        <div class="rounded-xl border border-red-200 bg-red-50/30 p-4 shadow-2xs">
            <span class="text-xs text-[#E3131B] font-bold block">المستحقات والمتأخرات المعلقة</span>
            <div class="flex items-baseline gap-1.5 mt-1">
                <span class="text-2xl font-black text-[#E3131B] font-mono">{{ number_format($stats['outstanding_payments']) }}</span>
                <span class="text-xs font-bold text-[#E3131B]">{{ __('app.currency') }}</span>
            </div>
            <div class="mt-2 text-[11px] text-[#E3131B] font-semibold flex items-center gap-1">
                <i data-lucide="alert-circle" class="h-3 w-3"></i>
                <span>20 اشتراكاً بحاجة للمتابعة والتجديد</span>
            </div>
        </div>

        <!-- 4. Refunds & Adjustments -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">تسويات الاسترداد والاستبدال</span>
            <div class="flex items-baseline gap-1.5 mt-1">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">850</span>
                <span class="text-xs font-bold text-[var(--text-muted)]">{{ __('app.currency') }}</span>
            </div>
            <div class="mt-2 text-[11px] text-[var(--text-muted)] font-semibold">
                <span>عملية واحدة (استبدال مقاس الزي الرسمي)</span>
            </div>
        </div>
    </div>

    <!-- Charts Split -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Daily Collections Trend (2 cols) -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs lg:col-span-2">
            <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">حركة التحصيل اليومي لشهر مارس (ج.م)</h3>
                    <p class="text-xs text-[var(--text-muted)]">توزيع التدفقات النقدية المحصلة عبر القنوات المصرفية</p>
                </div>
                <span class="rounded bg-[var(--surface-subtle)] px-2.5 py-1 text-xs font-bold font-mono text-emerald-700 border border-[var(--border)]">
                    معدل التحصيل اليومي: 12,400 ج.م
                </span>
            </div>

            <div class="mt-4">
                <div id="collectionsChart" class="h-64"></div>
            </div>
        </div>

        <!-- Payment Channels Distribution (1 col) -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="border-b border-[var(--border)] pb-3">
                <h3 class="text-sm font-bold text-[var(--text-strong)]">قنوات السداد المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)]">النسب المئوية لاستخدام وسائل السداد</p>
            </div>

            <div class="py-2 flex items-center justify-center">
                <div id="methodsChart" class="h-52"></div>
            </div>

            <div class="space-y-2 border-t border-[var(--border)] pt-3 text-xs">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-[#E3131B]"></span> إنستاباي ومحافظ ذكية</span>
                    <span class="font-bold font-mono text-[var(--text-strong)]">48%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-[var(--text-strong)]"></span> بطاقات فيزا وميزة</span>
                    <span class="font-bold font-mono text-[var(--text-strong)]">32%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-[var(--border-strong)]"></span> تحويلات بنكية مباشرة</span>
                    <span class="font-bold font-mono text-[var(--text-strong)]">12%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full bg-amber-500"></span> سداد نقدي بخزينة النادي</span>
                    <span class="font-bold font-mono text-[var(--text-strong)]">8%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Outstanding Dues Follow-up Table -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">قائمة استحقاقات الاشتراكات والمستحقات العاجلة</h3>
                <p class="text-xs text-[var(--text-muted)]">متابعة المطالبات المالية والتسوية عبر بوابة التحصيل التجريبي</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('payments.checkout') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E3131B] hover:underline">
                    <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                    <span>تحصيل سريع</span>
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[var(--text)] hover:text-black">
                    <span>كافة الاشتراكات</span>
                    <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-start">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                    <tr>
                        <th class="py-3 px-4 text-start">اللاعب</th>
                        <th class="py-3 px-4 text-start">الفريق</th>
                        <th class="py-3 px-4 text-start">الباقة التدريبية</th>
                        <th class="py-3 px-4 text-start">المبلغ المستحق</th>
                        <th class="py-3 px-4 text-start">تاريخ الاستحقاق</th>
                        <th class="py-3 px-4 text-start">ولي الأمر والهاتف</th>
                        <th class="py-3 px-4 text-end">الإجراء المالي</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    @foreach($dues as $d)
                        <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                            <td class="py-3 px-4 font-bold text-[var(--text-strong)]">
                                {{ $d['player_name_ar'] }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]">
                                    {{ $d['team'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-[var(--text-muted)]">{{ $d['plan_ar'] }}</td>
                            <td class="py-3 px-4 font-mono font-bold text-[#E3131B]">
                                {{ number_format($d['amount_due']) }} ج.م
                            </td>
                            <td class="py-3 px-4 text-[var(--text-muted)] font-mono">{{ $d['due_date'] }}</td>
                            <td class="py-3 px-4">
                                <span class="font-medium text-[var(--text-strong)] block">{{ $d['parent_name'] }}</span>
                                <span class="font-mono text-[10px] text-[var(--text-muted)]">{{ $d['phone'] }}</span>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="inline-flex items-center gap-1.5">
                                    <a 
                                        href="{{ route('payments.checkout') }}" 
                                        class="rounded-lg bg-[#111214] px-2.5 py-1 text-[11px] font-bold text-white hover:bg-[#E3131B] transition-colors"
                                    >
                                        تسوية وتحصيل
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
window.renderPaymentsCharts = function() {
    const colEl = document.querySelector("#collectionsChart");
    if (!colEl) return;
    if (typeof ApexCharts === 'undefined') {
        setTimeout(window.renderPaymentsCharts, 40);
        return;
    }
    if (window._paymentsChartInstances) {
        window._paymentsChartInstances.forEach(c => { try { c.destroy(); } catch(e){} });
    }
    window._paymentsChartInstances = [];

    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#475569';
    const gridColor = isDarkMode ? '#252830' : '#E2E8F0';
    const secondColor = isDarkMode ? '#9CA3AF' : '#111214';

    colEl.innerHTML = '';
    const collectionsChart = new ApexCharts(colEl, {
        series: [{
            name: 'المتحصلات اليومية',
            data: [14200, 18500, 11200, 9800, 16400, 21000, 19200, 15000, 24000, 22100, 17800]
        }],
        chart: {
            type: 'area',
            height: 240,
            toolbar: { show: false },
            fontFamily: 'IBM Plex Sans Arabic, sans-serif',
            background: 'transparent'
        },
        colors: ['#E3131B'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.25,
                opacityTo: 0.02,
                stops: [0, 95, 100]
            }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2.5 },
        grid: {
            borderColor: gridColor,
            strokeDashArray: 3,
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        xaxis: {
            categories: ['1 مارس', '2 مارس', '3 مارس', '4 مارس', '5 مارس', '6 مارس', '7 مارس', '8 مارس', '9 مارس', '10 مارس', '11 مارس'],
            labels: { style: { colors: textColor, fontSize: '10px', fontFamily: 'IBM Plex Sans Arabic, sans-serif' } },
            axisBorder: { color: gridColor },
            axisTicks: { color: gridColor }
        },
        yaxis: {
            labels: {
                style: { colors: textColor, fontSize: '10px', fontFamily: 'JetBrains Mono, monospace' },
                formatter: function(val) { return (val / 1000).toLocaleString() + 'k'; }
            }
        },
        tooltip: {
            theme: isDarkMode ? 'dark' : 'light',
            y: { formatter: function(val) { return val.toLocaleString() + ' ج.م'; } }
        }
    });
    collectionsChart.render();
    window._paymentsChartInstances.push(collectionsChart);

    // Payment Methods Donut Chart
    const methodsEl = document.querySelector("#methodsChart");
    if (methodsEl) {
        methodsEl.innerHTML = '';
        const methodsChart = new ApexCharts(methodsEl, {
            series: [48, 32, 12, 8],
            chart: {
                type: 'donut',
                height: 210,
                fontFamily: 'IBM Plex Sans Arabic, sans-serif',
                background: 'transparent'
            },
            labels: ['إنستاباي ومحافظ', 'بطاقات بنكية', 'تحويلات مصرفية', 'نقدي بالخزينة'],
            colors: ['#E3131B', secondColor, isDarkMode ? '#475569' : '#94A3B8', '#F59E0B'],
            stroke: { colors: [isDarkMode ? '#14161A' : '#ffffff'], width: 2 },
            legend: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'الإجمالي',
                                color: textColor,
                                fontSize: '11px',
                                formatter: function () { return '100%'; }
                            }
                        }
                    }
                }
            },
            tooltip: {
                theme: isDarkMode ? 'dark' : 'light',
                y: { formatter: function(val) { return val + '% من العمليات'; } }
            }
        });
        methodsChart.render();
        window._paymentsChartInstances.push(methodsChart);
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.renderPaymentsCharts);
} else {
    window.renderPaymentsCharts();
}
window.addEventListener('page:loaded', window.renderPaymentsCharts);
window.addEventListener('theme-changed', () => setTimeout(window.renderPaymentsCharts, 50));
</script>
@endpush
