@extends('layouts.admin', ['title' => 'الملاعب والتدريبات الفردية والمعسكرات — EAGLE TRAINING'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    trainTab: 'facilities', // 'facilities', 'private', 'curricula', 'camps', 'schedule'
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                    <span>EAGLE FOOTBALL OPERATIONS</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">قطاع التدريب الميداني والمنشآت الرياضية</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">الملاعب، البرامج التدريبية، الجلسات الخاصة (Private)، والمعسكرات</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">جدول إشغال الاستادات، الحصص الفردية لتطوير المهارات، والمناهج التدريبية المعتمدة</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('attendance.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] px-3.5 py-2 text-xs font-bold text-white shadow-xs transition-colors">
                <i data-lucide="clipboard-check" class="h-4 w-4"></i>
                <span>تسجيل الحضور والغياب اليومي</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="printer" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>طباعة جدول الحصص</span>
            </button>
        </div>
    </div>

    <!-- Sub-tabs Navigation -->
    <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-x-auto w-full sm:w-auto">
        <button 
            type="button" 
            @click="trainTab = 'facilities'" 
            :class="trainTab === 'facilities' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="map-pin" class="w-4 h-4 text-[#E3131B]"></i>
            <span>الملاعب والمنشآت (3)</span>
        </button>
        <button 
            type="button" 
            @click="trainTab = 'private'" 
            :class="trainTab === 'private' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="user-check" class="w-4 h-4"></i>
            <span>التدريبات الفردية (Private)</span>
        </button>
        <button 
            type="button" 
            @click="trainTab = 'curricula'" 
            :class="trainTab === 'curricula' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="layers" class="w-4 h-4"></i>
            <span>البرامج والمناهج الفنية</span>
        </button>
        <button 
            type="button" 
            @click="trainTab = 'camps'" 
            :class="trainTab === 'camps' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="compass" class="w-4 h-4"></i>
            <span>المعسكرات والرحلات الترفيهية</span>
        </button>
        <button 
            type="button" 
            @click="trainTab = 'schedule'" 
            :class="trainTab === 'schedule' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>جدول الحصص الأسبوعي</span>
        </button>
    </div>

    <!-- TAB 1: FACILITIES & GROUNDS -->
    <div x-show="trainTab === 'facilities'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($facilities as $f)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs hover:border-[var(--border-strong)] transition-all flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center justify-between pb-2 border-b border-[var(--border-subtle)]">
                            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider font-mono">منشأة معتمدة #{{ $f['id'] }}</span>
                            <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)] flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>{{ $f['status'] }}</span>
                            </span>
                        </div>

                        <h3 class="text-base font-black text-[var(--text-strong)] mt-2.5">{{ $f['name_ar'] }}</h3>

                        <div class="mt-4 space-y-2 text-xs text-[var(--text-muted)]">
                            <div class="flex justify-between">
                                <span class="font-medium">نوعية الأرضية:</span>
                                <span class="font-bold text-[var(--text-strong)]">{{ $f['surface'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">المقاييس الهندسية:</span>
                                <span class="font-mono text-[var(--text-strong)]">{{ $f['dimensions'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">أنظمة الإضاءة:</span>
                                <span class="font-bold text-[var(--text-strong)]">{{ $f['lighting'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-medium">المرافق الملحقة:</span>
                                <span class="text-[var(--text-strong)]">{{ $f['capacity'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] text-xs">
                        <span class="text-[var(--text-muted)] text-[10px] block">الحجز التدريبي النشط حالياً:</span>
                        <span class="font-black text-[#E3131B] mt-0.5 block">{{ $f['current_booking'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 2: PRIVATE 1-ON-1 TRAINING SESSIONS -->
    <div x-show="trainTab === 'private'" class="space-y-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 border-b border-[var(--border)] gap-3">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">برنامج التدريب الفردي التخصصي (Private 1-on-1 Sessions)</h3>
                    <p class="text-xs text-[var(--text-muted)]">جلسات فردية مع المدربين لصقل نقاط الضعف وتكثيف المهارات التخصصية</p>
                </div>
                <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                    3 حصص فردية مؤكدة هذا الأسبوع
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                @foreach($privateSessions as $ps)
                    <div class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-4 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-sm font-black text-[var(--text-strong)]">{{ $ps['player_name_ar'] }}</h4>
                                    <span class="text-[11px] font-bold text-[#E3131B]">{{ $ps['position_ar'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                    {{ $ps['status'] }}
                                </span>
                            </div>

                            <div class="mt-3 space-y-1.5 text-xs text-[var(--text-muted)]">
                                <div>
                                    <span class="font-bold text-[var(--text)]">المدرب المشرف:</span>
                                    <span class="text-[var(--text-strong)] font-medium">{{ $ps['coach_name_ar'] }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-[var(--text)]">الموعد والتوقيت:</span>
                                    <span class="font-mono text-[var(--text-strong)]">{{ $ps['date'] }} ({{ $ps['time'] }})</span>
                                </div>
                                <div>
                                    <span class="font-bold text-[var(--text)]">الملعب:</span>
                                    <span class="text-[var(--text-strong)]">{{ $ps['pitch'] }}</span>
                                </div>
                            </div>

                            <div class="mt-3 p-2.5 bg-[var(--surface)] rounded-lg border border-[var(--border)] text-[11px]">
                                <span class="font-bold text-[var(--success-text)] block mb-0.5">المستهدف التدريبي:</span>
                                <p class="text-[var(--text-muted)]">{{ $ps['focus_area'] }}</p>
                            </div>
                        </div>

                        <button class="w-full py-1.5 bg-[var(--text-strong)] hover:bg-[#E3131B] text-[var(--surface)] hover:text-white text-[11px] font-bold rounded-lg transition-colors cursor-pointer">
                            تقرير تقييم الحصة الفردية
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- TAB 3: CURRICULA & METHODOLOGY -->
    <div x-show="trainTab === 'curricula'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($curricula as $cur)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center justify-between pb-2 border-b border-[var(--border-subtle)]">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--danger-bg)] text-[var(--danger-text)] border border-[var(--danger-border)]">
                                {{ $cur['target_age'] }}
                            </span>
                            <span class="font-mono text-xs font-bold text-[var(--text-muted)]">{{ $cur['weeks'] }} أسبوعاً تدريبياً</span>
                        </div>

                        <h3 class="text-base font-black text-[var(--text-strong)] mt-3">{{ $cur['title_ar'] }}</h3>
                        <p class="text-xs text-[var(--text-muted)] leading-relaxed mt-2">{{ $cur['description'] }}</p>
                    </div>

                    <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] text-xs flex items-center justify-between">
                        <span class="text-gray-500 font-medium">كثافة الحصص:</span>
                        <span class="font-bold text-[var(--text-strong)]">{{ $cur['sessions_per_week'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 4: CAMPS & RECREATIONAL TRIPS -->
    <div x-show="trainTab === 'camps'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($camps as $c)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                {{ $c['type'] }}
                            </span>
                            <span class="text-[11px] font-bold text-emerald-700">{{ $c['status'] }}</span>
                        </div>

                        <h3 class="text-base font-black text-[var(--text-strong)] mt-3">{{ $c['title_ar'] }}</h3>

                        <div class="mt-4 space-y-2 text-xs text-[var(--text-muted)]">
                            <div>
                                <span class="font-bold text-[var(--text)]">الموقع والمقر:</span>
                                <span class="text-[var(--text-strong)]">{{ $c['location'] }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-[var(--text)]">الفترة الزمنية:</span>
                                <span class="font-mono text-[var(--text-strong)]">{{ $c['duration'] }}</span>
                            </div>
                            <div>
                                <span class="font-bold text-[var(--text)]">الفرق المستهدفة:</span>
                                <span class="font-bold text-[#E3131B]">{{ $c['target_teams'] }}</span>
                            </div>
                        </div>

                        <div class="mt-3 p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] text-xs text-[var(--text)] leading-relaxed">
                            <strong class="text-[var(--text-strong)] block mb-0.5">مزايا البرنامج:</strong>
                            {{ $c['features'] }}
                        </div>
                    </div>

                    <button class="w-full py-2 bg-[var(--text-strong)] hover:bg-[#E3131B] text-[var(--surface)] hover:text-white text-xs font-bold rounded-lg transition-colors cursor-pointer">
                        تحميل جدول وبرنامج المعسكر
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 5: WEEKLY SESSIONS SCHEDULE -->
    <div x-show="trainTab === 'schedule'" class="space-y-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
                <h3 class="text-sm font-bold text-[var(--text-strong)]">جدول الحصص الميدانية الأسبوعية لجميع الفئات السنية</h3>
                <span class="text-xs font-mono font-bold text-[var(--text-muted)] bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)]">{{ count($sessions) }} حصص مسجلة</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-start">
                    <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                        <tr>
                            <th class="py-3 px-4 text-start">الحصة والتركيز</th>
                            <th class="py-3 px-4 text-start">الفريق</th>
                            <th class="py-3 px-4 text-start">المدرب المشرف</th>
                            <th class="py-3 px-4 text-start">الملعب</th>
                            <th class="py-3 px-4 text-start">اليوم والتوقيت</th>
                            <th class="py-3 px-4 text-end">الحضور</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                        @foreach($sessions as $s)
                            <tr class="hover:bg-[var(--surface-subtle)]/60 transition-colors">
                                <td class="py-3.5 px-4 font-bold text-[var(--text-strong)]">{{ $s['title_ar'] }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--danger-bg)] text-[var(--danger-text)] border border-[var(--danger-border)]">
                                        {{ $s['team_ar'] ?? $s['team'] ?? 'فريق الأكاديمية' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 font-medium">{{ $s['coach_ar'] ?? $s['coach_name_ar'] ?? 'كابتن الأكاديمية' }}</td>
                                <td class="py-3.5 px-4 text-[var(--text-muted)]">{{ $s['ground_ar'] ?? $s['pitch'] ?? 'الملعب الرئيسي' }}</td>
                                <td class="py-3.5 px-4 font-mono text-[var(--text-muted)]">{{ $s['day_ar'] ?? $s['date'] ?? 'اليوم' }} • {{ $s['time'] }}</td>
                                <td class="py-3.5 px-4 text-end">
                                    <a href="{{ route('attendance.index') }}" class="px-2.5 py-1 rounded bg-[var(--text-strong)] text-[var(--surface)] font-bold hover:bg-[#E3131B] transition-colors text-[11px]">
                                        رصد الحضور
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
