@extends('layouts.admin', ['title' => 'محرك ذكاء العمليات والقرارات — EAGLE INTELLIGENCE'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    activeCategory: 'all', // 'all', 'operational', 'technical', 'financial', 'medical'
    insights: {{ json_encode($insights) }},
    appliedActions: {},

    get filteredInsights() {
        if (this.activeCategory === 'all') return this.insights;
        return this.insights.filter(item => item.category === this.activeCategory);
    },

    executeAction(id, actionText) {
        this.appliedActions[id] = true;
        window.$toast?.success('تم تنفيذ الإجراء: ' + actionText, 'ذكاء العمليات');
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="cpu" class="w-3.5 h-3.5"></i>
                    <span>EAGLE INTELLIGENCE ENGINE</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">محرك الرقابة الذاتية وتحليل المؤشرات الحيوية</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">محرك ذكاء الأكاديمية — مؤشرات التنبؤ واتخاذ القرار</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">تحليل استباقي لمخاطر التجديد، إشغال الملاعب، الأحمال البدنية، وانضباط الفرق</p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>تقرير الذكاء التشغيلي</span>
            </button>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--text-strong)] hover:opacity-90 rounded-lg text-xs font-bold text-[var(--surface)] shadow-2xs transition-opacity">
                <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                <span>مركز القيادة</span>
            </a>
        </div>
    </div>

    <!-- 4 High-Density Strategic Metrics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- 1. Attendance Stability -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)]">مؤشر انتظام الحضور</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
            <div class="flex items-baseline gap-1 mt-1.5">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">93.9%</span>
                <span class="text-xs font-bold text-emerald-600">+1.8%</span>
            </div>
            <p class="text-[11px] text-[var(--text-muted)] mt-1">أعلى نسبة انضباط لفريق U15 بنسبة 96.4%</p>
        </div>

        <!-- 2. Renewal Risk Index -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)]">خطر عدم التجديد (Churn)</span>
                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">آمن جداً</span>
            </div>
            <div class="flex items-baseline gap-1 mt-1.5">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">6.2%</span>
                <span class="text-xs font-bold text-[var(--text-muted)]">فقط</span>
            </div>
            <p class="text-[11px] text-[var(--text-muted)] mt-1">14 اشتراكاً معلقاً بحاجة للتذكير قبل 25 مارس</p>
        </div>

        <!-- 3. Pitch Utilization -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)]">كفاءة إشغال الملاعب</span>
                <span class="text-[10px] font-bold text-sky-700 bg-sky-50 px-2 py-0.5 rounded">88.5%</span>
            </div>
            <div class="flex items-baseline gap-1 mt-1.5">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono">42</span>
                <span class="text-xs font-bold text-[var(--text-muted)]">ساعة تدريب / أسبوع</span>
            </div>
            <p class="text-[11px] text-[var(--text-muted)] mt-1">ذروة الإشغال أيام الأحد والثلاثاء والخميس</p>
        </div>

        <!-- 4. Trial Conversion -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-[var(--text-muted)]">انتقاء كشافة المعايشة</span>
                <span class="text-[10px] font-bold text-[#E3131B] bg-red-50 px-2 py-0.5 rounded">فلترة ناديوية</span>
            </div>
            <div class="flex items-baseline gap-1 mt-1.5">
                <span class="text-2xl font-black text-[#E3131B] font-mono">18.5%</span>
                <span class="text-xs font-bold text-gray-500">قبول معتمد</span>
            </div>
            <p class="text-[11px] text-[var(--text-muted)] mt-1">قبول 18 ناشئاً من أصل 97 متقدماً للاختبارات</p>
        </div>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex items-center justify-between bg-[var(--surface)] p-2.5 rounded-xl border border-[var(--border)] shadow-2xs overflow-x-auto">
        <div class="flex items-center gap-1.5">
            <button 
                @click="activeCategory = 'all'" 
                :class="activeCategory === 'all' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-gray-100'"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all"
            >
                كافة التنبيهات الذكية (<span x-text="insights.length"></span>)
            </button>
            <button 
                @click="activeCategory = 'financial'" 
                :class="activeCategory === 'financial' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-gray-100'"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1"
            >
                <i data-lucide="wallet" class="w-3.5 h-3.5 text-[#E3131B]"></i>
                <span>مالي وتحصيل</span>
            </button>
            <button 
                @click="activeCategory = 'operational'" 
                :class="activeCategory === 'operational' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-gray-100'"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1"
            >
                <i data-lucide="calendar" class="w-3.5 h-3.5 text-blue-600"></i>
                <span>تشغيلي وملاعب</span>
            </button>
            <button 
                @click="activeCategory = 'technical'" 
                :class="activeCategory === 'technical' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-gray-100'"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1"
            >
                <i data-lucide="activity" class="w-3.5 h-3.5 text-emerald-600"></i>
                <span>فني وتطوير</span>
            </button>
            <button 
                @click="activeCategory = 'medical'" 
                :class="activeCategory === 'medical' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-gray-100'"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1"
            >
                <i data-lucide="heart-pulse" class="w-3.5 h-3.5 text-rose-600"></i>
                <span>طبي واستشفاء</span>
            </button>
        </div>

        <span class="text-[11px] font-mono text-[var(--text-muted)] hidden sm:block pe-2">
            تم التحديث اللحظي: اليوم 14:30
        </span>
    </div>

    <!-- Active Operational Insights Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <template x-for="item in filteredInsights" :key="item.id">
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs hover:border-[var(--border-strong)] transition-all flex flex-col justify-between space-y-4">
                
                <div>
                    <!-- Card Top Header -->
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div class="flex items-center gap-2">
                            <span 
                                :class="{
                                    'bg-rose-50 text-rose-700 border-rose-200': item.severity === 'high',
                                    'bg-amber-50 text-amber-700 border-amber-200': item.severity === 'medium',
                                    'bg-emerald-50 text-emerald-700 border-emerald-200': item.severity === 'positive'
                                }"
                                class="px-2 py-0.5 rounded text-[10px] font-bold border font-mono uppercase"
                                x-text="item.category_ar"
                            ></span>
                            <span class="text-[11px] text-[var(--text-muted)] font-mono" x-text="item.metric"></span>
                        </div>

                        <span 
                            :class="{
                                'text-rose-600': item.severity === 'high',
                                'text-amber-600': item.severity === 'medium',
                                'text-emerald-600': item.severity === 'positive'
                            }"
                            class="text-xs font-black"
                            x-text="item.severity === 'high' ? 'أولوية عاجلة' : (item.severity === 'medium' ? 'متابعة مطلوبة' : 'مؤشر إيجابي')"
                        ></span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-sm font-black text-[var(--text-strong)]" x-text="item.title_ar"></h3>
                    <p class="text-xs text-[var(--text-muted)] leading-relaxed mt-1" x-text="item.description_ar"></p>

                    <!-- Trigger Logic Box -->
                    <div class="bg-[var(--surface-subtle)] rounded-lg p-2.5 mt-3 border border-[var(--border)] text-[11px] space-y-1">
                        <div class="flex items-center gap-1.5 text-gray-500">
                            <i data-lucide="sliders" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                            <span class="font-bold">معيار ومحدد التحفيز الذاتي:</span>
                        </div>
                        <p class="font-mono text-gray-800 ps-5" x-text="item.trigger_logic"></p>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="pt-3 border-t border-[var(--border)] flex items-center justify-between gap-2">
                    <span class="text-[11px] text-[var(--text-muted)] truncate max-w-[200px]" x-text="'المسؤول: ' + (item.assigned_role || 'إدارة الأكاديمية')"></span>

                    <template x-if="!appliedActions[item.id]">
                        <button 
                            @click="executeAction(item.id, item.action_label_ar)"
                            class="px-3.5 py-1.5 bg-[#111214] hover:bg-[#E3131B] text-white text-xs font-bold rounded-lg transition-colors flex items-center gap-1.5 shrink-0"
                        >
                            <i data-lucide="arrow-left" class="w-3.5 h-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                            <span x-text="item.action_label_ar"></span>
                        </button>
                    </template>
                    <template x-if="appliedActions[item.id]">
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200 flex items-center gap-1">
                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            <span>تم اعتماد الإجراء</span>
                        </span>
                    </template>
                </div>

            </div>
        </template>
    </div>

    <!-- Analytics Charts Split -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Attendance Discipline by Age Group -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">نسبة انضباط الحضور عبر الفئات العمرية (%)</h3>
                    <p class="text-xs text-[var(--text-muted)]">مقارنة معدلات الالتزام بحصص التدريب خلال الشهر الحالي</p>
                </div>
                <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                    معدل الأكاديمية: 93.9%
                </span>
            </div>

            <div class="mt-4">
                <div id="attendanceByTeamChart" class="h-64"></div>
            </div>
        </div>

        <!-- Weekly Pitch Utilization -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">توزيع ساعات إشغال الملاعب التدريبية (ساعة / يوم)</h3>
                    <p class="text-xs text-[var(--text-muted)]">الملعب الرئيسي A مقابل الملعب الفرعي B خلال الأسبوع</p>
                </div>
                <span class="text-xs font-mono font-bold text-[var(--text-strong)] bg-[var(--surface-subtle)] px-2 py-0.5 rounded border border-[var(--border)]">
                    إجمالي: 42 ساعة
                </span>
            </div>

            <div class="mt-4">
                <div id="pitchUtilizationChart" class="h-64"></div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
