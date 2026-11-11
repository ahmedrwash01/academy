@extends('layouts.admin', ['title' => 'مركز القيادة والعمليات — EAGLE OS'])

@section('content')
<div class="space-y-3.5 font-arabic" x-data="{
    // Current Active Formation on Tactical Pitch
    activeFormation: '4-3-3',
    selectedPlayer: null,

    // Formations Coordinate Maps
    formations: {
        '4-3-3': [
            { no: 1, name: 'بلال حسام', role: 'GK', roleAr: 'حارس مرمى', top: '84%', left: '50%', fitness: 98, goals: 0, assists: 1, rating: 9.1, id: 2 },
            { no: 2, name: 'كريم وائل', role: 'RB', roleAr: 'ظهير أيمن', top: '68%', left: '84%', fitness: 92, goals: 2, assists: 5, rating: 8.7, id: 4 },
            { no: 4, name: 'آدم شريف', role: 'CB', roleAr: 'مدافع قلب', top: '70%', left: '62%', fitness: 95, goals: 3, assists: 1, rating: 8.9, id: 5 },
            { no: 5, name: 'محمود طارق', role: 'CB', roleAr: 'مدافع قلب', top: '70%', left: '38%', fitness: 94, goals: 1, assists: 0, rating: 8.8, id: 6 },
            { no: 3, name: 'أحمد نادر', role: 'LB', roleAr: 'ظهير أيسر', top: '68%', left: '16%', fitness: 91, goals: 1, assists: 4, rating: 8.6, id: 7 },
            { no: 6, name: 'زياد طارق', role: 'DM', roleAr: 'وسط ارتكاز', top: '50%', left: '50%', fitness: 88, goals: 2, assists: 3, rating: 8.5, id: 3 },
            { no: 8, name: 'مصطفى كامل', role: 'CM', roleAr: 'وسط محور', top: '42%', left: '72%', fitness: 94, goals: 5, assists: 7, rating: 9.0, id: 8 },
            { no: 10, name: 'محمد أحمد', role: 'AM', roleAr: 'صانع ألعاب', top: '38%', left: '28%', fitness: 97, goals: 14, assists: 11, rating: 9.4, id: 1 },
            { no: 7, name: 'سيف الدين', role: 'RW', roleAr: 'جناح أيمن', top: '22%', left: '82%', fitness: 96, goals: 9, assists: 8, rating: 9.2, id: 9 },
            { no: 9, name: 'عمر شريف', role: 'ST', roleAr: 'رأس حربة', top: '16%', left: '50%', fitness: 95, goals: 16, assists: 4, rating: 9.5, id: 10 },
            { no: 11, name: 'حمزة وائل', role: 'LW', roleAr: 'جناح أيسر', top: '22%', left: '18%', fitness: 93, goals: 8, assists: 6, rating: 8.9, id: 11 }
        ],
        '4-4-2': [
            { no: 1, name: 'بلال حسام', role: 'GK', roleAr: 'حارس مرمى', top: '84%', left: '50%', fitness: 98, goals: 0, assists: 1, rating: 9.1, id: 2 },
            { no: 2, name: 'كريم وائل', role: 'RB', roleAr: 'ظهير أيمن', top: '68%', left: '84%', fitness: 92, goals: 2, assists: 5, rating: 8.7, id: 4 },
            { no: 4, name: 'آدم شريف', role: 'CB', roleAr: 'مدافع قلب', top: '70%', left: '62%', fitness: 95, goals: 3, assists: 1, rating: 8.9, id: 5 },
            { no: 5, name: 'محمود طارق', role: 'CB', roleAr: 'مدافع قلب', top: '70%', left: '38%', fitness: 94, goals: 1, assists: 0, rating: 8.8, id: 6 },
            { no: 3, name: 'أحمد نادر', role: 'LB', roleAr: 'ظهير أيسر', top: '68%', left: '16%', fitness: 91, goals: 1, assists: 4, rating: 8.6, id: 7 },
            { no: 7, name: 'سيف الدين', role: 'RM', roleAr: 'وسط أيمن', top: '46%', left: '84%', fitness: 96, goals: 9, assists: 8, rating: 9.2, id: 9 },
            { no: 6, name: 'زياد طارق', role: 'CM', roleAr: 'وسط مدافع', top: '48%', left: '60%', fitness: 88, goals: 2, assists: 3, rating: 8.5, id: 3 },
            { no: 8, name: 'مصطفى كامل', role: 'CM', roleAr: 'وسط محور', top: '48%', left: '40%', fitness: 94, goals: 5, assists: 7, rating: 9.0, id: 8 },
            { no: 11, name: 'حمزة وائل', role: 'LM', roleAr: 'وسط أيسر', top: '46%', left: '16%', fitness: 93, goals: 8, assists: 6, rating: 8.9, id: 11 },
            { no: 10, name: 'محمد أحمد', role: 'CF', roleAr: 'مهاجم متأخر', top: '22%', left: '62%', fitness: 97, goals: 14, assists: 11, rating: 9.4, id: 1 },
            { no: 9, name: 'عمر شريف', role: 'ST', roleAr: 'رأس حربة', top: '18%', left: '38%', fitness: 95, goals: 16, assists: 4, rating: 9.5, id: 10 }
        ],
        '3-5-2': [
            { no: 1, name: 'بلال حسام', role: 'GK', roleAr: 'حارس مرمى', top: '84%', left: '50%', fitness: 98, goals: 0, assists: 1, rating: 9.1, id: 2 },
            { no: 2, name: 'كريم وائل', role: 'CB', roleAr: 'مدافع أيمن', top: '70%', left: '76%', fitness: 92, goals: 2, assists: 5, rating: 8.7, id: 4 },
            { no: 4, name: 'آدم شريف', role: 'CB', roleAr: 'قلب دفاع', top: '72%', left: '50%', fitness: 95, goals: 3, assists: 1, rating: 8.9, id: 5 },
            { no: 5, name: 'محمود طارق', role: 'CB', roleAr: 'مدافع أيسر', top: '70%', left: '24%', fitness: 94, goals: 1, assists: 0, rating: 8.8, id: 6 },
            { no: 7, name: 'سيف الدين', role: 'RWB', roleAr: 'جناح دفاعي أيمن', top: '48%', left: '88%', fitness: 96, goals: 9, assists: 8, rating: 9.2, id: 9 },
            { no: 6, name: 'زياد طارق', role: 'DM', roleAr: 'وسط ارتكاز', top: '54%', left: '50%', fitness: 88, goals: 2, assists: 3, rating: 8.5, id: 3 },
            { no: 8, name: 'مصطفى كامل', role: 'CM', roleAr: 'وسط محور', top: '44%', left: '64%', fitness: 94, goals: 5, assists: 7, rating: 9.0, id: 8 },
            { no: 10, name: 'محمد أحمد', role: 'AM', roleAr: 'صانع ألعاب', top: '38%', left: '36%', fitness: 97, goals: 14, assists: 11, rating: 9.4, id: 1 },
            { no: 3, name: 'أحمد نادر', role: 'LWB', roleAr: 'جناح دفاعي أيسر', top: '48%', left: '12%', fitness: 91, goals: 1, assists: 4, rating: 8.6, id: 7 },
            { no: 9, name: 'عمر شريف', role: 'ST', roleAr: 'رأس حربة', top: '18%', left: '60%', fitness: 95, goals: 16, assists: 4, rating: 9.5, id: 10 },
            { no: 11, name: 'حمزة وائل', role: 'ST', roleAr: 'مهاجم ثاني', top: '18%', left: '40%', fitness: 93, goals: 8, assists: 6, rating: 8.9, id: 11 }
        ]
    },

    get currentSquad() {
        return this.formations[this.activeFormation];
    },

    // Live Match Countdown Timer State
    countdown: {
        days: 3,
        hours: 6,
        minutes: 42,
        seconds: 18,
        interval: null,
        init() {
            this.interval = setInterval(() => {
                if (this.seconds > 0) {
                    this.seconds--;
                } else {
                    this.seconds = 59;
                    if (this.minutes > 0) {
                        this.minutes--;
                    } else {
                        this.minutes = 59;
                        if (this.hours > 0) {
                            this.hours--;
                        } else {
                            this.hours = 23;
                            if (this.days > 0) this.days--;
                        }
                    }
                }
            }, 1000);
        }
    },

    // Dynamic Greeting based on current time
    get greeting() {
        const hour = new Date().getHours();
        if (hour >= 5 && hour < 12) return 'صباح الخير، كابتن إبراهيم فؤاد';
        if (hour >= 12 && hour < 17) return 'طاب يومك، كابتن إبراهيم فؤاد';
        return 'مساء الخير، كابتن إبراهيم فؤاد';
    },

    // Tactical Pitch Interactive Drag & Drop + Fullscreen Mode
    draggingPlayer: null,
    pitchFullscreen: false,
    startDrag(player, event) {
        this.draggingPlayer = player;
        this.selectedPlayer = player;
        const container = event.currentTarget.closest('.pitch-canvas');
        if (!container) return;
        const rect = container.getBoundingClientRect();
        
        const onMove = (e) => {
            if (!this.draggingPlayer) return;
            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;
            let left = ((clientX - rect.left) / rect.width) * 100;
            let top = ((clientY - rect.top) / rect.height) * 100;
            left = Math.max(5, Math.min(95, left));
            top = Math.max(8, Math.min(92, top));
            this.draggingPlayer.left = left.toFixed(1) + '%';
            this.draggingPlayer.top = top.toFixed(1) + '%';
        };

        const onEnd = () => {
            this.draggingPlayer = null;
            window.removeEventListener('mousemove', onMove);
            window.removeEventListener('mouseup', onEnd);
            window.removeEventListener('touchmove', onMove);
            window.removeEventListener('touchend', onEnd);
        };

        window.addEventListener('mousemove', onMove);
        window.addEventListener('mouseup', onEnd);
        window.addEventListener('touchmove', onMove);
        window.addEventListener('touchend', onEnd);
    },

    // Dynamic Popover Positioning: Renders directly next to the active player
    get popoverStyle() {
        if (!this.selectedPlayer) return '';
        const topVal = parseFloat(this.selectedPlayer.top) || 50;
        const leftVal = parseFloat(this.selectedPlayer.left) || 50;
        
        // Vertical positioning: If player is in bottom half (>50%), show above player; otherwise below
        const top = topVal > 50 ? Math.max(3, topVal - 32) + '%' : Math.min(65, topVal + 7) + '%';
        
        // Horizontal clamp to keep 256px card nicely framed inside pitch canvas
        let left = leftVal;
        if (leftVal < 26) left = 26;
        if (leftVal > 74) left = 74;
        
        return `top: ${top}; left: ${left}%; transform: translateX(-50%);`;
    },

    // Quick Attendance Modal State
    openQuickAttendance: false,
    quickAttendanceSaved: false,
    quickPlayers: [
        { id: 1, name: 'محمد أحمد إبراهيم', role: 'صانع ألعاب', jersey: 10, status: 'present' },
        { id: 2, name: 'عمر محمود الشناوي', role: 'حارس مرمى', jersey: 1, status: 'present' },
        { id: 3, name: 'يوسف إبراهيم مصطفى', role: 'جناح أيمن', jersey: 7, status: 'present' },
        { id: 4, name: 'أحمد مصطفى خليل', role: 'مدافع قلب', jersey: 4, status: 'present' },
        { id: 5, name: 'زياد طارق السعيد', role: 'وسط ارتكاز', jersey: 6, status: 'absent' },
        { id: 6, name: 'سيف الدين محمود', role: 'جناح أيمن', jersey: 11, status: 'present' },
        { id: 7, name: 'مصطفى كامل إبراهيم', role: 'وسط محور', jersey: 8, status: 'present' },
        { id: 8, name: 'كريم وائل المنصوري', role: 'ظهير أيمن', jersey: 2, status: 'excused' },
    ],
    markAllPresent() {
        this.quickPlayers.forEach(p => p.status = 'present');
        window.dispatchEvent(new CustomEvent('show-toast', { detail: 'تم تحضير جميع لاعبي الحصة بنجاح!' }));
    },
    saveQuickAttendance() {
        this.quickAttendanceSaved = true;
        setTimeout(() => {
            this.quickAttendanceSaved = false;
            this.openQuickAttendance = false;
            window.dispatchEvent(new CustomEvent('show-toast', { detail: 'تم اعتماد وحفظ كشف الحضور الميداني لفئة U-15 بنجاح!' }));
        }, 500);
    },

    // Decision Center Interactive State
    approvedAlerts: [],
    approveAlert(id) {
        if (!this.approvedAlerts.includes(id)) {
            this.approvedAlerts.push(id);
            window.dispatchEvent(new CustomEvent('show-toast', { detail: 'تم اعتماد وتنفيذ الإجراء الإداري بنجاح!' }));
        }
    }
}" x-init="countdown.init()">

    <!-- ========================================================================= -->
    <!-- 1. COMPACT EXECUTIVE HERO (NEVER OVERFLOWS, CRISP ON 1366PX)                -->
    <!-- ========================================================================= -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-2.5 sm:p-3 shadow-2xs border-s-[3px] border-s-[#E3131B] transition-all overflow-hidden">
        <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-2.5 w-full">
            
            <!-- Right / Start: Greeting & 3 Chips in One Single Clean Row -->
            <div class="flex items-center gap-1.5 sm:gap-2 flex-wrap sm:flex-nowrap shrink-0">
                <h1 class="text-xs sm:text-sm font-black text-[var(--text-strong)] tracking-tight whitespace-nowrap" x-text="greeting">
                    صباح الخير، كابتن إبراهيم فؤاد
                </h1>

                <!-- 1. Pitch Status Badge -->
                <x-badge variant="success" :dot="true" size="sm">
                    الملعب A: 100%
                </x-badge>

                <!-- 2. Upcoming Derby Match Chip -->
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-[var(--surface-subtle)] text-[11px] font-bold text-[var(--text-secondary)] border border-[var(--border)] whitespace-nowrap shadow-2xs">
                    <i data-lucide="trophy" class="w-3.5 h-3.5 text-amber-500"></i>
                    <span>الديربي: <strong class="text-[var(--text-strong)] tabular-nums" x-text="countdown.days + ' أيام'">3 أيام</strong></span>
                </span>

                <!-- 3. Operational Attention Chip -->
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-[var(--danger-bg)] text-[11px] font-bold text-[var(--danger-text)] border border-[var(--danger-border)] whitespace-nowrap shadow-2xs">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5 text-[var(--danger-text)]"></i>
                    <span><strong class="tabular-nums">4</strong> تنبيهات</span>
                </span>
            </div>

            <!-- Middle: Today's Schedule Mini Card (Point 4: Visible on 1366px laptops) -->
            <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] text-[11px] shadow-2xs shrink-0">
                <div class="flex items-center gap-1 text-[var(--text-secondary)] font-bold whitespace-nowrap pe-1 border-e border-[var(--border)]">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-[#E3131B]"></i>
                    <span>جدول اليوم:</span>
                </div>
                <div class="flex items-center gap-1 overflow-hidden whitespace-nowrap">
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded bg-[var(--surface)] border border-[var(--border-subtle)] text-[10px] font-medium shadow-2xs" title="16:30 • براعم U-11 • ملعب B">
                        <strong class="text-[var(--text-strong)] tabular-nums">16:30</strong>
                        <span class="text-[var(--text-secondary)]">U-11</span>
                        <span class="text-[var(--text-muted)]">(B)</span>
                    </span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded bg-[var(--surface)] border border-[var(--border-subtle)] text-[10px] font-medium shadow-2xs" title="18:00 • ناشئين U-15 • ملعب A الرئيسي">
                        <strong class="text-[var(--text-strong)] tabular-nums">18:00</strong>
                        <span class="text-[#E3131B] font-bold">U-15</span>
                        <span class="text-[var(--text-muted)]">(A)</span>
                    </span>
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded bg-[var(--surface)] border border-[var(--border-subtle)] text-[10px] font-medium shadow-2xs" title="19:30 • تخصصي الحراس • ملعب C">
                        <strong class="text-[var(--text-strong)] tabular-nums">19:30</strong>
                        <span class="text-amber-600 dark:text-amber-400 font-bold">حراس</span>
                        <span class="text-[var(--text-muted)]">(C)</span>
                    </span>
                </div>
            </div>

            <!-- Left / End: Primary Action -->
            <div class="flex items-center gap-2 shrink-0">
                <a 
                    href="{{ route('players.create') }}" 
                    class="py-1.5 px-4 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] text-white text-xs font-bold text-center inline-flex items-center justify-center gap-1.5 shadow-xs transition-colors whitespace-nowrap shrink-0"
                >
                    <i data-lucide="user-plus" class="h-3.5 w-3.5"></i>
                    <span>إضافة لاعب</span>
                </a>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. HIGH-DENSITY KPI CARDS WITH SPARKLINES, COLOR IDENTITY & 2-LINE FOOTER -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-3.5">
        
        <!-- KPI 1: Players Count (Blue / Command Center) -->
        <x-stat-card 
            title="قيد قطاع الناشئين" 
            :value="$stats['total_players']" 
            change="+14 لاعباً موسمياً" 
            changeDirection="up" 
            changeSemantic="success"
            :subtext="$stats['active_players'] . ' نشطاً'"
            footnote="8 فئات سنية مسجلة بالاتحاد" 
            accent="blue"
            icon="users"
            tooltip="إجمالي المقيدين بقطاعات الأكاديمية والجاهزين للمنافسات"
            :sparkline="[210, 218, 224, 230, 238, 242, 248]"
        />

        <!-- KPI 2: Attendance Rate (Pitch Green) -->
        <x-stat-card 
            title="حضور المران اليوم" 
            :value="($stats['attendance_rate'] ?? 93.9) . '%'" 
            change="+2.1% أسبوعياً" 
            changeDirection="up" 
            changeSemantic="success"
            :subtext="$stats['today_attendance'] . ' متدرباً'"
            footnote="12 غياب مسجل بعذر رسمي" 
            accent="pitch"
            icon="activity"
            tooltip="نسبة الالتزام الميداني بالحصص التدريبية ليوم السبت"
            :sparkline="[88, 89, 91, 90, 92, 93.5, 93.9]"
        />

        <!-- KPI 3: Monthly Revenue (Eagle Red) -->
        <x-stat-card 
            title="المتحصلات الشهرية" 
            :value="number_format($stats['monthly_revenue'])" 
            suffix="ج.م"
            change="+9.2% عن الهدف" 
            changeDirection="up" 
            changeSemantic="success"
            :subtext="'تحصيل ' . $stats['collection_rate'] . '%'"
            footnote="إجمالي الاشتراكات المحصلة لشهر مارس" 
            accent="brand"
            icon="trending-up"
            tooltip="إجمالي الإيرادات المحصلة بالجنيه المصري لشهر مارس الجاري"
            :sparkline="[310, 325, 340, 335, 360, 375, 385]"
        />

        <!-- KPI 4: Operating Surplus (Purple) -->
        <x-stat-card 
            title="صافي الفائض التشغيلي" 
            :value="number_format($stats['net_profit'] ?? 161000)" 
            suffix="ج.م"
            change="هامش ربح 41.8%" 
            changeDirection="up" 
            changeSemantic="success"
            subtext="161 ألف فائض"
            footnote="ضمن حدود الميزانية السنوية المعتمدة" 
            accent="purple"
            icon="pie-chart"
            tooltip="صافي الأرباح التشغيلية بعد خصم الرواتب والملاعب والمصروفات"
            :sparkline="[115, 128, 134, 142, 150, 158, 161]"
        />

    </div>

    <!-- ========================================================================= -->
    <!-- 3. INTERACTIVE TACTICAL PITCH & MATCHDAY DERBY (VISIBLE ABOVE FOLD 1366)  -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 sm:gap-4">
        
        <!-- Left Column: Interactive Tactical Pitch (7 cols) with Fullscreen Mode -->
        <div 
            :class="pitchFullscreen ? 'fixed inset-4 z-50 p-6 flex flex-col justify-between rounded-2xl bg-[#0C0D0F] border border-white/20 shadow-2xl overflow-hidden' : 'lg:col-span-7 bg-[#111214] rounded-xl border border-[#1C1F26] p-3.5 shadow-xl text-white flex flex-col justify-between'"
        >
            <div>
                <!-- Tactical Header with Formation Switcher Buttons & Fullscreen -->
                <div class="flex items-center justify-between pb-2.5 border-b border-white/10 mb-2.5">
                    <div class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-[#E3131B] animate-pulse"></span>
                        <h2 class="text-xs sm:text-sm font-bold text-white tracking-wide">المختبر التكتيكي الميداني — التشكيل الحي</h2>
                    </div>

                    <!-- Formations Switcher Buttons -->
                    <div class="inline-flex items-center p-0.5 rounded-lg bg-white/5 border border-white/10 text-xs gap-0.5">
                        <button 
                            type="button" 
                            @click="activeFormation = '4-3-3'; selectedPlayer = null"
                            :class="activeFormation === '4-3-3' ? 'bg-[#E3131B] text-white shadow-xs' : 'text-gray-400 hover:text-white'"
                            class="px-2 py-0.5 rounded-md font-bold text-[11px] transition-all tabular-nums"
                        >
                            4-3-3
                        </button>
                        <button 
                            type="button" 
                            @click="activeFormation = '4-4-2'; selectedPlayer = null"
                            :class="activeFormation === '4-4-2' ? 'bg-[#E3131B] text-white shadow-xs' : 'text-gray-400 hover:text-white'"
                            class="px-2 py-0.5 rounded-md font-bold text-[11px] transition-all tabular-nums"
                        >
                            4-4-2
                        </button>
                        <button 
                            type="button" 
                            @click="activeFormation = '3-5-2'; selectedPlayer = null"
                            :class="activeFormation === '3-5-2' ? 'bg-[#E3131B] text-white shadow-xs' : 'text-gray-400 hover:text-white'"
                            class="px-2 py-0.5 rounded-md font-bold text-[11px] transition-all tabular-nums"
                        >
                            3-5-2
                        </button>
                        <button 
                            type="button" 
                            @click="pitchFullscreen = !pitchFullscreen" 
                            :class="pitchFullscreen ? 'bg-amber-500 text-black' : 'text-gray-400 hover:text-white'"
                            class="px-1.5 py-0.5 rounded-md font-bold text-[11px] transition-all inline-flex items-center gap-1"
                            title="وضع شاشة العرض الكامل للمحاضرات"
                        >
                            <i data-lucide="maximize-2" class="w-3 h-3"></i>
                        </button>
                    </div>
                </div>

                <!-- Football Pitch Graphic Container with Drag & Drop Pitch Canvas (Point 2: Fills Space Generously) -->
                <div 
                    class="pitch-canvas relative w-full h-[340px] sm:h-[370px] rounded-xl bg-gradient-to-b from-[#14532d] via-[#15803d] to-[#14532d] border border-white/20 overflow-hidden shadow-inner select-none transition-all duration-300"
                    :class="pitchFullscreen ? '!h-[calc(100vh-140px)]' : ''"
                >
                    <!-- Turf Texture Stripes -->
                    <div class="absolute inset-0 opacity-15 flex flex-col pointer-events-none">
                        <div class="flex-1 bg-black/20"></div>
                        <div class="flex-1 bg-white/10"></div>
                        <div class="flex-1 bg-black/20"></div>
                        <div class="flex-1 bg-white/10"></div>
                        <div class="flex-1 bg-black/20"></div>
                    </div>

                    <!-- SVG Authentic Pitch Lines -->
                    <svg class="absolute inset-0 w-full h-full pointer-events-none opacity-40" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <line x1="0" y1="50" x2="100" y2="50" stroke="#ffffff" stroke-width="0.8" />
                        <circle cx="50" cy="50" r="14" stroke="#ffffff" stroke-width="0.8" fill="none" />
                        <circle cx="50" cy="50" r="1" fill="#ffffff" />
                        <rect x="22" y="0" width="56" height="18" stroke="#ffffff" stroke-width="0.8" fill="none" />
                        <rect x="34" y="0" width="32" height="7" stroke="#ffffff" stroke-width="0.8" fill="none" />
                        <rect x="22" y="82" width="56" height="18" stroke="#ffffff" stroke-width="0.8" fill="none" />
                        <rect x="34" y="93" width="32" height="7" stroke="#ffffff" stroke-width="0.8" fill="none" />
                    </svg>

                    <!-- Interactive Animated Draggable Player Tokens on Pitch -->
                    <template x-for="player in currentSquad" :key="player.no">
                        <div 
                            class="absolute -translate-x-1/2 -translate-y-1/2 flex flex-col items-center group select-none transition-all duration-300 ease-out"
                            :class="draggingPlayer && draggingPlayer.no === player.no ? 'cursor-grabbing scale-125 z-40 !duration-0' : 'cursor-grab z-20'"
                            :style="'top: ' + player.top + '; left: ' + player.left + ';'"
                            @mousedown="startDrag(player, $event)"
                            @touchstart.passive="startDrag(player, $event)"
                            @mouseenter="if (!draggingPlayer) selectedPlayer = player"
                            @click="selectedPlayer = player"
                        >
                            <div 
                                class="w-6 h-6 sm:w-7 sm:h-7 rounded-full border border-white text-white flex items-center justify-center font-bold text-[10px] tabular-nums shadow-lg transition-all"
                                :class="selectedPlayer && selectedPlayer.no === player.no ? 'bg-[#E3131B] border-white scale-125 ring-2 ring-[#E3131B]/40' : 'bg-[#111214] border-white group-hover:bg-[#E3131B] group-hover:scale-115'"
                            >
                                <span x-text="player.no"></span>
                            </div>
                            <span 
                                class="text-[8px] sm:text-[9px] font-bold px-1.5 py-0.2 rounded mt-0.5 whitespace-nowrap shadow-xs transition-colors"
                                :class="selectedPlayer && selectedPlayer.no === player.no ? 'bg-[#E3131B] text-white' : 'bg-black/80 text-white group-hover:bg-[#E3131B]'"
                                x-text="player.name"
                            ></span>
                        </div>
                    </template>

                    <!-- Sleek Dynamic Player Dossier Popover Adjacent to Player (Point 2: Appears Next to the Active Player) -->
                    <div 
                        x-show="selectedPlayer" 
                        x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-90 translate-y-1"
                        :style="popoverStyle"
                        class="absolute w-64 max-w-[88%] bg-[#111214]/95 backdrop-blur-md rounded-xl border border-white/20 p-3 shadow-2xl text-xs z-50 pointer-events-auto transition-all duration-200"
                    >
                        <div class="flex items-start justify-between border-b border-white/10 pb-2 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-[#E3131B] text-white flex items-center justify-center font-bold text-[10px] tabular-nums" x-text="'#' + selectedPlayer?.no"></span>
                                <div>
                                    <h4 class="font-bold text-white text-xs" x-text="selectedPlayer?.name"></h4>
                                    <span class="text-[10px] text-gray-400" x-text="selectedPlayer?.role + ' • ' + selectedPlayer?.roleAr"></span>
                                </div>
                            </div>
                            <button @click="selectedPlayer = null" class="text-gray-400 hover:text-white p-0.5">
                                <i data-lucide="x" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>

                        <!-- Mini Stats Grid -->
                        <div class="grid grid-cols-3 gap-1.5 text-center text-[10px] mb-2">
                            <div class="p-1 rounded bg-white/5 border border-white/5">
                                <span class="text-gray-400 block">الجاهزية</span>
                                <span class="font-bold text-emerald-400 text-[11px] mt-0.5 block tabular-nums" x-text="selectedPlayer?.fitness + '%'"></span>
                            </div>
                            <div class="p-1 rounded bg-white/5 border border-white/5">
                                <span class="text-gray-400 block">أهداف / صناعة</span>
                                <span class="font-bold text-white text-[11px] mt-0.5 block tabular-nums" x-text="selectedPlayer?.goals + ' / ' + selectedPlayer?.assists"></span>
                            </div>
                            <div class="p-1 rounded bg-white/5 border border-white/5">
                                <span class="text-gray-400 block">التقييم</span>
                                <span class="font-bold text-amber-400 text-[11px] mt-0.5 block tabular-nums" x-text="selectedPlayer?.rating + ' ★'"></span>
                            </div>
                        </div>

                        <a 
                            :href="'{{ url('players') }}/' + (selectedPlayer?.id || 1)" 
                            class="w-full text-center py-1 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] text-white text-[10px] font-bold block transition-colors"
                        >
                            فتح الملف 360 الكامل ←
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-2.5 pt-2 border-t border-white/10 flex items-center justify-between text-xs">
                <span class="text-gray-400 text-[11px]">المدرب المشرف: <strong class="text-white">كابتن أحمد سامي (CAF A)</strong></span>
                <a href="{{ route('tactics.index') }}" class="px-2.5 py-1 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] text-white font-bold text-xs transition-colors inline-flex items-center gap-1 shadow-sm">
                    <span>فتح اللوحة الكاملة</span>
                    <i data-lucide="arrow-left" class="w-3 h-3 rtl:rotate-0 ltr:rotate-180"></i>
                </a>
            </div>
        </div>

        <!-- Right Column: Matchday Derby Countdown & Needs Attention (5 cols) -->
        <div class="lg:col-span-5 flex flex-col justify-between space-y-3">
            
            <!-- Featured Upcoming Derby Match with Live Countdown -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-3.5 shadow-2xs space-y-2.5">
                <div class="flex items-center justify-between pb-2 border-b border-[var(--border)]">
                    <div class="flex items-center gap-2">
                        <i data-lucide="trophy" class="w-4 h-4 text-[#E3131B]"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-strong)]">المواجهة الرسمية القادمة — قمة الصدارة</h3>
                    </div>
                    <!-- Unified Badge System (Item 3) -->
                    <x-badge variant="danger" size="md">
                        دوري سوبر القاهرة
                    </x-badge>
                </div>

                <!-- Live Countdown Ticker Strip -->
                <div class="bg-[var(--surface-subtle)] rounded-lg p-2.5 border border-[var(--border)]">
                    <div class="flex items-center justify-between text-xs text-[var(--text-muted)] mb-2">
                        <span class="font-bold text-[var(--text-strong)]">العد التنازلي لانطلاق القمة:</span>
                        <span class="text-[#E3131B] font-bold">السبت 14 مارس • <span class="tabular-nums">17:30</span></span>
                    </div>

                    <!-- Enlarged Countdown Numbers (Red on seconds ONLY, min 12px labels) -->
                    <div class="grid grid-cols-4 gap-1.5 text-center">
                        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-md py-1.5 px-2 shadow-2xs">
                            <span class="text-2xl sm:text-3xl font-black text-[var(--text-strong)] block tabular-nums" x-text="countdown.days">3</span>
                            <span class="text-xs font-bold text-[var(--text-muted)] block mt-0.5">أيام</span>
                        </div>
                        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-md py-1.5 px-2 shadow-2xs">
                            <span class="text-2xl sm:text-3xl font-black text-[var(--text-strong)] block tabular-nums" x-text="countdown.hours">6</span>
                            <span class="text-xs font-bold text-[var(--text-muted)] block mt-0.5">ساعات</span>
                        </div>
                        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-md py-1.5 px-2 shadow-2xs">
                            <span class="text-2xl sm:text-3xl font-black text-[var(--text-strong)] block tabular-nums" x-text="countdown.minutes">42</span>
                            <span class="text-xs font-bold text-[var(--text-muted)] block mt-0.5">دقائق</span>
                        </div>
                        <div class="bg-[var(--surface)] border border-[var(--border)] rounded-md py-1.5 px-2 shadow-2xs">
                            <span class="text-2xl sm:text-3xl font-black text-[#E3131B] block tabular-nums" x-text="countdown.seconds">18</span>
                            <span class="text-xs font-bold text-[var(--text-muted)] block mt-0.5">ثواني</span>
                        </div>
                    </div>
                </div>

                <!-- Match Face-off & Crests (Item 6: Guaranteed No-Overlap at 1366px) -->
                <div class="p-2.5 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)]">
                    <div class="flex items-center justify-between gap-1 sm:gap-2 py-0.5">
                        <!-- Eagles SC (Left Side / Team 1) -->
                        <div class="text-center min-w-0 flex-1 px-1">
                            <div class="w-10 h-10 mx-auto rounded-lg bg-[var(--surface)] border border-[var(--border)] p-1 flex items-center justify-center shadow-2xs">
                                <img src="{{ asset('images/academy-logo.png') }}" class="w-7 h-7 object-contain">
                            </div>
                            <span class="text-xs font-black text-[var(--text-strong)] mt-1 block truncate" title="النسور U-15">النسور U-15</span>
                            <span class="text-xs text-[var(--success-text)] font-bold block truncate" title="المتصدر (38 ن)">المتصدر (<span class="tabular-nums">38</span> ن)</span>
                            <!-- Form Streak -->
                            <div class="flex items-center justify-center gap-0.5 mt-1">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500" title="تعادل"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                            </div>
                        </div>

                        <!-- VS Center Badge -->
                        <div class="flex flex-col items-center shrink-0 px-1 sm:px-2">
                            <span class="px-2.5 py-0.5 rounded bg-[var(--text-strong)] text-[var(--surface)] font-black text-xs shadow-xs">VS</span>
                            <span class="text-[11px] text-[var(--text-muted)] mt-1 whitespace-nowrap">ستاد كلية الشرطة</span>
                        </div>

                        <!-- Al Ahly SC (Right Side / Team 2) -->
                        <div class="text-center min-w-0 flex-1 px-1">
                            <div class="w-10 h-10 mx-auto rounded-lg bg-[#E3131B] text-white font-black text-xs flex items-center justify-center shadow-2xs">
                                الأهلي
                            </div>
                            <span class="text-xs font-black text-[var(--text-strong)] mt-1 block truncate" title="الأهلي U-15">الأهلي U-15</span>
                            <span class="text-xs text-[var(--text-muted)] font-bold block truncate" title="الوصيف (34 ن)">الوصيف (<span class="tabular-nums">34</span> ن)</span>
                            <!-- Form Streak -->
                            <div class="flex items-center justify-center gap-0.5 mt-1">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500" title="تعادل"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500" title="فوز"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-0.5 flex items-center justify-between text-xs">
                    <span class="text-[11px] text-[var(--text-muted)]">سجل المواجهات: 3 فوز للنسور • 1 تعادل</span>
                    <a href="{{ route('competitions.index') }}" class="font-bold text-[#E3131B] hover:underline text-[11px]">
                        جدول الدوري وترتيب الفرق ←
                    </a>
                </div>
            </div>

            <!-- National Initiative: Project 500 Talents (Compact & Integrated) -->
            <div class="bg-[var(--bg-surface)] rounded-xl border border-[var(--border-default)] p-3 shadow-2xs border-s-[3px] border-s-amber-500">
                <div class="flex items-center justify-between pb-1.5 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center gap-1.5">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        <h3 class="text-xs font-bold text-[var(--text-primary)]">المبادرة القومية: مشروع الـ 500 موهبة</h3>
                    </div>
                    <x-badge variant="warning" size="xs">
                        <span class="tabular-nums">28.4%</span> مكتمل
                    </x-badge>
                </div>

                <div class="grid grid-cols-2 gap-2 mt-2 text-xs">
                    <div class="p-2 bg-[var(--bg-surface-subtle)] rounded-lg border border-[var(--border-default)]">
                        <span class="text-[10px] text-[var(--text-muted)] block">تم رصدهم بالمحافظات:</span>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-lg font-black text-[#E3131B] tabular-nums">142</span>
                            <span class="text-[10px] text-[var(--text-muted)] tabular-nums">/ 500</span>
                        </div>
                    </div>
                    <div class="p-2 bg-[var(--bg-surface-subtle)] rounded-lg border border-[var(--border-default)]">
                        <span class="text-[10px] text-[var(--text-muted)] block">عقود معايشة للأندية:</span>
                        <div class="flex items-baseline gap-1 mt-0.5">
                            <span class="text-lg font-black text-emerald-700 dark:text-emerald-400 tabular-nums">18</span>
                            <span class="text-[10px] font-bold text-emerald-800 dark:text-emerald-300">ناشئاً</span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pt-1.5 border-t border-[var(--border-subtle)] flex items-center justify-between text-[11px]">
                    <span class="text-[10px] text-[var(--text-muted)]">الأهلي، زد، إنبي، سيراميكا</span>
                    <a href="{{ route('scouting.index') }}" class="font-bold text-[#E3131B] hover:underline flex items-center gap-1 text-[11px]">
                        <span>فتح رادار المواهب</span>
                        <i data-lucide="crosshair" class="w-3 h-3"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 4. DECISION CENTER (NEEDS ATTENTION / مركز القرارات والعمليات)             -->
    <!-- ========================================================================= -->
    <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 sm:p-5 shadow-2xs space-y-3.5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-2.5 border-b border-[var(--border-default)] gap-2">
            <div>
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-alert" class="h-4 w-4 text-[#E3131B]"></i>
                    <h2 class="text-sm font-bold text-[var(--text-primary)]">مركز القرارات والعمليات — إجراءات تتطلب تدخلك</h2>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E3131B] text-white tabular-nums">4 عاجل</span>
                </div>
                <p class="text-[11px] text-[var(--text-muted)] mt-0.5">
                    تنبيهات تشغيلية حرجة مستخرجة آلياً من ملفات اللاعبين، المنظومة الطبية، والرقابة المالية
                </p>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-[11px] text-[var(--text-muted)]">تم التحديث تلقائياً: منذ دقيقتين</span>
            </div>
        </div>

        <!-- Decision Alerts Grid (4 items) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach($decisionAlerts as $alert)
                <div class="p-3.5 rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface-subtle)] flex flex-col justify-between space-y-2.5 hover:shadow-2xs transition-shadow border-s-[3px] {{ $alert['priority'] === 'urgent' ? 'border-s-[#E3131B]' : ($alert['priority'] === 'high' ? 'border-s-amber-500' : ($alert['priority'] === 'medium' ? 'border-s-emerald-600' : 'border-s-sky-500')) }}">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold {{ $alert['priority'] === 'urgent' ? 'bg-[#E3131B] text-white' : ($alert['priority'] === 'high' ? 'bg-amber-500 text-white' : ($alert['priority'] === 'medium' ? 'bg-emerald-600 text-white' : 'bg-sky-600 text-white')) }}">
                                {{ $alert['priority_label_ar'] }}
                            </span>
                            <span class="text-[10px] text-[var(--text-muted)]">{{ $alert['meta'] }}</span>
                        </div>
                        <h4 class="text-xs font-bold text-[var(--text-primary)]">{{ $alert['title_ar'] }}</h4>
                        <p class="text-[11px] text-[var(--text-muted)] mt-0.5 leading-relaxed">{{ $alert['description_ar'] }}</p>
                    </div>

                    <div class="pt-2 border-t border-[var(--border-subtle)] flex items-center justify-between">
                        <span class="text-[10px] text-[var(--text-muted)]">الإجراء المطلوب من الإدارة</span>
                        <div class="inline-flex items-center gap-1.5">
                            @if(str_contains($alert['title_ar'], 'اشتراكات'))
                                <a 
                                    href="https://wa.me/201000000000?text={{ urlencode('تحية طيبة من إدارة أكاديمية النسور SC. نود تذكيركم بضرورة سداد الاشتراك الشهري المستحق.') }}" 
                                    target="_blank"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-700 hover:bg-emerald-800 text-white shadow-2xs transition-all"
                                >
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    <span>واتساب ولي الأمر</span>
                                </a>
                            @endif

                            <template x-if="approvedAlerts.includes('{{ $loop->index }}')">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300 border border-emerald-300">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    <span>تم الاعتماد والتنفيذ</span>
                                </span>
                            </template>

                            <template x-if="!approvedAlerts.includes('{{ $loop->index }}')">
                                <div class="inline-flex items-center gap-1">
                                    <button 
                                        type="button"
                                        @click="approveAlert('{{ $loop->index }}')"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-[var(--surface)] text-[var(--text-strong)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] transition-all shadow-2xs"
                                    >
                                        <span>اعتماد فوري</span>
                                    </button>
                                    <a 
                                        href="{{ $alert['action_url'] }}" 
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-bold transition-all shadow-2xs {{ $alert['priority'] === 'urgent' ? 'bg-[#E3131B] text-white hover:bg-[#c00f16]' : 'bg-[var(--text-strong)] text-[var(--surface)] hover:opacity-90' }}"
                                    >
                                        <span>{{ $alert['action_label'] }}</span>
                                        <i data-lucide="arrow-left" class="w-3 h-3 rtl:rotate-0 ltr:rotate-180"></i>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 5. 4 OPERATIONAL CHARTS (ATTENDANCE, REVENUE/EXPENSE, AGE DONUT, RADAR)   -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        
        <!-- Chart 1: Revenue vs Expenses Cashflow Combo -->
        <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 sm:p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2.5 border-b border-[var(--border-default)]">
                <div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="h-4 w-4 text-[#E3131B]"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">حركة الإيرادات والمصروفات والتدفق النقدي (EGP)</h3>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">مقارنة الإيرادات المحصلة بمصروفات التشغيل للأشهر الستة الأخيرة</p>
                </div>
                <a href="{{ route('finance.index') }}" class="text-xs font-bold text-[#E3131B] hover:underline shrink-0">الميزانية ←</a>
            </div>

            <div id="financialPerformanceChart" class="h-60 w-full"></div>

            <div class="pt-2 border-t border-[var(--border-subtle)] grid grid-cols-3 gap-2 text-center text-xs">
                <div class="p-2 rounded-lg bg-[var(--bg-surface-subtle)] border border-[var(--border-default)]">
                    <span class="text-[10px] text-[var(--text-muted)] block font-bold">إجمالي الإيرادات</span>
                    <span class="font-black text-[var(--text-primary)] text-xs tabular-nums">385,000 ج.م</span>
                </div>
                <div class="p-2 rounded-lg bg-[var(--bg-surface-subtle)] border border-[var(--border-default)]">
                    <span class="text-[10px] text-[var(--text-muted)] block font-bold">تكاليف التشغيل</span>
                    <span class="font-black text-[var(--text-muted)] text-xs tabular-nums">224,000 ج.م</span>
                </div>
                <div class="p-2 rounded-lg bg-[var(--success-bg)] border border-[var(--success-border)]">
                    <span class="text-[10px] text-[var(--success-text)] block font-bold">صافي الفائض</span>
                    <span class="font-black text-[var(--success-text)] text-xs tabular-nums">161,000 ج.م</span>
                </div>
            </div>
        </div>

        <!-- Chart 2: Weekly Attendance & Discipline (Bar/Column) -->
        <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 sm:p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2.5 border-b border-[var(--border-default)]">
                <div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-check" class="h-4 w-4 text-emerald-600"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">نسبة الحضور الميداني الأسبوعي (%)</h3>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">معدل الانضباط وحضور الحصص التدريبية لجميع الفئات السنية من السبت للخميس</p>
                </div>
                <a href="{{ route('attendance.index') }}" class="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:underline shrink-0">سجل الغياب ←</a>
            </div>

            <div id="weeklyAttendanceChart" class="h-60 w-full"></div>

            <div class="pt-2 border-t border-[var(--border-subtle)] flex items-center justify-between text-xs">
                <span class="text-[var(--text-muted)]">متوسط الحضور العام: <strong class="text-emerald-700 dark:text-emerald-400 tabular-nums">93.9%</strong></span>
                <span class="text-[var(--text-muted)]">أعلى يوم: <strong class="text-[var(--text-primary)]">الإثنين (<span class="tabular-nums">96.4%</span>)</strong></span>
            </div>
        </div>

        <!-- Chart 3: Player Distribution by Age Group (Donut) -->
        <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 sm:p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2.5 border-b border-[var(--border-default)]">
                <div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="pie-chart" class="h-4 w-4 text-[#E3131B]"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">توزيع اللاعبين حسب الفئة السنية (U9 - U19)</h3>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">توزيع 248 لاعباً مقيداً على المراحل العمرية وفرق الأكاديمية</p>
                </div>
                <a href="{{ route('players.age-groups') }}" class="text-xs font-bold text-[var(--text-primary)] hover:underline shrink-0">الفئات السنية ←</a>
            </div>

            <div id="ageDistributionChart" class="h-60 w-full"></div>
        </div>

        <!-- Chart 4: Team Physical & Tactical Readiness (Radar) -->
        <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 sm:p-5 shadow-2xs space-y-3">
            <div class="flex items-center justify-between pb-2.5 border-b border-[var(--border-default)]">
                <div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="activity" class="h-4 w-4 text-purple-600"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">مؤشر الجاهزية البدنية والتكتيكية للفريق</h3>
                    </div>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">تقييم شامل عبر 6 محاور فنية وبدنية معتمدة من الطاقم التدريبي</p>
                </div>
                <a href="{{ route('intelligence.index') }}" class="text-xs font-bold text-purple-600 dark:text-purple-400 hover:underline shrink-0">مركز الذكاء ←</a>
            </div>

            <div id="readinessRadarChart" class="h-60 w-full"></div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 6. LEAGUE STANDINGS & RECENT ACTIVITY TIMELINE (2 COLUMNS)                -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        
        <!-- League Standings Table (7 cols) -->
        <div class="lg:col-span-7 rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] shadow-2xs overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-3.5 sm:p-4 border-b border-[var(--border-default)] flex items-center justify-between bg-[var(--bg-surface-subtle)]">
                    <div class="flex items-center gap-2">
                        <i data-lucide="award" class="h-4 w-4 text-amber-500"></i>
                        <div>
                            <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">جدول ترتيب دوري سوبر القاهرة للناشئين (U-15)</h3>
                            <p class="text-[10px] text-[var(--text-muted)] mt-0.5">النسور SC ينفرد بصدارة الترتيب بفارق 4 نقاط عن الأهلي</p>
                        </div>
                    </div>
                    <x-badge variant="warning" size="xs">
                        الجولة <span class="tabular-nums">14 / 22</span>
                    </x-badge>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-start text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-[var(--border-default)] bg-[var(--bg-surface-subtle)] text-[var(--text-muted)] text-[11px] font-bold uppercase">
                                <th class="py-2 px-3 text-center">#</th>
                                <th class="py-2 px-3 text-start">النادي / الفريق</th>
                                <th class="py-2 px-2 text-center">لعب</th>
                                <th class="py-2 px-2 text-center">فاز</th>
                                <th class="py-2 px-2 text-center">تعادل</th>
                                <th class="py-2 px-2 text-center">خسر</th>
                                <th class="py-2 px-2 text-center">له/عليه</th>
                                <th class="py-2 px-2 text-center">الفارق</th>
                                <th class="py-2 px-3 text-center font-black">النقاط</th>
                                <th class="py-2 px-3 text-center">النتائج الأخيرة</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--border-default)] text-[var(--text-primary)]">
                            @foreach($leagueStandings as $row)
                                <tr class="{{ $row['is_eagles'] ? 'bg-red-500/10 font-bold border-s-4 border-s-[#E3131B]' : 'hover:bg-[var(--surface-subtle)]' }} transition-colors">
                                    <td class="py-2.5 px-3 text-center font-bold">
                                        @if($row['rank'] === 1)
                                            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-amber-400 text-black text-[10px] font-black shadow-xs tabular-nums">1</span>
                                        @else
                                            <span class="tabular-nums">{{ $row['rank'] }}</span>
                                        @endif
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex items-center gap-2">
                                            @if($row['is_eagles'])
                                                <img src="{{ asset('images/academy-logo.png') }}" class="w-4 h-4 object-contain">
                                                <span class="text-[#E3131B] font-black">{{ $row['team_name_ar'] }}</span>
                                                <span class="text-[9px] bg-[#E3131B] text-white px-1.5 py-0.2 rounded font-bold">فريقنا</span>
                                            @else
                                                <span class="font-bold">{{ $row['team_name_ar'] }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-2 text-center tabular-nums">{{ $row['played'] }}</td>
                                    <td class="py-2.5 px-2 text-center tabular-nums text-emerald-700 dark:text-emerald-400 font-bold">{{ $row['won'] }}</td>
                                    <td class="py-2.5 px-2 text-center tabular-nums text-amber-700 dark:text-amber-400">{{ $row['drawn'] }}</td>
                                    <td class="py-2.5 px-2 text-center tabular-nums text-red-600 dark:text-red-400">{{ $row['lost'] }}</td>
                                    <td class="py-2.5 px-2 text-center tabular-nums text-[var(--text-muted)] text-[11px]">{{ $row['goals_for'] }}-{{ $row['goals_against'] }}</td>
                                    <td class="py-2.5 px-2 text-center tabular-nums font-bold {{ str_starts_with($row['goal_diff'], '+') ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-600' }}">{{ $row['goal_diff'] }}</td>
                                    <td class="py-2.5 px-3 text-center tabular-nums font-black text-sm {{ $row['is_eagles'] ? 'text-[#E3131B]' : 'text-[var(--text-primary)]' }}">{{ $row['points'] }}</td>
                                    <td class="py-2.5 px-3 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            @foreach($row['form'] as $f)
                                                <span class="h-4 w-4 rounded text-[9px] font-bold flex items-center justify-center {{ $f === 'W' ? 'bg-emerald-600 text-white' : ($f === 'D' ? 'bg-amber-500 text-white' : 'bg-red-600 text-white') }}">
                                                    {{ $f }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-2.5 border-t border-[var(--border-default)] bg-[var(--bg-surface-subtle)] flex items-center justify-between text-xs">
                <span class="text-[11px] text-[var(--text-muted)]">المتصدر والوصيف يتأهلان لتصفيات بطولة الجمهورية 2026</span>
                <a href="{{ route('competitions.index') }}" class="font-bold text-[#E3131B] hover:underline text-[11px]">
                    كافة البطولات والمباريات ←
                </a>
            </div>
        </div>

        <!-- Activity Timeline Feed (5 cols) -->
        <div class="lg:col-span-5 rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-4 shadow-2xs space-y-3 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-2 border-b border-[var(--border-default)]">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="h-4 w-4 text-[#E3131B]"></i>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">سجل العمليات والأنشطة الميدانية</h3>
                    </div>
                    <x-badge variant="success" :dot="true" size="xs">بث حي</x-badge>
                </div>

                <div class="space-y-3 pt-1.5">
                    @foreach(array_slice($activityTimeline, 0, 5) as $activity)
                        <div class="flex items-start gap-2.5 group">
                            <div class="h-7 w-7 rounded-lg bg-[var(--bg-surface-subtle)] border border-[var(--border-default)] flex items-center justify-center text-[#E3131B] shrink-0 mt-0.5 shadow-2xs group-hover:bg-[#E3131B] group-hover:text-white transition-colors">
                                <i data-lucide="{{ $activity['icon'] ?? 'activity' }}" class="w-3.5 h-3.5"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-[var(--text-primary)] group-hover:text-[#E3131B] transition-colors truncate">{{ $activity['title_ar'] }}</h4>
                                    <span class="text-[10px] text-[var(--text-muted)] shrink-0">{{ $activity['time_ar'] }}</span>
                                </div>
                                <p class="text-[11px] text-[var(--text-muted)] mt-0.5 leading-relaxed">{{ $activity['description_ar'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-2 border-t border-[var(--border-default)] text-center">
                <a href="{{ route('reports.index') }}" class="text-xs font-bold text-[var(--text-primary)] hover:text-[#E3131B] transition-colors">
                    عرض كافة سجلات العمليات والتقارير ←
                </a>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 7. RECENT PLAYERS REGISTRATIONS DOSSIER TABLE (CLEAN WHITE ENTERPRISE)     -->
    <!-- ========================================================================= -->
    <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] shadow-2xs overflow-hidden">
        <div class="p-3.5 sm:p-4 border-b border-[var(--border-default)] flex items-center justify-between bg-[var(--bg-surface-subtle)]">
            <div>
                <div class="flex items-center gap-2">
                    <i data-lucide="user-check" class="h-4 w-4 text-[#E3131B]"></i>
                    <h2 class="text-xs sm:text-sm font-bold text-[var(--text-primary)]">أحدث اللاعبين المقيدين رسمياً بالمنظومة</h2>
                </div>
                <p class="text-[10px] text-[var(--text-muted)] mt-0.5">
                    سجل قيد معتمد ومفحوص طبياً ضمن قطاعات الأكاديمية لموسم 2026
                </p>
            </div>
            <a href="{{ route('players.index') }}" class="text-xs font-bold text-[var(--text-primary)] hover:text-[#E3131B] transition-colors flex items-center gap-1">
                <span>عرض كافة اللاعبين (<span class="tabular-nums">{{ count($players) }}</span>)</span>
                <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-start text-xs border-collapse">
                <thead class="border-b border-[var(--border-default)] bg-[var(--bg-surface-subtle)] text-[var(--text-muted)] text-[11px] font-bold uppercase">
                    <tr>
                        <th class="py-2.5 px-4 text-start">اللاعب الموهوب</th>
                        <th class="py-2.5 px-4 text-start">الفئة السنية</th>
                        <th class="py-2.5 px-4 text-start">المركز الميداني</th>
                        <th class="py-2.5 px-4 text-start">حالة الاشتراك</th>
                        <th class="py-2.5 px-4 text-start">التقييم الفني العام</th>
                        <th class="py-2.5 px-4 text-end">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-default)] text-[var(--text-primary)]">
                    @foreach(array_slice($players, 0, 5) as $p)
                        <tr class="hover:bg-[var(--surface-subtle)] transition-colors group">
                            <td class="py-3 px-4">
                                <a href="{{ route('players.show', $p['id']) }}" class="flex items-center gap-2.5 font-semibold hover:text-[#E3131B] transition-colors">
                                    <div class="h-8 w-8 rounded-lg bg-[var(--bg-surface-subtle)] border border-[var(--border-default)] flex items-center justify-center font-bold text-[#E3131B] text-xs shrink-0">
                                        {{ mb_substr($p['name_ar'], 0, 2) }}
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-black text-[var(--text-primary)] group-hover:text-[#E3131B] truncate">{{ $p['name_ar'] }}</span>
                                        <span class="text-[10px] text-[var(--text-muted)]">قميص #<span class="tabular-nums">{{ $p['jersey_number'] ?? '0' }}</span> • {{ $p['team_name_ar'] ?? '' }}</span>
                                    </div>
                                </a>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-[var(--bg-surface-subtle)] text-[var(--text-primary)] border border-[var(--border-default)]">
                                    {{ $p['age_group'] ?? 'U-13' }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-bold text-[var(--text-muted)]">
                                {{ $p['position_ar'] ?? $p['position'] ?? 'صانع ألعاب' }}
                            </td>
                            <td class="py-3 px-4">
                                @if(($p['subscription_status'] ?? 'paid') === 'paid')
                                    <x-badge variant="success" :dot="true" size="sm">مسدد بالكامل</x-badge>
                                @else
                                    <x-badge variant="warning" :dot="true" size="sm">قيد الانتظار</x-badge>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 bg-gray-100 dark:bg-gray-800 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-[#E3131B] h-1.5 rounded-full" style="width: {{ ($p['rating'] ?? 8.5) * 10 }}%"></div>
                                    </div>
                                    <span class="font-black text-xs text-[var(--text-primary)] tabular-nums">{{ $p['rating'] ?? 8.5 }} ★</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-end">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('players.show', $p['id']) }}" class="rounded-lg border border-[var(--border-default)] bg-[var(--bg-surface)] px-2.5 py-1 text-[11px] font-bold text-[var(--text-primary)] hover:bg-[var(--bg-surface-subtle)] transition-colors shadow-2xs">
                                        الملف 360
                                    </a>
                                    <a href="{{ route('players.passport', $p['id']) }}" class="rounded-lg bg-[var(--text-strong)] px-2.5 py-1 text-[11px] font-bold text-[var(--surface)] hover:bg-[#E3131B] hover:text-white transition-colors shadow-2xs">
                                        الجواز
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- QUICK ATTENDANCE MODAL DIALOG (ITEM 4: 1-CLICK BULK ATTENDANCE)            -->
    <!-- ========================================================================= -->
    <div 
        x-show="openQuickAttendance" 
        x-cloak 
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4"
        role="dialog" 
        aria-modal="true"
    >
        <!-- Backdrop -->
        <div 
            class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
            x-show="openQuickAttendance"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="openQuickAttendance = false"
        ></div>

        <!-- Modal Content Container -->
        <div 
            class="relative w-full max-w-xl rounded-2xl bg-[var(--surface)] border border-[var(--border)] p-5 shadow-2xl z-10 font-arabic text-start"
            x-show="openQuickAttendance"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border)]">
                <div class="flex items-center gap-2.5">
                    <div class="h-9 w-9 rounded-lg bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="check-check" class="h-5 w-5"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[var(--text-strong)]">تسجيل الحضور الميداني السريع — فئة U-15</h3>
                        <p class="text-xs text-[var(--text-muted)]">حصة السبت المسائية • الملعب الرئيسي A</p>
                    </div>
                </div>
                <button @click="openQuickAttendance = false" class="rounded-lg p-1.5 text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors">
                    <i data-lucide="x" class="h-4 w-4"></i>
                </button>
            </div>

            <!-- 1-Click Action & Stats Strip -->
            <div class="mt-4 p-3 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-between">
                <div class="flex items-center gap-3 text-xs">
                    <span class="inline-flex items-center gap-1 font-bold text-emerald-700 dark:text-emerald-400">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        <span x-text="quickPlayers.filter(p => p.status === 'present').length + ' حاضر'"></span>
                    </span>
                    <span class="inline-flex items-center gap-1 font-bold text-red-600 dark:text-red-400">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        <span x-text="quickPlayers.filter(p => p.status === 'absent').length + ' غياب'"></span>
                    </span>
                    <span class="inline-flex items-center gap-1 font-bold text-amber-600 dark:text-amber-400">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        <span x-text="quickPlayers.filter(p => p.status === 'excused').length + ' عذر'"></span>
                    </span>
                </div>

                <button 
                    type="button" 
                    @click="markAllPresent()" 
                    class="py-1 px-3 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-colors inline-flex items-center gap-1 shadow-2xs cursor-pointer"
                >
                    <i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i>
                    <span>تحضير الكل (حاضر)</span>
                </button>
            </div>

            <!-- Player List -->
            <div class="mt-3 max-h-64 overflow-y-auto divide-y divide-[var(--border-subtle)]">
                <template x-for="player in quickPlayers" :key="player.id">
                    <div class="py-2.5 flex items-center justify-between gap-2 px-1">
                        <div class="flex items-center gap-2.5">
                            <span class="w-6 h-6 rounded-full bg-[var(--surface-subtle)] border border-[var(--border)] text-xs font-bold text-[var(--text-strong)] flex items-center justify-center tabular-nums" x-text="player.jersey"></span>
                            <div>
                                <span class="text-xs font-bold text-[var(--text-strong)] block" x-text="player.name"></span>
                                <span class="text-[10px] text-[var(--text-muted)]" x-text="player.role"></span>
                            </div>
                        </div>

                        <!-- Status Toggle Switcher -->
                        <div class="inline-flex rounded-lg bg-[var(--surface-subtle)] p-0.5 border border-[var(--border)] text-xs">
                            <button 
                                type="button" 
                                @click="player.status = 'present'"
                                class="px-2 py-0.5 rounded text-[10px] font-bold transition-all cursor-pointer"
                                :class="player.status === 'present' ? 'bg-emerald-600 text-white shadow-2xs' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                            >
                                حاضر
                            </button>
                            <button 
                                type="button" 
                                @click="player.status = 'absent'"
                                class="px-2 py-0.5 rounded text-[10px] font-bold transition-all cursor-pointer"
                                :class="player.status === 'absent' ? 'bg-red-600 text-white shadow-2xs' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                            >
                                غائب
                            </button>
                            <button 
                                type="button" 
                                @click="player.status = 'excused'"
                                class="px-2 py-0.5 rounded text-[10px] font-bold transition-all cursor-pointer"
                                :class="player.status === 'excused' ? 'bg-amber-600 text-white shadow-2xs' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
                            >
                                بعذر
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Actions Footer -->
            <div class="mt-4 pt-3 border-t border-[var(--border)] flex items-center justify-between">
                <button 
                    type="button" 
                    @click="openQuickAttendance = false" 
                    class="py-1.5 px-3.5 rounded-lg border border-[var(--border)] bg-[var(--surface)] text-[var(--text-muted)] hover:text-[var(--text-strong)] text-xs font-bold transition-colors cursor-pointer"
                >
                    إلغاء
                </button>
                <button 
                    type="button" 
                    @click="saveQuickAttendance()" 
                    :disabled="quickAttendanceSaved"
                    class="py-1.5 px-4 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] text-white text-xs font-bold transition-colors inline-flex items-center gap-1.5 shadow-sm disabled:opacity-50 cursor-pointer"
                >
                    <i data-lucide="save" class="h-3.5 w-3.5"></i>
                    <span x-text="quickAttendanceSaved ? 'جاري الحفظ...' : 'اعتماد وحفظ الكشف'"></span>
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
window.renderEagleCharts = function() {
    if (typeof ApexCharts === 'undefined') {
        setTimeout(window.renderEagleCharts, 50);
        return;
    }

    // Destroy existing instances if any to prevent duplicate charts on SPA navigation
    if (window._eagleChartInstances && Array.isArray(window._eagleChartInstances)) {
        window._eagleChartInstances.forEach(c => {
            try { c.destroy(); } catch (e) {}
        });
    }
    window._eagleChartInstances = [];

    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#9CA3AF' : '#334155';
    const gridColor = isDarkMode ? '#252830' : '#E2E8F0';
    const fontFamily = 'IBM Plex Sans Arabic, sans-serif';

    // -------------------------------------------------------------
    // 1. Financial Performance Chart (Combo Area)
    // -------------------------------------------------------------
    const finEl = document.querySelector("#financialPerformanceChart");
    if (finEl) {
        try {
            finEl.innerHTML = '';
            const finChart = new ApexCharts(finEl, {
                series: [
                    {
                        name: 'الإيرادات المحصلة (ج.م)',
                        data: [280000, 310000, 295000, 340000, 360000, 385000]
                    },
                    {
                        name: 'تكاليف التشغيل (ج.م)',
                        data: [190000, 205000, 210000, 215000, 220000, 224000]
                    }
                ],
                chart: {
                    type: 'area',
                    height: 240,
                    toolbar: { show: false },
                    fontFamily: fontFamily
                },
                colors: ['#E3131B', isDarkMode ? '#9CA3AF' : '#111214'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                xaxis: {
                    categories: ['أكتوبر', 'نوفمبر', 'ديسمبر', 'يناير', 'فبراير', 'مارس'],
                    labels: { style: { colors: textColor, fontSize: '11px' } }
                },
                yaxis: {
                    labels: {
                        formatter: val => (val / 1000) + 'k ج.م',
                        style: { colors: textColor, fontSize: '11px' }
                    }
                },
                tooltip: {
                    y: {
                        formatter: val => Number(val).toLocaleString('ar-EG') + ' ج.م'
                    }
                },
                grid: { borderColor: gridColor, strokeDashArray: 4 },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontSize: '11px',
                    fontFamily: fontFamily,
                    labels: { colors: textColor }
                }
            });
            finChart.render();
            window._eagleChartInstances.push(finChart);
        } catch(e) { console.error('Error rendering finChart', e); }
    }

    // -------------------------------------------------------------
    // 2. Weekly Attendance Chart (Bar/Column)
    // -------------------------------------------------------------
    const attEl = document.querySelector("#weeklyAttendanceChart");
    if (attEl) {
        try {
            attEl.innerHTML = '';
            const attChart = new ApexCharts(attEl, {
                series: [{
                    name: 'نسبة الحضور الميداني',
                    data: [93.2, 94.8, 96.4, 91.5, 95.2, 93.9]
                }],
                chart: {
                    type: 'bar',
                    height: 240,
                    toolbar: { show: false },
                    fontFamily: fontFamily
                },
                colors: ['#15803D'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '45%',
                        dataLabels: { position: 'top' }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val + '%',
                    offsetY: -18,
                    style: { fontSize: '10px', colors: [textColor], fontFamily: fontFamily }
                },
                xaxis: {
                    categories: ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس'],
                    labels: { style: { colors: textColor, fontSize: '11px' } }
                },
                yaxis: {
                    max: 100,
                    min: 80,
                    labels: {
                        formatter: val => val + '%',
                        style: { colors: textColor, fontSize: '11px' }
                    }
                },
                grid: { borderColor: gridColor, strokeDashArray: 4 }
            });
            attChart.render();
            window._eagleChartInstances.push(attChart);
        } catch(e) { console.error('Error rendering attChart', e); }
    }

    // -------------------------------------------------------------
    // 3. Player Age Groups Distribution (Donut)
    // -------------------------------------------------------------
    const ageEl = document.querySelector("#ageDistributionChart");
    if (ageEl) {
        try {
            ageEl.innerHTML = '';
            const ageChart = new ApexCharts(ageEl, {
                series: [32, 45, 58, 48, 38, 27],
                labels: ['براعم U-9', 'ناشئين U-11', 'ناشئين U-13', 'شباب U-15', 'شباب U-17', 'شباب U-19'],
                chart: {
                    type: 'donut',
                    height: 240,
                    fontFamily: fontFamily
                },
                colors: ['#E3131B', '#15803D', '#F59E0B', '#3B82F6', '#8B5CF6', '#111214'],
                stroke: { colors: [isDarkMode ? '#14161A' : '#ffffff'], width: 2 },
                dataLabels: { enabled: false },
                legend: {
                    position: 'bottom',
                    fontSize: '11px',
                    fontFamily: fontFamily,
                    labels: { colors: textColor }
                },
                tooltip: {
                    y: {
                        formatter: val => val + ' لاعباً مقيداً'
                    }
                }
            });
            ageChart.render();
            window._eagleChartInstances.push(ageChart);
        } catch(e) { console.error('Error rendering ageChart', e); }
    }

    // -------------------------------------------------------------
    // 4. Team Readiness & Technical Index (Radar)
    // -------------------------------------------------------------
    const radarEl = document.querySelector("#readinessRadarChart");
    if (radarEl) {
        try {
            radarEl.innerHTML = '';
            const radarChart = new ApexCharts(radarEl, {
                series: [{
                    name: 'مستوى النسور SC',
                    data: [94, 91, 95, 88, 92, 96]
                }, {
                    name: 'متوسط أندية الدوري',
                    data: [82, 79, 84, 80, 81, 85]
                }],
                chart: {
                    type: 'radar',
                    height: 240,
                    toolbar: { show: false },
                    fontFamily: fontFamily
                },
                colors: ['#E3131B', isDarkMode ? '#6B7280' : '#D1D5DB'],
                stroke: { width: 2 },
                fill: { opacity: [0.3, 0.1] },
                markers: { size: 3 },
                xaxis: {
                    categories: ['السرعة والارتداد', 'القوة والالتحام', 'دقة التمرير', 'الانضباط التكتيكي', 'الضغط العالي', 'التهديف والفرص'],
                    labels: {
                        style: {
                            colors: [textColor, textColor, textColor, textColor, textColor, textColor],
                            fontSize: '10px',
                            fontFamily: fontFamily
                        }
                    }
                },
                yaxis: { show: false, max: 100 },
                legend: {
                    position: 'bottom',
                    fontSize: '11px',
                    fontFamily: fontFamily,
                    labels: { colors: textColor }
                }
            });
            radarChart.render();
            window._eagleChartInstances.push(radarChart);
        } catch(e) { console.error('Error rendering radarChart', e); }
    }
};

// Immediate or DOM ready execution
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', window.renderEagleCharts);
} else {
    window.renderEagleCharts();
}
window.addEventListener('page:loaded', window.renderEagleCharts);
window.addEventListener('theme-changed', () => setTimeout(window.renderEagleCharts, 50));
</script>
@endpush
