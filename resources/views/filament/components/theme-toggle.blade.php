<div x-data="{
    currentTheme: localStorage.getItem('theme') || 'system',
    setTheme(val) {
        this.currentTheme = val;
        localStorage.setItem('theme', val);
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: val }));
        const isDark = val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" 
x-init="
    setTheme(currentTheme);
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if (currentTheme === 'system') setTheme('system');
    });
"
class="flex items-center rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-100/90 dark:bg-slate-900/90 p-1 me-3 shadow-2xs">
    <!-- Light Button -->
    <button type="button" 
            @click="setTheme('light')" 
            :class="currentTheme === 'light' ? 'bg-white text-slate-900 shadow-xs dark:bg-slate-800 dark:text-slate-100 font-semibold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100'"
            class="flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md transition-all cursor-pointer"
            title="Mode Terang (Light)">
        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
        <span class="font-medium">Light</span>
    </button>

    <!-- Dark Button -->
    <button type="button" 
            @click="setTheme('dark')" 
            :class="currentTheme === 'dark' ? 'bg-white text-slate-900 shadow-xs dark:bg-slate-800 dark:text-slate-100 font-semibold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100'"
            class="flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md transition-all cursor-pointer"
            title="Mode Gelap (Dark)">
        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
        </svg>
        <span class="font-medium">Dark</span>
    </button>

    <!-- System Button -->
    <button type="button" 
            @click="setTheme('system')" 
            :class="currentTheme === 'system' ? 'bg-white text-slate-900 shadow-xs dark:bg-slate-800 dark:text-slate-100 font-semibold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100'"
            class="flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md transition-all cursor-pointer"
            title="Ikuti Sistem (System)">
        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" />
        </svg>
        <span class="font-medium">System</span>
    </button>
</div>
