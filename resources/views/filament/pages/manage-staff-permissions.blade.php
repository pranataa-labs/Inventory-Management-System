<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header Status Card (Shadcn Slate Aesthetic) --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xs">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-800 border border-slate-300">
                            <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Target Role: Staff Gudang
                        </span>
                        <span class="text-xs text-slate-500">
                            &bull; {{ \App\Models\User::role('Staff Gudang')->count() }} Karyawan Terdaftar
                        </span>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 tracking-tight">
                        Kontrol Hak Akses & Operasional Karyawan
                    </h2>
                    <p class="text-xs text-slate-500 max-w-2xl leading-relaxed">
                        Sebagai Super Admin, Anda dapat mengaktifkan atau menonaktifkan fitur apa saja yang diizinkan untuk dikelola oleh karyawan. Setiap perubahan yang disimpan langsung berlaku seketika tanpa perlu restart.
                    </p>
                </div>

                {{-- Quick Presets --}}
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider w-full md:w-auto">Preset Cepat:</span>
                    <button type="button" 
                            wire:click="applyPreset('standard')"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors shadow-2xs cursor-pointer">
                        <span>📦 Standar Gudang</span>
                    </button>
                    <button type="button" 
                            wire:click="applyPreset('readonly')"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors shadow-2xs cursor-pointer">
                        <span>👁️ Hanya Pantau</span>
                    </button>
                    <button type="button" 
                            wire:click="applyPreset('all')"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md border border-slate-300 bg-slate-50 text-slate-700 hover:bg-slate-100 hover:text-slate-900 transition-colors shadow-2xs cursor-pointer">
                        <span>🚀 Akses Penuh</span>
                    </button>
                    <button type="button" 
                            wire:click="applyPreset('none')"
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors shadow-2xs cursor-pointer">
                        <span>🔒 Kunci Semua</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Permission Form --}}
        <form wire:submit="save">
            {{ $this->form }}

            <div class="mt-6 flex justify-end">
                <x-filament-panels::form.actions
                    :actions="$this->getFormActions()"
                />
            </div>
        </form>
    </div>
</x-filament-panels::page>
