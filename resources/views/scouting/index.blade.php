@extends('layouts.admin', ['title' => 'رادار النسور لاكتشاف المواهب — EAGLE TALENT RADAR'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    viewMode: 'board', // 'board', 'table', 'compare'
    candidates: {{ json_encode($candidates) }},
    stages: [
        { id: 'new', label_ar: 'مرشح جديد', badge_color: 'bg-blue-50 text-blue-700 border-blue-200', count: 0 },
        { id: 'under_review', label_ar: 'قيد المراجعة الفنية', badge_color: 'bg-amber-50 text-amber-700 border-amber-200', count: 0 },
        { id: 'trial_scheduled', label_ar: 'معايشة ميدانية مجدولة', badge_color: 'bg-purple-50 text-purple-700 border-purple-200', count: 0 },
        { id: 'evaluated', label_ar: 'تم التقييم الفني', badge_color: 'bg-sky-50 text-sky-700 border-sky-200', count: 0 },
        { id: 'accepted', label_ar: 'تم القبول والضم', badge_color: 'bg-emerald-50 text-emerald-700 border-emerald-200', count: 0 },
        { id: 'rejected', label_ar: 'مستبعد / أرشيف', badge_color: 'bg-gray-100 text-gray-600 border-gray-300', count: 0 }
    ],
    selectedCandidate: null,
    rubricModal: false,
    compareCandidate1: null,
    compareCandidate2: null,
    searchFilter: '',
    
    init() {
        this.updateCounts();
        if (this.candidates.length > 0) {
            this.compareCandidate1 = this.candidates[0].id;
            this.compareCandidate2 = this.candidates.length > 1 ? this.candidates[1].id : this.candidates[0].id;
        }
    },
    
    updateCounts() {
        this.stages.forEach(s => {
            s.count = this.candidates.filter(c => c.stage === s.id).length;
        });
    },

    getCandidatesByStage(stageId) {
        return this.candidates.filter(c => {
            const matchesStage = c.stage === stageId;
            const matchesSearch = this.searchFilter === '' || 
                c.name_ar.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                c.position_ar.toLowerCase().includes(this.searchFilter.toLowerCase()) ||
                c.current_club.toLowerCase().includes(this.searchFilter.toLowerCase());
            return matchesStage && matchesSearch;
        });
    },

    moveStage(candidateId, newStage) {
        const c = this.candidates.find(item => item.id === candidateId);
        if (c) {
            c.stage = newStage;
            this.updateCounts();
            window.$toast?.success('تم تحديث مسار الموهبة: ' + c.name_ar, 'رادار النسور');
        }
    },

    openRubric(candidate) {
        this.selectedCandidate = JSON.parse(JSON.stringify(candidate));
        this.rubricModal = true;
    },

    saveRubric() {
        const idx = this.candidates.findIndex(item => item.id === this.selectedCandidate.id);
        if (idx !== -1) {
            this.candidates[idx] = JSON.parse(JSON.stringify(this.selectedCandidate));
            this.updateCounts();
        }
        this.rubricModal = false;
        window.$toast?.success('تم حفظ تقييم الموهبة واعتماد التوصيات الفنية', 'رادار النسور');
    },

    getRatingColor(score) {
        if (score >= 90) return 'text-emerald-700 bg-emerald-50 border-emerald-200';
        if (score >= 80) return 'text-sky-700 bg-sky-50 border-sky-200';
        if (score >= 70) return 'text-amber-700 bg-amber-50 border-amber-200';
        return 'text-rose-700 bg-rose-50 border-rose-200';
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="crosshair" class="w-3.5 h-3.5"></i>
                    <span>EAGLE TALENT RADAR</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">منظومة انتقاء وتأهيل المواهب الكروية</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">رادار كشافة النسور — مسار انتقاء المواهب الكروية</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">خطوات المعايشة الميدانية، الفحص التكتيكي، والتقييم الرباعي لاختيار نجوم المستقبل</p>
        </div>

        <div class="flex items-center gap-2">
            <!-- View Mode Switcher -->
            <div class="inline-flex p-1 bg-[var(--surface)] rounded-lg border border-[var(--border)] shadow-2xs">
                <button 
                    @click="viewMode = 'board'" 
                    :class="viewMode === 'board' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-all flex items-center gap-1.5"
                >
                    <i data-lucide="kanban" class="w-3.5 h-3.5"></i>
                    <span>لوحة المسار</span>
                </button>
                <button 
                    @click="viewMode = 'table'" 
                    :class="viewMode === 'table' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-all flex items-center gap-1.5"
                >
                    <i data-lucide="list" class="w-3.5 h-3.5"></i>
                    <span>سجل البيانات</span>
                </button>
                <button 
                    @click="viewMode = 'compare'" 
                    :class="viewMode === 'compare' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                    class="px-3 py-1.5 rounded-md text-xs font-bold transition-all flex items-center gap-1.5"
                >
                    <i data-lucide="scale" class="w-3.5 h-3.5"></i>
                    <span>مقارنة المواهب</span>
                </button>
            </div>

            <!-- Print / Export -->
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>تقرير الكشافة</span>
            </button>
        </div>
    </div>

    <!-- Overview Metrics Bar -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">إجمالي المرصودين</span>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl font-black text-[var(--text-strong)] font-mono" x-text="candidates.length"></span>
                <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">كشافي مصر</span>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">معايشة ميدانية مجدولة</span>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl font-black text-purple-700 font-mono" x-text="stages.find(s => s.id === 'trial_scheduled')?.count || 0"></span>
                <span class="text-[10px] text-[var(--text-muted)]">هذا الأسبوع</span>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">تم التقييم الفني</span>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl font-black text-sky-700 font-mono" x-text="stages.find(s => s.id === 'evaluated')?.count || 0"></span>
                <span class="text-[10px] text-[var(--text-muted)]">جاهز للقرار</span>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs">
            <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">تم القبول والضم</span>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl font-black text-emerald-600 font-mono" x-text="stages.find(s => s.id === 'accepted')?.count || 0"></span>
                <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">نجوم النسور</span>
            </div>
        </div>

        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-4 shadow-2xs col-span-2 md:col-span-1">
            <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-1">معدل الاعتماد النهائي</span>
            <div class="flex items-baseline justify-between">
                <span class="text-2xl font-black text-[#E3131B] font-mono">18.5%</span>
                <span class="text-[10px] text-gray-500">معايير نخبوية</span>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 bg-[var(--surface)] p-3 rounded-xl border border-[var(--border)] shadow-2xs">
        <div class="relative w-full sm:w-80">
            <i data-lucide="search" class="w-4 h-4 text-[var(--text-muted)] absolute start-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
            <input 
                type="text" 
                x-model="searchFilter" 
                placeholder="ابحث بالاسم، المركز، أو النادي الحالي..." 
                class="w-full ps-9 pe-4 py-1.5 text-xs rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B] transition-colors"
            >
        </div>

        <div class="flex items-center gap-2 text-xs text-[var(--text-muted)] w-full sm:w-auto justify-end">
            <span>عرض سريع لمسارات: <strong>6 مراحل فنية</strong></span>
        </div>
    </div>

    <!-- VIEW MODE 1: KANBAN 6-STAGE PIPELINE BOARD -->
    <div x-show="viewMode === 'board'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3.5 items-start">
            <template x-for="stage in stages" :key="stage.id">
                <div class="bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] p-3 flex flex-col min-h-[500px]">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between pb-2.5 mb-3 border-b border-[var(--border)]">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full" :class="{
                                'bg-blue-500': stage.id === 'new',
                                'bg-amber-500': stage.id === 'under_review',
                                'bg-purple-500': stage.id === 'trial_scheduled',
                                'bg-sky-500': stage.id === 'evaluated',
                                'bg-emerald-500': stage.id === 'accepted',
                                'bg-gray-400': stage.id === 'rejected'
                            }"></span>
                            <h3 class="text-xs font-bold text-[var(--text-strong)]" x-text="stage.label_ar"></h3>
                        </div>
                        <span class="text-[11px] font-mono font-bold px-1.5 py-0.5 rounded bg-[var(--surface)] text-[var(--text-strong)] border border-[var(--border)]" x-text="getCandidatesByStage(stage.id).length"></span>
                    </div>

                    <!-- Candidate Cards Container -->
                    <div class="space-y-2.5 flex-1 overflow-y-auto max-h-[620px] pe-0.5">
                        <template x-for="candidate in getCandidatesByStage(stage.id)" :key="candidate.id">
                            <div class="bg-[var(--surface)] rounded-lg border border-[var(--border)] p-3 shadow-2xs hover:shadow-sm hover:border-[var(--border-strong)] transition-all group">
                                <!-- Card Header -->
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <div>
                                        <h4 class="text-xs font-black text-[var(--text-strong)] group-hover:text-[#E3131B] transition-colors" x-text="candidate.name_ar"></h4>
                                        <p class="text-[11px] font-semibold text-[#E3131B] mt-0.5" x-text="candidate.position_ar"></p>
                                    </div>
                                    <span 
                                        :class="getRatingColor(candidate.rating)"
                                        class="px-1.5 py-0.5 rounded text-[11px] font-mono font-black border"
                                        x-text="candidate.rating"
                                    ></span>
                                </div>

                                <!-- Key Meta Details -->
                                <div class="space-y-1 text-[11px] text-[var(--text-muted)] pb-2 border-b border-gray-100 mb-2">
                                    <div class="flex items-center justify-between">
                                        <span>العمر / المواليد:</span>
                                        <span class="font-bold text-[var(--text-strong)]" x-text="candidate.age + ' سنة (' + candidate.birth_year + ')'"></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span>النادي / الجهة:</span>
                                        <span class="text-[var(--text-strong)] truncate max-w-[110px]" x-text="candidate.current_club"></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span>البنية / القدم:</span>
                                        <span class="font-mono text-[var(--text-strong)]" x-text="candidate.height + 'سم • ' + candidate.preferred_foot"></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span>الكشاف المسؤول:</span>
                                        <span class="text-[var(--text-strong)] font-medium" x-text="candidate.scout_name_ar"></span>
                                    </div>
                                </div>

                                <!-- Actions & Stage Transition -->
                                <div class="space-y-1.5 pt-1">
                                    <button 
                                        @click="openRubric(candidate)"
                                        class="w-full py-1 px-2 bg-[var(--surface-subtle)] hover:bg-[var(--text-strong)] hover:text-[var(--surface)] rounded border border-[var(--border)] text-[11px] font-bold text-[var(--text-strong)] transition-colors flex items-center justify-center gap-1"
                                    >
                                        <i data-lucide="file-text" class="w-3 h-3"></i>
                                        <span>استمارة التقييم الرباعي</span>
                                    </button>

                                    <!-- Quick Stage Shifter -->
                                    <div class="flex items-center justify-between gap-1">
                                        <!-- Previous Stage -->
                                        <button 
                                            x-show="stage.id !== 'new'"
                                            @click="
                                                const prevIdx = stages.findIndex(s => s.id === stage.id) - 1;
                                                if (prevIdx >= 0) moveStage(candidate.id, stages[prevIdx].id);
                                            "
                                            title="الرجوع مرحلة للخلف"
                                            class="p-1 rounded bg-[var(--surface-subtle)] hover:bg-gray-200 text-gray-600 transition-colors"
                                        >
                                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                                        </button>
                                        
                                        <div class="text-[10px] text-[var(--text-muted)] font-mono flex-1 text-center truncate">
                                            <span x-text="candidate.trial_date ? 'موعد: ' + candidate.trial_date : 'مكتمل التقييم'"></span>
                                        </div>

                                        <!-- Next Stage -->
                                        <button 
                                            x-show="stage.id !== 'accepted' && stage.id !== 'rejected'"
                                            @click="
                                                const nextIdx = stages.findIndex(s => s.id === stage.id) + 1;
                                                if (nextIdx < stages.length - 1) moveStage(candidate.id, stages[nextIdx].id);
                                                else moveStage(candidate.id, 'accepted');
                                            "
                                            title="التقديم للمرحلة التالية"
                                            class="p-1 rounded bg-red-50 hover:bg-[#E3131B] text-[#E3131B] hover:text-white transition-colors"
                                        >
                                            <i data-lucide="chevron-left" class="w-3.5 h-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Empty State in Column -->
                        <div x-show="getCandidatesByStage(stage.id).length === 0" class="py-8 text-center text-[var(--text-muted)] text-xs">
                            <i data-lucide="inbox" class="w-6 h-6 mx-auto mb-1 opacity-40"></i>
                            <span>لا توجد ملفات</span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- VIEW MODE 2: CANDIDATES DIRECTORY TABLE -->
    <div x-show="viewMode === 'table'" class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
            <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل كشافة النسور — تقرير المرشحين والمواهب</h3>
            <span class="text-xs font-mono font-bold text-[var(--text-muted)] bg-[var(--surface)] px-2.5 py-1 rounded border border-[var(--border)]" x-text="candidates.length + ' موهبة مسجلة'"></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-start">
                <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] text-[11px] font-bold border-b border-[var(--border)] uppercase">
                    <tr>
                        <th class="py-3 px-4 text-start">الموهبة الكروية</th>
                        <th class="py-3 px-4 text-start">المركز التكتيكي</th>
                        <th class="py-3 px-4 text-start">المواليد / السن</th>
                        <th class="py-3 px-4 text-start">النادي الحالي</th>
                        <th class="py-3 px-4 text-start">المواصفات البدنية</th>
                        <th class="py-3 px-4 text-start">الكشاف المسؤول</th>
                        <th class="py-3 px-4 text-start">التقييم العام</th>
                        <th class="py-3 px-4 text-start">المرحلة الحالية</th>
                        <th class="py-3 px-4 text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                    <template x-for="item in candidates" :key="item.id">
                        <tr class="hover:bg-[var(--surface-subtle)]/70 transition-colors">
                            <td class="py-3.5 px-4">
                                <div class="font-black text-[var(--text-strong)]" x-text="item.name_ar"></div>
                                <div class="text-[10px] text-[var(--text-muted)] font-mono" x-text="item.phone"></div>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-[#E3131B]" x-text="item.position_ar"></td>
                            <td class="py-3.5 px-4">
                                <span class="font-mono" x-text="item.age + ' سنة'"></span>
                                <span class="text-[var(--text-muted)] text-[10px] block" x-text="'مواليد ' + item.birth_year"></span>
                            </td>
                            <td class="py-3.5 px-4 text-[var(--text)]" x-text="item.current_club"></td>
                            <td class="py-3.5 px-4 font-mono text-gray-600">
                                <span x-text="item.height + ' سم'"></span> / <span x-text="item.weight + ' كجم'"></span>
                                <span class="text-[var(--text-muted)] text-[10px] block" x-text="'قدم: ' + item.preferred_foot"></span>
                            </td>
                            <td class="py-3.5 px-4 font-medium text-gray-800" x-text="item.scout_name_ar"></td>
                            <td class="py-3.5 px-4">
                                <span 
                                    :class="getRatingColor(item.rating)"
                                    class="px-2 py-0.5 rounded text-[11px] font-mono font-black border"
                                    x-text="item.rating + ' / 100'"
                                ></span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span 
                                    class="px-2.5 py-0.5 rounded text-[11px] font-bold border inline-block"
                                    :class="stages.find(s => s.id === item.stage)?.badge_color || 'bg-gray-100 text-[var(--text)]'"
                                    x-text="stages.find(s => s.id === item.stage)?.label_ar || item.stage"
                                ></span>
                            </td>
                            <td class="py-3.5 px-4 text-end">
                                <div class="inline-flex items-center gap-1.5">
                                    <button 
                                        @click="openRubric(item)" 
                                        class="px-2.5 py-1 rounded bg-[var(--text-strong)] text-[var(--surface)] text-[11px] font-bold hover:bg-[#E3131B] transition-colors"
                                    >
                                        استمارة التقييم
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <!-- VIEW MODE 3: CANDIDATE COMPARISON MATRIX -->
    <div x-show="viewMode === 'compare'" class="space-y-4">
        <!-- Comparison Selectors -->
        <div class="bg-[var(--surface)] p-4 rounded-xl border border-[var(--border)] shadow-2xs">
            <h3 class="text-sm font-bold text-[var(--text-strong)] mb-3">مقارنة فنية ثنائية لاختيار أنسب المواهب لتمثيل أكاديمية النسور</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-gray-500 block mb-1">الموهبة الأولى:</label>
                    <select x-model="compareCandidate1" class="w-full text-xs font-bold p-2.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] focus:bg-[var(--surface)] focus:outline-none">
                        <template x-for="c in candidates" :key="'c1-' + c.id">
                            <option :value="c.id" x-text="c.name_ar + ' (' + c.position_ar + ' - ' + c.age + ' سنة)'"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-gray-500 block mb-1">الموهبة الثانية:</label>
                    <select x-model="compareCandidate2" class="w-full text-xs font-bold p-2.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] focus:bg-[var(--surface)] focus:outline-none">
                        <template x-for="c in candidates" :key="'c2-' + c.id">
                            <option :value="c.id" x-text="c.name_ar + ' (' + c.position_ar + ' - ' + c.age + ' سنة)'"></option>
                        </template>
                    </select>
                </div>
            </div>
        </div>

        <!-- Comparative Side-by-Side Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{
            get c1() { return candidates.find(c => c.id == compareCandidate1) || candidates[0]; },
            get c2() { return candidates.find(c => c.id == compareCandidate2) || candidates[1]; }
        }">
            <!-- Candidate 1 Card -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <div class="flex items-start justify-between border-b border-gray-100 pb-3">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)]">مرشح النسور #A</span>
                        <h4 class="text-lg font-black text-[var(--text-strong)]" x-text="c1?.name_ar"></h4>
                        <p class="text-xs font-bold text-[#E3131B]" x-text="c1?.position_ar"></p>
                    </div>
                    <div class="text-end">
                        <span class="text-2xl font-black font-mono text-[#E3131B]" x-text="c1?.rating"></span>
                        <span class="text-[10px] text-[var(--text-muted)] block">تقييم الكشاف</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 bg-[var(--surface-subtle)] p-3 rounded-lg text-center">
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">العمر</span>
                        <span class="text-xs font-mono font-black text-[var(--text-strong)]" x-text="c1?.age + ' سنة'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">الطول / الوزن</span>
                        <span class="text-xs font-mono font-black text-[var(--text-strong)]" x-text="c1?.height + 'سم / ' + c1?.weight + 'كجم'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">القدم المفضلة</span>
                        <span class="text-xs font-black text-[var(--text-strong)]" x-text="c1?.preferred_foot"></span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-700 block mb-0.5">نقاط القوة والميزات:</span>
                        <p class="text-gray-600 bg-emerald-50/60 p-2.5 rounded-lg border border-emerald-100" x-text="c1?.strengths_ar"></p>
                    </div>
                    <div>
                        <span class="font-bold text-amber-700 block mb-0.5">فرص التطوير والتأهيل:</span>
                        <p class="text-gray-600 bg-amber-50/60 p-2.5 rounded-lg border border-amber-100" x-text="c1?.weaknesses_ar"></p>
                    </div>
                </div>

                <div class="pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-[var(--text-muted)]">الكشاف: <strong class="text-[var(--text-strong)]" x-text="c1?.scout_name_ar"></strong></span>
                    <button @click="openRubric(c1)" class="px-3 py-1 bg-[var(--text-strong)] text-[var(--surface)] rounded font-bold hover:bg-[#E3131B]">
                        التقييم التفصيلي
                    </button>
                </div>
            </div>

            <!-- Candidate 2 Card -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <div class="flex items-start justify-between border-b border-gray-100 pb-3">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-muted)]">مرشح النسور #B</span>
                        <h4 class="text-lg font-black text-[var(--text-strong)]" x-text="c2?.name_ar"></h4>
                        <p class="text-xs font-bold text-[#E3131B]" x-text="c2?.position_ar"></p>
                    </div>
                    <div class="text-end">
                        <span class="text-2xl font-black font-mono text-[#E3131B]" x-text="c2?.rating"></span>
                        <span class="text-[10px] text-[var(--text-muted)] block">تقييم الكشاف</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 bg-[var(--surface-subtle)] p-3 rounded-lg text-center">
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">العمر</span>
                        <span class="text-xs font-mono font-black text-[var(--text-strong)]" x-text="c2?.age + ' سنة'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">الطول / الوزن</span>
                        <span class="text-xs font-mono font-black text-[var(--text-strong)]" x-text="c2?.height + 'سم / ' + c2?.weight + 'كجم'"></span>
                    </div>
                    <div>
                        <span class="text-[10px] text-[var(--text-muted)] block font-bold">القدم المفضلة</span>
                        <span class="text-xs font-black text-[var(--text-strong)]" x-text="c2?.preferred_foot"></span>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="font-bold text-emerald-700 block mb-0.5">نقاط القوة والميزات:</span>
                        <p class="text-gray-600 bg-emerald-50/60 p-2.5 rounded-lg border border-emerald-100" x-text="c2?.strengths_ar"></p>
                    </div>
                    <div>
                        <span class="font-bold text-amber-700 block mb-0.5">فرص التطوير والتأهيل:</span>
                        <p class="text-gray-600 bg-amber-50/60 p-2.5 rounded-lg border border-amber-100" x-text="c2?.weaknesses_ar"></p>
                    </div>
                </div>

                <div class="pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="text-[var(--text-muted)]">الكشاف: <strong class="text-[var(--text-strong)]" x-text="c2?.scout_name_ar"></strong></span>
                    <button @click="openRubric(c2)" class="px-3 py-1 bg-[var(--text-strong)] text-[var(--surface)] rounded font-bold hover:bg-[#E3131B]">
                        التقييم التفصيلي
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- EVALUATION RUBRIC MODAL / DRAWER -->
    <div 
        x-show="rubricModal" 
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4"
    >
        <div 
            @click.away="rubricModal = false"
            class="bg-[var(--surface)] rounded-2xl border border-[var(--border)] max-w-2xl w-full p-6 shadow-2xl space-y-5"
        >
            <div class="flex items-start justify-between border-b border-[var(--border)] pb-4">
                <div>
                    <span class="text-[11px] font-bold text-[#E3131B] uppercase tracking-wider">استمارة الفحص الميداني والتقييم الرباعي</span>
                    <h3 class="text-xl font-black text-[var(--text-strong)]" x-text="selectedCandidate?.name_ar"></h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5" x-text="selectedCandidate?.position_ar + ' • نادي ' + selectedCandidate?.current_club"></p>
                </div>
                <button @click="rubricModal = false" class="text-[var(--text-muted)] hover:text-gray-600 p-1">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- 4 Core Rubric Pillars -->
            <div class="space-y-4">
                <!-- 1. Technical Pillar -->
                <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)]">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-black text-[var(--text-strong)]">1. التقييم المهاري والفني (Technical Mastery)</label>
                        <span class="text-xs font-mono font-black text-[#E3131B]">9 / 10</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mb-2">الاستلام والتسليم تحت الضغط، دقة المراوغة، اللمسة الأولى، والإنهاء</p>
                    <input type="range" min="1" max="10" value="9" class="w-full accent-[#E3131B]">
                </div>

                <!-- 2. Physical Pillar -->
                <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)]">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-black text-[var(--text-strong)]">2. التقييم البدني والفسيولوجي (Athletic & Physical)</label>
                        <span class="text-xs font-mono font-black text-[#E3131B]">8 / 10</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mb-2">السرعة القصوى، الرشاقة وتغيير الاتجاه، قوة الالتحام الهوائي والأرضي</p>
                    <input type="range" min="1" max="10" value="8" class="w-full accent-[#E3131B]">
                </div>

                <!-- 3. Tactical Pillar -->
                <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)]">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-black text-[var(--text-strong)]">3. الفهم والتمركز التكتيكي (Tactical Awareness)</label>
                        <span class="text-xs font-mono font-black text-[#E3131B]">9 / 10</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mb-2">قراءة مساحات الخصم، التحرك بدون كرة، وسرعة الارتداد الدفاعي والهجومي</p>
                    <input type="range" min="1" max="10" value="9" class="w-full accent-[#E3131B]">
                </div>

                <!-- 4. Psychological Pillar -->
                <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)]">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-black text-[var(--text-strong)]">4. السمات الذهنية والشخصية (Psychological Grit)</label>
                        <span class="text-xs font-mono font-black text-[#E3131B]">9 / 10</span>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mb-2">روح القيادة، الثبات الانفعالي عند التأخر في النتيجة، وتقبل التوجيه الفني</p>
                    <input type="range" min="1" max="10" value="9" class="w-full accent-[#E3131B]">
                </div>
            </div>

            <!-- Scout Recommendation Stage -->
            <div>
                <label class="text-xs font-bold text-[var(--text-strong)] block mb-1">القرار الفني والتوصية المباشرة:</label>
                <div class="grid grid-cols-3 gap-2">
                    <button 
                        type="button"
                        @click="selectedCandidate.stage = 'accepted'"
                        :class="selectedCandidate?.stage === 'accepted' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-[var(--surface)] text-[var(--text)] border-[var(--border)]'"
                        class="p-2.5 rounded-lg border text-xs font-bold transition-all text-center"
                    >
                        قبول واعتماد فوري
                    </button>
                    <button 
                        type="button"
                        @click="selectedCandidate.stage = 'trial_scheduled'"
                        :class="selectedCandidate?.stage === 'trial_scheduled' ? 'bg-purple-600 text-white border-purple-600' : 'bg-[var(--surface)] text-[var(--text)] border-[var(--border)]'"
                        class="p-2.5 rounded-lg border text-xs font-bold transition-all text-center"
                    >
                        معايشة إضافية
                    </button>
                    <button 
                        type="button"
                        @click="selectedCandidate.stage = 'rejected'"
                        :class="selectedCandidate?.stage === 'rejected' ? 'bg-gray-700 text-white border-gray-700' : 'bg-[var(--surface)] text-[var(--text)] border-[var(--border)]'"
                        class="p-2.5 rounded-lg border text-xs font-bold transition-all text-center"
                    >
                        استبعاد للأرشيف
                    </button>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex items-center justify-end gap-2 pt-4 border-t border-[var(--border)]">
                <button @click="rubricModal = false" class="px-4 py-2 rounded-lg border border-[var(--border)] text-xs font-bold text-gray-600 hover:bg-[var(--surface-subtle)]">
                    إلغاء
                </button>
                <button @click="saveRubric()" class="px-5 py-2 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] text-white text-xs font-bold shadow-xs transition-colors">
                    اعتماد وحفظ التقييم
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
