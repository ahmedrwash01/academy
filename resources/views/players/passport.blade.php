@extends('layouts.admin', ['title' => 'جواز التطوير الرياضي: ' . $player['name_ar']])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    newTargetTitle: '',
    targetsList: {{ json_encode($targets) }},
    addTarget() {
        if (this.newTargetTitle.trim()) {
            this.targetsList.push({
                title: this.newTargetTitle,
                status: 'in_progress',
                progress: 10
            });
            this.newTargetTitle = '';
            if (window.Alpine) {
                this.$dispatch('show-toast', 'تمت إضافة الهدف التدريبي الجديد بنجاح!');
            }
        }
    }
}">
    <!-- Header with Breadcrumbs & Actions -->
    <x-page-header 
        title="جواز التطوير الرياضي (Eagle Development Passport)" 
        subtitle="المتابعة المستمرة لمنحنى تطور اللاعب، خطة الأهداف الفردية، والتقييمات الربعية المعتمدة"
        badge="الموسم الرياضي 2025 / 2026"
    >
        <x-slot:actions>
            <a href="{{ route('players.show', $player['id']) }}" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="arrow-right" class="h-4 w-4"></i>
                <span>العودة للملف 360</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg bg-[var(--text-strong)] px-3.5 py-2 text-xs font-bold text-[var(--surface)] hover:opacity-90 transition-opacity shadow-sm cursor-pointer">
                <i data-lucide="printer" class="h-3.5 w-3.5"></i>
                <span>طباعة جواز التطوير الرسمي</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Athlete Passport Identity Card -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <img src="{{ $player['avatar'] }}" alt="{{ $player['name_ar'] }}" class="h-16 w-16 rounded-full object-cover border-2 border-[var(--border)] shadow-sm">
            <div>
                <div class="flex items-center gap-2">
                    <h2 class="text-xl font-black text-[var(--text-strong)]">{{ $player['name_ar'] }}</h2>
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-[var(--surface-subtle)] border border-[var(--border)]">#{{ $player['jersey_number'] }}</span>
                </div>
                <p class="text-xs text-[var(--text-muted)] mt-0.5 font-arabic">{{ $player['position_ar'] }} • {{ $player['team_name_ar'] }} ({{ $player['age_group'] }})</p>
                <span class="text-[11px] font-mono text-[var(--text-muted)] block mt-0.5">PASSPORT ID: #PASSPORT-00{{ $player['id'] }}-2026</span>
            </div>
        </div>

        <div class="flex items-center gap-4 border-t md:border-t-0 md:border-s border-[var(--border)] pt-3 md:pt-0 md:ps-6 text-xs text-[var(--text-muted)]">
            <div>
                <span class="text-[11px] block">التقييم الفني العام:</span>
                <span class="font-mono font-black text-amber-500 text-xl block mt-0.5">★ {{ $player['rating'] }}</span>
            </div>
            <div class="border-s border-[var(--border)] ps-4">
                <span class="text-[11px] block">موعد الفحص القادم:</span>
                <span class="font-mono font-bold text-[var(--text-strong)] text-sm block mt-0.5">15 أبريل 2026</span>
            </div>
        </div>
    </div>

    <!-- Skills Comparison Matrix (Current vs Previous) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xs space-y-4">
        <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">مصفوفة المهارات والمقارنة التاريخية</h3>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">مقارنة أداء الموسم الحالي (2025/2026) بالموسم السابق (2024/2025)</p>
            </div>
            <span class="text-xs font-mono font-bold text-[var(--success-text)] bg-[var(--success-bg)] px-2.5 py-1 rounded border border-[var(--success-border)]">
                +7.4% تطور تراكمي
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-xs">
            @foreach($skills as $key => $s)
                <div class="p-3 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)]">
                    <div class="flex justify-between font-bold mb-1.5">
                        <span class="text-[var(--text-strong)]">{{ $s['name_ar'] }}</span>
                        <div class="flex items-center gap-2.5">
                            <span class="text-[var(--text-muted)] font-mono font-normal">سابقاً: {{ $s['previous'] }}%</span>
                            <span class="font-mono text-[#E3131B] font-bold text-sm">{{ $s['current'] }}%</span>
                        </div>
                    </div>
                    <div class="w-full bg-[var(--surface)] rounded-full h-2 overflow-hidden border border-[var(--border)]">
                        <div class="bg-[#E3131B] h-2 rounded-full" style="width: {{ $s['current'] }}%"></div>
                    </div>
                    <span class="text-[10px] text-[var(--success-text)] font-bold mt-1 block">
                        ↑ تحسن بمقدار +{{ $s['current'] - $s['previous'] }} نقطة
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Development Action Plan & Add Goal Feature -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Development Targets (7 cols) -->
        <div class="lg:col-span-7 rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">خطة الأهداف الفردية للربع الحالي</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">متابعة إنجاز الأهداف التدريبية الموضوعة من المدرب</p>
                </div>
            </div>

            <!-- Form to Add a Target -->
            <form @submit.prevent="addTarget()" class="flex items-center gap-2">
                <input 
                    type="text" 
                    x-model="newTargetTitle" 
                    placeholder="أضف هدفاً تدريبياً جديداً للاعب..." 
                    class="w-full rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] px-3 py-2 text-xs text-[var(--text-strong)] placeholder-[var(--text-muted)] focus:bg-[var(--surface)] focus:border-[var(--border-strong)] focus:outline-none transition-colors"
                >
                <button type="submit" class="px-3.5 py-2 rounded-lg bg-[var(--text-strong)] text-[var(--surface)] text-xs font-bold hover:opacity-90 transition-opacity shrink-0 cursor-pointer">
                    + إضافة هدف
                </button>
            </form>

            <!-- Target List -->
            <div class="space-y-3 pt-2">
                <template x-for="(tgt, index) in targetsList" :key="index">
                    <div class="p-3.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] shadow-2xs">
                        <div class="flex items-center justify-between text-xs mb-1.5">
                            <span class="font-bold text-[var(--text-strong)]" x-text="tgt.title"></span>
                            <span class="text-[10px] font-mono font-bold text-[#E3131B]" x-text="`${tgt.progress}%`"></span>
                        </div>
                        <div class="w-full bg-[var(--surface-subtle)] rounded-full h-1.5 overflow-hidden">
                            <div class="bg-[#E3131B] h-1.5 rounded-full" :style="`width: ${tgt.progress}%`"></div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Coach Evaluations Timeline (5 cols) -->
        <div class="lg:col-span-5 rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-4 flex flex-col justify-between">
            <div>
                <div class="border-b border-[var(--border-subtle)] pb-3 mb-3">
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل التقييمات الربعية</h3>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">تقارير الجهاز الفني الموثقة في جواز التطوير</p>
                </div>

                <div class="space-y-3 text-xs">
                    @foreach($timeline as $tl)
                        <div class="p-3 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)]">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-bold text-[var(--text-strong)]">{{ $tl['title'] }}</span>
                                <span class="font-mono font-bold text-amber-500 bg-[var(--surface)] px-2 py-0.5 rounded border border-[var(--border)]">{{ $tl['score'] }}</span>
                            </div>
                            <span class="text-[10px] font-mono text-[var(--text-muted)] block mb-1">{{ $tl['date'] }}</span>
                            <p class="text-[11px] text-[var(--text-muted)] leading-relaxed">{{ $tl['notes'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-3 border-t border-[var(--border-subtle)]">
                <div class="p-3 rounded-lg bg-[var(--success-bg)] border border-[var(--success-border)] text-xs text-[var(--success-text)]">
                    <span class="font-bold block">توصية المدير الفني:</span>
                    <span class="text-[11px] text-[var(--success-text)] opacity-90 mt-0.5 block leading-relaxed">اللاعب جاهز للمشاركة في معسكر الإعداد الصيفي والترشيح لتجارب أندية النخبة.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

