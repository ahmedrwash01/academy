<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="h-full bg-[var(--bg)]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? __('app.nav.dashboard') }} — EAGLE OS | {{ __('app.academy_name') }}</title>

    <!-- Academy Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/academy-logo.png') }}">

    <!-- Critical Zero-Flash Dark Mode Script -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Critical Alpine x-cloak style to prevent flashing cards/modals on load -->
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <!-- Google Fonts: IBM Plex Sans Arabic, Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Local Offline ApexCharts Engine for Guaranteed Instant Chart Rendering -->
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>

    @stack('styles')
</head>
<body 
    x-data="{ 
        sidebarOpen: false, 
        darkMode: localStorage.getItem('theme') === 'dark',
        isRtl: {{ app()->getLocale() === 'ar' ? 'true' : 'false' }},
        toastMessage: '',
        showToast(msg) {
            this.toastMessage = typeof msg === 'object' ? (msg.detail || msg.message || '') : msg;
            setTimeout(() => this.toastMessage = '', 4000);
        }
    }" 
    @show-toast.window="showToast($event.detail)"
    class="h-full font-sans antialiased text-[var(--text)] bg-[var(--bg)] selection:bg-[#E3131B] selection:text-white"
>
    <div class="min-h-screen flex flex-row bg-[var(--bg)] overflow-x-hidden">
        <!-- Sidebar Navigation (Desktop Fixed Flow + Mobile Drawer) -->
        @include('layouts.partials.sidebar')

        <!-- Main Workspace Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 min-h-screen bg-[var(--bg)] overflow-x-hidden">
            <!-- Clean Editorial Topbar -->
            @include('layouts.partials.topbar')

            <!-- Main Workspace Container -->
            <main class="flex-1 w-full max-w-[1440px] mx-auto px-4 sm:px-6 py-3.5 sm:py-4">
                <!-- Session Alert Messages -->
                @if(session('success'))
                    <div class="mb-6 rounded-lg border border-emerald-200 bg-white p-4 text-sm text-[#111214] flex items-center justify-between shadow-xs">
                        <div class="flex items-center gap-3">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                                <i data-lucide="check" class="h-4 w-4"></i>
                            </span>
                            <span class="font-medium font-arabic">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Global Command Palette Modal (Ctrl+K) -->
    @include('layouts.partials.command-palette')

    <!-- Global Toast Notification -->
    <div 
        x-show="toastMessage" 
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 end-6 z-50 flex items-center gap-3 rounded-lg border border-[var(--border)] bg-[var(--surface)] px-4 py-3 shadow-xl"
    >
        <span class="h-2 w-2 rounded-full bg-[#E3131B] animate-pulse"></span>
        <p class="text-xs font-semibold text-[var(--text-strong)] font-arabic" x-text="toastMessage"></p>
    </div>

    <!-- Scripts stack and lucide icon re-triggering -->
    @stack('scripts')
    <script>
        window.showToast = function(msg) {
            window.dispatchEvent(new CustomEvent('show-toast', { detail: typeof msg === 'object' ? (msg.detail || msg.message || '') : msg }));
        };
        window.$toast = {
            success: (msg) => window.showToast(msg),
            error: (msg) => window.showToast(msg),
            info: (msg) => window.showToast(msg)
        };

        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
