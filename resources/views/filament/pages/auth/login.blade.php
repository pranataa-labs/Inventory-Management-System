<x-filament-panels::page.simple>
    <div class="w-full space-y-4">
        {{-- Quick Demo Credentials Chips --}}
        <div class="rounded-lg border border-slate-200 bg-slate-50/80 p-3 space-y-2">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Pilih Akun Demo:</span>
                <span class="text-[10px] text-slate-400">Klik untuk isi otomatis</span>
            </div>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" 
                        wire:click="fillDemo('admin')"
                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 hover:text-slate-900 active:bg-slate-200 transition-colors shadow-2xs cursor-pointer">
                    <span>👑 Super Admin</span>
                </button>
                <button type="button" 
                        wire:click="fillDemo('staff')"
                        class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 bg-white text-slate-700 hover:bg-slate-100 hover:text-slate-900 active:bg-slate-200 transition-colors shadow-2xs cursor-pointer">
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

        <div class="pt-2 text-center border-t border-slate-200">
            <p class="text-[11px] text-slate-400">
                &copy; {{ date('Y') }} Inventaris Studio &bull; Developed by pranataa-labs
            </p>
        </div>
    </div>
</x-filament-panels::page.simple>
