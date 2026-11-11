@extends('layouts.admin', ['title' => __('app.nav.age_groups')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.age_groups')" 
        subtitle="الهيكل الفني للقطاعات والمراحل السنية المعتمدة لمسابقات الاتحاد المصري لكرة القدم"
        badge="6 مراحل عمرية"
    >
        <x-slot:actions>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface-subtle)] transition-colors">
                <i data-lucide="users" class="h-4 w-4"></i>
                <span>قائمة اللاعبين</span>
            </a>
            <a href="{{ route('players.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3.5 py-2 text-xs font-bold text-white shadow-xs hover:bg-red-700 transition-colors">
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                <span>قيد لاعب جديد</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @php
            $ageCategories = [
                ['name' => 'فئة البراعم U-9', 'birth' => 'مواليد 2017 - 2018', 'count' => 24, 'focus' => 'المهارات الأساسية، التحكم في الكرة، والتوافق العضلي العصبي والرشاقة الحركية', 'badge' => 'U-9'],
                ['name' => 'فئة الأشبال U-11', 'birth' => 'مواليد 2015 - 2016', 'count' => 26, 'focus' => 'التمرير السريع، التحرك الذكي بدون كرة، واللعب التشاركي الجماعي', 'badge' => 'U-11'],
                ['name' => 'فئة الناشئين U-13', 'birth' => 'مواليد 2013 - 2014', 'count' => 28, 'focus' => 'التمركز التكتيكي، التحولات الهجومية والدفاعية، وبناء الهجمات من الخلف', 'badge' => 'U-13'],
                ['name' => 'فئة الشباب U-15 (النخبة)', 'birth' => 'مواليد 2011 - 2012', 'count' => 26, 'focus' => 'اللياقة البدنية العالية، الضغط العكسي، وإنهاء الهجمات تحت الضغط', 'badge' => 'U-15'],
                ['name' => 'فئة الشباب المتقدم U-17', 'birth' => 'مواليد 2009 - 2010', 'count' => 25, 'focus' => 'التكتيك الاحترافي المتقدم، سرعة اتخاذ القرار، والإعداد النفسي للمباريات', 'badge' => 'U-17'],
                ['name' => 'الفريق الأول للأكاديمية', 'birth' => 'فوق 18 سنة', 'count' => 28, 'focus' => 'المسابقات الرسمية المؤهلة للدرجة الرابعة ودوري الجمهورية العام', 'badge' => 'First Team'],
            ];
        @endphp

        @foreach($ageCategories as $ac)
            <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs hover:border-gray-300 hover:shadow-xs transition-all flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-[var(--text-strong)] text-[var(--surface)]">
                            {{ $ac['name'] }}
                        </span>
                        <span class="text-xs text-[var(--text-muted)] font-mono font-medium">{{ $ac['birth'] }}</span>
                    </div>

                    <div class="mt-4 space-y-2.5">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-[var(--text-muted)] font-medium">عدد اللاعبين المقيدين:</span>
                            <span class="font-mono font-bold text-[var(--text-strong)] text-sm">{{ $ac['count'] }} لاعباً</span>
                        </div>
                        <div class="text-xs text-gray-600 bg-[var(--surface-subtle)]/80 border border-gray-200/60 p-3 rounded-lg leading-relaxed">
                            <span class="font-bold text-[var(--text-strong)] block mb-1">الهدف التدريبي للمرحلة:</span>
                            {{ $ac['focus'] }}
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <a href="{{ route('players.index') }}" class="inline-flex items-center gap-1 font-bold text-red-600 hover:text-red-700 transition-colors">
                        <span>استعراض القائمة</span>
                        <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                    </a>
                    <a href="{{ route('training.index') }}" class="text-[var(--text-muted)] hover:text-[var(--text)] font-medium">
                        الجدول التدريبي
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
