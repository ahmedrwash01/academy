@extends('layouts.admin', ['title' => __('app.nav.players')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.players')" 
        subtitle="سجلات قيد اللاعبين، البيانات الفنية والبدنية، توزيع القطاعات ومتابعة الالتزام الميداني"
        badge="248 لاعباً مقيداً"
    >
        <x-slot:actions>
            <a href="{{ route('players.goalkeepers') }}" class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="shield" class="h-4 w-4 text-amber-500"></i>
                <span>أكاديمية الحراس</span>
            </a>
            <a href="{{ route('players.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-[#E3131B] px-4 py-2 text-xs font-bold text-white hover:bg-[#c00f16] transition-colors shadow-xs">
                <i data-lucide="plus" class="h-4 w-4"></i>
                <span>{{ __('app.nav.add_player') }}</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <!-- Roster Overview Stats Cards (Clean Tokenized Enterprise) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between border-s-4 border-s-[var(--info-text)]">
            <span class="text-[var(--text-muted)] font-bold">إجمالي القيد المعتمد:</span>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="font-black font-mono text-[var(--text-strong)] text-2xl tabular-nums">248</span>
                <span class="text-xs text-[var(--text-muted)] font-bold">لاعباً</span>
            </div>
            <span class="text-xs text-emerald-700 dark:text-emerald-400 font-bold mt-1">8 فئات سنية</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between border-s-4 border-s-emerald-600">
            <span class="text-[var(--text-muted)] font-bold">المشاركون بالميدان:</span>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="font-black font-mono text-[var(--text-strong)] text-2xl tabular-nums">236</span>
                <span class="text-xs text-[var(--text-muted)] font-bold">نشط</span>
            </div>
            <span class="text-xs text-emerald-700 dark:text-emerald-400 font-bold mt-1">جاهزية بدنية كاملة</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between border-s-4 border-s-amber-500">
            <span class="text-[var(--text-muted)] font-bold">قطاع حراس المرمى:</span>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="font-black font-mono text-[var(--text-strong)] text-2xl tabular-nums">28</span>
                <span class="text-xs text-[var(--text-muted)] font-bold">حارساً</span>
            </div>
            <span class="text-xs text-amber-700 dark:text-amber-400 font-bold mt-1">تدريب تخصصي</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between border-s-4 border-s-[#E3131B]">
            <span class="text-[var(--text-muted)] font-bold">الاشتراكات المسددة:</span>
            <div class="mt-2 flex items-baseline gap-1">
                <span class="font-black font-mono text-[var(--text-strong)] text-2xl tabular-nums">228</span>
                <span class="text-xs text-[var(--text-muted)] font-bold">مسدداً</span>
            </div>
            <span class="text-xs text-emerald-700 dark:text-emerald-400 font-bold mt-1">تحصيل 91.9%</span>
        </div>
    </div>

    <!-- Filter & Search Toolbar (Tokenized Card) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs">
        <form method="GET" action="{{ route('players.index') }}" class="flex flex-col md:flex-row items-center justify-between gap-3">
            <div class="w-full md:w-80 relative">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-[var(--text-muted)]">
                    <i data-lucide="search" class="h-4 w-4"></i>
                </div>
                <input 
                    type="search" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="ابحث بالاسم، المركز، أو رقم الهاتف..." 
                    class="w-full rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] py-2 ps-9 pe-4 text-xs text-[var(--text)] placeholder-[var(--text-muted)] focus:border-[#E3131B] focus:bg-[var(--surface)] focus:outline-none transition-colors shadow-2xs"
                >
            </div>

            <div class="flex flex-wrap items-center gap-2.5 w-full md:w-auto text-xs">
                <select name="age_group" onchange="this.form.submit()" class="rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] py-2 px-3 text-xs text-[var(--text)] focus:border-[#E3131B] focus:bg-[var(--surface)] focus:outline-none shadow-2xs font-arabic">
                    <option value="">كافة الفئات السنية</option>
                    <option value="U-11" {{ ($filterAge ?? '') === 'U-11' ? 'selected' : '' }}>براعم U-11</option>
                    <option value="U-13" {{ ($filterAge ?? '') === 'U-13' ? 'selected' : '' }}>ناشئين U-13</option>
                    <option value="U-15" {{ ($filterAge ?? '') === 'U-15' ? 'selected' : '' }}>شباب U-15</option>
                    <option value="U-17" {{ ($filterAge ?? '') === 'U-17' ? 'selected' : '' }}>شباب U-17</option>
                    <option value="الفريق الأول" {{ ($filterAge ?? '') === 'الفريق الأول' ? 'selected' : '' }}>الفريق الأول</option>
                </select>

                <select name="status" onchange="this.form.submit()" class="rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] py-2 px-3 text-xs text-[var(--text)] focus:border-[#E3131B] focus:bg-[var(--surface)] focus:outline-none shadow-2xs font-arabic">
                    <option value="">كافة حالات الاشتراك</option>
                    <option value="paid" {{ ($filterStatus ?? '') === 'paid' ? 'selected' : '' }}>مسدد بالكامل</option>
                    <option value="partial" {{ ($filterStatus ?? '') === 'partial' ? 'selected' : '' }}>سداد جزئي</option>
                    <option value="unpaid" {{ ($filterStatus ?? '') === 'unpaid' ? 'selected' : '' }}>متأخر / معلق</option>
                </select>

                <a href="{{ route('players.index') }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] p-2 text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs" title="إعادة تعيين الفلاتر">
                    <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Players Data Table (Tokenized Enterprise Table) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs">
                <thead>
                    <tr class="border-b border-[var(--border)] bg-[var(--surface-subtle)] text-[var(--text-muted)] text-xs font-bold uppercase">
                        <th class="py-3 px-4 text-start">اللاعب الموهوب</th>
                        <th class="py-3 px-4 text-start">الفئة / الفريق</th>
                        <th class="py-3 px-4 text-start">المركز والرقم</th>
                        <th class="py-3 px-4 text-start">ولي الأمر والهاتف</th>
                        <th class="py-3 px-4 text-start">حالة الاشتراك</th>
                        <th class="py-3 px-4 text-center">الانضباط الميداني</th>
                        <th class="py-3 px-4 text-center">التقييم الفني</th>
                        <th class="py-3 px-4 text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-[var(--text)]">
                    @forelse($players as $player)
                        <tr class="hover:bg-[var(--surface-subtle)] transition-colors group">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-xs shrink-0 shadow-2xs">
                                        {{ mb_substr($player['name_ar'], 0, 2) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('players.show', $player['id']) }}" class="font-bold text-[var(--text-strong)] group-hover:text-[#E3131B] transition-colors block text-sm">
                                            {{ $player['name_ar'] }}
                                        </a>
                                        <span class="text-xs text-[var(--text-muted)] font-mono block">
                                            ID: #00{{ $player['id'] }} • {{ $player['dob'] }} ({{ $player['age'] }} سنة)
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text)] border border-[var(--border)]">
                                    {{ $player['age_group'] }}
                                </span>
                                <span class="text-xs text-[var(--text-muted)] block mt-0.5">{{ $player['team_name_ar'] }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-[var(--text-strong)] block">{{ $player['position_ar'] }}</span>
                                <span class="text-xs text-[var(--text-muted)] font-mono">القميص: #{{ $player['jersey_number'] }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-[var(--text-strong)] block">{{ $player['parent_name_ar'] }}</span>
                                <span class="font-mono text-xs text-[var(--text-muted)]">{{ $player['parent_phone'] }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <x-status-badge :status="$player['subscription_status'] ?? 'paid'" />
                                <span class="block text-xs text-[var(--text-muted)] font-mono mt-0.5">
                                    المتبقي: {{ number_format($player['sub_remaining'] ?? 0) }} ج.م
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-[var(--text-strong)]">
                                {{ $player['attendance_rate'] }}%
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center gap-1 font-mono font-black text-xs text-amber-700 dark:text-amber-400 bg-amber-100 dark:bg-amber-950/50 border border-amber-300 dark:border-amber-800 px-2 py-0.5 rounded-md">
                                    ★ {{ $player['rating'] }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-end">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('players.show', $player['id']) }}" class="rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2.5 py-1 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs" title="عرض الملف">
                                        الملف
                                    </a>
                                    <a href="{{ route('players.passport', $player['id']) }}" class="rounded-lg bg-[#E3131B] px-2.5 py-1 text-xs font-bold text-white hover:bg-[#c00f16] transition-colors shadow-2xs" title="الجواز الرياضي">
                                        الجواز
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-[var(--text-muted)]">
                                لا يوجد لاعبين مطابقين لمعايير البحث
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-[var(--border)] bg-[var(--surface-subtle)] flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-[var(--text-muted)]">
            <span>عرض {{ count($players) }} من أصل 248 لاعباً مقيداً</span>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1 rounded-lg border border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:text-[var(--text-strong)] font-mono text-xs shadow-2xs">السابق</button>
                <span class="px-3 py-1 rounded-lg bg-[#E3131B] text-white font-mono text-xs shadow-2xs">1</span>
                <button class="px-3 py-1 rounded-lg border border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:text-[var(--text-strong)] font-mono text-xs shadow-2xs">التالي</button>
            </div>
        </div>
    </div>
</div>
@endsection
