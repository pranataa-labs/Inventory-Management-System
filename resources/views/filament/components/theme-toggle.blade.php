<div x-data="{
    currentTheme: (localStorage.getItem('theme') === 'light') ? 'light' : 'system',
    setTheme(val) {
        this.currentTheme = val;
        localStorage.setItem('theme', val);
        const isDark = (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: val }));
    }
}" 
x-init="
    setTheme(currentTheme);
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (currentTheme === 'system') {
            if (e.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    });
"
class="flex items-center rounded-lg border border-slate-200 dark:border-white/10 bg-slate-100/90 dark:bg-slate-900/90 p-0.5 me-3 shadow-2xs">
    <!-- Light Button -->
    <button type="button" 
            @click="setTheme('light')" 
            :class="currentTheme === 'light' ? 'bg-white text-slate-900 shadow-xs dark:bg-slate-800 dark:text-slate-100 font-semibold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200'"
            class="flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md transition-all cursor-pointer"
            title="Mode Terang (Light)">
        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
        </svg>
        <span class="font-medium text-xs">Light</span>
    </button>

    <!-- System Button -->
    <button type="button" 
            @click="setTheme('system')" 
            :class="currentTheme === 'system' ? 'bg-white text-slate-900 shadow-xs dark:bg-slate-800 dark:text-slate-100 font-semibold' : 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200'"
            class="flex items-center gap-1.5 px-2.5 py-1 text-xs rounded-md transition-all cursor-pointer"
            title="Bawaan Sistem (Mengikuti setelan perangkat Anda)">
        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" />
        </svg>
        <span class="font-medium text-xs">Sistem</span>
    </button>
</div>
