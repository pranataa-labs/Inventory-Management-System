<x-filament-panels::page.simple>
    <div class="w-full space-y-5 -mt-4">
        {{-- Brand Header --}}
        <div class="flex flex-col items-center text-center space-y-2 mb-2">
            <div class="size-11 rounded-xl bg-slate-900 text-white dark:bg-slate-100 dark:text-slate-900 flex items-center justify-center shadow-xs">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Inventaris Studio</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Enterprise Inventory & Warehouse Management Suite</p>
        </div>

        {{-- Quick Demo Credentials Chips --}}
        <div class="rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50/80 dark:bg-slate-900/60 p-3 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Pilih Akun Demo:</span>
                <span class="text-[10px] text-slate-400">Klik untuk isi otomatis</span>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" 
                        onclick="fillCredentials('admin@inventory.test', 'password')"
                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors shadow-2xs cursor-pointer">
                    <span>👑 Super Admin</span>
                </button>
                <button type="button" 
                        onclick="fillCredentials('staff@inventory.test', 'password')"
                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors shadow-2xs cursor-pointer">
                    <span>📦 Staff Gudang</span>
                </button>
            </div>
        </div>

        {{-- Filament Authentication Form --}}
        <x-filament-panels::form id="form" wire:submit="authenticate">
            {{ $this->form }}

            <x-filament-panels::form.actions
                :actions="$this->getCachedFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        </x-filament-panels::form>

        <div class="pt-2 text-center border-t border-slate-200 dark:border-slate-800">
            <p class="text-[11px] text-slate-400 dark:text-slate-500">
                &copy; {{ date('Y') }} Inventaris Studio &bull; Developed by pranataa-labs
            </p>
        </div>
    </div>

    <script>
        function fillCredentials(email, password) {
            const emailInput = document.querySelector('input[type="email"]') || document.querySelector('input[id*="email"]');
            const passInput = document.querySelector('input[type="password"]') || document.querySelector('input[id*="password"]');
            
            if (emailInput && passInput) {
                emailInput.value = email;
                emailInput.dispatchEvent(new Event('input', { bubbles: true }));
                passInput.value = password;
                passInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
    </script>
</x-filament-panels::page.simple>
