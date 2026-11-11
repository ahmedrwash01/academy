@props([
    'duration' => 4000,
])

<div 
    x-data="{
        messages: [],
        add(msg, type = 'info') {
            const id = Date.now();
            this.messages.push({ id, msg, type });
            setTimeout(() => {
                this.remove(id);
            }, {{ $duration }});
        },
        remove(id) {
            this.messages = this.messages.filter(m => m.id !== id);
        }
    }"
    x-on:toast.window="add($event.detail.message || $event.detail, $event.detail.type || 'info')"
    class="fixed bottom-6 end-6 z-50 flex flex-col gap-2.5 max-w-sm w-full pointer-events-none font-arabic"
>
    <template x-for="item in messages" :key="item.id">
        <div 
            x-show="true"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-3 scale-95"
            class="pointer-events-auto flex items-center justify-between gap-3 p-3.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-xl text-xs text-[var(--text)]"
        >
            <div class="flex items-center gap-2.5">
                <span 
                    class="h-2 w-2 rounded-full shrink-0"
                    :class="{
                        'bg-emerald-500': item.type === 'success',
                        'bg-[#E3131B]': item.type === 'danger',
                        'bg-amber-500': item.type === 'warning',
                        'bg-sky-500': item.type === 'info'
                    }"
                ></span>
                <span class="font-bold" x-text="item.msg"></span>
            </div>

            <button 
                type="button" 
                @click="remove(item.id)" 
                class="text-[var(--text-muted)] hover:text-[var(--text-strong)] p-0.5"
            >
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>

