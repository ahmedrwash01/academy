@extends('layouts.admin', ['title' => 'ملف اللاعب 360: ' . $player['name_ar']])

@section('content')
<div class="space-y-6 font-arabic" x-data="{ activeTab: 'overview' }">
    <!-- Header with Breadcrumbs & Actions -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-3 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-1.5 text-xs text-[var(--text-muted)] mb-1">
                <a href="{{ route('dashboard') }}" class="hover:text-[var(--text-strong)] transition-colors">مركز القيادة</a>
                <span class="text-[var(--text-muted)]">/</span>
                <a href="{{ route('players.index') }}" class="hover:text-[var(--text-strong)] transition-colors">قائمة اللاعبين</a>
                <span class="text-[var(--text-muted)]">/</span>
                <span class="text-[var(--text-strong)] font-bold">{{ $player['name_ar'] }}</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">الملف الفني والرياضي الشامل (EAGLE PLAYER 360)</h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('players.passport', $player['id']) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-[#E3131B] bg-[var(--surface)] px-3 py-2 text-xs font-bold text-[#E3131B] hover:bg-[#E3131B]/10 transition-colors shadow-2xs">
                <i data-lucide="award" class="h-4 w-4"></i>
                <span>جواز التطوير الرياضي</span>
            </a>
            <a href="{{ route('players.edit', $player['id']) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-xs font-semibold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="edit-2" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
                <span>تعديل السجل</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg bg-[var(--text-strong)] px-3.5 py-2 text-xs font-bold text-[var(--surface)] hover:opacity-90 transition-opacity shadow-sm cursor-pointer">
                <i data-lucide="printer" class="h-3.5 w-3.5"></i>
                <span>طباعة الملف 360</span>
            </button>
        </div>
    </div>

    <!-- Executive Player Dossier Hero Card -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xs">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="relative shrink-0">
                    <img src="{{ $player['avatar'] }}" alt="{{ $player['name_ar'] }}" class="h-20 w-20 rounded-full object-cover border-2 border-[var(--border)] shadow-md">
                    <span class="absolute -bottom-1 -end-1 flex h-7 w-7 items-center justify-center rounded-full bg-[#E3131B] text-xs font-mono font-black text-white shadow-sm">
                        #{{ $player['jersey_number'] }}
                    </span>
                </div>

                <div class="space-y-1">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <h2 class="text-xl sm:text-2xl font-black text-[var(--text-strong)]">{{ $player['name_ar'] }}</h2>
                        <span class="text-xs text-[var(--text-muted)] font-mono">({{ $player['name_en'] }})</span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[var(--success-bg)] text-[var(--success-text)] border border-[var(--success-border)]">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                            <span>لائق طبياً 100%</span>
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[var(--text-muted)]">
                        <span class="font-bold text-[var(--text-strong)]">{{ $player['position_ar'] }}</span>
                        <span class="text-[var(--text-muted)]">•</span>
                        <span>{{ $player['team_name_ar'] }}</span>
                        <span class="text-[var(--text-muted)]">•</span>
                        <span class="font-mono">{{ $player['age'] }} سنة (مواليد {{ $player['dob'] }})</span>
                        <span class="text-[var(--text-muted)]">•</span>
                        <span class="font-mono text-[var(--text-strong)] font-semibold">ID: #00{{ $player['id'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Metrics Strip -->
            <div class="flex flex-wrap items-center gap-5 border-t lg:border-t-0 lg:border-s border-[var(--border)] pt-4 lg:pt-0 lg:ps-6 text-center text-xs">
                <div>
                    <span class="block text-2xl font-black font-mono text-[var(--text-strong)]">{{ $player['attendance_rate'] }}%</span>
                    <span class="text-[11px] text-[var(--text-muted)] font-semibold">الحضور الميداني</span>
                </div>
                <div class="border-s border-[var(--border)] ps-5">
                    <span class="block text-2xl font-black font-mono text-amber-500">★ {{ $player['rating'] }}</span>
                    <span class="text-[11px] text-[var(--text-muted)] font-semibold">التقييم الفني العام</span>
                </div>
                <div class="border-s border-[var(--border)] ps-5">
                    <span class="block text-2xl font-black font-mono text-[var(--text-strong)]">{{ $player['goals'] ?? $player['clean_sheets'] ?? 14 }}</span>
                    <span class="text-[11px] text-[var(--text-muted)] font-semibold">{{ !empty($player['is_goalkeeper']) ? 'شباك نظيفة' : 'مساهمة تهديفية' }}</span>
                </div>
            </div>
        </div>

        <!-- Comprehensive 360 Tabs Navigation -->
        <div class="mt-6 flex overflow-x-auto border-b border-[var(--border)] gap-6 text-xs font-bold">
            <button 
                @click="activeTab = 'overview'" 
                :class="activeTab === 'overview' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="user" class="h-3.5 w-3.5"></i>
                <span>البيانات الشخصية والطبية</span>
            </button>
            <button 
                @click="activeTab = 'skills'" 
                :class="activeTab === 'skills' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="activity" class="h-3.5 w-3.5"></i>
                <span>رادار المهارات والقياسات البدنية</span>
            </button>
            <button 
                @click="activeTab = 'passport'" 
                :class="activeTab === 'passport' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="award" class="h-3.5 w-3.5"></i>
                <span>جواز التطوير الرياضي</span>
            </button>
            <button 
                @click="activeTab = 'finance'" 
                :class="activeTab === 'finance' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="credit-card" class="h-3.5 w-3.5"></i>
                <span>سجل الاشتراكات والرسوم</span>
            </button>
            <button 
                @click="activeTab = 'attendance'" 
                :class="activeTab === 'attendance' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="calendar" class="h-3.5 w-3.5"></i>
                <span>سجل الحضور والتمارين</span>
            </button>
            <button 
                @click="activeTab = 'documents'" 
                :class="activeTab === 'documents' ? 'border-[#E3131B] text-[var(--text-strong)] font-black' : 'border-transparent text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                class="pb-2.5 border-b-2 transition-colors whitespace-nowrap flex items-center gap-1.5"
            >
                <i data-lucide="folder" class="h-3.5 w-3.5"></i>
                <span>الوثائق والتراخيص المعتمدة</span>
            </button>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 1: PERSONAL, GUARDIAN & MEDICAL INFORMATION                           -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'overview'" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Personal Data Card -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
            <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-[var(--border-subtle)] pb-3 flex items-center gap-2">
                <i data-lucide="info" class="h-4 w-4 text-[#E3131B]"></i>
                <span>البيانات الأساسية للاعب</span>
            </h3>
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">الاسم الرباعي الرسمي</span>
                    <span class="font-bold text-[var(--text-strong)] mt-1 block">{{ $player['name_ar'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">تاريخ الميلاد والسن</span>
                    <span class="font-mono text-[var(--text-strong)] font-bold mt-1 block">{{ $player['dob'] }} ({{ $player['age'] }} سنة)</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">الجنسية</span>
                    <span class="font-semibold text-[var(--text-strong)] mt-1 block">{{ $player['nationality_ar'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">رقم هاتف اللاعب الشخصي</span>
                    <span class="font-mono text-[var(--text-strong)] font-bold mt-1 block">{{ $player['phone'] }}</span>
                </div>
                <div class="col-span-2">
                    <span class="text-[var(--text-muted)] block text-[11px]">العنوان السكني المسجل</span>
                    <span class="font-medium text-[var(--text-strong)] mt-1 block">{{ $player['address_ar'] }}</span>
                </div>
            </div>
        </div>

        <!-- Guardian & Medical Card -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
            <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-[var(--border-subtle)] pb-3 flex items-center gap-2">
                <i data-lucide="shield" class="h-4 w-4 text-[#E3131B]"></i>
                <span>بيانات ولي الأمر والجاهزية الطبية</span>
            </h3>
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">اسم ولي الأمر</span>
                    <span class="font-bold text-[var(--text-strong)] mt-1 block">{{ $player['parent_name_ar'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">صلة القرابة</span>
                    <span class="font-semibold text-[var(--text-strong)] mt-1 block">{{ $player['parent_relation_ar'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">هاتف ولي الأمر للطوارئ</span>
                    <span class="font-mono text-[var(--text-strong)] font-bold mt-1 block">{{ $player['parent_phone'] }}</span>
                </div>
                <div>
                    <span class="text-[var(--text-muted)] block text-[11px]">تاريخ آخر فحص دوري</span>
                    <span class="font-mono text-[var(--text-strong)] font-bold mt-1 block">15 يناير 2026</span>
                </div>
                <div class="col-span-2 p-3 rounded-lg bg-emerald-50 border border-emerald-200">
                    <span class="text-emerald-900 font-bold block text-xs">تقرير اللجنة الطبية:</span>
                    <p class="text-emerald-800 text-[11px] mt-0.5 leading-relaxed">{{ $player['medical_notes_ar'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 2: SKILLS RADAR & PHYSICAL MEASUREMENTS                               -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'skills'" style="display: none;" class="space-y-6">
        <!-- Physical Stats Bar -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs text-center">
                <span class="text-xs text-[var(--text-muted)] font-semibold">الطول القانوني</span>
                <span class="block text-2xl font-black font-mono text-[var(--text-strong)] mt-1">{{ $player['height'] }} سم</span>
            </div>
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs text-center">
                <span class="text-xs text-[var(--text-muted)] font-semibold">الوزن المثالي</span>
                <span class="block text-2xl font-black font-mono text-[var(--text-strong)] mt-1">{{ $player['weight'] }} كجم</span>
            </div>
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs text-center">
                <span class="text-xs text-[var(--text-muted)] font-semibold">القدم المفضلة</span>
                <span class="block text-2xl font-bold text-[var(--text-strong)] mt-1">{{ $player['preferred_foot_ar'] }}</span>
            </div>
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs text-center">
                <span class="text-xs text-[var(--text-muted)] font-semibold">رقم القميص الرسمي</span>
                <span class="block text-2xl font-black font-mono text-[#E3131B] mt-1">#{{ $player['jersey_number'] }}</span>
            </div>
        </div>

        <!-- Radar Chart vs Attributes Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Radar Chart (6 cols) -->
            <div class="lg:col-span-6 rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text-strong)]">رادار الأداء الفني والبدني المعتمد</h3>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">مقارنة الموسم الحالي بالموسم السابق (مقياس من 100)</p>
                        </div>
                        <span class="text-xs font-mono font-bold text-[var(--text-strong)] bg-[var(--surface-subtle)] px-2 py-0.5 rounded border border-[var(--border)]">RADAR 360</span>
                    </div>

                    <div class="mt-4 flex items-center justify-center">
                        <div id="playerRadarChart" class="h-80 w-full"></div>
                    </div>
                </div>

                <div class="mt-3 pt-3 border-t border-[var(--border-subtle)] flex items-center justify-around text-xs text-[var(--text-muted)]">
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-[#E3131B]"></span> الموسم الحالي (2025/2026)</span>
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-[#747982]"></span> الموسم السابق (2024/2025)</span>
                </div>
            </div>

            <!-- Detailed Skills Progress Bars (6 cols) -->
            <div class="lg:col-span-6 rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">تفصيل المهارات ومعدل التطور الدوري</h3>
                    <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">+7.4% نمو عام</span>
                </div>

                <div class="space-y-3.5 text-xs">
                    @foreach($skills as $key => $skill)
                        <div>
                            <div class="flex justify-between font-bold mb-1">
                                <span class="text-[var(--text-strong)]">{{ $skill['name_ar'] }}</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-[var(--text-muted)] font-mono font-normal">سابقاً: {{ $skill['previous'] }}%</span>
                                    <span class="font-mono text-[var(--text-strong)] font-bold">{{ $skill['current'] }}%</span>
                                </div>
                            </div>
                            <div class="w-full bg-[var(--surface-subtle)] rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-[#E3131B] to-rose-500 h-2 rounded-full" style="width: {{ $skill['current'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 3: DEVELOPMENT PASSPORT (جواز التطوير الرياضي)                          -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'passport'" style="display: none;" class="space-y-6">
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xs space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[var(--border-subtle)] gap-3">
                <div>
                    <h3 class="text-base font-bold text-[var(--text-strong)]">جواز التطوير الفني للاعب (Eagle Development Passport)</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">متابعة الأهداف الفردية، التقييمات الربعية، وتوصيات الجهاز الفني المعتمد</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-mono text-[var(--text-muted)]">موعد التقييم القادم:</span>
                    <span class="text-xs font-mono font-bold text-[var(--text-strong)] bg-[var(--surface-subtle)] px-2.5 py-1 rounded border border-[var(--border)]">15 أبريل 2026</span>
                </div>
            </div>

            <!-- Head Coach Feedback Callout -->
            <div class="p-4 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)]">
                <div class="flex items-center gap-2 text-xs font-bold text-[var(--text-strong)] mb-1.5">
                    <i data-lucide="message-square" class="h-4 w-4 text-[#E3131B]"></i>
                    <span>ملاحظات المدير الفني المشرف (كابتن حسام عبد الرؤوف):</span>
                </div>
                <p class="text-xs text-[var(--text-muted)] leading-relaxed">{{ $feedback }}</p>
            </div>

            <!-- Current Development Targets -->
            <div>
                <h4 class="text-xs font-bold text-[var(--text-strong)] uppercase tracking-wider mb-3">الأهداف التدريبية المعتمدة للربع الحالي:</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($targets as $tgt)
                        <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs">
                            <div class="flex items-center justify-between text-xs mb-2">
                                <span class="font-bold text-[var(--text-strong)]">{{ $tgt['title'] }}</span>
                            </div>
                            <div class="mt-2 flex items-center justify-between text-[11px] text-[var(--text-muted)] mb-1">
                                <span>معدل الإنجاز الميداني:</span>
                                <span class="font-mono font-bold text-[var(--text-strong)]">{{ $tgt['progress'] }}%</span>
                            </div>
                            <div class="w-full bg-[var(--surface-subtle)] rounded-full h-1.5 overflow-hidden">
                                <div class="bg-[#E3131B] h-1.5 rounded-full" style="width: {{ $tgt['progress'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quarterly Evaluation Timeline -->
            <div class="pt-4 border-t border-[var(--border-subtle)]">
                <h4 class="text-xs font-bold text-[var(--text-strong)] uppercase tracking-wider mb-3">سجل التقييمات التاريخية:</h4>
                <div class="space-y-2.5">
                    @foreach($timeline as $tl)
                        <div class="p-3.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between text-xs">
                            <div class="flex items-center gap-3">
                                <span class="font-mono font-bold text-[var(--text-strong)] w-24 shrink-0">{{ $tl['date'] }}</span>
                                <div>
                                    <h5 class="font-bold text-[var(--text-strong)]">{{ $tl['title'] }}</h5>
                                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">{{ $tl['notes'] }}</p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-amber-500 bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)] shrink-0">{{ $tl['score'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 4: FINANCIAL & SUBSCRIPTION TRACKING (CLEAN SEPARATION!)              -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'finance'" style="display: none;" class="space-y-6">
        <!-- Subscription Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs">
                <span class="text-xs text-[var(--text-muted)]">قيمة الاشتراك السنوي</span>
                <span class="block text-2xl font-black font-mono text-[var(--text-strong)] mt-1">{{ number_format($player['sub_amount'] ?? 1800) }} ج.م</span>
                <span class="text-[11px] text-[var(--text-muted)] mt-1 block">{{ $player['package_ar'] ?? 'باقة النخبة' }}</span>
            </div>
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs">
                <span class="text-xs text-[var(--text-muted)]">المسدد فعلياً</span>
                <span class="block text-2xl font-black font-mono text-emerald-700 mt-1">{{ number_format($player['sub_paid'] ?? 1800) }} ج.م</span>
                <span class="text-[11px] text-emerald-700 font-semibold mt-1 block">إيصالات إلكترونية معتمدة</span>
            </div>
            <div class="p-4 rounded-xl bg-[var(--surface)] border border-[var(--border)] shadow-2xs">
                <span class="text-xs text-[var(--text-muted)]">المتبقي والمستحق</span>
                <span class="block text-2xl font-black font-mono {{ ($player['sub_remaining'] ?? 0) > 0 ? 'text-[#E3131B]' : 'text-[var(--text-muted)]' }} mt-1">
                    {{ number_format($player['sub_remaining'] ?? 0) }} ج.م
                </span>
                <span class="text-[11px] text-[var(--text-muted)] mt-1 block">{{ ($player['sub_remaining'] ?? 0) > 0 ? 'استحقاق مارس 2026' : 'خالص السداد' }}</span>
            </div>
        </div>

        <!-- Verified Receipts Table -->
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-[var(--border-subtle)] flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل المعاملات والإيصالات المسددة</h3>
                    <p class="text-xs text-[var(--text-muted)]">أرشفة رقمية متكاملة لمدفوعات الاشتراك وتاريخ التحصيل</p>
                </div>
                <a href="{{ route('payments.checkout') }}" class="text-xs font-bold text-[#E3131B] hover:underline font-arabic">
                    + تسجيل إيصال جديد
                </a>
            </div>

            <table class="w-full text-xs text-start">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                    <tr>
                        <th class="py-3 px-4 text-start">رقم الإيصال</th>
                        <th class="py-3 px-4 text-start">الباقة / البيان</th>
                        <th class="py-3 px-4 text-start">طريقة السداد</th>
                        <th class="py-3 px-4 text-start">تاريخ العملية</th>
                        <th class="py-3 px-4 text-start">المبلغ</th>
                        <th class="py-3 px-4 text-end">الإيصال</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    @forelse($transactions as $t)
                        <tr class="hover:bg-[var(--surface-subtle)] transition-colors">
                            <td class="py-3 px-4 font-mono font-bold text-[var(--text-strong)]">{{ $t['invoice_no'] ?? $t['receipt_no'] ?? $t['id'] }}</td>
                            <td class="py-3 px-4">{{ $t['package_ar'] ?? 'اشتراك فصلي' }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-[var(--surface-subtle)] border border-[var(--border)]">
                                    {{ $t['method_ar'] ?? 'إنستاباي' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-mono text-[var(--text-muted)]">{{ $t['date'] }}</td>
                            <td class="py-3 px-4 font-mono font-bold text-emerald-700">{{ number_format($t['amount']) }} ج.م</td>
                            <td class="py-3 px-4 text-end">
                                <a href="{{ route('payments.receipt', $t['id']) }}" class="rounded border border-[var(--border)] bg-[var(--surface)] px-2 py-1 text-[11px] font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)]">
                                    عرض وطباعة
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-[var(--text-muted)]">
                                لا توجد معاملات مالية مسجلة للاعب
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 5: ATTENDANCE HISTORY & DISCIPLINE                                    -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'attendance'" style="display: none;" class="space-y-6">
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل الانضباط والحضور الميداني التراكمي</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">متابعة نسب الحضور والغياب المبرر على مدار الموسم الرياضي</p>
                </div>
                <span class="text-xs font-mono font-bold text-[var(--text-strong)] bg-[var(--surface-subtle)] px-2.5 py-1 rounded border border-[var(--border)]">
                    معدل الحضور: {{ $player['attendance_rate'] }}%
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                <div class="p-3 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                    <span class="text-[var(--text-muted)] block text-[11px]">إجمالي الحصص المجدولة</span>
                    <span class="font-bold font-mono text-[var(--text-strong)] text-lg mt-1 block">38 حصة</span>
                </div>
                <div class="p-3 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                    <span class="text-[var(--text-muted)] block text-[11px]">الحصص المحضورة فعلياً</span>
                    <span class="font-bold font-mono text-emerald-700 text-lg mt-1 block">36 حصة</span>
                </div>
                <div class="p-3 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                    <span class="text-[var(--text-muted)] block text-[11px]">غياب بإذن مسبق</span>
                    <span class="font-bold font-mono text-amber-700 text-lg mt-1 block">2 حصة</span>
                </div>
                <div class="p-3 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                    <span class="text-[var(--text-muted)] block text-[11px]">غياب بدون إذن</span>
                    <span class="font-bold font-mono text-[var(--text-muted)] text-lg mt-1 block">0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- TAB 6: DOCUMENTS, LICENSES & MEDIA                                        -->
    <!-- ========================================================================= -->
    <div x-show="activeTab === 'documents'" style="display: none;" class="space-y-6">
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
            <div class="border-b border-[var(--border-subtle)] pb-3">
                <h3 class="text-sm font-bold text-[var(--text-strong)]">الوثائق الرسمية والأوراق المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">شهادات الاتحاد المصري لكرة القدم، الفحص الطبي، وعقد الانضمام</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="file-check" class="h-6 w-6 text-emerald-600 shrink-0"></i>
                        <div>
                            <h4 class="font-bold text-[var(--text-strong)]">بطاقة قيد الاتحاد المصري (EFA)</h4>
                            <span class="text-[11px] text-[var(--text-muted)] font-mono">رقم القيد: #EFA-2026-0941</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">معتمد</span>
                </div>

                <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="activity" class="h-6 w-6 text-emerald-600 shrink-0"></i>
                        <div>
                            <h4 class="font-bold text-[var(--text-strong)]">الشهادة الطبية وتخطيط القلب (ECG)</h4>
                            <span class="text-[11px] text-[var(--text-muted)] font-mono">مستشفى وادي النيل التخصصي</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">ساري</span>
                </div>

                <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="file-text" class="h-6 w-6 text-blue-600 shrink-0"></i>
                        <div>
                            <h4 class="font-bold text-[var(--text-strong)]">عقد الانضمام ولائحة الأكاديمية</h4>
                            <span class="text-[11px] text-[var(--text-muted)]">موقع إلكترونياً من ولي الأمر</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800">مؤرشف</span>
                </div>

                <div class="p-4 rounded-xl border border-[var(--border)] bg-[var(--surface-subtle)] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i data-lucide="image" class="h-6 w-6 text-[#E3131B] shrink-0"></i>
                        <div>
                            <h4 class="font-bold text-[var(--text-strong)]">الصور الشخصية والرقم القومي</h4>
                            <span class="text-[11px] text-[var(--text-muted)]">شهادة الميلاد المميكنة</span>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-200 text-gray-800">مستوفى</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
window.renderPlayerChart = function() {
    const radarEl = document.querySelector("#playerRadarChart");
    if (!radarEl) return;
    if (typeof ApexCharts === 'undefined') {
        setTimeout(window.renderPlayerChart, 40);
        return;
    }
    if (window._playerRadarChart) {
        try { window._playerRadarChart.destroy(); } catch(e){}
    }

    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#475569';
    const compareColor = isDarkMode ? '#6B7280' : '#94A3B8';

    radarEl.innerHTML = '';
    const radarChart = new ApexCharts(radarEl, {
        series: [{
            name: 'الموسم الحالي (2025/2026)',
            data: [
                {{ $skills['speed']['current'] ?? 92 }},
                {{ $skills['passing']['current'] ?? 94 }},
                {{ $skills['shooting']['current'] ?? 88 }},
                {{ $skills['ball_control']['current'] ?? 95 }},
                {{ $skills['tactical']['current'] ?? 90 }},
                {{ $skills['fitness']['current'] ?? 91 }},
                {{ $skills['teamwork']['current'] ?? 96 }}
            ]
        }, {
            name: 'الموسم السابق (2024/2025)',
            data: [
                {{ $skills['speed']['previous'] ?? 84 }},
                {{ $skills['passing']['previous'] ?? 88 }},
                {{ $skills['shooting']['previous'] ?? 79 }},
                {{ $skills['ball_control']['previous'] ?? 89 }},
                {{ $skills['tactical']['previous'] ?? 82 }},
                {{ $skills['fitness']['previous'] ?? 85 }},
                {{ $skills['teamwork']['previous'] ?? 90 }}
            ]
        }],
        chart: {
            type: 'radar',
            height: 320,
            toolbar: { show: false },
            fontFamily: 'IBM Plex Sans Arabic, sans-serif',
            background: 'transparent'
        },
        colors: ['#E3131B', compareColor],
        stroke: { width: 2 },
        fill: { opacity: [0.3, 0.15] },
        markers: { size: 4 },
        xaxis: {
            categories: [
                'السرعة والرشاقة',
                'دقة التمرير',
                'التسديد والإنهاء',
                'التحكم بالكرة',
                'الوعي التكتيكي',
                'اللياقة والتحمل',
                'الروح الجماعية'
            ],
            labels: {
                style: {
                    colors: [textColor, textColor, textColor, textColor, textColor, textColor, textColor],
                    fontSize: '11px',
                    fontFamily: 'IBM Plex Sans Arabic, sans-serif'
                }
            }
        },
        yaxis: {
            show: false,
            min: 50,
            max: 100
        },
        legend: { show: false },
        tooltip: {
            theme: isDarkMode ? 'dark' : 'light',
            y: { formatter: function(val) { return val + '% كفاءة'; } }
        }
    });

    radarChart.render();
    window._playerRadarChart = radarChart;
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.renderPlayerChart);
} else {
    window.renderPlayerChart();
}
window.addEventListener('page:loaded', window.renderPlayerChart);
window.addEventListener('theme-changed', () => setTimeout(window.renderPlayerChart, 50));
</script>
@endpush
