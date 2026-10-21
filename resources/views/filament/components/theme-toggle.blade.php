<div x-data="{
    open: false,
    theme: localStorage.getItem('theme') || 'system',
    init() {
        this.applyTheme(this.theme);
    },
    setTheme(val) {
        this.theme = val;
        localStorage.setItem('theme', val);
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: val }));
        this.applyTheme(val);
        this.open = false;
    },
    applyTheme(val) {
        const isDark = val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" class="relative inline-flex items-center me-2">
    <button @click="open = !open" type="button" aria-label="Toggle theme" 
            class="inline-flex size-9 items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/90 text-slate-700 dark:text-slate-200 shadow-2xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-all cursor-pointer">
        <!-- Sun Icon (Light) -->
        <svg x-show="theme === 'light'" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
        <!-- Moon Icon (Dark) -->
        <svg x-show="theme === 'dark'" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
        <!-- Laptop / System Icon -->
        <svg x-show="theme === 'system'" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" />
        </svg>
    </button>

    <!-- Theme Dropdown -->
    <div x-show="open" @click.outside="open = false" x-cloak
         class="absolute right-0 top-full mt-2 w-32 rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-1 text-slate-800 dark:text-slate-200 shadow-lg z-50">
        <button type="button" @click="setTheme('light')" 
                class="w-full flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-left"
                :class="{ 'font-semibold bg-slate-100 dark:bg-slate-800': theme === 'light' }">
            <span>☀️ Light</span>
        </button>
        <button type="button" @click="setTheme('dark')" 
                class="w-full flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-left"
                :class="{ 'font-semibold bg-slate-100 dark:bg-slate-800': theme === 'dark' }">
            <span>🌙 Dark</span>
        </button>
        <button type="button" @click="setTheme('system')" 
                class="w-full flex items-center gap-2 rounded-md px-2.5 py-1.5 text-xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-left"
                :class="{ 'font-semibold bg-slate-100 dark:bg-slate-800': theme === 'system' }">
            <span>💻 System</span>
        </button>
    </div>
</div>
