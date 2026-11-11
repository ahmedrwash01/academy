@extends('layouts.admin', ['title' => 'المختبر التكتيكي الميداني'])

@section('content')
<div 
    class="space-y-6 font-arabic" 
    x-data="{
        formations: {{ json_encode($tacticalPresets) }},
        currentFormation: '4-2-3-1',
        slots: [],
        availablePlayers: {{ json_encode(array_slice($players, 0, 16)) }},
        selectedSlot: null,
        tacticalNotes: '',
        savedPlans: [
            { name: 'خطة ديربي القاهرة U-15', formation: '4-2-3-1', date: '11 مارس 2026' },
            { name: 'الضغط العالي — الكأس', formation: '4-3-3', date: '08 مارس 2026' }
        ],
        planName: 'خطة مباراة نادي الشمس — الجولة 15',
        toast: '',
        
        init() {
            this.setFormation(this.currentFormation);
        },
        
        setFormation(key) {
            this.currentFormation = key;
            const preset = this.formations[key];
            if (preset) {
                // Clone slots so changes are responsive
                this.slots = JSON.parse(JSON.stringify(preset.slots));
                this.tacticalNotes = preset.notes_ar;
            }
        },

        assignPlayer(player) {
            if (this.selectedSlot !== null) {
                const s = this.slots.find(x => x.id === this.selectedSlot);
                if (s) {
                    s.name = player.name_ar;
                    s.number = player.jersey_number;
                    this.showToast('تم تعيين ' + player.name_ar + ' في مركز ' + s.role);
                }
            } else {
                this.showToast('يرجى النقر أولاً على موقع في الملعب لتعيين اللاعب فيه');
            }
        },

        savePlan() {
            this.savedPlans.unshift({
                name: this.planName,
                formation: this.currentFormation,
                date: '11 مارس 2026'
            });
            this.showToast('تم حفظ الخطة التكتيكية بنجاح ضمن أرشيف الفريق!');
        },

        resetBoard() {
            this.setFormation(this.currentFormation);
            this.selectedSlot = null;
            this.showToast('تمت إعادة ضبط مواقع اللاعبين إلى التشكيل القياسي');
        },

        showToast(msg) {
            if (window.Alpine) {
                this.$dispatch('show-toast', msg);
            }
        }
    }"
