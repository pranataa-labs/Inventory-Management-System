<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public static array $permissions = [
        // Katalog Barang
        'products.view' => 'Lihat Katalog Barang',
        'products.create' => 'Tambah Barang Baru',
        'products.edit' => 'Ubah / Edit Barang & Harga',
        'products.delete' => 'Hapus Barang dari Katalog',

        // Mutasi & Transaksi
        'movements.view' => 'Lihat Riwayat Mutasi Stok',
        'movements.create' => 'Buat Mutasi Masuk/Keluar/Transfer',

        // Stock Opname
        'stock_takes.view' => 'Lihat Sesi Stock Opname',
        'stock_takes.create' => 'Buka Sesi Stock Opname Baru',
        'stock_takes.edit' => 'Input / Catat Hitungan Fisik Opname',
        'stock_takes.delete' => 'Hapus / Batalkan Sesi Opname',

        // Scanner QR
        'qr.scan' => 'Gunakan Scanner QR Barcode',

        // Data Master
        'master.categories' => 'Kelola Data Kategori',
        'master.units' => 'Kelola Data Satuan',
        'master.suppliers' => 'Kelola Data Pemasok (Supplier)',
        'master.warehouses' => 'Kelola Data Gudang & Lokasi',

        // Audit Trail
        'audit.view' => 'Lihat Log Audit Trail Aktivitas',
    ];

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create all permissions
        foreach (self::$permissions as $name => $label) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // Ensure roles exist
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $staffRole = Role::firstOrCreate(['name' => 'Staff Gudang', 'guard_name' => 'web']);

        // Admin gets all permissions
        $adminRole->syncPermissions(Permission::all());

        // Default staff permissions if none set yet
        if ($staffRole->permissions()->count() === 0) {
            $defaultStaff = [
                'products.view',
                'movements.view',
                'movements.create',
                'stock_takes.view',
                'stock_takes.edit',
                'qr.scan',
            ];
            $staffRole->syncPermissions($defaultStaff);
        }
    }
}
