<div 
    x-data="{
        open: false,
        query: '',
        activeCategory: 'all',
        selectedIndex: 0,
        items: {{ json_encode(\App\Services\AcademyDataService::getSearchIndex()) }},
        get filteredItems() {
            if (!this.query && this.activeCategory === 'all') {
                return this.items.slice(0, 8);
            }
            return this.items.filter(item => {
                const matchesCat = this.activeCategory === 'all' || item.category === this.activeCategory;
                const matchesQuery = !this.query || 
                    item.title.toLowerCase().includes(this.query.toLowerCase()) || 
                    item.subtitle.toLowerCase().includes(this.query.toLowerCase()) ||
                    item.category_label_ar.toLowerCase().includes(this.query.toLowerCase());
                return matchesCat && matchesQuery;
            });
        },
        selectItem(index) {
            const list = this.filteredItems;
            if (list[index]) {
                window.location.href = list[index].url;
            }
        },
        handleKeyDown(e) {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                this.open = !this.open;
                if (this.open) {
                    this.$nextTick(() => this.$refs.searchInput.focus());
                }
            } else if (e.key === 'Escape' && this.open) {
                this.open = false;
            }
        }
    }"
    @keydown.window="handleKeyDown($event)"
    @open-command-palette.window="open = true; $nextTick(() => $refs.searchInput.focus())"
    x-cloak
>
    <!-- Modal Backdrop -->
    <div 
        x-show="open" 
        x-transition:enter="transition-opacity ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false" 
        class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-start justify-center pt-16 sm:pt-24 px-4"
    >
        <!-- Modal Card -->
        <div 
            @click.stop
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-2xl rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xl overflow-hidden font-arabic text-start text-[var(--text-strong)]"
        >
            <!-- Search Input Header -->
            <div class="relative flex items-center border-b border-[var(--border)] px-4 py-3 bg-[var(--surface-subtle)]">
                <i data-lucide="search" class="h-5 w-5 text-[var(--text-muted)] shrink-0"></i>
                <input 
                    x-ref="searchInput"
                    x-model="query"
                    @keydown.down.prevent="selectedIndex = Math.min(selectedIndex + 1, filteredItems.length - 1)"
                    @keydown.up.prevent="selectedIndex = Math.max(selectedIndex - 1, 0)"
                    @keydown.enter.prevent="selectItem(selectedIndex)"
                    type="search"
                    placeholder="ابحث في منظومة EAGLE OS (لاعب، مدرب، فريق، حصة تدريبية)..."
                    class="w-full bg-transparent border-0 py-1 ps-3 pe-8 text-sm text-[var(--text-strong)] placeholder-[var(--text-muted)] focus:ring-0 focus:outline-none"
                >
                <button @click="open = false" class="text-xs font-mono text-[var(--text-muted)] bg-[var(--surface)] border border-[var(--border)] px-1.5 py-0.5 rounded shadow-2xs hover:text-[var(--text-strong)]">
                    ESC
                </button>
            </div>

            <!-- Categories Tabs -->
            <div class="flex items-center gap-1.5 px-4 py-2 border-b border-[var(--border)] bg-[var(--surface)] text-xs overflow-x-auto">
                <button 
                    @click="activeCategory = 'all'; selectedIndex = 0"
                    :class="activeCategory === 'all' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    كافة النتائج
                </button>
                <button 
                    @click="activeCategory = 'players'; selectedIndex = 0"
                    :class="activeCategory === 'players' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    اللاعبين
                </button>
                <button 
                    @click="activeCategory = 'coaches'; selectedIndex = 0"
                    :class="activeCategory === 'coaches' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    الجهاز الفني
                </button>
                <button 
                    @click="activeCategory = 'teams'; selectedIndex = 0"
                    :class="activeCategory === 'teams' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    الفرق والقطاعات
                </button>
                <button 
                    @click="activeCategory = 'training'; selectedIndex = 0"
                    :class="activeCategory === 'training' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    التدريبات
                </button>
                <button 
                    @click="activeCategory = 'tactics'; selectedIndex = 0"
                    :class="activeCategory === 'tactics' ? 'bg-[var(--text-strong)] text-[var(--surface)] font-bold' : 'text-[var(--text-muted)] hover:bg-[var(--surface-subtle)]'"
                    class="px-2.5 py-1 rounded-md transition-colors shrink-0"
                >
                    التكتيك
                </button>
            </div>

            <!-- Results List -->
            <div class="max-h-80 overflow-y-auto divide-y divide-[var(--border-subtle)] p-1 text-xs">
                <template x-for="(item, index) in filteredItems" :key="item.id">
                    <a 
                        :href="item.url"
                        @mouseenter="selectedIndex = index"
                        :class="selectedIndex === index ? 'bg-[var(--surface-subtle)] border-s-2 border-[#E3131B]' : 'border-s-2 border-transparent'"
                        class="flex items-center justify-between p-3 rounded-md transition-all group cursor-pointer"
                    >
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="h-8 w-8 rounded-lg bg-[var(--surface-subtle)] border border-[var(--border)] flex items-center justify-center text-[var(--text-strong)] shrink-0 group-hover:bg-[var(--text-strong)] group-hover:text-[var(--surface)] transition-colors">
                                <i :data-lucide="item.icon" class="h-4 w-4"></i>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-[var(--text-strong)] truncate text-xs" x-text="item.title"></h4>
                                <p class="text-[11px] text-[var(--text-muted)] truncate mt-0.5" x-text="item.subtitle"></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-[var(--surface-subtle)] text-[var(--text-muted)] border border-[var(--border)]" x-text="item.category_label_ar"></span>
                            <i data-lucide="chevron-left" class="h-3.5 w-3.5 text-[var(--text-muted)] rtl:rotate-0 ltr:rotate-180 group-hover:text-[#E3131B] transition-colors"></i>
                        </div>
                    </a>
                </template>

                <div x-show="filteredItems.length === 0" class="py-10 text-center text-[var(--text-muted)]">
                    <i data-lucide="search-x" class="h-8 w-8 mx-auto text-[var(--text-muted)] mb-2"></i>
                    <p class="font-medium text-xs">لا توجد نتائج مطابقة لبحثك</p>
                    <p class="text-[11px] text-[var(--text-muted)] mt-0.5">جرّب البحث باسم لاعب، مدرب، أو فئة سنية (U-15, U-17)</p>
                </div>
            </div>

            <!-- Footer Keyboard Navigation Hints -->
            <div class="border-t border-[var(--border)] px-4 py-2.5 bg-[var(--surface-subtle)] flex items-center justify-between text-[11px] text-[var(--text-muted)]">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1">
                        <kbd class="px-1 py-0.5 rounded bg-[var(--surface)] border border-[var(--border)] text-[10px] font-mono">↑</kbd>
                        <kbd class="px-1 py-0.5 rounded bg-[var(--surface)] border border-[var(--border)] text-[10px] font-mono">↓</kbd>
                        <span>للتنقل</span>
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 rounded bg-[var(--surface)] border border-[var(--border)] text-[10px] font-mono">↵</kbd>
                        <span>للاختيار</span>
                    </span>
                </div>
                <span class="font-mono text-[10px]">EAGLE OS SEARCH ENGINE</span>
            </div>
        </div>
    </div>
</div>

