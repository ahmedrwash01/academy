@extends('layouts.admin', ['title' => __('app.nav.add_player')])

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <x-page-header 
        :title="__('app.nav.add_player')" 
        subtitle="تسجيل وقيد موهبة جديدة في صفوف أكاديمية النسور وإصدار بطاقة اللاعب"
    >
        <x-slot:actions>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-[var(--surface)] px-4 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors font-arabic">
                <i data-lucide="arrow-right" class="h-4 w-4"></i>
                <span>العودة للقائمة</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="rounded-2xl border border-gray-100 bg-[var(--surface)] p-6 sm:p-8 shadow-sm font-arabic">
        <form action="{{ route('players.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Section 1: Personal Info -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-black">1</span>
                    <span>البيانات الشخصية للاعب</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الاسم باللغة العربية (رباعي) *</label>
                        <input type="text" name="name_ar" required placeholder="مثال: يوسف محمود حسن الشناوي" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الاسم باللغة الإنجليزية (Full English Name) *</label>
                        <input type="text" name="name_en" required placeholder="e.g. Youssef Mahmoud Hassan" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">تاريخ الميلاد *</label>
                        <input type="date" name="dob" required class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الجنسية</label>
                        <input type="text" name="nationality" value="مصري" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">رقم هاتف اللاعب (إن وجد)</label>
                        <input type="tel" name="phone" placeholder="+20 100 000 0000" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">محل الإقامة / العنوان التفصيلي</label>
                        <input type="text" name="address" placeholder="المدينة، الحي، المحافظة" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 2: Guardian Info -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-black">2</span>
                    <span>بيانات ولي الأمر والتواصل</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">اسم ولي الأمر *</label>
                        <input type="text" name="parent_name" required placeholder="اسم الأب أو الأم" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">صلة القرابة</label>
                        <select name="parent_relation" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                            <option value="الأب">الأب</option>
                            <option value="الأم">الأم</option>
                            <option value="الوصي القانوني">الوصي القانوني</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">رقم هاتف ولي الأمر (لإشعارات الرسوم والغياب) *</label>
                        <input type="tel" name="parent_phone" required placeholder="+20 120 000 0000" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 3: Sports and Football Specs -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-black">3</span>
                    <span>البيانات الكروية والفرقة الرياضية</span>
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">مركز اللعب *</label>
                        <select name="position" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                            <option value="حارس مرمى">حارس مرمى</option>
                            <option value="قلب دفاع">قلب دفاع</option>
                            <option value="ظهير أيمن">ظهير أيمن</option>
                            <option value="ظهير أيسر">ظهير أيسر</option>
                            <option value="وسط ارتكاز">وسط ارتكاز</option>
                            <option value="وسط مهاجم / صانع ألعاب">وسط مهاجم / صانع ألعاب</option>
                            <option value="جناح هجومي">جناح هجومي</option>
                            <option value="رأس حربة / مهاجم صريح">رأس حربة / مهاجم صريح</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">القدم المفضلة</label>
                        <select name="preferred_foot" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                            <option value="اليمنى">اليمنى</option>
                            <option value="اليسرى">اليسرى</option>
                            <option value="كلاهما">كلاهما</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الطول (سم)</label>
                        <input type="number" name="height" placeholder="165" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">الوزن (كجم)</label>
                        <input type="number" name="weight" placeholder="55" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                    </div>

                    <div class="col-span-2">
                        <label class="block font-bold text-[var(--text)] mb-1">الفريق والتسكين الميداني *</label>
                        <select name="team_id" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                            @foreach($teams as $team)
                                <option value="{{ $team['id'] }}">{{ $team['name_ar'] }} — {{ $team['category_ar'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label class="block font-bold text-[var(--text)] mb-1">باقة الاشتراك المعتمدة *</label>
                        <select name="package_id" class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none">
                            @foreach($packages as $pkg)
                                <option value="{{ $pkg['id'] }}">{{ $pkg['name_ar'] }} ({{ number_format($pkg['price']) }} ج.م)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 4: Medical Notes -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-[var(--text-strong)] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-600 text-xs font-black">4</span>
                    <span>الحالة الطبية والإقرار</span>
                </h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block font-bold text-[var(--text)] mb-1">ملاحظات طبية أو حساسية خاصة (إن وجدت)</label>
                        <textarea rows="2" name="medical_notes" placeholder="سليم ولائق طبياً لممارسة كرة القدم التنافسية..." class="w-full rounded-lg border border-gray-200 bg-[var(--surface-subtle)] p-2.5 text-xs focus:border-red-500 focus:bg-[var(--surface)] focus:outline-none"></textarea>
                    </div>

                    <div class="flex items-start gap-2 pt-2">
                        <input type="checkbox" required id="terms" class="mt-0.5 rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <label for="terms" class="text-gray-600">
                            أقر أنا ولي الأمر بصحة كافة البيانات الواردة أعلاه والالتزام بلائحة التدريبات والسلوك الرياضي لأكاديمية النسور لكرة القدم.
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                <a href="{{ route('players.index') }}" class="rounded-xl border border-gray-200 px-5 py-2.5 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                    إلغاء
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-red-600 px-6 py-2.5 text-xs font-bold text-white shadow-md shadow-red-600/30 hover:bg-red-700 transition-colors">
                    <i data-lucide="check" class="h-4 w-4"></i>
                    <span>حفظ وقيد اللاعب رسمياً</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

