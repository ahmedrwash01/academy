@extends('layouts.admin', ['title' => __('app.nav.payment_methods')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.payment_methods')" 
        subtitle="قنوات التحصيل المصرفية المعتمدة، الحسابات البنكية ومحافظ التحويل اللحظي الخاصة بالأكاديمية"
        badge="قنوات إيداع وتحصيل معتمدة"
    />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- InstaPay & Wallets -->
        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600 border border-red-100">
                        <i data-lucide="smartphone" class="h-5 w-5"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        نشط ومعتمد
                    </span>
                </div>
                <h3 class="text-base font-black text-[var(--text-strong)]">شبكة إنستاباي والمحافظ الذكية (IPN)</h3>
                <p class="text-xs text-gray-500 leading-relaxed">التحصيل اللحظي المباشر عبر تطبيق إنستاباي ومحافظ فودافون كاش وأورنج كاش مع ربط الإشعارات الآلي.</p>
                <div class="pt-2 text-[11px] font-mono text-[var(--text)] bg-[var(--surface-subtle)] p-2.5 rounded border border-gray-200">
                    <span class="text-[var(--text-muted)] block text-[10px]">عنوان الدفع (IPA):</span>
                    <span class="font-bold">eagles.academy@instapay</span>
                </div>
            </div>

            <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-[var(--text-muted)] text-[11px]">معدل التحصيل: 48%</span>
                <span class="font-bold text-[var(--text-strong)]">حساب جاري نشط</span>
            </div>
        </div>

        <!-- Bank Cards (Visa & Meeza) -->
        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-neutral-100 text-neutral-800 border border-neutral-200">
                        <i data-lucide="credit-card" class="h-5 w-5"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        نشط ومعتمد
                    </span>
                </div>
                <h3 class="text-base font-black text-[var(--text-strong)]">البطاقات البنكية وماكينات POS</h3>
                <p class="text-xs text-gray-500 leading-relaxed">استقبال المدفوعات ببطاقات فيزا، ماستركارد وميزة الوطنية عبر نقاط البيع المعتمدة بمقر الأكاديمية.</p>
                <div class="pt-2 text-[11px] font-mono text-[var(--text)] bg-[var(--surface-subtle)] p-2.5 rounded border border-gray-200">
                    <span class="text-[var(--text-muted)] block text-[10px]">ماكينات نقاط البيع:</span>
                    <span class="font-bold">3 أجهزة POS بنك مصر والبنك الأهلي</span>
                </div>
            </div>

            <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-[var(--text-muted)] text-[11px]">معدل التحصيل: 32%</span>
                <span class="font-bold text-[var(--text-strong)]">تسوية يومية 12:00 ص</span>
            </div>
        </div>

        <!-- Direct Bank Transfer -->
        <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 text-[var(--text)] border border-gray-200">
                        <i data-lucide="landmark" class="h-5 w-5"></i>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        نشط ومعتمد
                    </span>
                </div>
                <h3 class="text-base font-black text-[var(--text-strong)]">الحسابات والتحويلات البنكية المباشرة</h3>
                <p class="text-xs text-gray-500 leading-relaxed">التحويلات المصرفية عبر الحساب الرسمي المعتمد لأكاديمية النسور مع مطابقة إيصالات الإيداع والـ Swift.</p>
                <div class="pt-2 text-[11px] font-mono text-[var(--text)] bg-[var(--surface-subtle)] p-2.5 rounded border border-gray-200">
                    <span class="text-[var(--text-muted)] block text-[10px]">رقم الحساب الدولي (IBAN):</span>
                    <span class="font-bold text-[10px]">EG1200020001000000123456789</span>
                </div>
            </div>

            <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                <span class="text-[var(--text-muted)] text-[11px]">معدل التحصيل: 12%</span>
                <span class="font-bold text-[var(--text-strong)]">بنك مصر — فرع القاهرة الجديدة</span>
            </div>
        </div>
    </div>
</div>
@endsection