window.renderIntelligenceCharts = function() {
    const attEl = document.querySelector("#attendanceByTeamChart");
    if (!attEl) return;
    if (typeof ApexCharts === 'undefined') {
        setTimeout(window.renderIntelligenceCharts, 40);
        return;
    }
    if (window._intelChartInstances) {
        window._intelChartInstances.forEach(c => { try { c.destroy(); } catch(e){} });
    }
    window._intelChartInstances = [];

    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#475569';
    const gridColor = isDarkMode ? '#252830' : '#E2E8F0';
    const barSecondColor = isDarkMode ? '#9CA3AF' : '#111214';

    attEl.innerHTML = '';
    const attendanceChart = new ApexCharts(attEl, {
        series: [{
            name: 'نسبة الحضور',
            data: [92.0, 94.5, 96.4, 93.2, 91.8]
        }],
        chart: {
            type: 'bar',
            height: 240,
            toolbar: { show: false },
            fontFamily: 'IBM Plex Sans Arabic, sans-serif',
            background: 'transparent'
        },
        colors: ['#E3131B'],
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '40%',
                distributed: false,
                dataLabels: { position: 'top' }
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) { return val + "%"; },
            offsetY: -20,
            style: { fontSize: '10px', colors: [textColor], fontFamily: 'JetBrains Mono, monospace', fontWeight: 'bold' }
        },
        grid: {
            borderColor: gridColor,
            strokeDashArray: 3,
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        xaxis: {
            categories: ['فريق U11', 'فريق U13', 'فريق U15', 'فريق U17', 'فريق U19'],
            labels: { style: { colors: textColor, fontSize: '11px', fontFamily: 'IBM Plex Sans Arabic, sans-serif' } },
            axisBorder: { color: gridColor },
            axisTicks: { color: gridColor }
        },
        yaxis: {
            min: 80,
            max: 100,
            labels: {
                style: { colors: textColor, fontSize: '10px', fontFamily: 'JetBrains Mono, monospace' },
                formatter: function(val) { return val + '%'; }
            }
        },
        tooltip: {
            theme: isDarkMode ? 'dark' : 'light',
            y: { formatter: function(val) { return val + '% حضور فعلي'; } }
        }
    });
    attendanceChart.render();
    window._intelChartInstances.push(attendanceChart);

    // Weekly Pitch Utilization Area / Bar
    const pitchEl = document.querySelector("#pitchUtilizationChart");
    if (pitchEl) {
        pitchEl.innerHTML = '';
        const pitchChart = new ApexCharts(pitchEl, {
            series: [
                { name: 'الملعب الرئيسي (استاد A)', data: [6, 4, 8, 4, 8, 4, 6] },
                { name: 'الملعب التدريبي (فرعي B)', data: [4, 4, 6, 4, 6, 4, 4] }
            ],
            chart: {
                type: 'bar',
                height: 240,
                stacked: true,
                toolbar: { show: false },
                fontFamily: 'IBM Plex Sans Arabic, sans-serif',
                background: 'transparent'
            },
            colors: [barSecondColor, '#E3131B'],
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    columnWidth: '45%'
                }
            },
            grid: {
                borderColor: gridColor,
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } }
            },
            xaxis: {
                categories: ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
                labels: { style: { colors: textColor, fontSize: '11px', fontFamily: 'IBM Plex Sans Arabic, sans-serif' } },
                axisBorder: { color: gridColor },
                axisTicks: { color: gridColor }
            },
            yaxis: {
                labels: {
                    style: { colors: textColor, fontSize: '10px', fontFamily: 'JetBrains Mono, monospace' },
                    formatter: function(val) { return val + ' س'; }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontFamily: 'IBM Plex Sans Arabic, sans-serif',
                fontSize: '11px',
                labels: { colors: textColor }
            },
            tooltip: {
                theme: isDarkMode ? 'dark' : 'light',
                y: { formatter: function(val) { return val + ' ساعات تدريبية'; } }
            }
        });
        pitchChart.render();
        window._intelChartInstances.push(pitchChart);
    }
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.renderIntelligenceCharts);
} else {
    window.renderIntelligenceCharts();
}
window.addEventListener('page:loaded', window.renderIntelligenceCharts);
window.addEventListener('theme-changed', () => setTimeout(window.renderIntelligenceCharts, 50));
</script>
@endpush

