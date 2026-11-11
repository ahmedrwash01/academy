@extends('layouts.admin', ['title' => 'الجهاز الفني وورش العمل للمدربين — EAGLE COACHES'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    coachTab: 'coaches', // 'coaches' or 'workshops'
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="user-check" class="w-3.5 h-3.5"></i>
                    <span>EAGLE TECHNICAL FACULTY</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">الإدارة الفنية والأجهزة التدريبية المعتمدة</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">الكادر الفني، الأجهزة التدريبية، وورش العمل التأهيلية</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">رخص التدريب القارية (CAF & UEFA)، التخصصات التكتيكية، وبرامج التطوير المهني المستمر للمدربين</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('coaches.create') }}" class="inline-flex items-center gap-1.5 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] px-3.5 py-2 text-xs font-bold text-white shadow-xs transition-colors">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                <span>إضافة مدرب جديد</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>طباعة الكشف الفني</span>
            </button>
        </div>
    </div>

    <!-- Sub-tabs Navigation -->
    <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs">
        <button 
            type="button" 
            @click="coachTab = 'coaches'" 
            :class="coachTab === 'coaches' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2"
        >
            <i data-lucide="users" class="w-4 h-4"></i>
            <span>كشف الأجهزة الفنية والمدربين ({{ count($coaches) }})</span>
        </button>
        <button 
            type="button" 
            @click="coachTab = 'workshops'" 
            :class="coachTab === 'workshops' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2"
        >
            <i data-lucide="book-open" class="w-4 h-4 text-[#E3131B]"></i>
            <span>ورش العمل للمدربين (Workshops)</span>
        </button>
    </div>

    <!-- Strategic Metrics Bar -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between">
            <span class="text-[var(--text-muted)] block text-[11px] font-bold">إجمالي الطاقم الفني</span>
            <div class="mt-2 text-3xl font-black font-mono text-[var(--text-strong)]">{{ count($coaches) }}</div>
            <span class="text-emerald-700 font-bold mt-2 pt-2 border-t border-gray-100 text-[11px]">100% رخص CAF و UEFA و EFA</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between">
            <span class="text-[var(--text-muted)] block text-[11px] font-bold">متوسط سنوات الخبرة</span>
            <div class="mt-2 text-3xl font-black font-mono text-[var(--text-strong)]">9.4</div>
            <span class="text-[var(--text-muted)] mt-2 pt-2 border-t border-gray-100 text-[11px]">أندية الدوري والمنتخبات</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between">
            <span class="text-[var(--text-muted)] block text-[11px] font-bold">معدل التقييم الفني</span>
            <div class="mt-2 text-3xl font-black font-mono text-amber-500">★ 4.88</div>
            <span class="text-[var(--text-muted)] mt-2 pt-2 border-t border-gray-100 text-[11px]">وفق معايير اللجنة الفنية</span>
        </div>

        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs flex flex-col justify-between">
            <span class="text-[var(--text-muted)] block text-[11px] font-bold">ورش العمل المجدولة</span>
            <div class="mt-2 text-3xl font-black font-mono text-[#E3131B]">{{ count($workshops) }}</div>
            <span class="text-[var(--text-muted)] mt-2 pt-2 border-t border-[var(--border-subtle)] text-[11px]">برنامج التطوير المستمر CPD</span>
        </div>
    </div>

    <!-- TAB 1: COACHES DIRECTORY -->
    <div x-show="coachTab === 'coaches'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($coaches as $coach)
                <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs hover:border-[var(--border-strong)] transition-all flex flex-col justify-between group">
                    <div>
                        <!-- Header: License Badge & Rating -->
                        <div class="flex items-center justify-between text-xs pb-3 border-b border-[var(--border-subtle)]">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]">
                                {{ $coach['certifications'] }}
                            </span>
                            <span class="font-mono font-bold text-amber-500 text-xs">
                                ★ {{ $coach['rating'] }}
                            </span>
                        </div>

                        <!-- Identity -->
                        <div class="mt-4 flex items-center gap-3">
                            <div class="h-12 w-12 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-sm shrink-0">
                                {{ mb_substr($coach['name_ar'], 0, 2) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-black text-sm text-[var(--text-strong)] group-hover:text-[#E3131B] transition-colors truncate">
                                    {{ $coach['name_ar'] }}
                                </h3>
                                <p class="text-xs text-[#E3131B] font-semibold mt-0.5 truncate">{{ $coach['role_ar'] }}</p>
                            </div>
                        </div>

                        <!-- Technical Specs -->
                        <div class="mt-4 space-y-2 text-xs text-[var(--text-muted)]">
                            <div class="flex justify-between">
                                <span>الفرق المسندة:</span>
                                <span class="font-bold text-[var(--text-strong)] truncate max-w-[140px]">{{ is_array($coach['assigned_teams'] ?? null) ? implode(' • ', $coach['assigned_teams']) : ($coach['team_assigned_ar'] ?? 'كافة الفرق') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>الخبرة الميدانية:</span>
                                <span class="font-mono text-[var(--text-strong)]">{{ $coach['experience'] ?? '8 سنوات تدريب' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>التخصص التدريبي:</span>
                                <span class="text-[var(--text-strong)] truncate max-w-[140px]">{{ $coach['specialization_ar'] ?? 'تطوير فني وتكتيكي' }}</span>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] text-[11px] text-[var(--text-muted)] flex items-center justify-between font-mono">
                            <span>{{ $coach['phone'] }}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)]">نشط ميدانياً</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-[var(--border-subtle)] flex items-center gap-2">
                        <a href="{{ route('coaches.show', $coach['id']) }}" class="w-full text-center py-2 rounded-lg bg-[var(--text-strong)] hover:bg-[#E3131B] text-[var(--surface)] hover:text-white text-xs font-bold transition-colors">
                            الملف الفني والسيرة الذاتية
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 2: COACH CPD WORKSHOPS -->
    <div x-show="coachTab === 'workshops'" class="space-y-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-[var(--border)] gap-2">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">برنامج ورش العمل الفنية والتطوير المهني المستمر (Coach CPD)</h3>
                    <p class="text-xs text-[var(--text-muted)]">محاضرات وتطبيقات ميدانية متخصصة لتطوير كفاءة المدربين والارتقاء بالمستوى الخططي</p>
                </div>
                <span class="text-xs font-mono font-bold text-[var(--success-text)] bg-[var(--success-bg)] px-2.5 py-1 rounded border border-[var(--success-border)]">
                    معتمدة من الإدارة الفنية
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                @foreach($workshops as $w)
                    <div class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-5 flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex items-start justify-between gap-3">
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold bg-[var(--danger-bg)] text-[var(--danger-text)] border border-[var(--danger-border)] font-mono">
                                    ورشة تخصصية #{{ $w['id'] }}
                                </span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)]">
                                    {{ $w['status'] }}
                                </span>
                            </div>

                            <h4 class="text-sm font-black text-[var(--text-strong)] mt-2.5 leading-snug">
                                {{ $w['title_ar'] }}
                            </h4>

                            <div class="mt-3 space-y-1.5 text-xs text-[var(--text-muted)]">
                                <div>
                                    <span class="font-bold text-[var(--text)]">المحاضر / الخبير:</span>
                                    <span class="text-[var(--text-strong)] font-medium">{{ $w['instructor'] }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-[var(--text)]">الموعد والتوقيت:</span>
                                    <span class="font-mono text-[var(--text-strong)]">{{ $w['date'] }} ({{ $w['time'] }})</span>
                                </div>
                                <div>
                                    <span class="font-bold text-[var(--text)]">المكان والمقر:</span>
                                    <span class="text-[var(--text-strong)]">{{ $w['location'] }}</span>
                                </div>
                            </div>

                            <div class="mt-3 p-3 bg-[var(--surface)] rounded-lg border border-[var(--border)] text-xs">
                                <span class="font-bold text-[var(--success-text)] block mb-0.5">المحاور الفنية:</span>
                                <p class="text-[var(--text-muted)]">{{ $w['topics'] }}</p>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-[var(--border-subtle)] flex items-center justify-between text-xs">
                            <span class="text-[var(--text-muted)] font-mono">مسجل: <strong class="text-[var(--text-strong)]">{{ $w['registered_coaches'] }} مدرباً</strong></span>
                            <button class="px-3.5 py-1.5 bg-[var(--text-strong)] hover:bg-[#E3131B] text-[var(--surface)] hover:text-white text-xs font-bold rounded-lg transition-colors cursor-pointer">
                                كشف الحضور والشهادات
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
