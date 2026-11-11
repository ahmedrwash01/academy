@extends('layouts.admin', ['title' => 'البطولات والدوريات وخزانة الإنجازات — EAGLE COMPETITIONS'])

@section('content')
<div class="space-y-6 font-arabic" x-data="{
    compTab: 'fixtures', // 'fixtures', 'standings', 'trophies', 'tournaments'
}">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-1 border-b border-[var(--border)]">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded text-[11px] font-bold bg-[#E3131B]/10 text-[#E3131B] border border-[#E3131B]/20">
                    <i data-lucide="trophy" class="w-3.5 h-3.5"></i>
                    <span>EAGLE COMPETITIONS & HONOURS</span>
                </span>
                <span class="text-xs font-bold text-[var(--text-muted)]">قطاع المسابقات الرسمية والبطولات المعتمدة</span>
            </div>
            <h1 class="text-2xl font-black text-[var(--text-strong)] tracking-tight">البطولات، الدوريات الرسمية، وخزانة إنجازات النسور</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">متابعة نتائج المباريات، جداول الترتيب، وإحصائيات التتويج بالكؤوس والدروع التذكارية</p>
        </div>

        <div class="flex items-center gap-2">
            <button onclick="window.print()" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--surface)] border border-[var(--border)] hover:bg-[var(--surface-subtle)] rounded-lg text-xs font-bold text-[var(--text-strong)] shadow-2xs transition-colors">
                <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--text-muted)]"></i>
                <span>طباعة جدول المباريات</span>
            </button>
            <a href="{{ route('tactics.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[var(--text-strong)] hover:opacity-90 rounded-lg text-xs font-bold text-[var(--surface)] shadow-2xs transition-opacity">
                <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                <span>المختبر التكتيكي</span>
            </a>
        </div>
    </div>

    <!-- Navigation Sub-tabs -->
    <div class="inline-flex p-1 bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-x-auto w-full sm:w-auto">
        <button 
            type="button" 
            @click="compTab = 'fixtures'" 
            :class="compTab === 'fixtures' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span>المباريات واللقاءات الرسمية</span>
        </button>
        <button 
            type="button" 
            @click="compTab = 'standings'" 
            :class="compTab === 'standings' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="list-ordered" class="w-4 h-4"></i>
            <span>جدول ترتيب الدوري</span>
        </button>
        <button 
            type="button" 
            @click="compTab = 'trophies'" 
            :class="compTab === 'trophies' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="award" class="w-4 h-4 text-[#E3131B]"></i>
            <span>خزانة الكؤوس والإنجازات (4)</span>
        </button>
        <button 
            type="button" 
            @click="compTab = 'tournaments'" 
            :class="compTab === 'tournaments' ? 'bg-[var(--text-strong)] text-[var(--surface)]' : 'text-[var(--text-muted)] hover:text-[var(--text-strong)]'"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 shrink-0"
        >
            <i data-lucide="flag" class="w-4 h-4"></i>
            <span>البطولات والمسابقات النشطة</span>
        </button>
    </div>

    <!-- TAB 1: FIXTURES & UPCOMING MATCHES -->
    <div x-show="compTab === 'fixtures'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($matches as $m)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs hover:border-[var(--border-strong)] transition-all flex flex-col justify-between space-y-4">
                    <div>
                        <!-- Match Meta Header -->
                        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)] text-xs">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded font-bold text-[11px] bg-[var(--danger-bg)] text-[var(--danger-text)] border border-[var(--danger-border)]">
                                <span>{{ $m['tournament_ar'] }}</span>
                            </span>
                            <span class="font-mono text-[var(--text-muted)] font-semibold flex items-center gap-1">
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                <span>{{ $m['date'] }} • {{ $m['time'] }}</span>
                            </span>
                        </div>

                        <!-- Match Head-to-Head Banner -->
                        <div class="py-4 flex items-center justify-between gap-4">
                            <!-- Home Team -->
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div class="w-11 h-11 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center p-1.5 shrink-0">
                                    <img src="{{ asset('images/academy-logo.png') }}" class="w-8 h-8 object-contain">
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-black text-[var(--text-strong)] text-xs sm:text-sm truncate">{{ $m['home_team_ar'] }}</h4>
                                    <span class="text-[10px] text-[var(--text-muted)] block">صاحب الأرض (Home)</span>
                                </div>
                            </div>

                            <!-- VS Badge -->
                            <div class="px-3 py-1 rounded-lg bg-[var(--text-strong)] text-[var(--surface)] font-mono font-black text-xs shrink-0 shadow-2xs">
                                VS
                            </div>

                            <!-- Away Team -->
                            <div class="flex items-center justify-end gap-3 flex-1 min-w-0 text-end">
                                <div class="min-w-0">
                                    <h4 class="font-black text-[var(--text-strong)] text-xs sm:text-sm truncate">{{ $m['away_team_ar'] }}</h4>
                                    <span class="text-[10px] text-[var(--text-muted)] block">الفريق الضيف (Away)</span>
                                </div>
                                <div class="w-11 h-11 rounded-xl bg-gray-100 border border-[var(--border)] flex items-center justify-center text-gray-600 shrink-0">
                                    <i data-lucide="shield" class="w-5 h-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Details -->
                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-[var(--text-muted)]">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#E3131B]"></i>
                            <span>{{ $m['ground_ar'] }}</span>
                        </span>
                        <span class="font-bold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded text-[11px] border border-emerald-200">
                            القائمة الرسمية معتمدة
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 2: LEAGUE STANDINGS TABLE -->
    <div x-show="compTab === 'standings'" class="space-y-4">
        <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] shadow-2xs overflow-hidden">
            <div class="p-4 border-b border-[var(--border)] flex items-center justify-between bg-[var(--surface-subtle)]">
                <div>
                    <h3 class="text-sm font-bold text-[var(--text-strong)]">جدول ترتيب دوري سوبر القاهرة للناشئين U-15</h3>
                    <p class="text-xs text-[var(--text-muted)]">موسم 2025 / 2026 — محدث رسمياً بعد الجولة 14</p>
                </div>
                <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                    أكاديمية النسور في الصدارة بفارق 4 نقاط
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-start">
                    <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                        <tr>
                            <th class="py-3 px-4 text-start"># الترتيب</th>
                            <th class="py-3 px-4 text-start">النادي / الأكاديمية</th>
                            <th class="py-3 px-4 text-center">لعب</th>
                            <th class="py-3 px-4 text-center">فوز</th>
                            <th class="py-3 px-4 text-center">تعادل</th>
                            <th class="py-3 px-4 text-center">هزيمة</th>
                            <th class="py-3 px-4 text-center">له</th>
                            <th class="py-3 px-4 text-center">عليه</th>
                            <th class="py-3 px-4 text-center">الفارق</th>
                            <th class="py-3 px-4 text-end">النقاط</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                        @foreach($standings as $s)
                            <tr class="{{ $s['is_eagles'] ? 'bg-[#E3131B]/5 font-bold' : 'hover:bg-[var(--surface-subtle)]/60' }} transition-colors">
                                <td class="py-3.5 px-4 font-mono font-black {{ $s['is_eagles'] ? 'text-[#E3131B]' : 'text-[var(--text-muted)]' }}">
                                    {{ $s['pos'] }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center gap-2">
                                        @if($s['is_eagles'])
                                            <img src="{{ asset('images/academy-logo.png') }}" class="w-5 h-5 object-contain">
                                            <span class="font-black text-[#E3131B]">{{ $s['team'] }}</span>
                                            <span class="text-[9px] font-bold text-[var(--danger-text)] bg-[var(--danger-bg)] border border-[var(--danger-border)] px-1.5 py-0.5 rounded">المتصدر</span>
                                        @else
                                            <span class="font-medium text-[var(--text-strong)]">{{ $s['team'] }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-mono">{{ $s['played'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono text-[var(--success-text)] font-bold">{{ $s['won'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono text-[var(--text-muted)]">{{ $s['drawn'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono text-[var(--danger-text)]">{{ $s['lost'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono">{{ $s['gf'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono">{{ $s['ga'] }}</td>
                                <td class="py-3.5 px-4 text-center font-mono font-bold text-[var(--success-text)]">+{{ $s['gf'] - $s['ga'] }}</td>
                                <td class="py-3.5 px-4 text-end font-mono font-black text-sm {{ $s['is_eagles'] ? 'text-[#E3131B]' : 'text-[var(--text-strong)]' }}">
                                    {{ $s['pts'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-3 bg-[var(--surface-subtle)] border-t border-[var(--border)] text-[11px] text-[var(--text-muted)] flex items-center justify-between">
                <span>* بطل الدوري يتأهل مباشرة للمرحلة النهائية من دوري قطاعات الجمهورية للأكاديميات المعتمدة.</span>
                <span class="font-bold text-[var(--text-strong)]">إجمالي الفرق المشاركة: 16 فريقاً</span>
            </div>
        </div>
    </div>

    <!-- TAB 3: TROPHY CABINET & ACHIEVEMENTS -->
    <div x-show="compTab === 'trophies'" class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($trophies as $t)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs hover:shadow-md hover:border-[#E3131B]/40 transition-all flex flex-col justify-between space-y-4 relative overflow-hidden group">
                    <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full bg-amber-500/5 group-hover:scale-125 transition-transform pointer-events-none"></div>

                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-500 flex items-center justify-center text-xl shadow-xs">
                                🏆
                            </span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]">
                                {{ $t['season'] }}
                            </span>
                        </div>

                        <h3 class="text-sm font-black text-[var(--text-strong)] group-hover:text-[#E3131B] transition-colors leading-snug">
                            {{ $t['title_ar'] }}
                        </h3>
                        <p class="text-[11px] text-[var(--text-muted)] mt-1">الجهة المنظمة: {{ $t['organizer'] }}</p>

                        <div class="mt-3 p-2.5 bg-[var(--surface-subtle)] rounded-lg border border-[var(--border)] space-y-1 text-[11px]">
                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">الإنجاز المحقق:</span>
                                <span class="font-bold text-[var(--success-text)]">{{ $t['medal'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[var(--text-muted)]">أبرز اللاعبين:</span>
                                <span class="font-bold text-[var(--text-strong)]">{{ $t['top_scorer'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-[var(--border-subtle)] flex items-center justify-between text-[11px] text-[var(--text-muted)]">
                        <span>تاريخ التتويج: {{ $t['date'] }}</span>
                        <span class="text-amber-500 font-bold">معتمد بسجل النادي</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 4: ACTIVE TOURNAMENTS -->
    <div x-show="compTab === 'tournaments'" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($tournaments as $tour)
                <div class="bg-[var(--surface)] rounded-xl border border-[var(--border)] p-5 shadow-2xs space-y-3">
                    <div class="flex items-start justify-between">
                        <h4 class="text-sm font-black text-[var(--text-strong)]">{{ $tour['name_ar'] }}</h4>
                        <span class="p-1 rounded bg-[#E3131B]/10 text-[#E3131B]">
                            <i data-lucide="flag" class="w-4 h-4"></i>
                        </span>
                    </div>

                    <div class="space-y-2 text-xs text-[var(--text-muted)]">
                        <div class="flex items-center justify-between">
                            <span>الفرق المشاركة:</span>
                            <span class="font-mono font-bold text-[var(--text-strong)]">{{ $tour['teams_count'] }} فريقاً</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>المرحلة الحالية:</span>
                            <span class="font-bold text-[var(--info-text)]">{{ $tour['current_stage'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>الموقف التنافسي:</span>
                            <span class="font-black text-[var(--success-text)]">{{ $tour['standing'] }}</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-[var(--border-subtle)] text-[11px] text-[var(--text-strong)] bg-[var(--surface-subtle)] p-2.5 rounded-lg">
                        <span class="text-[var(--text-muted)] block mb-0.5">المباراة القادمة:</span>
                        <span class="font-bold text-[#E3131B]">{{ $tour['next_match'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
