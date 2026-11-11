// Eagle OS High-Speed Seamless SPA Navigation Engine
class SpaNavigator {
    constructor() {
        this.cache = new Map();
        this.progressBar = null;
        this.isNavigating = false;
        this.init();
    }

    init() {
        this.createProgressBar();
        this.interceptLinks();
        this.handlePopState();
        this.highlightActiveLink(window.location.pathname);
    }

    createProgressBar() {
        this.progressBar = document.createElement('div');
        this.progressBar.id = 'eagle-spa-progress';
        this.progressBar.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #E3131B, #ff4d4f);
            z-index: 99999;
            width: 0%;
            transition: width 0.15s ease, opacity 0.15s ease;
            opacity: 0;
            pointer-events: none;
        `;
        document.body.appendChild(this.progressBar);
    }

    startProgress() {
        this.progressBar.style.opacity = '1';
        this.progressBar.style.width = '35%';
        setTimeout(() => {
            if (this.progressBar.style.opacity === '1') {
                this.progressBar.style.width = '75%';
            }
        }, 50);
    }

    endProgress() {
        this.progressBar.style.width = '100%';
        setTimeout(() => {
            this.progressBar.style.opacity = '0';
            setTimeout(() => {
                this.progressBar.style.width = '0%';
            }, 150);
        }, 100);
    }

    interceptLinks() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link) return;

            const href = link.getAttribute('href');
            if (!href) return;

            // Don't intercept external links, anchors, or download links
            if (
                href.startsWith('#') ||
                href.startsWith('javascript:') ||
                href.startsWith('mailto:') ||
                href.startsWith('tel:') ||
                link.hasAttribute('download') ||
                link.getAttribute('target') === '_blank' ||
                link.getAttribute('data-no-spa') !== null ||
                e.ctrlKey || e.metaKey || e.shiftKey
            ) {
                return;
            }

            // Only intercept same-origin links
            try {
                const url = new URL(link.href, window.location.origin);
                if (url.origin !== window.location.origin) return;

                // Don't intercept lang switch or auth logout
                if (url.pathname.startsWith('/lang') || url.pathname.startsWith('/login')) {
                    return;
                }

                // If clicking current exact URL, do nothing
                if (url.pathname === window.location.pathname && url.search === window.location.search) {
                    e.preventDefault();
                    return;
                }

                e.preventDefault();
                this.navigateTo(url.href, true);
            } catch (err) {
                // Allow default navigation
            }
        });
    }

    handlePopState() {
        window.addEventListener('popstate', () => {
            this.navigateTo(window.location.href, false);
        });
    }

    async navigateTo(url, push = true) {
        if (this.isNavigating) return;
        this.isNavigating = true;
        this.startProgress();

        try {
            let htmlText = this.cache.get(url);
            if (!htmlText) {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                if (!response.ok) {
                    window.location.href = url;
                    return;
                }
                htmlText = await response.text();
                if (this.cache.size > 20) {
                    const firstKey = this.cache.keys().next().value;
                    this.cache.delete(firstKey);
                }
                this.cache.set(url, htmlText);
            }

            const parser = new DOMParser();
            const newDoc = parser.parseFromString(htmlText, 'text/html');

            const currentMain = document.querySelector('main');
            const newMain = newDoc.querySelector('main');

            if (!currentMain || !newMain) {
                window.location.href = url;
                return;
            }

            // 1. Update Title
            document.title = newDoc.title;

            // 2. Update Header Title if present
            const currentHeaderTitle = document.querySelector('header h1');
            const newHeaderTitle = newDoc.querySelector('header h1');
            if (currentHeaderTitle && newHeaderTitle) {
                currentHeaderTitle.innerHTML = newHeaderTitle.innerHTML;
            }

            // 3. Smooth swap of main content
            currentMain.style.opacity = '0';
            currentMain.style.transition = 'opacity 0.08s ease';

            setTimeout(() => {
                currentMain.innerHTML = newMain.innerHTML;
                currentMain.className = newMain.className;
                currentMain.style.opacity = '1';

                // 4. Update browser URL history
                if (push) {
                    window.history.pushState({}, '', url);
                }

                // 5. Scroll to top smoothly
                window.scrollTo({ top: 0, behavior: 'instant' });

                // 6. Highlight active link in the permanently fixed sidebar
                const urlObj = new URL(url, window.location.origin);
                this.highlightActiveLink(urlObj.pathname);

                // 7. Reinitialize Alpine and Lucide
                this.reinitializeDom(currentMain, newDoc);

                this.endProgress();
                this.isNavigating = false;
            }, 80);

        } catch (err) {
            console.error('SPA navigation error, falling back to full reload:', err);
            window.location.href = url;
        }
    }

    highlightActiveLink(pathname) {
        const sidebars = document.querySelectorAll('aside');
        if (!sidebars.length) return;

        // Determine which group should be active exclusively
        let targetGroup = null;
        if (pathname.startsWith('/players') || pathname.startsWith('/scouting')) {
            targetGroup = 'players';
        } else if (pathname.startsWith('/coaches') || pathname.startsWith('/training') || pathname.startsWith('/attendance') || pathname.startsWith('/competitions')) {
            targetGroup = 'training';
        } else if (pathname.startsWith('/finance') || pathname.startsWith('/subscriptions') || pathname.startsWith('/payments')) {
            targetGroup = 'finance';
        } else if (pathname.startsWith('/academy') || pathname.startsWith('/sponsors') || pathname.startsWith('/media') || pathname.startsWith('/sportswear') || pathname.startsWith('/complaints')) {
            targetGroup = 'governance';
        }

        sidebars.forEach(sidebar => {
            // Update activeGroup in the exclusive accordion state
            const navContainer = sidebar.querySelector('[x-data]');
            if (navContainer && navContainer._x_dataStack && navContainer._x_dataStack[0]) {
                navContainer._x_dataStack[0].activeGroup = targetGroup;
            }

            const links = sidebar.querySelectorAll('a[href]');
            links.forEach(a => {
                try {
                    const aUrl = new URL(a.href, window.location.origin);
                    const isExact = aUrl.pathname === pathname;
                    const isDashboard = pathname === '/' && aUrl.pathname === '/';

                    // Skip logo link
                    if (a.querySelector('img[alt="EAGLE OS"]')) return;

                    const activeClasses = ['bg-[var(--bg-sidebar-active)]', 'text-[var(--text-sidebar-active)]', 'font-black', 'border-s-[3px]', 'border-s-[#E3131B]'];
                    const inactiveClasses = ['text-[var(--text-sidebar-muted)]'];

                    if (isExact || (isDashboard && aUrl.pathname === '/')) {
                        a.classList.remove('bg-[#1B1D21]', 'text-white', 'text-[#A0A3AA]', 'hover:bg-[#1B1D21]/60', 'hover:text-white', ...inactiveClasses);
                        a.classList.add(...activeClasses);
                    } else {
                        a.classList.remove('bg-[#1B1D21]', 'text-white', 'hover:bg-[#1B1D21]/60', 'hover:text-white', ...activeClasses);
                        a.classList.add(...inactiveClasses);
                    }
                } catch (e) {}
            });
        });
    }

    reinitializeDom(container, newDoc) {
        // Reinitialize Lucide Icons
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }

        // Reinitialize Alpine on the new DOM tree
        if (window.Alpine) {
            window.Alpine.initTree(container);
        }

        // Execute scripts inside @push('scripts') that came with the new page
        const scripts = newDoc.querySelectorAll('script');
        scripts.forEach(s => {
            if (!s.src && s.textContent.trim().length > 0 && !s.textContent.includes('vite') && !s.textContent.includes('app.js')) {
                try {
                    // Replace DOMContentLoaded wrapper with immediate execution
                    let scriptContent = s.textContent.replace(
                        /document\.addEventListener\(['"]DOMContentLoaded['"],\s*function\s*\(\)\s*\{/g,
                        '(function(){'
                    );
                    const newScript = document.createElement('script');
                    newScript.textContent = scriptContent;
                    document.body.appendChild(newScript);
                    setTimeout(() => newScript.remove(), 200);
                } catch (e) {
                    console.warn('Script execution error:', e);
                }
            }
        });

        // Trigger custom page:loaded event
        window.dispatchEvent(new CustomEvent('page:loaded'));

        // Reinitialize Dashboard Charts if present
        if (typeof window.renderEagleCharts === 'function') {
            setTimeout(window.renderEagleCharts, 40);
        }
    }
}

export default SpaNavigator;

