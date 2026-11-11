@extends('layouts.admin', ['title' => 'التقرير المالي العام والميزانية — EAGLE OS FINANCE'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    period: 'monthly', // 'monthly' or 'annual'
    financialSummary: {{ json_encode($financialSummary) }},
    revenueCategories: {{ json_encode($revenueCategories) }},
    expenseCategories: {{ json_encode($expenseCategories) }},
    monthlyTrend: {{ json_encode($monthlyTrend) }},

    get currentData() {
        return this.period === 'monthly' ? this.financialSummary.monthly : this.financialSummary.annual;
    },

    formatCurrency(val) {
        return Number(val).toLocaleString('ar-EG') + ' ج.م';
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    <span>EAGLE OS FINANCIAL AUDIT</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">نظام الرقابة المالية والميزانية المعتمدة للأكاديمية</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">التقرير المالي المجمع — الإيرادات والمصروفات والأرباح</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">تدقيق الحسابات الختامية، التدفقات النقدية، وعوائد الاشتراكات والرعاية بالجنيه المصري (EGP)</p>
        </div>

        <div class="flex items-center gap-2.5">
            <!-- Period Toggle: Monthly vs Annual -->
            <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs">
                <button 
                    type="button"
                    @click="period = 'monthly'"
                    :class="period === 'monthly' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                    class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5"
                >
                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                    <span>الإيرادات والمصروفات الشهرية</span>
                </button>
                <button 
                    type="button"
                    @click="period = 'annual'"
                    :class="period === 'annual' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                    class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1.5"
                >
                    <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i>
                    <span>الميزانية السنوية المجمعة</span>
                </button>
            </div>

            <!-- Print & Export -->
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>طباعة البيان المالي</span>
            </button>
            <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="layers" class="w-3.5 h-3.5 text-[#E3131B]"></i>
                <span>باقات الاشتراكات</span>
            </a>
            <a href="{{ route('payments.checkout') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#E3131B] hover:bg-[#c00f16] rounded-lg text-xs font-bold text-white shadow-2xs transition-colors">
                <i data-lucide="wallet" class="w-3.5 h-3.5"></i>
                <span>بوابة التحصيل</span>
            </a>
        </div>
    </div>

    <!-- Period Context Banner -->
    <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-3.5 px-4 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center text-[#E3131B]">
                <i data-lucide="receipt" class="w-4 h-4"></i>
            </span>
            <div>
                <span class="text-xs font-bold text-[var(--text-strong)]" x-text="period === 'monthly' ? 'عرض الحسابات الختامية لشهر مارس 2026' : 'عرض الميزانية السنوية للموسم الرياضي 2025 / 2026'"></span>
                <span class="text-[11px] text-[var(--text-muted)] block">البيانات مدققة ومطابقة لحسابات الخزينة وبوابة InstaPay والبنك التجاري الدولي (CIB)</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                تسوية معتمدة 100%
            </span>
            <span class="text-xs text-[var(--text-muted)] font-mono" x-text="'تحديث: ' + new Date().toLocaleDateString('ar-EG')"></span>
        </div>
    </div>

    <!-- 4 High-Density Strategic Financial KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. Total Revenue -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs text-[var(--text-muted)] font-bold block" x-text="period === 'monthly' ? 'الإيرادات الشهرية المحصلة' : 'الإيرادات السنوية المجمعة'"></span>
                <span class="p-1.5 rounded-lg bg-emerald-50 text-emerald-600">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                </span>
            </div>
            <div class="flex items-baseline gap-1.5 mt-2">
                <span class="text-3xl font-black text-[var(--text-strong)] font-mono" x-text="Number(currentData.revenue).toLocaleString('en-US')"></span>
                <span class="text-xs font-bold text-[var(--text-muted)]">ج.م</span>
            </div>
            <div class="mt-2.5 text-[11px] text-emerald-700 font-bold flex items-center gap-1">
                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                <span x-text="period === 'monthly' ? '+12.4% زيادة وتيرة التحصيل' : '+18.5% نمو الإيرادات السنوية'"></span>
            </div>
        </div>

        <!-- 2. Total Expenses -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs text-[var(--text-muted)] font-bold block" x-text="period === 'monthly' ? 'المصروفات الشهرية التشغيلية' : 'المصروفات السنوية المجمعة'"></span>
                <span class="p-1.5 rounded-lg bg-gray-100 text-[var(--text-strong)]">
                    <i data-lucide="wallet" class="w-4 h-4"></i>
                </span>
            </div>
            <div class="flex items-baseline gap-1.5 mt-2">
                <span class="text-3xl font-black text-[var(--text-strong)] font-mono" x-text="Number(currentData.expenses).toLocaleString('en-US')"></span>
                <span class="text-xs font-bold text-[var(--text-muted)]">ج.م</span>
            </div>
            <div class="mt-2.5 text-[11px] text-[var(--text-muted)] font-semibold flex items-center gap-1">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-emerald-600"></i>
                <span>ضمن حدود الميزانية المعتمدة من مجلس الإدارة</span>
            </div>
        </div>

        <!-- 3. Net Operating Profit -->
        <div class="bg-[var(--surface)] rounded-xl border-2 border-emerald-500/20 bg-emerald-50/10 p-5 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs text-emerald-900 font-bold block" x-text="period === 'monthly' ? 'صافي الفائض الشهري (Net Profit)' : 'صافي الفائض السنوي (Net Profit)'"></span>
                <span class="p-1.5 rounded-lg bg-emerald-100 text-emerald-700">
                    <i data-lucide="pie-chart" class="w-4 h-4"></i>
                </span>
            </div>
            <div class="flex items-baseline gap-1.5 mt-2">
                <span class="text-3xl font-black text-emerald-700 font-mono" x-text="Number(currentData.net_profit).toLocaleString('en-US')"></span>
                <span class="text-xs font-bold text-emerald-900">ج.م</span>
            </div>
            <div class="mt-2.5 text-[11px] text-emerald-800 font-bold flex items-center gap-1">
                <span class="font-mono" x-text="'هامش ربح تشغيلي: ' + currentData.margin + '%'"></span>
                <span>• مؤشر مالي ممتاز</span>
            </div>
        </div>

        <!-- 4. Outstanding Dues & Collection Rate -->
        <div class="bg-[var(--surface)] rounded-xl border border-red-200 bg-red-50/20 p-5 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs text-[#E3131B] font-bold block">المستحقات المعلقة للتحصيل</span>
                <span class="p-1.5 rounded-lg bg-red-100 text-[#E3131B]">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                </span>
            </div>
            <div class="flex items-baseline gap-1.5 mt-2">
                <span class="text-3xl font-black text-[#E3131B] font-mono">32,500</span>
                <span class="text-xs font-bold text-[#E3131B]">ج.م</span>
            </div>
            <div class="mt-2.5 text-[11px] text-[#E3131B] font-bold flex items-center justify-between">
                <span>نسبة التحصيل: 92.2%</span>
                <a href="{{ route('payments.checkout') }}" class="underline hover:text-red-900">بدء التحصيل</a>
            </div>
        </div>
    </div>

    <!-- Interactive Charts Grid: 12-Month Audited Trend -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- 12-Month Comparison Area Chart (2 Cols) -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs lg:col-span-2 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-[var(--border)] gap-2">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">حركة الإيرادات والمصروفات على مدار 12 شهراً (ج.م)</h3>
                    <p class="text-xs text-[var(--text-muted)]">مقارنة الإيرادات المحصلة مقابل تكاليف التشغيل الشهرية</p>
                </div>
                <div class="flex items-center gap-3 text-xs font-bold">
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[#E3131B]"></span> الإيرادات</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-[var(--text-strong)]"></span> المصروفات</span>
                </div>
            </div>

            <div>
                <div id="annualTrendChart" class="h-68"></div>
            </div>
        </div>

        <!-- Revenue & Expense Ratio Donut (1 Col) -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs flex flex-col justify-between space-y-4">
            <div class="pb-3 border-b border-[var(--border)]">
                <h3 class="text-sm font-bold text-[var(--text-strong)]">توزيع هيكل المصروفات</h3>
                <p class="text-xs text-[var(--text-muted)]">النسبة المئوية لبنود الإنفاق الرئيسية</p>
            </div>

            <div class="flex items-center justify-center py-1">
                <div id="expensesDonutChart" class="h-52"></div>
            </div>

            <div class="space-y-2 text-xs border-t border-[var(--border)] pt-3">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#E3131B]"></span> رواتب الأجهزة الفنية (52%)</span>
                    <span class="font-mono font-bold text-[var(--text-strong)]" x-text="period === 'monthly' ? '116,480 ج.م' : '1,397,760 ج.م'"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[var(--text-strong)]"></span> إيجار الملاعب والصيانة (24%)</span>
                    <span class="font-mono font-bold text-[var(--text-strong)]" x-text="period === 'monthly' ? '53,760 ج.م' : '645,120 ج.م'"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[var(--border-strong)]"></span> التجهيزات والأدوات (12%)</span>
                    <span class="font-mono font-bold text-[var(--text-strong)]" x-text="period === 'monthly' ? '26,880 ج.م' : '322,560 ج.م'"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span> رسوم البطولات والدوري (12%)</span>
                    <span class="font-mono font-bold text-[var(--text-strong)]" x-text="period === 'monthly' ? '26,880 ج.م' : '322,560 ج.م'"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Ledger Tables Split: Revenue Streams vs Expense Streams -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        
        <!-- 1. Revenue Categories Table -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
                <div class="flex items-center gap-2">
                    <span class="p-1.5 bg-emerald-100 text-emerald-700 rounded-lg">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">بيان مصادر الإيرادات والمداخيل</h3>
                        <p class="text-[11px] text-[var(--text-muted)]">الاشتراكات، الرعاية، المتجر، والأنشطة الخاصة</p>
                    </div>
                </div>
                <span class="text-xs font-mono font-bold text-emerald-700 bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)]" x-text="formatCurrency(currentData.revenue)"></span>
            </div>

            <div class="divide-y divide-[var(--border-subtle)]">
                <template x-for="item in revenueCategories" :key="item.name">
                    <div class="p-4 hover:bg-[var(--surface-subtle)]/60 transition-colors flex items-center justify-between gap-3 text-xs">
                        <div class="space-y-1">
                            <div class="font-black text-[var(--text-strong)]" x-text="item.name"></div>
                            <div class="flex items-center gap-2 text-[11px] text-[var(--text-muted)]">
                                <span class="font-mono font-bold text-emerald-700" x-text="item.percent + '% من الإجمالي'"></span>
                                <span>•</span>
                                <span class="font-bold text-emerald-600" x-text="'معدل النمو: ' + item.trend"></span>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="text-sm font-black font-mono text-[var(--text-strong)]" x-text="period === 'monthly' ? Number(item.monthly_amount).toLocaleString('en-US') + ' ج.م' : Number(item.annual_amount).toLocaleString('en-US') + ' ج.م'"></div>
                            <span class="text-[10px] text-[var(--text-muted)] block" x-text="period === 'monthly' ? 'تحصيل شهري' : 'إجمالي سنوي'"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- 2. Expense Categories Table -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
                <div class="flex items-center gap-2">
                    <span class="p-1.5 bg-gray-200 text-[var(--text-strong)] rounded-lg">
                        <i data-lucide="wallet" class="w-4 h-4"></i>
                    </span>
                    <div>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">بيان بنود المصروفات والتشغيل</h3>
                        <p class="text-[11px] text-[var(--text-muted)]">الرواتب، إيجار الملاعب، المهمات، وتكاليف البطولات</p>
                    </div>
                </div>
                <span class="text-xs font-mono font-bold text-[var(--text-strong)] bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)]" x-text="formatCurrency(currentData.expenses)"></span>
            </div>

            <div class="divide-y divide-[var(--border-subtle)]">
                <template x-for="item in expenseCategories" :key="item.name">
                    <div class="p-4 hover:bg-[var(--surface-subtle)]/60 transition-colors flex items-center justify-between gap-3 text-xs">
                        <div class="space-y-1">
                            <div class="font-black text-[var(--text-strong)]" x-text="item.name"></div>
                            <div class="flex items-center gap-2 text-[11px] text-[var(--text-muted)]">
                                <span class="font-mono font-bold text-[var(--text-strong)]" x-text="item.percent + '% من الميزانية'"></span>
                                <span>•</span>
                                <span class="text-gray-500" x-text="item.status"></span>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="text-sm font-black font-mono text-[#E3131B]" x-text="period === 'monthly' ? Number(item.monthly_amount).toLocaleString('en-US') + ' ج.م' : Number(item.annual_amount).toLocaleString('en-US') + ' ج.م'"></div>
                            <span class="text-[10px] text-[var(--text-muted)] block" x-text="period === 'monthly' ? 'صرف شهري' : 'إجمالي سنوي'"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>

    <!-- Recent Audited Transactions Ledger -->
    <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">دفتر اليومية وقيود المقبوضات المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)]">مطابقة العمليات اليومية برقم الإيصال واسم المشترك وطريقة السداد</p>
            </div>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E3131B] hover:underline">
                <span>عرض السجل المالي الكامل</span>
                <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-start">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                    <tr>
                        <th class="py-3 px-4 text-start">رقم القيد / الإيصال</th>
                        <th class="py-3 px-4 text-start">اللاعب المشترك</th>
                        <th class="py-3 px-4 text-start">البند والتوصيف</th>
                        <th class="py-3 px-4 text-start">قناة السداد</th>
                        <th class="py-3 px-4 text-start">التاريخ والوقت</th>
                        <th class="py-3 px-4 text-start">المبلغ المسدد</th>
                        <th class="py-3 px-4 text-end">الإجراء</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    @foreach(array_slice($transactions, 0, 6) as $t)
                        <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-bold text-[var(--text-strong)]">
                                {{ $t['receipt_no'] ?? $t['id'] }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-[var(--text-strong)]">
                                {{ $t['player_name_ar'] }}
                            </td>
                            <td class="py-3.5 px-4 text-[var(--text-muted)]">
                                {{ $t['package_ar'] ?? 'اشتراك فصلي' }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]">
                                    {{ $t['method_label_ar'] ?? $t['method'] }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">
                                {{ $t['date'] }}
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-emerald-700">
                                {{ number_format($t['amount']) }} ج.م
                            </td>
                            <td class="py-3.5 px-4 text-end">
                                <a href="{{ route('payments.receipt', $t['id']) }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2.5 py-1 text-[11px] font-bold text-[var(--text-strong)] hover:bg-gray-100 transition-colors shadow-2xs">
                                    عرض الإيصال
                                </a>
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
window.renderFinanceCharts = function() {
    const trendEl = document.querySelector("#annualTrendChart");
    if (!trendEl) return;
    if (typeof ApexCharts === 'undefined') {
        setTimeout(window.renderFinanceCharts, 40);
        return;
    }
    if (window._financeChartInstances) {
        window._financeChartInstances.forEach(c => { try { c.destroy(); } catch(e){} });
    }
    window._financeChartInstances = [];

    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#475569';
    const gridColor = isDarkMode ? '#252830' : '#E2E8F0';
    const expenseColor = isDarkMode ? '#9CA3AF' : '#111214';

    trendEl.innerHTML = '';
    const trendChart = new ApexCharts(trendEl, {
        series: [
            {
                name: 'الإيرادات المحصلة',
                data: [320, 345, 410, 430, 450, 390, 380, 375, 360, 370, 380, 385]
            },
            {
                name: 'المصروفات التشغيلية',
                data: [210, 215, 240, 250, 255, 230, 220, 220, 215, 218, 220, 224]
            }
        ],
        chart: {
            type: 'area',
            height: 270,
            toolbar: { show: false },
            fontFamily: 'IBM Plex Sans Arabic, Inter, sans-serif',
            background: 'transparent'
        },
        colors: ['#E3131B', expenseColor],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.35,
                opacityTo: 0.03,
                stops: [0, 90, 100]
            }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: [2.5, 2] },
        grid: {
            borderColor: gridColor,
            strokeDashArray: 3,
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        xaxis: {
            categories: ['أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر', 'يناير', 'فبراير', 'مارس'],
            labels: { style: { colors: textColor, fontSize: '11px', fontFamily: 'IBM Plex Sans Arabic, sans-serif' } },
            axisBorder: { color: gridColor },
            axisTicks: { color: gridColor }
        },
        yaxis: {
            labels: {
                style: { colors: textColor, fontSize: '10px', fontFamily: 'JetBrains Mono, monospace' },
                formatter: function(val) { return val + 'k ج.م'; }
            }
        },
        tooltip: {
            theme: isDarkMode ? 'dark' : 'light',
            y: { formatter: function(val) { return (val * 1000).toLocaleString() + ' ج.م'; } }
        }
    });
    trendChart.render();
    window._financeChartInstances.push(trendChart);

    // Expenses Donut Chart
    const expensesEl = document.querySelector("#expensesDonutChart");
    if (expensesEl) {
        expensesEl.innerHTML = '';
        const expensesChart = new ApexCharts(expensesEl, {
            series: [52, 24, 12, 12],
            chart: {
                type: 'donut',
                height: 210,
                fontFamily: 'IBM Plex Sans Arabic, Inter, sans-serif',
                background: 'transparent'
            },
            labels: ['رواتب الأجهزة الفنية', 'إيجار الملاعب والصيانة', 'التجهيزات والأدوات', 'رسوم البطولات والدوري'],
            colors: ['#E3131B', expenseColor, isDarkMode ? '#475569' : '#94A3B8', '#F59E0B'],
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
                                label: 'إجمالي الإنفاق',
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
                y: { formatter: function(val) { return val + '% من ميزانية التشغيل'; } }
            }
        });
        expensesChart.render();
        window._financeChartInstances.push(expensesChart);
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.renderFinanceCharts);
} else {
    window.renderFinanceCharts();
}
window.addEventListener('page:loaded', window.renderFinanceCharts);
window.addEventListener('theme-changed', () => setTimeout(window.renderFinanceCharts, 50));
</script>
@endpush
