@extends('layouts.admin', ['title' => 'تعديل بيانات اللاعب: ' . $player['name_ar']])

@section('content')
<div class="space-y-6 max-w-4xl mx-auto font-arabic">
    <x-page-header 
        :title="'تعديل بيانات اللاعب: ' . $player['name_ar']" 
        subtitle="تحديث السجلات الشخصية، اللياقة البدنية، ورقم القميص والفرقة الرياضية"
    >
        <x-slot:actions>
            <a href="{{ route('players.show', $player['id']) }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="eye" class="h-4 w-4"></i>
                <span>عرض الملف الشخصي</span>
            </a>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="arrow-right" class="h-4 w-4"></i>
                <span>قائمة اللاعبين</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-6 sm:p-8 shadow-2xs">
        <form action="{{ route('players.update', $player['id']) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Section 1: Personal Info -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-red-100 text-red-600 text-xs font-black">1</span>
                    <span>البيانات الشخصية</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الاسم بالعربية *</label>
                        <input type="text" name="name_ar" value="{{ $player['name_ar'] }}" required class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الاسم بالإنجليزية *</label>
                        <input type="text" name="name_en" value="{{ $player['name_en'] }}" required class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">تاريخ الميلاد</label>
                        <input type="date" name="dob" value="{{ $player['dob'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 font-mono">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الجنسية</label>
                        <input type="text" name="nationality" value="{{ $player['nationality_ar'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">رقم هاتف اللاعب</label>
                        <input type="tel" name="phone" value="{{ $player['phone'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 font-mono">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">العنوان السكني</label>
                        <input type="text" name="address" value="{{ $player['address_ar'] ?? $player['address'] ?? '' }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                    </div>
                </div>
            </div>

            <!-- Section 2: Technical & Sports Profile -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-5 w-5 items-center justify-center rounded-md bg-red-100 text-red-600 text-xs font-black">2</span>
                    <span>الملف الفني والرياضي</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">المركز الأساسي</label>
                        <input type="text" name="position_ar" value="{{ $player['position_ar'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">رقم القميص (Jersey)</label>
                        <input type="number" name="jersey_number" value="{{ $player['jersey_number'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 font-mono">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">القدم المفضلة</label>
                        <select name="preferred_foot" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                            @php
                                $pref = $player['preferred_foot'] ?? (($player['preferred_foot_ar'] ?? '') === 'اليمنى' ? 'right' : 'left');
                            @endphp
                            <option value="right" {{ $pref === 'right' ? 'selected' : '' }}>اليمنى</option>
                            <option value="left" {{ $pref === 'left' ? 'selected' : '' }}>اليسرى</option>
                            <option value="both" {{ $pref === 'both' ? 'selected' : '' }}>كلتا القدمين</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الطول (سم)</label>
                        <input type="number" name="height" value="{{ $player['height'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 font-mono">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الوزن (كجم)</label>
                        <input type="number" name="weight" value="{{ $player['weight'] }}" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600 font-mono">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">حالة القيد الرياضي</label>
                        <select name="status" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)]/80 p-2.5 text-xs focus:border-red-600 focus:bg-[var(--surface)] focus:outline-none focus:ring-1 focus:ring-red-600">
                            <option value="active" {{ $player['status'] === 'active' ? 'selected' : '' }}>نشط (Active)</option>
                            <option value="injured" {{ $player['status'] === 'injured' ? 'selected' : '' }}>مصاب (Injured)</option>
                            <option value="suspended" {{ $player['status'] === 'suspended' ? 'selected' : '' }}>موقوف (Suspended)</option>
                            <option value="inactive" {{ $player['status'] === 'inactive' ? 'selected' : '' }}>غير نشط (Inactive)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                <a href="{{ route('players.show', $player['id']) }}" class="rounded-lg border border-gray-200 px-4 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                    إلغاء
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                    <i data-lucide="check" class="h-4 w-4"></i>
                    <span>حفظ التعديلات الفنية</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
