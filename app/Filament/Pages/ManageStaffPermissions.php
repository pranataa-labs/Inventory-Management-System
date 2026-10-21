<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ManageStaffPermissions extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Pengaturan Sistem';
    protected static ?string $navigationLabel = 'Hak Akses Karyawan';
    protected static ?string $title = 'Pengaturan Hak Akses Karyawan';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.manage-staff-permissions';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Admin') ?? false;
    }

    public function mount(): void
    {
        $role = Role::firstOrCreate(['name' => 'Staff Gudang', 'guard_name' => 'web']);
        $assigned = $role->permissions->pluck('name')->toArray();

        $allPermissionKeys = [
            'products_view' => in_array('products.view', $assigned),
            'products_create' => in_array('products.create', $assigned),
            'products_edit' => in_array('products.edit', $assigned),
            'products_delete' => in_array('products.delete', $assigned),

            'movements_view' => in_array('movements.view', $assigned),
            'movements_create' => in_array('movements.create', $assigned),

            'stock_takes_view' => in_array('stock_takes.view', $assigned),
            'stock_takes_create' => in_array('stock_takes.create', $assigned),
            'stock_takes_edit' => in_array('stock_takes.edit', $assigned),
            'stock_takes_delete' => in_array('stock_takes.delete', $assigned),

            'qr_scan' => in_array('qr.scan', $assigned),

            'master_categories' => in_array('master.categories', $assigned),
            'master_units' => in_array('master.units', $assigned),
            'master_suppliers' => in_array('master.suppliers', $assigned),
            'master_warehouses' => in_array('master.warehouses', $assigned),

            'audit_view' => in_array('audit.view', $assigned),
        ];

        $this->form->fill($allPermissionKeys);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Katalog Barang & Harga')
                    ->description('Atur wewenang karyawan dalam melihat, menambah, mengubah, dan menghapus barang di inventaris.')
                    ->icon('heroicon-o-cube')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('products_view')
                                ->label('Lihat Katalog Barang')
                                ->helperText('Izinkan staf melihat daftar seluruh stok barang')
                                ->default(true),
                            Toggle::make('products_create')
                                ->label('Tambah Barang Baru')
                                ->helperText('Izinkan staf mendaftarkan item atau SKU baru ke katalog'),
                            Toggle::make('products_edit')
                                ->label('Ubah / Edit Barang & Harga')
                                ->helperText('Izinkan staf mengubah nama, harga beli, jual, atau detail barang'),
                            Toggle::make('products_delete')
                                ->label('Hapus Barang')
                                ->helperText('Izinkan staf menghapus data barang dari inventaris (sensitif)'),
                        ]),
                    ]),

                Section::make('Transaksi & Mutasi Gudang')
                    ->description('Wewenang untuk melakukan pergerakan stok (Barang Masuk, Barang Keluar, dan Transfer Gudang).')
                    ->icon('heroicon-o-arrows-right-left')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('movements_view')
                                ->label('Lihat Riwayat Mutasi')
                                ->helperText('Melihat catatan keluar-masuk barang')
                                ->default(true),
                            Toggle::make('movements_create')
                                ->label('Buat Mutasi Barang')
                                ->helperText('Input transaksi barang masuk, keluar, atau transfer antar gudang')
                                ->default(true),
                        ]),
                    ]),

                Section::make('Stock Opname (Pemeriksaan Fisik)')
                    ->description('Pengaturan audit fisik periodik untuk mencocokkan stok nyata dengan stok sistem.')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('stock_takes_view')
                                ->label('Lihat Sesi Stock Opname')
                                ->helperText('Melihat sesi pemeriksaan fisik yang sedang berjalan atau selesai')
                                ->default(true),
                            Toggle::make('stock_takes_create')
                                ->label('Buka Sesi Opname Baru')
                                ->helperText('Membuat sesi audit fisik baru untuk gudang tertentu'),
                            Toggle::make('stock_takes_edit')
                                ->label('Input / Catat Hitungan Fisik')
                                ->helperText('Mengisi jumlah fisik barang saat proses opname berlangsung')
                                ->default(true),
                            Toggle::make('stock_takes_delete')
                                ->label('Hapus Sesi Stock Opname')
                                ->helperText('Membatalkan atau menghapus draft sesi audit fisik'),
                        ]),
                    ]),

                Section::make('Scanner Barcode & QR Code')
                    ->description('Akses modul kamera untuk scan SKU dan mutasi instan.')
                    ->icon('heroicon-o-camera')
                    ->collapsible()
                    ->schema([
                        Toggle::make('qr_scan')
                            ->label('Akses Scanner QR')
                            ->helperText('Gunakan kamera ponsel/laptop untuk scan kode SKU barang')
                            ->default(true),
                    ]),

                Section::make('Data Master Operasional')
                    ->description('Pengelolaan data induk gudang, supplier, kategori, dan satuan.')
                    ->icon('heroicon-o-circle-stack')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Toggle::make('master_categories')
                                ->label('Kelola Kategori')
                                ->helperText('Tambah, edit, dan hapus kategori produk'),
                            Toggle::make('master_units')
                                ->label('Kelola Satuan (Unit)')
                                ->helperText('Tambah, edit, dan hapus satuan unit (Pcs, Box, Kg)'),
                            Toggle::make('master_suppliers')
                                ->label('Kelola Pemasok (Supplier)')
                                ->helperText('Tambah, edit, dan hapus kontak vendor pemasok'),
                            Toggle::make('master_warehouses')
                                ->label('Kelola Gudang & Lokasi')
                                ->helperText('Tambah, edit, dan hapus data gudang penyimpanan fisik'),
                        ]),
                    ]),

                Section::make('Audit Trail & Log Keamanan')
                    ->description('Rekaman jejak aktivitas dan perubahan data sistem.')
                    ->icon('heroicon-o-shield-exclamation')
                    ->collapsible()
                    ->schema([
                        Toggle::make('audit_view')
                            ->label('Lihat Log Audit Trail')
                            ->helperText('Melihat aktivitas login, pembuatan, dan pengubahan data oleh semua pengguna'),
                    ]),
            ])
            ->statePath('data');
    }

    public function applyPreset(string $preset): void
    {
        $states = match ($preset) {
            'all' => [
                'products_view' => true,
                'products_create' => true,
                'products_edit' => true,
                'products_delete' => true,
                'movements_view' => true,
                'movements_create' => true,
                'stock_takes_view' => true,
                'stock_takes_create' => true,
                'stock_takes_edit' => true,
                'stock_takes_delete' => true,
                'qr_scan' => true,
                'master_categories' => true,
                'master_units' => true,
                'master_suppliers' => true,
                'master_warehouses' => true,
                'audit_view' => true,
            ],
            'standard' => [
                'products_view' => true,
                'products_create' => false,
                'products_edit' => false,
                'products_delete' => false,
                'movements_view' => true,
                'movements_create' => true,
                'stock_takes_view' => true,
                'stock_takes_create' => false,
                'stock_takes_edit' => true,
                'stock_takes_delete' => false,
                'qr_scan' => true,
                'master_categories' => false,
                'master_units' => false,
                'master_suppliers' => false,
                'master_warehouses' => false,
                'audit_view' => false,
            ],
            'readonly' => [
                'products_view' => true,
                'products_create' => false,
                'products_edit' => false,
                'products_delete' => false,
                'movements_view' => true,
                'movements_create' => false,
                'stock_takes_view' => true,
                'stock_takes_create' => false,
                'stock_takes_edit' => false,
                'stock_takes_delete' => false,
                'qr_scan' => false,
                'master_categories' => false,
                'master_units' => false,
                'master_suppliers' => false,
                'master_warehouses' => false,
                'audit_view' => false,
            ],
            'none' => [
                'products_view' => false,
                'products_create' => false,
                'products_edit' => false,
                'products_delete' => false,
                'movements_view' => false,
                'movements_create' => false,
                'stock_takes_view' => false,
                'stock_takes_create' => false,
                'stock_takes_edit' => false,
                'stock_takes_delete' => false,
                'qr_scan' => false,
                'master_categories' => false,
                'master_units' => false,
                'master_suppliers' => false,
                'master_warehouses' => false,
                'audit_view' => false,
            ],
            default => [],
        };

        $this->form->fill($states);

        Notification::make()
            ->title('Preset Berhasil Diterapkan')
            ->body('Silakan klik Simpan Pengaturan untuk memberlakukan.')
            ->info()
            ->send();
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $map = [
            'products_view' => 'products.view',
            'products_create' => 'products.create',
            'products_edit' => 'products.edit',
            'products_delete' => 'products.delete',

            'movements_view' => 'movements.view',
            'movements_create' => 'movements.create',

            'stock_takes_view' => 'stock_takes.view',
            'stock_takes_create' => 'stock_takes.create',
            'stock_takes_edit' => 'stock_takes.edit',
            'stock_takes_delete' => 'stock_takes.delete',

            'qr_scan' => 'qr.scan',

            'master_categories' => 'master.categories',
            'master_units' => 'master.units',
            'master_suppliers' => 'master.suppliers',
            'master_warehouses' => 'master.warehouses',

            'audit_view' => 'audit.view',
        ];

        $granted = [];
        foreach ($map as $key => $perm) {
            if (!empty($data[$key])) {
                $granted[] = $perm;
            }
        }

        $role = Role::firstOrCreate(['name' => 'Staff Gudang', 'guard_name' => 'web']);
        $role->syncPermissions($granted);

        // Clear permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Notification::make()
            ->title('Hak Akses Karyawan Berhasil Disimpan!')
            ->body('Perubahan wewenang Staff Gudang telah diterapkan dan langsung aktif secara instan.')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan Hak Akses')
                ->icon('heroicon-o-check-badge')
                ->submit('save')
                ->color('primary'),
        ];
    }
}
