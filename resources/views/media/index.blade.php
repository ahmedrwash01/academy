@extends('layouts.admin', ['title' => __('app.nav.media')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.media')" 
        subtitle="معرض الصور، التغطيات التلفزيونية، وسجل البطولات والدروع الرسمية"
        badge="المركز الإعلامي والتوثيق"
    />

    <!-- Trophies & Achievements Showcase -->
    <div class="rounded-xl bg-[#0E0F12] text-white p-6 shadow-2xs border border-[#1C1F26]">
        <div class="flex items-center gap-3 border-b border-[#1C1F26] pb-4 mb-5">
            <div class="h-10 w-10 rounded-lg bg-amber-500/10 text-amber-500 flex items-center justify-center border border-amber-500/20">
                <i data-lucide="trophy" class="h-5 w-5"></i>
            </div>
            <div>
                <h3 class="text-base font-black">سجل الشرف والبطولات الرسمية المعتمدة</h3>
                <p class="text-xs text-[var(--text-muted)]">إنجازات قطاعات الناشئين والبراعم والفرق التنافسية للأكاديمية</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($trophies as $t)
                <div class="p-4 rounded-lg bg-[#181B22] border border-[#262B35] flex items-center gap-4">
                    <div class="text-2xl">🏆</div>
                    <div>
                        <h4 class="font-bold text-white text-xs">{{ $t['title'] }}</h4>
                        <p class="text-[11px] text-amber-400 font-mono mt-0.5">{{ $t['category'] }} • {{ $t['date'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Photo Gallery -->
    <div class="rounded-xl border border-gray-200/80 bg-[var(--surface)] p-5 shadow-2xs space-y-4">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
            <h3 class="text-sm font-bold text-[var(--text-strong)]">أحدث الصور واللقطات الميدانية للتدريبات</h3>
            <span class="text-xs text-[var(--text-muted)] font-mono">120 لقطة موثقة</span>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="group relative overflow-hidden rounded-lg bg-gray-100 h-44 shadow-2xs">
                <img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=400&auto=format&fit=crop&q=80" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3 text-white text-xs font-bold">
                    مران فريق U-15 التكتيكي
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-lg bg-gray-100 h-44 shadow-2xs">
                <img src="https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=400&auto=format&fit=crop&q=80" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3 text-white text-xs font-bold">
                    تدريبات حراس المرمى التخصصية
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-lg bg-gray-100 h-44 shadow-2xs">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400&auto=format&fit=crop&q=80" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3 text-white text-xs font-bold">
                    مباراة سوبر دوري القاهرة
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-lg bg-gray-100 h-44 shadow-2xs">
                <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e?w=400&auto=format&fit=crop&q=80" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3 text-white text-xs font-bold">
                    حفل تكريم المتفوقين دراسياً
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