>
    <!-- Clean Structured Header with No Word-Breaks -->
    <x-page-header 
        title="المختبر التكتيكي الميداني" 
        subtitle="بناء تشكيلات المباريات، توزيع مراكز اللاعبين وتوثيق الخطط الفنية التفاعلية"
        badge="التحليل الفني التفاعلي"
    >
        <x-slot:actions>
            <button @click="resetBoard()" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs whitespace-nowrap cursor-pointer">
                <i data-lucide="rotate-ccw" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
                <span>إعادة ضبط اللوحة</span>
            </button>
            <button @click="savePlan()" class="inline-flex items-center gap-1.5 rounded-lg bg-[#E3131B] px-3.5 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-[#C70F16] transition-colors whitespace-nowrap cursor-pointer">
                <i data-lucide="save" class="h-3.5 w-3.5"></i>
                <span>حفظ الخطة التكتيكية</span>
            </button>
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs whitespace-nowrap cursor-pointer">
                <i data-lucide="printer" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
                <span>طباعة الكشف</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Top Toolbar: Formation Selector & Active Plan -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Formation Switcher Buttons -->
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-1 md:pb-0">
            <span class="text-xs font-bold text-[var(--text-muted)] shrink-0 me-1">التشكيل:</span>
            <template x-for="(f, key) in formations" :key="key">
                <button 
                    @click="setFormation(key)" 
                    :class="currentFormation === key ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-2xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--border-subtle)]'"
                    class="px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-all shrink-0"
                    x-text="key"
                >
                </button>
            </template>
        </div>

        <!-- Plan Name Input -->
        <div class="flex items-center gap-2 w-full md:w-96">
            <i data-lucide="clipboard-pen" class="h-4 w-4 text-[var(--text-muted)] shrink-0"></i>
            <input 
                type="text" 
                x-model="planName" 
                placeholder="اسم المخطط التكتيكي..." 
                class="w-full rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] px-3 py-1.5 text-xs text-[var(--text-strong)] focus:bg-[var(--surface)] focus:border-[#E3131B] focus:outline-none transition-colors font-arabic font-semibold"
            >
        </div>
    </div>

    <!-- Main Workspace: Interactive Football Pitch (8 cols) vs Player Assignment Roster (4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- ========================================================================= -->
        <!-- LEFT: THE TACTICAL PITCH (8 cols)                                         -->
        <!-- ========================================================================= -->
        <div class="lg:col-span-8 rounded-2xl border border-[#1C1F26] bg-[#0E1014] p-4 sm:p-6 shadow-xl flex flex-col justify-between relative overflow-hidden">
            <!-- Pitch Header -->
            <div class="flex items-center justify-between pb-3 mb-2 border-b border-[#1C1F26] text-white">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-[#E3131B]"></span>
                    <span class="text-xs font-bold" x-text="formations[currentFormation]?.name"></span>
                </div>
                <span class="text-[11px] text-[#A0A3AA] font-arabic">انقر على أي مركز لتعيين لاعب أو تعديل التمركز</span>
            </div>

            <!-- Pitch Canvas with Authentic Markings -->
            <div class="relative w-full aspect-[4/3] rounded-xl bg-gradient-to-b from-[#143320] via-[#163823] to-[#122e1c] border-2 border-[#2b593a] overflow-hidden select-none shadow-inner">
                <!-- SVG Football Field Markings -->
                <svg class="absolute inset-0 w-full h-full pointer-events-none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Touchline & Goal line border -->
                    <rect x="5%" y="4%" width="90%" height="92%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <!-- Halfway line -->
                    <line x1="5%" y1="50%" x2="95%" y2="50%" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <!-- Center Circle -->
                    <circle cx="50%" cy="50%" r="12%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <circle cx="50%" cy="50%" r="4" fill="rgba(255,255,255,0.7)" />

                    <!-- Top Penalty Box (Opponent Goal) -->
                    <rect x="25%" y="4%" width="50%" height="18%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <rect x="36%" y="4%" width="28%" height="7%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <circle cx="50%" cy="14%" r="3" fill="rgba(255,255,255,0.7)" />

                    <!-- Bottom Penalty Box (Eagles Goal Area) -->
                    <rect x="25%" y="78%" width="50%" height="18%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <rect x="36%" y="89%" width="28%" height="7%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <circle cx="50%" cy="86%" r="3" fill="rgba(255,255,255,0.7)" />

                    <!-- Corner Arcs -->
                    <path d="M 5% 7% A 3% 3% 0 0 0 8% 4%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <path d="M 95% 7% A 3% 3% 0 0 1 92% 4%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <path d="M 5% 93% A 3% 3% 0 0 1 8% 96%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                    <path d="M 95% 93% A 3% 3% 0 0 0 92% 96%" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="2" />
                </svg>

                <!-- Interactive Player Slots -->
                <template x-for="slot in slots" :key="slot.id">
                    <div 
                        @click="selectedSlot = slot.id"
                        :style="`left: ${slot.x}%; top: ${slot.y}%; transform: translate(-50%, -50%);`"
                        class="absolute flex flex-col items-center cursor-pointer group transition-all duration-300"
                    >
                        <!-- Player Marker Token -->
                        <div 
                            :class="selectedSlot === slot.id ? 'ring-4 ring-[#E3131B] scale-110 shadow-lg' : (slot.number === 10 ? 'ring-2 ring-amber-400' : 'ring-1 ring-white/50 hover:scale-105')"
                            class="relative flex h-10 w-10 sm:h-11 sm:w-11 items-center justify-center rounded-full bg-[#111214] text-white shadow-md border-2 border-[#1E2229] transition-transform"
                        >
                            <!-- Position Badge Overlay -->
                            <span 
                                :class="slot.role === 'GK' ? 'bg-amber-500 text-black' : (['CB','LB','RB'].includes(slot.role) ? 'bg-blue-600 text-white' : (['DM','CM','AM','LM','RM'].includes(slot.role) ? 'bg-emerald-600 text-white' : 'bg-[#E3131B] text-white'))"
                                class="absolute -top-1.5 -end-1.5 px-1 py-0.2 rounded text-[8px] font-mono font-bold leading-none shadow-2xs"
                                x-text="slot.role"
                            ></span>

                            <!-- Shirt Number -->
                            <span class="font-mono font-extrabold text-xs sm:text-sm tracking-tighter" x-text="slot.number"></span>
                        </div>

                        <!-- Player Label Tag -->
                        <div 
                            :class="selectedSlot === slot.id ? 'bg-[#E3131B] text-white font-bold' : 'bg-black/85 text-white/95'"
                            class="mt-1 px-2 py-0.5 rounded text-[10px] sm:text-[11px] font-semibold whitespace-nowrap shadow-sm border border-white/10 max-w-[90px] truncate transition-colors"
                            x-text="slot.name"
                        ></div>
                    </div>
                </template>
            </div>

            <!-- Pitch Legend & Tactical Guidance -->
            <div class="mt-4 pt-3 border-t border-[#1C1F26] flex flex-wrap items-center justify-between text-xs text-[#A0A3AA] gap-2">
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-amber-500"></span> حارس مرمى (GK)</span>
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-blue-600"></span> دفاع (DEF)</span>
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-emerald-600"></span> وسط (MID)</span>
                    <span class="flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-full bg-[#E3131B]"></span> هجوم (ATT)</span>
                </div>
                <span class="font-mono text-[11px]">11 PLAYERS ON PITCH</span>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- RIGHT: SQUAD ROSTER & TACTICAL INSTRUCTIONS (4 cols)                      -->
        <!-- ========================================================================= -->
        <div class="lg:col-span-4 space-y-5">
            <!-- Selected Position Info & Player Assignment -->
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-3 mb-3">
                    <div>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">تعيين لاعبي التشكيل الأساسي</h3>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">اختر موقعاً في الملعب ثم انقر على اللاعب للتعيين</p>
                    </div>
                    <template x-if="selectedSlot !== null">
                        <span class="px-2 py-0.5 rounded text-xs font-mono font-bold bg-[var(--text-strong)] text-[var(--surface)]">
                            مركز: <span x-text="slots.find(x => x.id === selectedSlot)?.role"></span>
                        </span>
                    </template>
                </div>

                <!-- Available Squad Roster List -->
                <div class="max-h-72 overflow-y-auto space-y-1.5 pe-1 divide-y divide-[var(--border-subtle)]">
                    <template x-for="player in availablePlayers" :key="player.id">
                        <div 
                            @click="assignPlayer(player)"
                            class="flex items-center justify-between p-2 rounded-lg hover:bg-[var(--surface-subtle)] transition-colors cursor-pointer group"
                        >
                            <div class="flex items-center gap-2.5 min-w-0">
                                <img :src="player.avatar" class="h-8 w-8 rounded-full object-cover border border-[var(--border)] shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-[var(--text-strong)] text-xs truncate group-hover:text-[#E3131B] transition-colors" x-text="player.name_ar"></h4>
                                    <span class="text-[10px] text-[var(--text-muted)] font-mono block" x-text="`#${player.jersey_number} • ${player.position_ar}`"></span>
                                </div>
                            </div>

                            <button class="px-2 py-1 rounded bg-[var(--surface-subtle)] group-hover:bg-[var(--text-strong)] group-hover:text-[var(--surface)] text-[10px] font-bold transition-colors">
                                تعيين +
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Tactical Notes & Instructions Area -->
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between border-b border-[var(--border-subtle)] pb-2.5">
                    <div class="flex items-center gap-2">
                        <i data-lucide="file-text" class="h-4 w-4 text-[#E3131B]"></i>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">التعليمات الفنية والتكتيكية</h3>
                    </div>
                    <span class="text-[10px] text-[var(--text-muted)]">توجيهات المدرب</span>
                </div>

                <textarea 
                    x-model="tacticalNotes" 
                    rows="4" 
                    placeholder="اكتب التوجيهات والواجبات التكتيكية للاعبين في هذه الخطة..."
                    class="w-full rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] p-3 text-xs text-[var(--text-strong)] focus:bg-[var(--surface)] focus:border-[#E3131B] focus:outline-none transition-colors font-arabic leading-relaxed resize-none"
                ></textarea>

                <!-- Saved Tactical Plans Library -->
                <div class="pt-2 border-t border-[var(--border-subtle)]">
                    <span class="text-[11px] font-bold text-[var(--text-muted)] block mb-2">الخطط المحفوظة للمباريات:</span>
                    <div class="space-y-1.5">
                        <template x-for="(plan, index) in savedPlans" :key="index">
                            <div class="p-2 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-[var(--text-strong)] block" x-text="plan.name"></span>
                                    <span class="text-[10px] text-[var(--text-muted)] font-mono" x-text="`${plan.formation} • ${plan.date}`"></span>
                                </div>
                                <button @click="setFormation(plan.formation); planName = plan.name; showToast('تم تفعيل: ' + plan.name)" class="text-[11px] font-bold text-[#E3131B] hover:underline">
                                    تفعيل
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

