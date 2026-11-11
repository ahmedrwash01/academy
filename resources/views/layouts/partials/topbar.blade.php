<header class="sticky top-0 z-40 flex h-14 w-full items-center justify-between border-b border-[var(--border)] bg-[var(--surface)] px-4 sm:px-6 shadow-2xs font-arabic">
    <!-- Start: Mobile Toggle & Page Title (Clean & Minimal) -->
    <div class="flex items-center gap-3">
        <!-- Mobile Sidebar Toggle -->
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            type="button" 
            class="rounded-lg p-1.5 text-[var(--text-muted)] hover:bg-[var(--surface-subtle)] hover:text-[var(--text)] lg:hidden transition-colors"
            aria-label="Toggle Navigation"
        >
            <i data-lucide="menu" class="h-5 w-5"></i>
        </button>

        <!-- Clean Page Title & Status -->
        <div class="flex items-center gap-2.5">
            <h1 class="text-sm sm:text-base font-black text-[var(--text-strong)] tracking-tight">
                {{ $title ?? 'مركز القيادة والعمليات' }}
            </h1>
            <!-- Unified System Status Badge (Point 3) -->
            <x-badge variant="success" :dot="true" size="md" class="hidden md:inline-flex">
                النظام متصل
            </x-badge>
        </div>
    </div>

    <!-- End: Global Search Trigger, Season, Notifications, Dark Mode Toggle, Language, Profile -->
    <div class="flex items-center gap-2 sm:gap-3">
        <!-- Command Palette Trigger Button (Ctrl+K) -->
        <button 
            @click="$dispatch('open-command-palette')"
            type="button"
            class="hidden sm:flex items-center gap-2.5 w-52 md:w-60 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] px-3 py-1.5 text-xs text-[var(--text-muted)] hover:border-[var(--text-strong)] hover:bg-[var(--surface)] transition-all shadow-2xs"
        >
            <i data-lucide="search" class="h-3.5 w-3.5 text-[var(--text-muted)]"></i>
            <span class="flex-1 text-start">بحث أو أمر سريع...</span>
            <kbd class="text-xs font-bold text-[var(--text-muted)] bg-[var(--surface)] border border-[var(--border)] px-1.5 py-0.5 rounded shadow-2xs">⌘K</kbd>
        </button>

        <!-- Current Season Badge -->
        <div class="hidden xl:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border border-[var(--border)] bg-[var(--surface-subtle)] text-xs font-semibold text-[var(--text)]">
            <span class="h-1.5 w-1.5 rounded-full bg-[#E3131B]"></span>
            <span>موسم <span class="tabular-nums">2025/2026</span></span>
        </div>

        <!-- Dark/Light Mode Switcher -->
        <button 
            type="button"
            @click="
                darkMode = !darkMode;
                if (darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
                window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: darkMode } }));
            "
            class="rounded-lg border border-[var(--border)] bg-[var(--surface)] p-1.5 text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs"
            :title="darkMode ? 'التبديل إلى الوضع الفاتح' : 'التبديل إلى الوضع الليلي'"
        >
            <i x-show="!darkMode" data-lucide="moon" class="h-4 w-4"></i>
            <i x-show="darkMode" x-cloak data-lucide="sun" class="h-4 w-4 text-amber-400"></i>
        </button>

        <!-- Language Switcher Pill -->
        @php
            $currentLocale = app()->getLocale();
            $targetLocale = $currentLocale === 'ar' ? 'en' : 'ar';
            $targetLabel = $currentLocale === 'ar' ? 'EN' : 'عربي';
        @endphp
        <a 
            href="{{ route('lang.switch', $targetLocale) }}" 
            class="inline-flex items-center rounded-lg border border-[var(--border)] bg-[var(--surface)] px-2.5 py-1 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs"
            title="Switch Language"
        >
            {{ $targetLabel }}
        </a>

        <!-- Notifications Dropdown with Real Tabs -->
        <div class="relative" x-data="{ open: false, tab: 'all' }" @click.outside="open = false">
            <button 
                @click.stop="open = !open" 
                class="relative rounded-lg border border-[var(--border)] bg-[var(--surface)] p-1.5 text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs"
                aria-label="Notifications"
            >
                <i data-lucide="bell" class="h-4 w-4"></i>
                <span class="absolute top-1 end-1 h-2 w-2 rounded-full bg-[#E3131B]"></span>
            </button>

            <!-- Notification Flyout -->
            <div 
                x-show="open" 
                x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute end-0 mt-2 w-80 sm:w-96 rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xl z-50 text-xs text-start"
            >
                <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-[var(--text-strong)]">مركز الإشعارات والعمليات</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-bold bg-[#E3131B] text-white tabular-nums">4</span>
                    </div>
                    <button type="button" class="text-xs font-bold text-[#E3131B] hover:underline">
                        تحديد الكل كمقروء
                    </button>
                </div>

                <!-- Notification Tabs -->
                <div class="flex items-center gap-2 pt-2.5 pb-2">
                    <button 
                        type="button" 
                        @click="tab = 'all'"
                        :class="tab === 'all' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)]'"
                        class="px-2.5 py-1 rounded-lg text-xs font-bold transition-all"
                    >
                        كافة الإشعارات (<span class="tabular-nums">4</span>)
                    </button>
                    <button 
                        type="button" 
                        @click="tab = 'unread'"
                        :class="tab === 'unread' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)]'"
                        class="px-2.5 py-1 rounded-lg text-xs font-bold transition-all"
                    >
                        غير مقروء (<span class="tabular-nums">2</span>)
                    </button>
                </div>

                <!-- Notifications List -->
                <div class="py-1 divide-y divide-[var(--border-subtle)] max-h-72 overflow-y-auto">
                    <!-- Item 1: Urgent Medical -->
                    <div class="py-2.5 flex items-start gap-2.5 hover:bg-[var(--surface-subtle)] rounded-lg p-1.5 transition-colors">
                        <span class="h-2 w-2 rounded-full bg-[#E3131B] mt-1 shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-[var(--text-strong)] text-xs">إصابة ميدانية: زياد طارق</p>
                                <span class="text-xs text-[var(--text-muted)]">منذ <span class="tabular-nums">15</span> دقيقة</span>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">التواء كاحل لفريق U-17 بالمران، مطلوب اعتماد خطة التأهيل</p>
                        </div>
                    </div>

                    <!-- Item 2: Expired Subscriptions -->
                    <div class="py-2.5 flex items-start gap-2.5 hover:bg-[var(--surface-subtle)] rounded-lg p-1.5 transition-colors">
                        <span class="h-2 w-2 rounded-full bg-amber-500 mt-1 shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-[var(--text-strong)] text-xs">اشتراكات متأخرة تجاوزت مهلة السماح</p>
                                <span class="text-xs text-[var(--text-muted)]">منذ <span class="tabular-nums">40</span> دقيقة</span>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">4 أولياء أمور تجاوزت مستحقاتهم 30 يوماً (<span class="tabular-nums">6,200</span> ج.م)</p>
                        </div>
                    </div>

                    <!-- Item 3: Attendance -->
                    <div x-show="tab === 'all'" class="py-2.5 flex items-start gap-2.5 hover:bg-[var(--surface-subtle)] rounded-lg p-1.5 transition-colors">
                        <span class="h-2 w-2 rounded-full bg-emerald-500 mt-1 shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-[var(--text-strong)] text-xs">نسبة الحضور الميداني اليوم</p>
                                <span class="text-xs text-[var(--text-muted)]">منذ ساعتين</span>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">حضور <span class="tabular-nums">93.9%</span> (<span class="tabular-nums">184</span> متدرباً من أصل <span class="tabular-nums">196</span> مقيداً بالميدان)</p>
                        </div>
                    </div>

                    <!-- Item 4: Scout Trial -->
                    <div x-show="tab === 'all'" class="py-2.5 flex items-start gap-2.5 hover:bg-[var(--surface-subtle)] rounded-lg p-1.5 transition-colors">
                        <span class="h-2 w-2 rounded-full bg-sky-500 mt-1 shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-[var(--text-strong)] text-xs">طلب معايشة رسمي من نادي ZED FC</p>
                                <span class="text-xs text-[var(--text-muted)]">أمس <span class="tabular-nums">16:30</span></span>
                            </div>
                            <p class="text-xs text-[var(--text-muted)] mt-0.5">طلب معايشة للموهوب محمد أحمد إبراهيم صانع الألعاب</p>
                        </div>
                    </div>
                </div>

                <div class="pt-2.5 border-t border-[var(--border)] flex items-center justify-between">
                    <a href="{{ route('subscriptions.index') }}" class="text-xs font-bold text-[#E3131B] hover:underline">
                        إدارة الاشتراكات والمستحقات ←
                    </a>
                    <a href="{{ route('intelligence.index') }}" class="text-xs font-bold text-[var(--text-muted)] hover:text-[var(--text-strong)]">
                        مركز الذكاء
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Profile Pill -->
        <div class="hidden sm:flex items-center gap-2.5 ps-2 border-s border-[var(--border)]">
            <div class="h-8 w-8 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-xs shadow-xs shrink-0">
                EA
            </div>
            <div class="flex flex-col text-start">
                <span class="text-xs font-bold text-[var(--text-strong)] truncate max-w-[120px]">كابتن إبراهيم فؤاد</span>
                <span class="text-xs text-[var(--text-muted)] leading-none">مدير الأكاديمية</span>
            </div>
        </div>
    </div>
</header>
