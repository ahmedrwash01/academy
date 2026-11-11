@extends('layouts.admin', ['title' => __('app.nav.subscriptions')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.subscriptions')" 
        subtitle="خطط وباقات التدريب، الاشتراكات السارية، وتتبع مواعيد الاستحقاق والتجديد الدوري"
        badge="228 اشتراكاً سارياً"
    >
        <x-slot:actions>
            <a href="{{ route('finance.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-emerald-700 hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="bar-chart-3" class="h-4 w-4"></i>
                <span>الميزانية والقوائم المالية</span>
            </a>
            <a href="{{ route('payments.checkout') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#E3131B] px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-[#c00f16] transition-colors">
                <i data-lucide="wallet" class="h-4 w-4"></i>
                <span>تجربة بوابة السداد الإلكتروني</span>
            </a>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="receipt" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>سجل الإيصالات الرسمية</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <!-- Subscription Plans Grid (Clean White Cards) -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2">
                <i data-lucide="layers" class="h-4 w-4 text-[#E3131B]"></i>
                <span>باقات التدريب المعتمدة لموسم 2026</span>
            </h3>
            <span class="text-xs text-[var(--text-muted)]">تحديث فوري لعدد المشتركين</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($plans as $plan)
                <div class="rounded-xl border {{ $plan['is_featured'] ? 'border-[#E3131B] ring-2 ring-[#E3131B]/20' : 'border-[var(--border)]' }} bg-[var(--surface)] p-5 shadow-2xs hover:shadow-xs transition-all flex flex-col justify-between relative overflow-hidden">
                    @if($plan['is_featured'])
                        <div class="absolute top-0 right-0 left-0 bg-[#E3131B] text-white text-[9px] font-black uppercase text-center py-0.5 tracking-wider font-arabic">
                            الباقة الأكثر تسجيلاً
                        </div>
                    @endif

                    <div class="{{ $plan['is_featured'] ? 'pt-2' : '' }}">
                        <div class="flex items-center justify-between">
                            <span class="rounded bg-[var(--surface-subtle)] px-2 py-0.5 text-[10px] font-bold text-[var(--text-strong)] border border-[var(--border)]">{{ $plan['badge'] }}</span>
                            <span class="text-xs font-mono font-bold text-[var(--text-muted)]">{{ $plan['active_subscribers'] }} مشترك</span>
                        </div>

                        <h4 class="text-base font-black text-[var(--text-strong)] mt-2.5">{{ $plan['name_ar'] }}</h4>
                        
                        <div class="mt-3 flex items-baseline gap-1">
                            <span class="text-2xl font-black text-[var(--text-strong)] font-mono">{{ number_format($plan['price']) }}</span>
                            <span class="text-xs font-bold text-[var(--text-muted)]">{{ __('app.currency') }}</span>
                            <span class="text-[11px] text-[var(--text-muted)]">/ {{ $plan['period_ar'] }}</span>
                        </div>

                        <div class="mt-4 space-y-2 border-t border-[var(--border)] pt-3 text-xs">
                            @foreach($plan['features_ar'] as $feat)
                                <div class="flex items-start gap-2">
                                    <i data-lucide="check" class="h-3.5 w-3.5 text-emerald-600 shrink-0 mt-0.5"></i>
                                    <span class="text-[var(--text-muted)] text-[11px] leading-relaxed">{{ $feat }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5 pt-3.5 border-t border-[var(--border)]">
                        <a href="{{ route('players.index') }}" class="w-full flex items-center justify-center gap-1.5 rounded-lg {{ $plan['is_featured'] ? 'bg-[#E3131B] text-white hover:bg-[#c00f16]' : 'bg-[var(--text-strong)] text-[var(--surface)] hover:opacity-90' }} py-2 text-xs font-bold transition-all shadow-2xs">
                            <span>متابعة المشتركين ({{ $plan['active_subscribers'] }})</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Active Subscribers Monitoring Table (Clean White Table) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل اشتراكات اللاعبين ومطابقة الأرصدة</h3>
                <p class="text-xs text-[var(--text-muted)]">متابعة دقيقة لمطابقة مستحقات الاشتراكات بدون معالجة دفع</p>
            </div>
            <a href="{{ route('payments.transactions') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E3131B] hover:underline">
                <span>سجل الإيصالات</span>
                <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-start">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                    <tr>
                        <th class="py-3 px-4 text-start">اللاعب</th>
                        <th class="py-3 px-4 text-start">الباقة</th>
                        <th class="py-3 px-4 text-start">قيمة الاشتراك</th>
                        <th class="py-3 px-4 text-start">المسدد فعلياً</th>
                        <th class="py-3 px-4 text-start">المتبقي</th>
                        <th class="py-3 px-4 text-start">حالة السداد</th>
                        <th class="py-3 px-4 text-end">ملف اللاعب</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    @foreach($players as $p)
                        <tr class="hover:bg-[var(--surface-subtle)]/80 transition-colors">
                            <td class="py-3 px-4">
                                <a href="{{ route('players.show', $p['id']) }}" class="font-bold text-[var(--text-strong)] hover:text-[#E3131B] flex items-center gap-2">
                                    <img src="{{ $p['avatar'] }}" class="h-7 w-7 rounded-full object-cover border border-[var(--border)]">
                                    <span>{{ $p['name_ar'] }}</span>
                                </a>
                            </td>
                            <td class="py-3 px-4 text-[var(--text-muted)]">{{ $p['package_ar'] ?? 'باقة النخبة' }}</td>
                            <td class="py-3 px-4 font-mono font-bold text-[var(--text-strong)]">
                                {{ number_format($p['sub_amount'] ?? 1800) }} ج.م
                            </td>
                            <td class="py-3 px-4 font-mono font-bold text-emerald-700">
                                {{ number_format($p['sub_paid'] ?? 1800) }} ج.م
                            </td>
                            <td class="py-3 px-4 font-mono font-bold {{ ($p['sub_remaining'] ?? 0) > 0 ? 'text-[#E3131B]' : 'text-[var(--text-muted)]' }}">
                                {{ number_format($p['sub_remaining'] ?? 0) }} ج.م
                            </td>
                            <td class="py-3 px-4">
                                <x-status-badge :status="$p['subscription_status'] ?? 'paid'" />
                            </td>
                            <td class="py-3 px-4 text-end">
                                <a href="{{ route('players.show', $p['id']) }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2.5 py-1 text-[11px] font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                                    الملف الكامل
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