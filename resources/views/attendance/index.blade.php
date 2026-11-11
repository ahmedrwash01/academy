@extends('layouts.admin', ['title' => __('app.nav.attendance')])

@section('content')
<div 
    class="space-y-6 font-arabic" 
    x-data="{
        selectedTeam: 'all',
        playersList: [
            @foreach($players as $p)
            {
                id: {{ $p['id'] }},
                name: '{{ $p['name_ar'] }}',
                team: '{{ $p['age_group'] }}',
                teamName: '{{ $p['team_name_ar'] }}',
                jersey: {{ $p['jersey_number'] }},
                avatar: '{{ $p['avatar'] }}',
                status: 'present'
            },
            @endforeach
        ],
        setStatus(id, newStatus) {
            const p = this.playersList.find(x => x.id === id);
            if (p) {
                p.status = newStatus;
            }
        },
        get presentCount() {
            return this.playersList.filter(p => p.status === 'present').length;
        },
        get absentCount() {
            return this.playersList.filter(p => p.status === 'absent').length;
        },
        get excusedCount() {
            return this.playersList.filter(p => p.status === 'excused').length;
        },
        get filteredPlayers() {
            if (this.selectedTeam === 'all') return this.playersList;
            return this.playersList.filter(p => p.team === this.selectedTeam);
        }
    }"
