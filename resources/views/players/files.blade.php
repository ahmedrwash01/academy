@extends('layouts.admin', ['title' => __('app.nav.player_files')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.player_files')" 
        subtitle="الأرشيف الرقمي لملفات ومستندات اللاعبين الرسمية، الشهادات الطبية، وصور بطاقات الاتحاد"
        badge="الأرشيف الإلكتروني والتوثيق"
    >
        <x-slot:actions>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="users" class="h-4 w-4"></i>
                <span>قائمة اللاعبين</span>
            </a>
            <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                <i data-lucide="printer" class="h-4 w-4"></i>
                <span>طباعة جرد المستندات</span>
            </button>
        </x-slot:actions>
    </x-page-header>

    <!-- Archive Metrics -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-gray-200/80 shadow-2xs">
            <span class="text-xs text-[var(--text-muted)] font-bold block">إجمالي الملفات المفهرسة</span>
            <span class="block text-2xl font-black text-[var(--text-strong)] font-mono mt-1">248</span>
            <span class="text-[11px] text-gray-500 font-medium">ملف إلكتروني نشط</span>
        </div>
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-gray-200/80 shadow-2xs">
            <span class="text-xs text-emerald-600 font-bold block">شهادات الفحص الطبي</span>
            <span class="block text-2xl font-black text-emerald-600 font-mono mt-1">244</span>
            <span class="text-[11px] text-emerald-700 font-medium">معتمدة وصالحة للموسم</span>
        </div>
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-gray-200/80 shadow-2xs">
            <span class="text-xs text-neutral-800 font-bold block">استمارات قيد الاتحاد</span>
            <span class="block text-2xl font-black text-neutral-900 font-mono mt-1">238</span>
            <span class="text-[11px] text-gray-500 font-medium">مسجلة بمنطقة القاهرة</span>
        </div>
        <div class="p-4 rounded-xl bg-[var(--surface)] border border-amber-200/80 shadow-2xs">
            <span class="text-xs text-amber-600 font-bold block">ملفات قيد استكمال الأوراق</span>
            <span class="block text-2xl font-black text-amber-600 font-mono mt-1">4</span>
            <span class="text-[11px] text-amber-700 font-medium">شهادات ميلاد تحت التحديث</span>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-gray-200/80 flex items-center justify-between bg-[var(--surface-subtle)]/50">
            <div>
                <h3 class="text-sm font-bold text-[var(--text-strong)]">سجل فحص مستندات اللاعبين الرسمية</h3>
                <p class="text-xs text-[var(--text-muted)]">تحديث دوري لحالة الأوراق الثبوتية والتقارير الطبية</p>
            </div>
            <span class="text-xs font-mono font-bold text-gray-500 bg-[var(--surface)] px-2.5 py-1 rounded border border-gray-200">
                248 ملفاً
            </span>
        </div>

        <table class="w-full text-xs text-start">
            <thead class="bg-[var(--surface-subtle)]/80 text-gray-500 uppercase text-[11px] font-bold border-b border-gray-200/80">
                <tr>
                    <th class="py-3 px-4 text-start">اللاعب</th>
                    <th class="py-3 px-4 text-start">الفئة السنية</th>
                    <th class="py-3 px-4 text-start">شهادة الميلاد / الرقم القومي</th>
                    <th class="py-3 px-4 text-start">الفحص الطبي الدوري</th>
                    <th class="py-3 px-4 text-start">كارنيه الاتحاد</th>
                    <th class="py-3 px-4 text-end">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-[var(--text)]">
                @foreach($players as $p)
                    <tr class="hover:bg-[var(--surface-subtle)]/60 transition-colors">
                        <td class="py-3.5 px-4 font-bold text-[var(--text-strong)]">
                            <a href="{{ route('players.show', $p['id']) }}" class="hover:text-red-600 block">
                                {{ $p['name_ar'] }}
                            </a>
                            <span class="text-[10px] text-[var(--text-muted)] font-normal">ولي الأمر: {{ $p['parent_name_ar'] }}</span>
                        </td>
                        <td class="py-3.5 px-4 font-bold text-[var(--text)]">{{ $p['age_group'] }}</td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center gap-1 text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                <i data-lucide="file-check" class="h-3 w-3"></i> متوفر ومفحوص
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center gap-1 text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">
                                <i data-lucide="heart-pulse" class="h-3 w-3"></i> لائق كلياً
                            </span>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center gap-1 text-neutral-800 font-bold bg-gray-100 px-2 py-0.5 rounded border border-gray-200">
                                <i data-lucide="badge" class="h-3 w-3"></i> صادر 2026
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-end">
                            <a href="{{ route('players.show', $p['id']) }}" class="inline-flex items-center gap-1 font-bold text-red-600 hover:text-red-700 transition-colors">
                                <span>عرض الأرشيف</span>
                                <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
