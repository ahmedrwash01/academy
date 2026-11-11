@extends('layouts.admin', ['title' => __('app.nav.reports')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.reports')" 
        subtitle="مركز التقارير التنفيذية للأداء الرياضي، الحضور والغياب، الرقابة المالية، وتقييم المدربين"
        badge="تقارير تحليلية وميدانية"
    >
        <x-slot:actions>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                <i data-lucide="printer" class="h-4 w-4"></i>
                <span>طباعة التقرير الشامل</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Report Modules -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-2.5">
                <div class="h-10 w-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center border border-red-100">
                    <i data-lucide="users" class="h-5 w-5"></i>
                </div>
                <h3 class="text-base font-bold text-[var(--text-strong)]">تقرير تطور اللاعبين والتقييم الفني</h3>
                <p class="text-xs text-gray-500 leading-relaxed">تحليل راداري شامل لتطور المهارات، اللياقة البدنية، ومعدلات المشاركة لكافة فرق وقطاعات الأكاديمية.</p>
            </div>
            <div class="mt-5 pt-3.5 border-t border-gray-100">
                <a href="{{ route('players.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 transition-colors">
                    <span>توليد التقرير الفني</span>
                    <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-2.5">
                <div class="h-10 w-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100">
                    <i data-lucide="clipboard-check" class="h-5 w-5"></i>
                </div>
                <h3 class="text-base font-bold text-[var(--text-strong)]">تقرير الانضباط والحضور الميداني</h3>
                <p class="text-xs text-gray-500 leading-relaxed">إحصائيات شهرية ونسب التزام اللاعبين والأجهزة الفنية بكافة الحصص التدريبية والمباريات والغياب بعذر.</p>
            </div>
            <div class="mt-5 pt-3.5 border-t border-gray-100">
                <a href="{{ route('attendance.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition-colors">
                    <span>كشف نسب الحضور</span>
                    <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-2.5">
                <div class="h-10 w-10 rounded-lg bg-neutral-100 text-neutral-800 flex items-center justify-center border border-neutral-200">
                    <i data-lucide="wallet" class="h-5 w-5"></i>
                </div>
                <h3 class="text-base font-bold text-[var(--text-strong)]">التقرير المالي ومطابقة التحصيلات</h3>
                <p class="text-xs text-gray-500 leading-relaxed">بيان تفصيلي بالمتحصلات البنكية والإلكترونية، رصد المتأخرات، ومطابقة الأرصدة وحسابات البنوك.</p>
            </div>
            <div class="mt-5 pt-3.5 border-t border-gray-100">
                <a href="{{ route('finance.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[var(--text-strong)] hover:text-red-600 transition-colors">
                    <span>عرض الموازنة والتدقيق</span>
                    <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
