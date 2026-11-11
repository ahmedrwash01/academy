@extends('layouts.guest', ['title' => __('app.nav.administration') . ' - تسجيل الدخول'])

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md px-4 font-arabic">
    <!-- Language Toggle Top Right -->
    <div class="flex justify-end mb-4">
        @php
            $targetLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
            $targetText = app()->getLocale() === 'ar' ? 'English (LTR)' : 'العربية (RTL)';
        @endphp
        <a href="{{ route('lang.switch', $targetLocale) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded border border-[#222222] text-xs font-medium bg-[#151515] text-[#A0A0A0] hover:text-white transition-colors">
            <i data-lucide="globe" class="h-3.5 w-3.5 text-[#E3131B]"></i>
            <span>{{ $targetText }}</span>
        </a>
    </div>

    <!-- Academy Brand Center -->
    <div class="text-center">
        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-md bg-[#151515] p-2 border border-[#222222]">
            <img src="{{ asset('images/academy-logo.png') }}" alt="Eagles Academy Logo" class="h-14 w-14 object-contain">
        </div>
        <h2 class="mt-4 text-xl font-bold tracking-tight text-white">
            {{ __('app.academy_name') }}
        </h2>
        <p class="mt-0.5 text-xs text-[#777777] font-medium tracking-wider uppercase font-mono">
            منظومة العمليات الرياضية المركزية
        </p>
    </div>

    <!-- Login Box -->
    <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md" x-data="{ showPassword: false }">
        <div class="bg-[#151515] py-7 px-6 rounded-md border border-[#222222] sm:px-8 shadow-sm">
            <form action="{{ route('dashboard') }}" method="GET" class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-medium text-[#A0A0A0]">
                        البريد الإلكتروني للإدارة
                    </label>
                    <div class="mt-1.5 relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-[#666666]">
                            <i data-lucide="mail" class="h-3.5 w-3.5"></i>
                        </div>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            value="director@eagles-academy.com" 
                            required 
                            class="block w-full rounded border border-[#2A2A2A] bg-[#111111] py-2 ps-9 pe-3 text-xs text-white placeholder-[#666666] focus:border-[#E3131B] focus:outline-none transition-colors"
                        >
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-[#A0A0A0]">
                        كلمة المرور
                    </label>
                    <div class="mt-1.5 relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-[#666666]">
                            <i data-lucide="lock" class="h-3.5 w-3.5"></i>
                        </div>
                        <input 
                            id="password" 
                            name="password" 
                            :type="showPassword ? 'text' : 'password'" 
                            value="••••••••••••" 
                            required 
                            class="block w-full rounded border border-[#2A2A2A] bg-[#111111] py-2 ps-9 pe-9 text-xs text-white placeholder-[#666666] focus:border-[#E3131B] focus:outline-none transition-colors font-mono"
                        >
                        <button 
                            type="button" 
                            @click="showPassword = !showPassword" 
                            class="absolute inset-y-0 end-0 flex items-center pe-3 text-[#666666] hover:text-white"
                        >
                            <i data-lucide="eye" x-show="!showPassword" class="h-3.5 w-3.5"></i>
                            <i data-lucide="eye-off" x-show="showPassword" class="h-3.5 w-3.5" style="display: none;"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-[#777777]">
                        <input type="checkbox" checked class="rounded border-[#2A2A2A] bg-[#111111] text-[#E3131B] focus:ring-0">
                        <span>تذكر الجلسة</span>
                    </label>
                    <a href="#" class="text-xs text-[#A0A0A0] hover:text-white">استعادة الرمز؟</a>
                </div>

                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full flex justify-center items-center gap-2 rounded bg-[#E3131B] py-2.5 px-4 text-xs font-bold text-white hover:bg-[#c90f16] transition-colors"
                    >
                        <i data-lucide="log-in" class="h-3.5 w-3.5"></i>
                        <span>دخول النظام المركزي</span>
                    </button>
                </div>
            </form>

            <div class="mt-5 border-t border-[#222222] pt-3.5 text-center">
                <span class="text-[11px] text-[#666666] font-mono">
                    نسخة العرض التنفيذي — بيانات الدخول جاهزة مباشرة
                </span>
            </div>
        </div>

        <p class="mt-6 text-center text-xs text-[#555555]">
            {{ __('app.footer.rights') }}
        </p>
    </div>
</div>
@endsection
