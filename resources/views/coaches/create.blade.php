@extends('layouts.admin', ['title' => __('app.nav.add_coach')])

@section('content')
<div class="space-y-6 max-w-3xl mx-auto font-arabic">
    <x-page-header 
        :title="__('app.nav.add_coach')" 
        subtitle="إضافة عضو جديد للجهاز الفني للأكاديمية وتحديد الصلاحيات والفرق التابعة"
    />

    <div class="rounded-2xl border border-gray-100 bg-[var(--surface)] p-6 sm:p-8 shadow-sm">
        <form action="{{ route('coaches.store') }}" method="POST" class="space-y-6 text-xs">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">اسم المدرب رباعي (عربي) *</label>
                    <input type="text" name="name_ar" required placeholder="كابتن أحمد سامي..." class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">الاسم بالإنجليزية (English Name) *</label>
                    <input type="text" name="name_en" required placeholder="Capt. Ahmed Samy..." class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">المسمى الوظيفي والصفة الفنية *</label>
                    <input type="text" name="role_ar" required placeholder="مدرب فريق U-15 / مساعد مدير فني" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">الرخصة الفنية المعتمدة</label>
                    <select name="certification" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                        <option value="CAF A License">CAF A License</option>
                        <option value="CAF B License">CAF B License</option>
                        <option value="CAF C License">CAF C License</option>
                        <option value="UEFA License">UEFA Coaching Diploma</option>
                        <option value="FIFA Goalkeeping Coach">FIFA Goalkeeping Specialist</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">رقم الهاتف *</label>
                    <input type="tel" name="phone" required placeholder="+20 100 000 0000" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-[var(--text)] mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" placeholder="coach@eagles-academy.com" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                <a href="{{ route('coaches.index') }}" class="rounded-xl border border-gray-200 px-5 py-2.5 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)]">
                    إلغاء
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-6 py-2.5 text-xs font-bold text-white shadow-md shadow-red-600/30 hover:bg-red-700">
                    <i data-lucide="check" class="h-4 w-4"></i>
                    <span>حفظ واعتماد المدرب</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

