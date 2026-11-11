@extends('layouts.admin', ['title' => 'ميثاق الأكاديمية ومشروع 500 موهبة — EAGLE CHARTER'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    activeTab: 'talents500', // 'talents500', 'about', 'regulations', 'contact',
    saved: false,
    
    saveCharter() {
        this.saved = true;
        setTimeout(() => this.saved = false, 3000);
        window.$toast?.success('تم اعتماد وحفظ البيانات الرسمية بنجاح', 'ميثاق الأكاديمية');
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="award" class="w-3.5 h-3.5"></i>
                    <span>EAGLE'S SC CHARTER & GOVERNANCE</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">ميثاق وهوية الأكاديمية والمشروع الوطني</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">مشروع الـ 500 موهبة، الرؤية والرسالة، واللوائح التنظيمية</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">منصة حوكمة المحتوى الرسمي، شروط وقواعد القبول، ودليل المنصات الرقمية للأكاديمية</p>
        </div>

        <div class="flex items-center gap-2">
            <button @click="saveCharter()" class="inline-flex items-center gap-2 rounded-lg bg-[#E3131B] hover:bg-[#c00f16] px-4 py-2 text-xs font-bold text-white shadow-xs transition-colors">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>حفظ واعتماد التعديلات</span>
            </button>
        </div>
    </div>

    <!-- Navigation Sub-tabs -->
    <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-x-auto w-full sm:w-auto">
        <button 
            type="button" 
            @click="activeTab = 'talents500'" 
            :class="activeTab === 'talents500' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="sparkles" class="w-4 h-4 text-[#E3131B]"></i>
            <span>مشروع الـ 500 موهبة</span>
        </button>
        <button 
            type="button" 
            @click="activeTab = 'about'" 
            :class="activeTab === 'about' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="compass" class="w-4 h-4"></i>
            <span>من نحن والرؤية والرسالة</span>
        </button>
        <button 
            type="button" 
            @click="activeTab = 'regulations'" 
            :class="activeTab === 'regulations' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="shield-alert" class="w-4 h-4"></i>
            <span>اللوائح والأنظمة والشروط</span>
        </button>
        <button 
            type="button" 
            @click="activeTab = 'contact'" 
            :class="activeTab === 'contact' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="phone-call" class="w-4 h-4"></i>
            <span>الفروع والمنصات والأرقام</span>
        </button>
    </div>

    <!-- TAB 1: PROJECT 500 TALENTS INITIATIVE -->
    <div x-show="activeTab === 'talents500'" class="space-y-6">
        <!-- Hero Showcase Card -->
        <div class="bg-gradient-to-br from-[#111214] to-[#1C1F26] rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden shadow-md">
            <div class="relative z-10 max-w-3xl space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#E3131B] text-white">
                    <i data-lucide="flame" class="w-3.5 h-3.5"></i>
                    <span>المبادرة الوطنية الكبرى لاكتشاف نجوم مصر</span>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight">مشروع الـ 500 موهبة كروية — برعاية أكاديمية النسور</h2>
                <p class="text-xs sm:text-sm text-gray-300 leading-relaxed">
                    مشروع استراتيجي قومي يهدف إلى مسح واكتشاف 500 موهبة كروية استثنائية من جميع محافظات جمهورية مصر العربية في الفئات السنية من مواليد 2008 حتى 2016، وصقلهم بدنياً وتكتيكياً بأحدث الأجهزة والبرامج المعتمدة تمهيداً لتسويقهم لأندية الدوري الممتاز والمنتخبات الوطنية.
                </p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-4">
                    <div class="bg-[var(--surface)]/10 backdrop-blur-xs p-3 rounded-xl border border-white/10">
                        <span class="text-[10px] text-gray-300 block uppercase font-mono">الهدف الإجمالي</span>
                        <span class="text-2xl font-black font-mono text-white">500</span>
                        <span class="text-[10px] text-[var(--text-muted)] block">ناشئ موهوب</span>
                    </div>
                    <div class="bg-[var(--surface)]/10 backdrop-blur-xs p-3 rounded-xl border border-white/10">
                        <span class="text-[10px] text-gray-300 block uppercase font-mono">تم انتقاؤهم حتى الآن</span>
                        <span class="text-2xl font-black font-mono text-[#E3131B]">142</span>
                        <span class="text-[10px] text-emerald-400 block">28.4% من الهدف</span>
                    </div>
                    <div class="bg-[var(--surface)]/10 backdrop-blur-xs p-3 rounded-xl border border-white/10">
                        <span class="text-[10px] text-gray-300 block uppercase font-mono">محافظات مستهدفة</span>
                        <span class="text-2xl font-black font-mono text-white">12</span>
                        <span class="text-[10px] text-[var(--text-muted)] block">محافظة مصرية</span>
                    </div>
                    <div class="bg-[var(--surface)]/10 backdrop-blur-xs p-3 rounded-xl border border-white/10">
                        <span class="text-[10px] text-gray-300 block uppercase font-mono">عقود معايشة للأندية</span>
                        <span class="text-2xl font-black font-mono text-emerald-400">18</span>
                        <span class="text-[10px] text-gray-300 block">لاعب تم تسويقهم</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Strategic Goals Form -->
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-6 shadow-2xs space-y-4">
            <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-[var(--border)] pb-3 flex items-center gap-2">
                <i data-lucide="target" class="w-4 h-4 text-[#E3131B]"></i>
                <span>محاور وأهداف مشروع الـ 500 موهبة المعتمدة</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                <div class="p-3.5 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1.5">
                    <label class="font-black text-[var(--text-strong)] block">1. المسح الميداني والاختبارات الدورية:</label>
                    <textarea rows="3" class="w-full bg-[var(--surface)] p-2.5 rounded-lg border border-[var(--border)] text-xs text-[var(--text)] leading-relaxed focus:outline-none focus:border-[#E3131B]">تنظيم جولات كشفية أسبوعية عبر شبكة كشافي الأكاديمية بالملاعب الشعبية والمدارس والأندية ومراكز الشباب بمختلف المحافظات لاكتشاف الخامات الطبيعية.</textarea>
                </div>
                <div class="p-3.5 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1.5">
                    <label class="font-black text-[var(--text-strong)] block">2. المنح التدريبية الكاملة والتأهيل الرياضي:</label>
                    <textarea rows="3" class="w-full bg-[var(--surface)] p-2.5 rounded-lg border border-[var(--border)] text-xs text-[var(--text)] leading-relaxed focus:outline-none focus:border-[#E3131B]">منح الناشئين المقبولين رعاية رياضية كاملة تشمل البرامج التدريبية المتقدمة، الفحوصات الطبية، القياسات الفسيولوجية، والتغذية الرياضية مجاناً.</textarea>
                </div>
                <div class="p-3.5 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1.5">
                    <label class="font-black text-[var(--text-strong)] block">3. التوثيق بالفيديو والتحليل الرقمي GPS:</label>
                    <textarea rows="3" class="w-full bg-[var(--surface)] p-2.5 rounded-lg border border-[var(--border)] text-xs text-[var(--text)] leading-relaxed focus:outline-none focus:border-[#E3131B]">تسجيل كافة مباريات واختبارات المواهب بتقنيات التحليل الفني والكاميرات التكتيكية لبناء سيرة ذاتية رقمية لكل لاعب تخدم تسويقه محلياً ودولياً.</textarea>
                </div>
                <div class="p-3.5 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1.5">
                    <label class="font-black text-[var(--text-strong)] block">4. الربط المباشر مع أندية الدوري الممتاز:</label>
                    <textarea rows="3" class="w-full bg-[var(--surface)] p-2.5 rounded-lg border border-[var(--border)] text-xs text-[var(--text)] leading-relaxed focus:outline-none focus:border-[#E3131B]">توقيع بروتوكولات تعاون مع أندية (الأهلي، الزمالك، إنبي، زد، سيراميكا كليوباترا، المقاولون) لإلحاق المتميزين بقطاعات الناشئين الرسمية.</textarea>
                </div>
            </div>
        </div>

        <!-- Scouting Candidates Roster within Project 500 Talents -->
        @if(isset($candidates) && count($candidates) > 0)
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
                <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
                    <div class="flex items-center gap-2">
                        <i data-lucide="crosshair" class="w-4 h-4 text-[#E3131B]"></i>
                        <div>
                            <h3 class="text-xs sm:text-sm font-bold text-[var(--text-strong)]">كشف المواهب المرصودة ضمن مشروع الـ 500 موهبة بالمحافظات</h3>
                            <p class="text-[10px] text-[var(--text-muted)] mt-0.5">قائمة الموهوبين المرشحين لمرحلة الاختبارات والمعايشة الرسمية</p>
                        </div>
                    </div>
                    <a href="{{ route('scouting.index') }}" class="text-xs font-bold text-[#E3131B] hover:underline flex items-center gap-1">
                        <span>فتح رادار المواهب بالكامل</span>
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-start text-xs border-collapse">
                        <thead class="border-b border-[var(--border)] bg-[var(--surface-subtle)] text-[var(--text-muted)] text-[11px] font-bold uppercase">
                            <tr>
                                <th class="py-2.5 px-4 text-start">اللاعب الموهوب</th>
                                <th class="py-2.5 px-3 text-center">الميلاد / السن</th>
                                <th class="py-2.5 px-4 text-start">المركز الميداني</th>
                                <th class="py-2.5 px-4 text-start">النادي الحالي / المحافظة</th>
                                <th class="py-2.5 px-4 text-start">الكشاف المشرف</th>
                                <th class="py-2.5 px-3 text-center">المرحلة الكشفية</th>
                                <th class="py-2.5 px-4 text-end">الإجراء</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text)]">
                            @foreach($candidates as $c)
                                <tr class="hover:bg-[var(--surface-subtle)] transition-colors">
                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <div class="h-8 w-8 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-xs shrink-0">
                                                {{ mb_substr($c['name_ar'], 0, 2) }}
                                            </div>
                                            <div>
                                                <span class="font-black text-[var(--text-strong)] block">{{ $c['name_ar'] }}</span>
                                                <span class="text-[10px] text-[var(--text-muted)]">كود: #{{ $c['id'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 text-center font-bold text-[var(--text-strong)] tabular-nums">
                                        {{ $c['birth_year'] }} ({{ $c['age'] }} سنة)
                                    </td>
                                    <td class="py-3 px-4 font-semibold text-[var(--text-secondary)]">
                                        {{ $c['position_ar'] }}
                                    </td>
                                    <td class="py-3 px-4 text-[var(--text-muted)]">
                                        {{ $c['current_club'] ?? 'مركز شباب' }}
                                    </td>
                                    <td class="py-3 px-4 font-medium text-[var(--text-secondary)]">
                                        {{ $c['scout_name_ar'] ?? 'كشاف الأكاديمية' }}
                                    </td>
                                    <td class="py-3 px-3 text-center">
                                        @if(($c['stage'] ?? 'new') === 'accepted')
                                            <x-badge variant="success" size="xs">تم القبول</x-badge>
                                        @elseif(($c['stage'] ?? 'new') === 'trial_scheduled')
                                            <x-badge variant="info" size="xs">معايشة مجدولة</x-badge>
                                        @elseif(($c['stage'] ?? 'new') === 'under_review')
                                            <x-badge variant="warning" size="xs">قيد المراجعة</x-badge>
                                        @else
                                            <x-badge variant="neutral" size="xs">مرصود حديثاً</x-badge>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-end">
                                        <a href="{{ route('scouting.index') }}" class="rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] px-2.5 py-1 text-xs font-bold text-[var(--text-strong)] hover:bg-[#E3131B] hover:text-white transition-colors shadow-2xs">
                                            معاينة الرادار
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <!-- TAB 2: ABOUT US, VISION & MISSION -->
    <div x-show="activeTab === 'about'" class="space-y-6">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-6 shadow-2xs space-y-6">
            <!-- About Us Section -->
            <div class="space-y-3">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2 pb-2 border-b border-[var(--border)]">
                    <i data-lucide="info" class="w-4 h-4 text-[#E3131B]"></i>
                    <span>من نحن (About EAGLE'S SC ACADEMY)</span>
                </h3>
                <textarea rows="4" class="w-full bg-[var(--surface-subtle)] p-3 rounded-lg border border-[var(--border)] text-xs text-[var(--text-strong)] leading-relaxed focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]">تأسست أكاديمية النسور لكرة القدم (EAGLE'S SC ACADEMY) كصرح رياضي وتربوي متخصص في صناعة نجوم كرة القدم وفق أعلى المعايير الفنية والبدنية والاحترافية. تضم الأكاديمية أكثر من 240 لاعباً ناشئاً عبر 5 فئات سنية وبإشراف نخبة من المدربين الحاصلين على الرخص التدريبية المعتمدة من الاتحادين الأفريقي والمصري لكرة القدم.</textarea>
            </div>

            <!-- Vision -->
            <div class="space-y-3 pt-3 border-t border-[var(--border)]">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2">
                    <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                    <span>الرؤية الاستراتيجية (Our Vision)</span>
                </h3>
                <textarea rows="3" class="w-full bg-[var(--surface-subtle)] p-3 rounded-lg border border-[var(--border)] text-xs text-[var(--text-strong)] leading-relaxed focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]">أن تكون أكاديمية النسور المنظومة الكروية الأولى والرائدة في جمهورية مصر العربية في إنتاج وتأهيل المواهب الرياضية وتصديرها للأندية المحترفة والمنتخبات الوطنية، مع غرس الانضباط والروح القيادية في نفوس الناشئين.</textarea>
            </div>

            <!-- Mission -->
            <div class="space-y-3 pt-3 border-t border-[var(--border)]">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2">
                    <i data-lucide="flag" class="w-4 h-4 text-emerald-600"></i>
                    <span>رسالة الأكاديمية (Our Mission)</span>
                </h3>
                <textarea rows="3" class="w-full bg-[var(--surface-subtle)] p-3 rounded-lg border border-[var(--border)] text-xs text-[var(--text-strong)] leading-relaxed focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]">تقديم تجربة تدريبية متكاملة تجمع بين التطوير التكتيكي والبدني والتربوي، وتوفير بنية تحتية وملاعب حديثة وبيئة آمنة تتيح لكل لاعب اكتشاف طاقته الكامنة وتحقيق حلمه الكروي.</textarea>
            </div>
        </div>
    </div>

    <!-- TAB 3: REGULATIONS, CODE OF CONDUCT & TERMS -->
    <div x-show="activeTab === 'regulations'" class="space-y-6">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-6 shadow-2xs space-y-6">
            <!-- Code of Conduct -->
            <div class="space-y-3">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2 pb-2 border-b border-[var(--border)]">
                    <i data-lucide="book-open" class="w-4 h-4 text-[#E3131B]"></i>
                    <span>لائحة الانضباط والسلوك الرياضي (Code of Conduct)</span>
                </h3>
                <textarea rows="5" class="w-full bg-[var(--surface-subtle)] p-3 rounded-lg border border-[var(--border)] text-xs font-mono text-[var(--text-strong)] leading-relaxed focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]">1. الالتزام بالحضور إلى أرض الملعب قبل موعد الحصة التدريبية بـ 15 دقيقة على الأقل بالزي الرسمي المعتمد.
2. احترام قرارات الأجهزة الفنية والتحكيمية والالتزام بالروح الرياضية النزيهة داخل وخارج الملعب.
3. الحفاظ التام على مرافق النادي، الملاعب، والكرات والمهمات التدريبية المسلمة للاعب.
4. يحظر الغياب عن الحصص التدريبية أو المباريات الودية إلا بإذن كتابي مسبق للجهاز الإداري قبل 24 ساعة.
5. الالتزام بتعليمات الجهاز الطبي في حالات الإصابة أو الإجهاد العضلي.</textarea>
            </div>

            <!-- Terms and Conditions for Subscriptions -->
            <div class="space-y-3 pt-3 border-t border-[var(--border)]">
                <h3 class="text-sm font-bold text-[var(--text-strong)] flex items-center gap-2 pb-2 border-b border-[var(--border)]">
                    <i data-lucide="file-check" class="w-4 h-4 text-emerald-600"></i>
                    <span>الشروط والأحكام العامة للاشتراك والقيد</span>
                </h3>
                <textarea rows="4" class="w-full bg-[var(--surface-subtle)] p-3 rounded-lg border border-[var(--border)] text-xs font-mono text-[var(--text-strong)] leading-relaxed focus:bg-[var(--surface)] focus:outline-none focus:border-[#E3131B]">1. يسدد قسط الاشتراك الشهري في موعد أقصاه اليوم الخامس والعشرون من كل شهر ميلادي.
2. يشترط تقديم شهادة فحص طبي دوري تثبت خلو المشترك من أي أمراض تمنع ممارسة المجهود الرياضي المكثف.
3. يحق لإدارة الأكاديمية توقيع عقوبات إدارية تصل إلى الاستبعاد النهائي في حال تكرار مخالفة لوائح السلوك.
4. لا ترد رسوم الاشتراك بعد بدء الشهر التدريبي إلا في الحالات القهرية بموافقة المدير الفني.</textarea>
            </div>
        </div>
    </div>

    <!-- TAB 4: DIRECTORY, HOTLINES, CAMPUSES & PLATFORMS -->
    <div x-show="activeTab === 'contact'" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Campuses and Addresses -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] pb-2 border-b border-[var(--border)] flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#E3131B]"></i>
                    <span>عناوين الفروع ومقرات الملاعب</span>
                </h3>

                <div class="space-y-3 text-xs">
                    <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1">
                        <span class="font-black text-[var(--text-strong)] block">الفرع الرئيسي — استاد النسور الدولي:</span>
                        <p class="text-[var(--text-muted)]">القاهرة الجديدة، التجمع الخامس، محور محمد نجيب، مجمع الملاعب الأولمبية</p>
                        <span class="text-[11px] font-mono text-[var(--success-text)] font-bold block">ملعب نجيل صناعي معتمد FIFA + إضاءة ليلية كاملة</span>
                    </div>

                    <div class="p-3 bg-[var(--surface-subtle)] rounded-xl border border-[var(--border)] space-y-1">
                        <span class="font-black text-[var(--text-strong)] block">فرع غرب القاهرة — فرع نادي 6 أكتوبر:</span>
                        <p class="text-[var(--text-muted)]">مدينة 6 أكتوبر، الحي المتميز، أمام مول العرب، بوابة 4</p>
                        <span class="text-[11px] font-mono text-[var(--info-text)] font-bold block">ملعبان تدريبيان + صالة لياقة واستشفاء متكاملة</span>
                    </div>
                </div>
            </div>

            <!-- Digital Platforms & Hotlines -->
            <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] pb-2 border-b border-[var(--border)] flex items-center gap-2">
                    <i data-lucide="globe" class="w-4 h-4 text-blue-600"></i>
                    <span>أرقام التواصل والمنصات الرسمية</span>
                </h3>

                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)]">
                        <span class="font-bold text-[var(--text)]">الخط الساخن للأكاديمية:</span>
                        <span class="font-mono font-black text-[var(--text-strong)]" dir="ltr">+20 100 111 2233</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)]">
                        <span class="font-bold text-[var(--text)]">خدمة أولياء الأمور (WhatsApp):</span>
                        <span class="font-mono font-black text-[var(--success-text)]" dir="ltr">+20 102 334 8899</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)]">
                        <span class="font-bold text-[var(--text)]">صفحة فيسبوك الرسمية:</span>
                        <span class="font-mono text-[var(--info-text)] font-bold" dir="ltr">fb.com/EaglesSCAcademy</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)]">
                        <span class="font-bold text-[var(--text)]">حساب إنستغرام:</span>
                        <span class="font-mono text-[var(--danger-text)] font-bold" dir="ltr">@eagles.sc.academy</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)]">
                        <span class="font-bold text-[var(--text)]">قناة تيك توك وتوثيق المهارات:</span>
                        <span class="font-mono text-[var(--text-strong)] font-bold" dir="ltr">@eagles_football_skills</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
