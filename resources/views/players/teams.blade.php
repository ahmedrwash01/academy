@extends('layouts.admin', ['title' => __('app.nav.teams')])

@section('content')
<div class="space-y-6 font-arabic">
    <x-page-header 
        :title="__('app.nav.teams')" 
        subtitle="القطاعات السنية والفرق الرسمية المشاركة في بطولات الاتحاد المصري ومنطقة القاهرة"
        badge="8 فرق رسمية معتمدة"
    >
        <x-slot:actions>
            <a href="{{ route('players.index') }}" class="inline-flex items-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3.5 py-2 text-xs font-bold text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors shadow-2xs">
                <i data-lucide="users" class="h-4 w-4 text-[var(--text-muted)]"></i>
                <span>قائمة اللاعبين</span>
            </a>
            <a href="{{ route('players.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-[#E3131B] px-4 py-2 text-xs font-bold text-white hover:bg-[#c00f16] transition-colors shadow-xs">
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                <span>قيد لاعب جديد</span>
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($teams as $team)
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-2xs hover:border-[var(--border-strong)] hover:shadow-xs transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-mono font-bold bg-[var(--surface-subtle)] text-[var(--text-strong)] border border-[var(--border)]">
                            {{ $team['age_group'] }}
                        </span>
                        <span class="text-xs text-[var(--text-muted)] font-semibold">{{ $team['category_ar'] }}</span>
                    </div>

                    <h3 class="text-base font-black text-[var(--text-strong)] mt-3 group-hover:text-[#E3131B] transition-colors">{{ $team['name_ar'] }}</h3>

                    <div class="mt-4 space-y-2 text-xs text-[var(--text-muted)]">
                        <div class="flex items-center justify-between">
                            <span>المدير الفني المشرف:</span>
                            <span class="font-bold text-[var(--text-strong)]">{{ $team['head_coach_ar'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>عدد اللاعبين المقيدين:</span>
                            <span class="font-mono font-bold text-[#E3131B]">{{ $team['players_count'] }} لاعباً</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>الملعب الرئيسي:</span>
                            <span class="font-semibold text-[var(--text-strong)]">{{ $team['ground_ar'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>أيام التدريب:</span>
                            <span class="font-semibold text-[var(--text-strong)]">{{ $team['training_days_ar'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3.5 border-t border-[var(--border)] flex items-center justify-between">
                    <a href="{{ route('players.index', ['age_group' => $team['age_group']]) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[var(--text-strong)] hover:text-[#E3131B] transition-colors">
                        <span>عرض لاعبي الفريق ({{ $team['players_count'] }})</span>
                        <i data-lucide="chevron-left" class="h-3.5 w-3.5 rtl:rotate-0 ltr:rotate-180"></i>
                    </a>
                    <a href="{{ route('training.index') }}" class="rounded-lg p-1.5 text-[var(--text-muted)] hover:text-[var(--text-strong)] hover:bg-[var(--surface-subtle)] transition-colors" title="جدول التدريبات">
                        <i data-lucide="calendar" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection