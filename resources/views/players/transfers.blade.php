@extends('layouts.admin', ['title' => __('app.nav.transfers')])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    activeTab: 'transfers' // 'transfers' or 'trials'
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="arrow-left-right" class="w-3.5 h-3.5"></i>
                    <span>EAGLE TRANSFER MARKET</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">سجل تسويق وانتقال المواهب للأندية المحترفة</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">سوق الانتقالات، تجارب الأداء، وعقود الرعاية المستقبلية</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">توثيق صفقات انتقال ناشئي الأكاديمية لأندية الدوري الممتاز ونسب إعادة البيع التضامنية (Sell-on Clauses)</p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>كشف الصفقات المعتمدة</span>
            </button>
            <a href="{{ route('scouting.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--text-strong)] hover:opacity-90 rounded-lg text-xs font-bold text-[var(--surface)] shadow-2xs transition-opacity">
                <i data-lucide="crosshair" class="w-3.5 h-3.5"></i>
                <span>رادار الكشافة</span>
            </a>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">إجمالي الانتقالات الرسمية</span>
            <span class="text-2xl font-black text-[var(--text-strong)] font-mono mt-1 block">14 لاعباً</span>
            <span class="text-[11px] text-emerald-700 font-bold mt-1 block">أندية الدوري المصري الممتاز</span>
        </div>
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">تجارب الأداء والمعايشة الحالية</span>
            <span class="text-2xl font-black text-purple-700 font-mono mt-1 block">6 مواهب</span>
            <span class="text-[11px] text-gray-500 mt-1 block">قيد التقييم الفني بالأندية</span>
        </div>
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">متوسط نسبة إعادة البيع</span>
            <span class="text-2xl font-black text-[#E3131B] font-mono mt-1 block">22.5%</span>
            <span class="text-[11px] text-gray-500 mt-1 block">حقوق رعاية مستقبلية</span>
        </div>
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">الأندية الشريكة المستقبلة</span>
            <span class="text-2xl font-black text-[var(--text-strong)] font-mono mt-1 block">8 أندية</span>
            <span class="text-[11px] text-emerald-700 font-bold mt-1 block">بروتوكولات تعاون رسمية</span>
        </div>
    </div>

    <!-- Sub-tabs -->
    <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs">
        <button 
            type="button" 
            @click="activeTab = 'transfers'" 
            :class="activeTab === 'transfers' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2"
        >
            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            <span>الانتقالات الرسمية المعتمدة (14)</span>
        </button>
        <button 
            type="button" 
            @click="activeTab = 'trials'" 
            :class="activeTab === 'trials' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2"
        >
            <i data-lucide="clock" class="w-4 h-4 text-[#E3131B]"></i>
            <span>تجارب الأداء والمعايشات النشطة (6)</span>
        </button>
    </div>

    <!-- Content 1: Transfers Table -->
    <div x-show="activeTab === 'transfers'" class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between">
            <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل عقود الانتقال النهائي والإعارة الموثقة</h3>
            <span class="text-xs font-mono font-bold text-emerald-700 bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)]">
                موسم 2025 / 2026
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                    <tr>
                        <th class="py-3 px-4 text-start">اللاعب الموهوب</th>
                        <th class="py-3 px-4 text-start">المركز</th>
                        <th class="py-3 px-4 text-start">الفئة السنية</th>
                        <th class="py-3 px-4 text-start">النادي المنتقل إليه</th>
                        <th class="py-3 px-4 text-start">نوع العقد والشروط</th>
                        <th class="py-3 px-4 text-start">تاريخ الاعتماد</th>
                        <th class="py-3 px-4 text-end">حالة الصفقة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">سيف الدين أحمد عمارة</td>
                        <td class="py-3.5 px-4 font-bold text-[#E3131B]">مهاجم صريح / هداف</td>
                        <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">مواليد 2008 (U-17)</td>
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">النادي الأهلي المصري (قطاع الناشئين)</td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)]">انتقال نهائي + نسبة إعادة بيع 25%</td>
                        <td class="py-3.5 px-4 text-gray-500 font-mono">2026-01-15</td>
                        <td class="py-3.5 px-4 text-end">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">معتمد وموثق</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">أدهم شريف الزيني</td>
                        <td class="py-3.5 px-4 font-bold text-[#E3131B]">صانع ألعاب</td>
                        <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">مواليد 2010 (U-15)</td>
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">نادي زد إف سي (ZED FC)</td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)]">انتقال مشروط + حوافز مشاركة</td>
                        <td class="py-3.5 px-4 text-gray-500 font-mono">2026-02-01</td>
                        <td class="py-3.5 px-4 text-end">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">معتمد وموثق</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">مروان طارق الغندور</td>
                        <td class="py-3.5 px-4 font-bold text-[#E3131B]">حارس مرمى</td>
                        <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">مواليد 2009 (U-17)</td>
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">نادي سيراميكا كليوباترا</td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)]">إعارة موسمية مع خيار شراء نهائي</td>
                        <td class="py-3.5 px-4 text-gray-500 font-mono">2026-01-28</td>
                        <td class="py-3.5 px-4 text-end">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">إعارة سارية</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">كريم وائل المنشاوي</td>
                        <td class="py-3.5 px-4 font-bold text-[#E3131B]">ظهير أيمن هجومي</td>
                        <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">مواليد 2011 (U-15)</td>
                        <td class="py-3.5 px-4 font-black text-[var(--text-strong)]">نادي إنبي (قطاع البراعم)</td>
                        <td class="py-3.5 px-4 text-[var(--text-muted)]">انتقال نهائي + مكافأة توقيع</td>
                        <td class="py-3.5 px-4 text-gray-500 font-mono">2026-02-14</td>
                        <td class="py-3.5 px-4 text-end">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">معتمد وموثق</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Content 2: Active Club Trials -->
    <div x-show="activeTab === 'trials'" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">معايشة لمدة 10 أيام</span>
                <span class="text-xs font-mono font-bold text-[var(--text-muted)]">اليوم الـ 4</span>
            </div>
            <h4 class="text-base font-black text-[var(--text-strong)]">حمزة وائل عبد العظيم</h4>
            <p class="text-xs text-[#E3131B] font-bold">مهاجم صريح • مواليد 2012</p>
            <div class="p-2.5 bg-[var(--surface-subtle)] rounded-lg text-xs space-y-1">
                <div class="flex justify-between">
                    <span class="text-gray-500">النادي المستضيف:</span>
                    <strong class="text-[var(--text-strong)]">نادي الصيد المصري</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">المشرف على المعايشة:</span>
                    <span class="text-gray-800">كابتن حسام عبد الرؤوف</span>
                </div>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">فحص فني متقدم</span>
                <span class="text-xs font-mono font-bold text-[var(--text-muted)]">الجولة الثانية</span>
            </div>
            <h4 class="text-base font-black text-[var(--text-strong)]">يوسف عماد الدين كمال</h4>
            <p class="text-xs text-[#E3131B] font-bold">صانع ألعاب / وسط مهاجم • مواليد 2013</p>
            <div class="p-2.5 bg-[var(--surface-subtle)] rounded-lg text-xs space-y-1">
                <div class="flex justify-between">
                    <span class="text-gray-500">النادي المستضيف:</span>
                    <strong class="text-[var(--text-strong)]">أكاديمية نادي المقاولون العرب</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">المشرف على المعايشة:</span>
                    <span class="text-gray-800">كابتن طارق السروجي</span>
                </div>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">مرحلة إتمام التوقيع</span>
                <span class="text-xs font-mono font-bold text-emerald-700">مكتمل التقييم</span>
            </div>
            <h4 class="text-base font-black text-[var(--text-strong)]">آدم شريف القاضي</h4>
            <p class="text-xs text-[#E3131B] font-bold">قلب دفاع • مواليد 2011</p>
            <div class="p-2.5 bg-[var(--surface-subtle)] rounded-lg text-xs space-y-1">
                <div class="flex justify-between">
                    <span class="text-gray-500">النادي المستضيف:</span>
                    <strong class="text-[var(--text-strong)]">نادي المعادي واليخت</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">المشرف على المعايشة:</span>
                    <span class="text-gray-800">كابتن محمود الهواري</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
