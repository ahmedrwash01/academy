    <!-- Brand Crest Header (Matches Topbar 56px) -->
    <div class="flex h-14 items-center justify-between px-4 border-b border-[var(--border)] bg-[var(--bg-sidebar-header)]">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[var(--surface-subtle)] p-1 border border-[var(--border)] group-hover:border-[#E3131B]/60 transition-colors shadow-2xs">
                <img src="{{ asset('images/academy-logo.png') }}" alt="EAGLE OS" class="h-7 w-7 object-contain">
            </div>
            <div class="flex flex-col min-w-0">
                <div class="flex items-center gap-1.5">
                    <span class="text-xs font-black text-[var(--text-sidebar)] tracking-wider">EAGLE OS</span>
                    <span class="h-1.5 w-1.5 rounded-full bg-[#E3131B]"></span>
                </div>
                <span class="text-[10px] text-[var(--text-sidebar-muted)] font-semibold tracking-wide truncate">
                    أكاديمية النسور لكرة القدم
                </span>
            </div>
        </a>

        <!-- Mobile Close Button -->
        <button @click="sidebarOpen = false" class="rounded p-1 text-[var(--text-sidebar-muted)] hover:text-[var(--text-sidebar)] lg:hidden">
            <i data-lucide="x" class="h-4 w-4"></i>
        </button>
    </div>

    @php
        $initialGroup = null;
        if (request()->routeIs('players.*', 'scouting.*')) {
            $initialGroup = 'players';
        } elseif (request()->routeIs('coaches.*', 'training.*', 'attendance.*', 'competitions.*')) {
            $initialGroup = 'training';
        } elseif (request()->routeIs('finance.*', 'subscriptions.*', 'payments.*')) {
            $initialGroup = 'finance';
        } elseif (request()->routeIs('academy.*', 'sponsors.*', 'media.*', 'sportswear.*', 'complaints.*')) {
            $initialGroup = 'governance';
        }
    @endphp

    <!-- Navigation Scroll Area (Exclusive Accordion: Only One Section Open at a Time) -->
    <div 
        x-data="{ 
            activeGroup: {{ $initialGroup ? "'$initialGroup'" : 'null' }},
            toggle(group) {
                this.activeGroup = (this.activeGroup === group) ? null : group;
            }
        }"
        class="flex-1 overflow-y-auto px-3 py-3 space-y-3 dark-scroll text-xs"
    >
        
        <!-- Group 0: Core Command Hub -->
        <div class="space-y-1">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center justify-between rounded-lg px-2.5 py-2 text-xs transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#E3131B] text-white font-black shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)] font-bold' }}">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="layout-dashboard" class="h-4 w-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-[#E3131B]' }}"></i>
                    <span>مركز القيادة والعمليات</span>
                </div>
                @if(request()->routeIs('dashboard'))
                    <span class="text-[10px] px-1.5 py-0.5 rounded font-bold bg-white/20 text-white border border-white/30">HQ</span>
                @else
                    <x-badge variant="neutral" size="xs">HQ</x-badge>
                @endif
            </a>

            <!-- Tactical Lab -->
            <a href="{{ route('tactics.index') }}" 
               class="flex items-center justify-between rounded-lg px-2.5 py-2 text-xs transition-colors {{ request()->routeIs('tactics.*') ? 'bg-[#E3131B] text-white font-black shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)] font-bold' }}">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="layers" class="h-4 w-4 {{ request()->routeIs('tactics.*') ? 'text-white' : 'text-[var(--color-blue)]' }}"></i>
                    <span>المختبر التكتيكي الميداني</span>
                </div>
                @if(request()->routeIs('tactics.*'))
                    <span class="text-[10px] px-1.5 py-0.5 rounded font-bold bg-white/20 text-white border border-white/30">تكتيك</span>
                @else
                    <x-badge variant="danger" size="xs">تكتيك</x-badge>
                @endif
            </a>

            <!-- Academy Intelligence -->
            <a href="{{ route('intelligence.index') }}" 
               class="flex items-center justify-between rounded-lg px-2.5 py-2 text-xs transition-colors {{ request()->routeIs('intelligence.*') ? 'bg-[#E3131B] text-white font-black shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)] font-bold' }}">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="sparkles" class="h-4 w-4 {{ request()->routeIs('intelligence.*') ? 'text-white' : 'text-[var(--color-purple)]' }}"></i>
                    <span>ذكاء العمليات والقرارات</span>
                </div>
                @if(request()->routeIs('intelligence.*'))
                    <span class="text-[10px] px-1.5 py-0.5 rounded font-bold bg-white/20 text-white border border-white/30">AI OPS</span>
                @else
                    <x-badge variant="info" size="xs">AI OPS</x-badge>
                @endif
            </a>
        </div>

        <!-- Group 1: قطاع كرة القدم والمواهب -->
        <div>
            <button 
                type="button"
                @click="toggle('players')" 
                class="w-full flex items-center justify-between px-2.5 py-1.5 rounded-md text-[11px] font-black text-[var(--text-sidebar)] hover:bg-[var(--bg-sidebar-hover)] uppercase tracking-wider transition-colors group cursor-pointer"
            >
                <span>قطاع كرة القدم والمواهب</span>
                <span class="transition-transform duration-200 shrink-0 transform" :class="activeGroup === 'players' ? 'rotate-180' : 'rotate-0'">
                    <svg class="h-3.5 w-3.5 text-[var(--text-sidebar-muted)] group-hover:text-[var(--text-sidebar)] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <div x-show="activeGroup === 'players'" x-cloak class="space-y-0.5 mt-0.5 ps-1">
                <a href="{{ route('players.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('players.index', 'players.show', 'players.create', 'players.edit') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="users" class="h-3.5 w-3.5 {{ request()->routeIs('players.index', 'players.show', 'players.create', 'players.edit') ? 'text-white' : 'text-[#E3131B]' }}"></i>
                        <span>اللاعبين والملفات الطبية</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('players.index', 'players.show', 'players.create', 'players.edit') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }} tabular-nums">248</span>
                </a>

                <a href="{{ route('players.goalkeepers') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('players.goalkeepers') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield" class="h-3.5 w-3.5 {{ request()->routeIs('players.goalkeepers') ? 'text-white' : 'text-amber-500' }}"></i>
                        <span>أكاديمية حراس المرمى</span>
                    </div>
                    <span class="text-[9px] font-bold px-1 rounded {{ request()->routeIs('players.goalkeepers') ? 'bg-white/20 text-white' : 'text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/40' }}">تخصصي</span>
                </a>

                <a href="{{ route('scouting.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('scouting.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="crosshair" class="h-3.5 w-3.5 {{ request()->routeIs('scouting.*') ? 'text-white' : 'text-emerald-600' }}"></i>
                        <span>الرادار واكتشاف المواهب</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('scouting.*') ? 'text-white' : 'text-emerald-700 dark:text-emerald-400' }}">Scouting</span>
                </a>

                <a href="{{ route('players.teams') }}" class="flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('players.teams', 'players.age-groups') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <i data-lucide="layers" class="h-3.5 w-3.5 {{ request()->routeIs('players.teams', 'players.age-groups') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }}"></i>
                    <span>الفريق الأول والفئات العمرية</span>
                </a>

                <a href="{{ route('players.transfers') }}" class="flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('players.transfers') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <i data-lucide="arrow-left-right" class="h-3.5 w-3.5 {{ request()->routeIs('players.transfers') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }}"></i>
                    <span>انتقالات اللاعبين وتجارب الأندية</span>
                </a>
            </div>
        </div>

        <!-- Group 2: التدريب والملاعب والبطولات -->
        <div>
            <button 
                type="button"
                @click="toggle('training')" 
                class="w-full flex items-center justify-between px-2.5 py-1.5 rounded-md text-[11px] font-black text-[var(--text-sidebar)] hover:bg-[var(--bg-sidebar-hover)] uppercase tracking-wider transition-colors group cursor-pointer"
            >
                <span>التدريب والملاعب والبطولات</span>
                <span class="transition-transform duration-200 shrink-0 transform" :class="activeGroup === 'training' ? 'rotate-180' : 'rotate-0'">
                    <svg class="h-3.5 w-3.5 text-[var(--text-sidebar-muted)] group-hover:text-[var(--text-sidebar)] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <div x-show="activeGroup === 'training'" x-cloak class="space-y-0.5 mt-0.5 ps-1">
                <a href="{{ route('coaches.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('coaches.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="briefcase" class="h-3.5 w-3.5 {{ request()->routeIs('coaches.*') ? 'text-white' : 'text-sky-500' }}"></i>
                        <span>الجهاز الفني وورش العمل</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('coaches.*') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }} tabular-nums">16 مدرباً</span>
                </a>

                <a href="{{ route('training.index') }}" class="flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('training.index') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <i data-lucide="calendar" class="h-3.5 w-3.5 {{ request()->routeIs('training.index') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }}"></i>
                    <span>الملاعب والتدريبات الفردية Private</span>
                </a>

                <a href="{{ route('attendance.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('attendance.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clipboard-check" class="h-3.5 w-3.5 {{ request()->routeIs('attendance.*') ? 'text-white' : 'text-emerald-500' }}"></i>
                        <span>الحضور والغياب الميداني</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('attendance.*') ? 'text-white' : 'text-emerald-700 dark:text-emerald-400' }} tabular-nums">93.9%</span>
                </a>

                <a href="{{ route('competitions.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('competitions.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="trophy" class="h-3.5 w-3.5 {{ request()->routeIs('competitions.*') ? 'text-white' : 'text-amber-500' }}"></i>
                        <span>البطولات والدوريات والألقاب</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('competitions.*') ? 'text-white' : 'text-amber-700 dark:text-amber-400' }} tabular-nums">4 كؤوس</span>
                </a>
            </div>
        </div>

        <!-- Group 3: الرقابة والعمليات المالية -->
        <div>
            <button 
                type="button"
                @click="toggle('finance')" 
                class="w-full flex items-center justify-between px-2.5 py-1.5 rounded-md text-[11px] font-black text-[var(--text-sidebar)] hover:bg-[var(--bg-sidebar-hover)] uppercase tracking-wider transition-colors group cursor-pointer"
            >
                <span>الرقابة والعمليات المالية</span>
                <span class="transition-transform duration-200 shrink-0 transform" :class="activeGroup === 'finance' ? 'rotate-180' : 'rotate-0'">
                    <svg class="h-3.5 w-3.5 text-[var(--text-sidebar-muted)] group-hover:text-[var(--text-sidebar)] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <div x-show="activeGroup === 'finance'" x-cloak class="space-y-0.5 mt-0.5 ps-1">
                <a href="{{ route('finance.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('finance.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="h-3.5 w-3.5 {{ request()->routeIs('finance.*') ? 'text-white' : 'text-emerald-500' }}"></i>
                        <span>الميزانية (الإيرادات والمصروفات)</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('finance.*') ? 'text-white' : 'text-emerald-700 dark:text-emerald-400' }}">شهري/سنوي</span>
                </a>

                <a href="{{ route('subscriptions.index') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('subscriptions.*', 'payments.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="credit-card" class="h-3.5 w-3.5 {{ request()->routeIs('subscriptions.*', 'payments.*') ? 'text-white' : 'text-[#E3131B]' }}"></i>
                        <span>الاشتراكات والباقات والتحصيل</span>
                    </div>
                    <span class="text-[9px] font-bold {{ request()->routeIs('subscriptions.*', 'payments.*') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }} tabular-nums">228</span>
                </a>
            </div>
        </div>

        <!-- Group 4: ميثاق النادي، الرعاة، والمركز الإعلامي -->
        <div>
            <button 
                type="button"
                @click="toggle('governance')" 
                class="w-full flex items-center justify-between px-2.5 py-1.5 rounded-md text-[11px] font-black text-[var(--text-sidebar)] hover:bg-[var(--bg-sidebar-hover)] uppercase tracking-wider transition-colors group cursor-pointer"
            >
                <span>الميثاق المؤسسي والمركز الإعلامي</span>
                <span class="transition-transform duration-200 shrink-0 transform" :class="activeGroup === 'governance' ? 'rotate-180' : 'rotate-0'">
                    <svg class="h-3.5 w-3.5 text-[var(--text-sidebar-muted)] group-hover:text-[var(--text-sidebar)] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <div x-show="activeGroup === 'governance'" x-cloak class="space-y-0.5 mt-0.5 ps-1">
                <a href="{{ route('academy.cms') }}" class="flex items-center justify-between rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('academy.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <div class="flex items-center gap-2">
                        <i data-lucide="award" class="h-3.5 w-3.5 {{ request()->routeIs('academy.*') ? 'text-white' : 'text-[#E3131B]' }}"></i>
                        <span>مشروع 500 موهبة واللوائح</span>
                    </div>
                    <span class="text-[9px] font-bold px-1 rounded {{ request()->routeIs('academy.*') ? 'bg-white/20 text-white' : 'text-[#E3131B] bg-red-50 dark:bg-red-950/40' }}">قومي</span>
                </a>

                <a href="{{ route('sponsors.index') }}" class="flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('sponsors.*', 'sportswear.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <i data-lucide="handshake" class="h-3.5 w-3.5 {{ request()->routeIs('sponsors.*', 'sportswear.*') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }}"></i>
                    <span>الرعاة، الشركاء، والملابس</span>
                </a>

                <a href="{{ route('media.index') }}" class="flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs font-semibold {{ request()->routeIs('media.*', 'complaints.*') ? 'text-white bg-[#E3131B] shadow-xs' : 'text-[var(--text-sidebar-muted)] hover:bg-[var(--bg-sidebar-hover)] hover:text-[var(--text-sidebar)]' }}">
                    <i data-lucide="image" class="h-3.5 w-3.5 {{ request()->routeIs('media.*', 'complaints.*') ? 'text-white' : 'text-[var(--text-sidebar-muted)]' }}"></i>
                    <span>المركز الإعلامي والمنصات والشكاوى</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Profile & Login/Logout Footprint -->
    <div class="border-t border-[var(--border)] px-3.5 py-2.5 bg-[var(--bg-sidebar-header)]">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5 min-w-0">
                <div class="h-8 w-8 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-xs shadow-xs shrink-0">
                    EA
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-xs font-black text-[var(--text-sidebar)] truncate">كابتن إبراهيم فؤاد</span>
                    <span class="text-[10px] text-[var(--text-sidebar-muted)] font-semibold truncate">المدير الفني للأكاديمية</span>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <a href="{{ route('users.index') }}" title="إدارة المستخدمين والصلاحيات" class="rounded p-1 text-[var(--text-sidebar-muted)] hover:text-[var(--text-sidebar)] transition-colors">
                    <i data-lucide="settings" class="h-3.5 w-3.5"></i>
                </a>
                <a href="{{ route('auth.login') }}" title="تسجيل الدخول / الخروج" class="rounded p-1 text-[var(--text-sidebar-muted)] hover:text-[#E3131B] transition-colors">
                    <i data-lucide="log-out" class="h-3.5 w-3.5"></i>
                </a>
            </div>
        </div>
    </div>