>
    <x-page-header 
        :title="__('app.nav.attendance')" 
        subtitle="تسجيل الحضور والغياب اليومي للفرق الرياضية والتحديث الفوري لسجل الانضباط الميداني"
        badge="جلسة اليوم الميدانية"
    >
        <x-slot:actions>
            <button @click="playersList.forEach(p => p.status = 'present')" class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 px-3.5 py-2 text-xs font-bold text-white shadow-xs transition-colors">
                <i data-lucide="check-check" class="h-4 w-4"></i>
                <span>تسجيل حضور الكل</span>
            </button>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="printer" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>طباعة كشف الحضور</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Real-time Counters Row (Clean White) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs border-s-4 border-s-[var(--border-strong)]">
            <span class="text-xs text-[var(--text-muted)] font-bold block">إجمالي المقيدين بالكشف</span>
            <span class="block text-2xl font-black text-[var(--text-strong)] font-mono mt-1" x-text="playersList.length"></span>
            <span class="text-[11px] text-[var(--text-muted)] font-medium">كافة فرق الأكاديمية</span>
        </div>

        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs border-s-4 border-s-emerald-600">
            <span class="text-xs text-[var(--success-text)] font-bold block">الحاضرين بالميدان</span>
            <span class="block text-2xl font-black text-[var(--success-text)] font-mono mt-1" x-text="presentCount"></span>
            <span class="text-[11px] text-[var(--success-text)] font-bold" x-text="Math.round((presentCount / (playersList.length || 1)) * 100) + '% نسبة الحضور'"></span>
        </div>

        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs border-s-4 border-s-[#E3131B]">
            <span class="text-xs text-[#E3131B] font-bold block">الغياب بدون إذن</span>
            <span class="block text-2xl font-black text-[#E3131B] font-mono mt-1" x-text="absentCount"></span>
            <span class="text-[11px] text-[var(--text-muted)] font-medium">إشعار ولي الأمر فوراً</span>
        </div>

        <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-4 shadow-2xs border-s-4 border-s-amber-500">
            <span class="text-xs text-[var(--warning-text)] font-bold block">غياب بإذن مسبق</span>
            <span class="block text-2xl font-black text-[var(--warning-text)] font-mono mt-1" x-text="excusedCount"></span>
            <span class="text-[11px] text-[var(--warning-text)] font-medium">إجازات وتصاريح دراسية</span>
        </div>
    </div>

    <!-- Team Filter Bar (White) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-3.5 shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <i data-lucide="filter" class="h-4 w-4 text-[var(--text-muted)]"></i>
            <span class="text-xs font-bold text-[var(--text-strong)]">تصفية حسب الفئة السنية:</span>
        </div>

        <div class="flex flex-wrap gap-1.5 text-xs">
            <button 
                @click="selectedTeam = 'all'" 
                :class="selectedTeam === 'all' ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] border border-[var(--border)]'"
                class="px-3 py-1.5 rounded-lg font-bold transition-colors cursor-pointer"
            >
                كافة الفرق
            </button>
            <button 
                @click="selectedTeam = 'U-11'" 
                :class="selectedTeam === 'U-11' ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] border border-[var(--border)]'"
                class="px-3 py-1.5 rounded-lg font-bold transition-colors cursor-pointer"
            >
                U-11 براعم
            </button>
            <button 
                @click="selectedTeam = 'U-13'" 
                :class="selectedTeam === 'U-13' ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] border border-[var(--border)]'"
                class="px-3 py-1.5 rounded-lg font-bold transition-colors cursor-pointer"
            >
                U-13 أشبال
            </button>
            <button 
                @click="selectedTeam = 'U-15'" 
                :class="selectedTeam === 'U-15' ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] border border-[var(--border)]'"
                class="px-3 py-1.5 rounded-lg font-bold transition-colors cursor-pointer"
            >
                U-15 ناشئين
            </button>
            <button 
                @click="selectedTeam = 'U-17'" 
                :class="selectedTeam === 'U-17' ? 'bg-[var(--text-strong)] text-[var(--surface)] shadow-xs' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:text-[var(--text-strong)] border border-[var(--border)]'"
                class="px-3 py-1.5 rounded-lg font-bold transition-colors cursor-pointer"
            >
                U-17 شباب
            </button>
        </div>
    </div>

    <!-- Attendance Table (Clean White) -->
    <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xs overflow-hidden">
        <table class="w-full text-xs text-start">
            <thead class="bg-[var(--surface-subtle)] text-[var(--text-muted)] uppercase text-[11px] font-bold border-b border-[var(--border)]">
                <tr>
                    <th class="py-3 px-4 text-start">اللاعب</th>
                    <th class="py-3 px-4 text-start">الفريق</th>
                    <th class="py-3 px-4 text-center">الرقم</th>
                    <th class="py-3 px-4 text-center">الحالة الحالية</th>
                    <th class="py-3 px-4 text-end">تغيير الحالة الميدانية</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border-subtle)] text-[var(--text-strong)]">
                <template x-for="p in filteredPlayers" :key="p.id">
                    <tr class="hover:bg-[var(--surface-subtle)]/80 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center font-bold text-[#E3131B] text-xs shrink-0 shadow-2xs">
                                    <span x-text="p.name.substring(0, 2)"></span>
                                </div>
                                <div>
                                    <span class="font-bold text-[var(--text-strong)] block text-sm" x-text="p.name"></span>
                                    <span class="text-[11px] text-[var(--text-muted)] font-mono" x-text="'ID: #00' + p.id"></span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]" x-text="p.team"></span>
                            <span class="text-[11px] text-[var(--text-muted)] block mt-0.5" x-text="p.teamName"></span>
                        </td>
                        <td class="py-3 px-4 text-center font-mono font-bold text-[var(--text-strong)]" x-text="'#' + p.jersey"></td>
                        <td class="py-3 px-4 text-center">
                            <span 
                                x-show="p.status === 'present'"
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200"
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                <span>حاضر بالميدان</span>
                            </span>
                            <span 
                                x-show="p.status === 'absent'"
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-red-50 text-[#E3131B] border border-red-200"
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-[#E3131B]"></span>
                                <span>غائب بدون إذن</span>
                            </span>
                            <span 
                                x-show="p.status === 'excused'"
                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200"
                            >
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-600"></span>
                                <span>غياب بعذر</span>
                            </span>
                        </td>
                        <td class="py-3 px-4 text-end">
                            <div class="inline-flex items-center gap-1">
                                <button 
                                    @click="setStatus(p.id, 'present')"
                                    :class="p.status === 'present' ? 'bg-emerald-600 text-white' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:bg-emerald-50 hover:text-emerald-700 border border-[var(--border)]'"
                                    class="rounded-lg px-2.5 py-1 text-[11px] font-bold transition-colors cursor-pointer shadow-2xs"
                                >
                                    حاضر
                                </button>
                                <button 
                                    @click="setStatus(p.id, 'absent')"
                                    :class="p.status === 'absent' ? 'bg-[#E3131B] text-white' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:bg-red-50 hover:text-[#E3131B] border border-[var(--border)]'"
                                    class="rounded-lg px-2.5 py-1 text-[11px] font-bold transition-colors cursor-pointer shadow-2xs"
                                >
                                    غائب
                                </button>
                                <button 
                                    @click="setStatus(p.id, 'excused')"
                                    :class="p.status === 'excused' ? 'bg-amber-500 text-white' : 'bg-[var(--surface-subtle)] text-[var(--text-muted)] hover:bg-amber-50 hover:text-amber-700 border border-[var(--border)]'"
                                    class="rounded-lg px-2.5 py-1 text-[11px] font-bold transition-colors cursor-pointer shadow-2xs"
                                >
                                    بعذر
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
@endsection