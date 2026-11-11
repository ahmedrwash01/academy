@extends('layouts.admin', ['title' => __('app.nav.goalkeepers')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.goalkeepers')" 
        subtitle="القطاع التخصصي لإعداد وتطوير حراس المرمى تحت إشراف نخبة من كبار مدربي الحراس المعتمدين دولياً"
        badge="أكاديمية حراس المرمى النخبوية"
    >
        <x-slot:actions>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="users" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>كافة اللاعبين</span>
            </a>
            <a href="{{ route('players.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] px-3.5 py-2 text-xs font-bold text-white shadow-xs transition-colors">
                <i data-lucide="user-plus" class="w-3.5 h-3.5"></i>
                <span>قيد حارس جديد</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <!-- Goalkeeping Sector Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl bg-[var(--text-strong)] text-[var(--surface)] shadow-2xs border border-[var(--border)] flex flex-col justify-between">
            <span class="text-[10px] text-[#E3131B] font-bold uppercase tracking-wider">كبير مدربي الحراس</span>
            <div class="mt-2">
                <h4 class="text-sm font-black">كابتن طارق السروجي</h4>
                <p class="text-[10px] text-[var(--surface-subtle)] opacity-80">رخصة مدربي حراس مرمى معتمدة من FIFA & CAF A</p>
            </div>
            <div class="mt-3 pt-2.5 border-t border-[var(--border-subtle)] text-[10px] text-[var(--surface-subtle)] opacity-80">
                مقر تدريب الحراس: الملعب التخصصي المغلق
            </div>
        </div>

        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs flex flex-col justify-between">
            <span class="text-xs text-[var(--text-muted)] font-bold">الحراس الأساسيين للفرق</span>
            <span class="text-3xl font-black text-[var(--text-strong)] font-mono mt-1">{{ count($goalkeepers) }} حراس</span>
            <span class="text-[11px] text-emerald-700 font-bold mt-1">مشاركون في كافة بطولات الدوري</span>
        </div>

        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs flex flex-col justify-between">
            <span class="text-xs text-[var(--text-muted)] font-bold">الشباك النظيفة (Clean Sheets)</span>
            <span class="text-3xl font-black text-amber-500 font-mono mt-1">31 مباراة</span>
            <span class="text-[11px] text-[var(--text-muted)] font-mono mt-1">موسم 2025 / 2026</span>
        </div>

        <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs flex flex-col justify-between">
            <span class="text-xs text-[var(--text-muted)] font-bold">معدل التصديات للركلات</span>
            <span class="text-3xl font-black text-[#E3131B] font-mono mt-1">88.4%</span>
            <span class="text-[11px] text-[var(--text-muted)] mt-1">وفق قياسات الفيديو والتحليل الرقمي</span>
        </div>
    </div>

    <!-- Goalkeepers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($goalkeepers as $gk)
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs hover:border-[var(--border-strong)] hover:shadow-xs transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-start gap-3.5">
                        <div class="relative shrink-0">
                            <div class="h-14 w-14 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-base">
                                {{ mb_substr($gk['name_ar'], 0, 2) }}
                            </div>
                            <span class="absolute -bottom-1 -end-1 h-5 w-5 rounded bg-[var(--text-strong)] text-[var(--surface)] flex items-center justify-center text-[10px] font-mono font-bold">
                                {{ $gk['jersey_number'] ?? '1' }}
                            </span>
                        </div>
                        <div class="min-w-0">
                            <a href="{{ route('players.show', $gk['id']) }}" class="font-black text-[var(--text-strong)] text-sm group-hover:text-[#E3131B] transition-colors block truncate">
                                {{ $gk['name_ar'] }}
                            </a>
                            <span class="text-xs text-[#E3131B] font-bold block mt-0.5">{{ $gk['team_name_ar'] }}</span>
                            <span class="text-[10px] text-[var(--text-muted)] font-mono block">{{ $gk['dob'] }} ({{ $gk['age'] }} سنة)</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3.5 border-t border-gray-100 grid grid-cols-2 gap-2 text-xs">
                        <div class="p-2.5 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                            <span class="text-[var(--text-muted)] text-[10px] block">المباريات بشباك نظيفة:</span>
                            <span class="font-black text-[var(--text-strong)] font-mono text-sm mt-0.5 block">{{ $gk['clean_sheets'] ?? 0 }} مباراة</span>
                        </div>
                        <div class="p-2.5 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                            <span class="text-[var(--text-muted)] text-[10px] block">نسبة التصدي:</span>
                            <span class="font-black text-emerald-700 font-mono text-sm mt-0.5 block">{{ $gk['save_percentage'] ?? 89.4 }}%</span>
                        </div>
                    </div>

                    <div class="mt-3 text-xs space-y-1 text-[var(--text-muted)]">
                        <div class="flex justify-between">
                            <span>الطول والوزن:</span>
                            <span class="font-mono text-[var(--text-strong)] font-bold">{{ $gk['height'] }} سم • {{ $gk['weight'] }} كجم</span>
                        </div>
                        <div class="flex justify-between">
                            <span>القدم المفضلة:</span>
                            <span class="font-bold text-[var(--text-strong)]">{{ $gk['preferred_foot_ar'] ?? 'اليمنى' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <x-status-badge :status="$gk['status']" />
                    <a href="{{ route('players.show', $gk['id']) }}" class="inline-flex items-center gap-1 font-bold text-[var(--text-strong)] hover:text-[#E3131B] transition-colors">
                        <span>الملف الفني الشامل</span>
                        <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
