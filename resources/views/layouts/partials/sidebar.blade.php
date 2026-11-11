<!-- 1. Desktop Permanent Sticky Sidebar (Strictly in flex flow, never floats, never overlaps) -->
<aside class="hidden lg:flex lg:flex-col lg:w-[260px] lg:sticky lg:top-0 lg:h-screen lg:shrink-0 bg-[var(--bg-sidebar)] text-[var(--text-sidebar-muted)] border-e border-[var(--border)] font-arabic select-none z-30">
    @include('layouts.partials.sidebar-content')
</aside>

<!-- 2. Mobile Slide-over Drawer (Only on mobile viewport when sidebarOpen is true) -->
<div 
    x-show="sidebarOpen" 
    x-cloak 
    class="fixed inset-0 z-50 flex lg:hidden"
    :class="isRtl ? 'justify-start' : 'justify-end'"
    role="dialog" 
    aria-modal="true"
>
    <!-- Dark Backdrop -->
    <div 
        @click="sidebarOpen = false" 
        class="fixed inset-0 bg-black/60 backdrop-blur-xs"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <!-- Drawer Panel -->
    <div 
        class="relative flex w-[260px] max-w-[85vw] flex-col bg-[var(--bg-sidebar)] text-[var(--text-sidebar-muted)] border-e border-[var(--border)] font-arabic z-50 h-full shadow-2xl"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
    >
        @include('layouts.partials.sidebar-content')
    </div>
</div>
