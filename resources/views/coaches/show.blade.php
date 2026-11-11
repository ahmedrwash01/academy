@extends('layouts.admin', ['title' => 'الملف الفني للمدرب: ' . $coach['name_ar']])

@section('content')
<div class="space-y-6 max-w-6xl mx-auto font-arabic">
    <!-- Breadcrumb context -->
    <div class="flex items-center gap-2 text-xs text-[var(--text-muted)]">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-600 transition-colors">لوحة التحكم</a>
        <i data-lucide="chevron-left" class="h-3 w-3 rtl:rotate-0 ltr:rotate-180"></i>
        <a href="{{ route('coaches.index') }}" class="hover:text-gray-600 transition-colors">الجهاز الفني والمدربين</a>
        <i data-lucide="chevron-left" class="h-3 w-3 rtl:rotate-0 ltr:rotate-180"></i>
        <span class="text-[var(--text-strong)] font-bold">{{ $coach['name_ar'] }}</span>
    </div>

    <!-- Coach Dossier Hero Card -->
    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-6 sm:p-8 shadow-2xs">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <img src="{{ $coach['avatar'] }}" alt="{{ $coach['name_ar'] }}" class="h-24 w-24 rounded-xl object-cover ring-2 ring-gray-200 shadow-sm shrink-0">
                <div class="space-y-1">
                    <div class="flex items-center gap-2.5">
                        <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">{{ $coach['name_ar'] }}</h1>
                        <span class="px-2.5 py-0.5 rounded text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                            {{ $coach['certifications'] }}
                        </span>
                    </div>
                    <p class="text-xs font-bold text-red-600">{{ $coach['role_ar'] }} • {{ $coach['specialization_ar'] }}</p>
                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 pt-1">
                        <span class="flex items-center gap-1">
                            <i data-lucide="mail" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
                            <span class="font-mono">{{ $coach['email'] }}</span>
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="phone" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
                            <span class="font-mono">{{ $coach['phone'] }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Performance Badges -->
            <div class="flex items-center gap-3 bg-[var(--surface-subtle)]/80 p-4 rounded-xl border border-gray-200/80 text-center">
                <div class="px-3">
                    <span class="text-[10px] text-[var(--text-muted)] font-bold uppercase tracking-wider block">تقييم الكفاءة</span>
                    <span class="block text-xl font-black text-amber-500 font-mono mt-0.5">★ {{ $coach['rating'] }}</span>
                </div>
                <div class="border-s border-gray-200 px-3">
                    <span class="text-[10px] text-[var(--text-muted)] font-bold uppercase tracking-wider block">اللاعبين تحت الإشراف</span>
                    <span class="block text-xl font-black text-[var(--text-strong)] font-mono mt-0.5">{{ $coach['trainees_count'] }}</span>
                </div>
                <div class="border-s border-gray-200 px-3">
                    <span class="text-[10px] text-[var(--text-muted)] font-bold uppercase tracking-wider block">نسبة الالتزام</span>
                    <span class="block text-xl font-black text-emerald-600 font-mono mt-0.5">97.8%</span>
                </div>
            </div>
        </div>

        <!-- Career & Assignment Split -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-gray-100 pt-6 text-xs">
            <!-- Col 1: Credentials -->
            <div class="space-y-3">
                <h3 class="font-bold text-[var(--text-strong)] text-sm flex items-center gap-2">
                    <i data-lucide="award" class="h-4 w-4 text-red-600"></i>
                    <span>الشهادات والاعتمادات الرسمية</span>
                </h3>
                <div class="p-4 rounded-xl bg-[var(--surface-subtle)]/80 border border-gray-200/60 space-y-2.5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">الرخصة الفنية المعتمدة:</span>
                        <span class="font-bold text-[var(--text-strong)]">{{ $coach['certifications'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">الخبرة في التدريب الاحترافي:</span>
                        <span class="font-bold text-[var(--text-strong)]">{{ $coach['experience'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">التخصص التكتيكي:</span>
                        <span class="font-bold text-[var(--text-strong)]">{{ $coach['specialization_ar'] }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">تاريخ الانضمام للأكاديمية:</span>
                        <span class="font-mono text-[var(--text)]">15 أغسطس 2023</span>
                    </div>
                </div>
            </div>

            <!-- Col 2: Assigned Teams -->
            <div class="space-y-3">
                <h3 class="font-bold text-[var(--text-strong)] text-sm flex items-center gap-2">
                    <i data-lucide="users" class="h-4 w-4 text-red-600"></i>
                    <span>الفرق والقطاعات الموكلة</span>
                </h3>
                <div class="p-4 rounded-xl bg-[var(--surface-subtle)]/80 border border-gray-200/60 space-y-3">
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($coach['assigned_teams'] as $team)
                            <span class="px-2.5 py-1 rounded bg-[var(--surface)] border border-gray-200 font-bold text-[var(--text-strong)] text-xs">
                                {{ $team }}
                            </span>
                        @endforeach
                    </div>
                    <p class="text-gray-500 leading-relaxed text-[11px] pt-1">
                        يقود الخطة التدريبية الموحدة لقطاع الأشبال وتأهيل المواهب للمشاركة في مسابقات دوري منطقة القاهرة والبطولات الودية الدولية.
                    </p>
                </div>
            </div>

            <!-- Col 3: Weekly Field Schedule -->
            <div class="space-y-3">
                <h3 class="font-bold text-[var(--text-strong)] text-sm flex items-center gap-2">
                    <i data-lucide="calendar" class="h-4 w-4 text-red-600"></i>
                    <span>المخطط التدريبي الأسبوعي</span>
                </h3>
                <div class="p-4 rounded-xl bg-[var(--surface-subtle)]/80 border border-gray-200/60 space-y-2.5">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">أيام التمارين:</span>
                        <span class="font-bold text-[var(--text-strong)]">الأحد • الثلاثاء • الخميس</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">الفترة الزمنية:</span>
                        <span class="font-mono text-[var(--text-strong)]">04:30 م – 07:00 م</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">الملعب المخصص:</span>
                        <span class="font-bold text-red-600">ستاد النسور الرئيسي</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
