<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\StockMovement;
use App\Models\StockTake;
use App\Models\StockTakeItem;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        // 1. Kategori Realistis
        $categoryData = [
            'Makanan & Minuman',
            'Elektronik & Gadget',
            'Pakaian & Fashion',
            'Peralatan Rumah Tangga',
            'Alat Tulis Kantor (ATK)',
            'Otomotif & Sparepart',
            'Farmasi & Kesehatan',
            'Olahraga & Outdoor',
            'Bahan Bangunan & Perkakas',
            'Kosmetik & Perawatan Diri',
        ];

        $categories = [];
        foreach ($categoryData as $catName) {
            $categories[] = Category::firstOrCreate(['name' => $catName]);
        }

        // 2. Gudang Utama
        $warehouseData = [
            ['name' => 'Gudang Pusat Cakung', 'location' => 'Kawasan Industri Pulogadung, Jakarta Timur'],
            ['name' => 'Gudang Distribusi Rungkut', 'location' => 'SIER Rungkut Industri, Surabaya'],
            ['name' => 'Gudang Logistik Cimahi', 'location' => 'Jl. Industri Utama No. 88, Cimahi, Bandung'],
            ['name' => 'Gudang Hub Krapyak', 'location' => 'Kawasan Industri Krapyak, Semarang'],
            ['name' => 'Gudang Regional KIM II', 'location' => 'Kawasan Industri Medan II, Deli Serdang'],
            ['name' => 'Gudang Transit Panakkukang', 'location' => 'Jl. Boulevard Raya No. 45, Makassar'],
        ];

        $warehouses = [];
        foreach ($warehouseData as $wh) {
            $warehouses[] = Warehouse::firstOrCreate(['name' => $wh['name']], $wh);
        }

        // 3. Satuan (Units)
        $unitData = [
            ['name' => 'Pieces', 'symbol' => 'Pcs'],
            ['name' => 'Kotak', 'symbol' => 'Box'],
            ['name' => 'Paket', 'symbol' => 'Pack'],
            ['name' => 'Karton / Dus', 'symbol' => 'Dus'],
            ['name' => 'Botol', 'symbol' => 'Btl'],
            ['name' => 'Kilogram', 'symbol' => 'Kg'],
            ['name' => 'Liter', 'symbol' => 'L'],
            ['name' => 'Rim', 'symbol' => 'Rim'],
            ['name' => 'Set', 'symbol' => 'Set'],
            ['name' => 'Strip / Blister', 'symbol' => 'Strip'],
        ];

        $units = [];
        foreach ($unitData as $u) {
            $units[] = Unit::firstOrCreate(['name' => $u['name']], $u);
        }

        // 4. Pemasok (Suppliers)
        $supplierData = [
            ['name' => 'PT Indofood Sukses Makmur Tbk', 'contact_person' => 'Hendra Wijaya', 'phone' => '021-57958822', 'address' => 'Sudirman Plaza Indofood Tower, Jakarta Selatan'],
            ['name' => 'PT Unilever Indonesia Tbk', 'contact_person' => 'Ratna Sari', 'phone' => '021-5262112', 'address' => 'BSD City Green Office Park, Tangerang'],
            ['name' => 'PT Astra Otoparts Tbk', 'contact_person' => 'Budi Haryanto', 'phone' => '021-4603550', 'address' => 'Jl. Raya Pegangsaan Dua Km. 2.2, Kelapa Gading'],
            ['name' => 'PT Kalbe Farma Tbk', 'contact_person' => 'Dr. Irwan Susanto', 'phone' => '021-42873888', 'address' => 'Jl. Letjen Suprapto Kav. 4, Cempaka Putih'],
            ['name' => 'PT Sinarmas Pulp & Paper', 'contact_person' => 'Denny Kurniawan', 'phone' => '021-3929266', 'address' => 'Sinar Mas Land Plaza Tower II, Jakarta Pusat'],
            ['name' => 'PT Mayora Indah Tbk', 'contact_person' => 'Agus Pranoto', 'phone' => '021-5655320', 'address' => 'Jl. Tomang Raya 21-23, Jakarta Barat'],
            ['name' => 'PT Panasonic Gobel Indonesia', 'contact_person' => 'Yanti Kusuma', 'phone' => '021-8015710', 'address' => 'Jl. Dewi Sartika No. 14, Cawang, Jakarta Timur'],
            ['name' => 'PT Wings Surya', 'contact_person' => 'Eko Prasetyo', 'phone' => '031-8438181', 'address' => 'Jl. Embong Malang No. 61-65, Surabaya'],
            ['name' => 'PT Kimia Farma Tbk', 'contact_person' => 'Maya Anggraini', 'phone' => '021-3847777', 'address' => 'Jl. Veteran No. 9, Jakarta Pusat'],
            ['name' => 'CV Mitra Bangunan Utama', 'contact_person' => 'Bambang Sutrisno', 'phone' => '021-5821990', 'address' => 'Jl. Daan Mogot Km. 11, Jakarta Barat'],
        ];

        $suppliers = [];
        foreach ($supplierData as $sup) {
            $suppliers[] = Supplier::firstOrCreate(['name' => $sup['name']], $sup);
        }

        // 5. Tambah Staff Tambahan jika belum ada
        $admin = User::where('email', 'admin@inventory.test')->first();
        $staff1 = User::where('email', 'staff@inventory.test')->first();

        $staff2 = User::firstOrCreate(
            ['email' => 'budi.santoso@inventory.test'],
            ['name' => 'Budi Santoso', 'password' => bcrypt('password')]
        );
        $staff2->assignRole('Staff Gudang');

        $staff3 = User::firstOrCreate(
            ['email' => 'siti.aminah@inventory.test'],
            ['name' => 'Siti Aminah', 'password' => bcrypt('password')]
        );
        $staff3->assignRole('Staff Gudang');

        $userIds = [$admin->id, $staff1->id, $staff2->id, $staff3->id];

        // 6. Produk Realistis (35 Produk)
        $catalog = [
            // Makanan & Minuman
            ['name' => 'Indomie Goreng Spesial 85g', 'cat' => 0, 'unit' => 0, 'sup' => 0, 'buy' => 3100, 'sell' => 3800, 'min' => 50],
            ['name' => 'Kopi Kapal Api Spesial Mix 10x25g', 'cat' => 0, 'unit' => 2, 'sup' => 5, 'buy' => 13500, 'sell' => 16500, 'min' => 30],
            ['name' => 'Minyak Goreng Bimoli Klasik 2L', 'cat' => 0, 'unit' => 4, 'sup' => 0, 'buy' => 36000, 'sell' => 42000, 'min' => 25],
            ['name' => 'Susu UHT Ultra Milk Cokelat 1L', 'cat' => 0, 'unit' => 4, 'sup' => 5, 'buy' => 18500, 'sell' => 22000, 'min' => 20],
            ['name' => 'Teh Botol Sosro Kotak 250ml Dus (24 pcs)', 'cat' => 0, 'unit' => 3, 'sup' => 5, 'buy' => 68000, 'sell' => 82000, 'min' => 15],

            // Elektronik
            ['name' => 'Mouse Wireless Logitech B170', 'cat' => 1, 'unit' => 0, 'sup' => 6, 'buy' => 135000, 'sell' => 165000, 'min' => 10],
            ['name' => 'Keyboard USB Logitech K120', 'cat' => 1, 'unit' => 0, 'sup' => 6, 'buy' => 140000, 'sell' => 175000, 'min' => 10],
            ['name' => 'Kabel HDMI Vention 2M 4K Nylon Braided', 'cat' => 1, 'unit' => 0, 'sup' => 6, 'buy' => 45000, 'sell' => 60000, 'min' => 15],
            ['name' => 'Lampu LED Philips 12W Putih Cool Daylight', 'cat' => 1, 'unit' => 0, 'sup' => 6, 'buy' => 38000, 'sell' => 48000, 'min' => 25],
            ['name' => 'Stop Kontak Uticon 4 Lubang Kabel 3M', 'cat' => 1, 'unit' => 0, 'sup' => 6, 'buy' => 65000, 'sell' => 82000, 'min' => 10],

            // Pakaian & Fashion
            ['name' => 'Kaos Polos Cotton Combed 30s Hitam L', 'cat' => 2, 'unit' => 0, 'sup' => 4, 'buy' => 35000, 'sell' => 50000, 'min' => 20],
            ['name' => 'Kemeja Flannel Pria Lengan Panjang XL', 'cat' => 2, 'unit' => 0, 'sup' => 4, 'buy' => 120000, 'sell' => 165000, 'min' => 10],
            ['name' => 'Celana Chino Pria Slim Fit Khaki 32', 'cat' => 2, 'unit' => 0, 'sup' => 4, 'buy' => 135000, 'sell' => 185000, 'min' => 10],

            // Rumah Tangga
            ['name' => 'Sabun Mandi Cair Lifebuoy Total 10 450ml Pouch', 'cat' => 3, 'unit' => 4, 'sup' => 1, 'buy' => 24000, 'sell' => 29500, 'min' => 30],
            ['name' => 'Deterjen Rinso Molto Cair Rose Fresh 750ml', 'cat' => 3, 'unit' => 4, 'sup' => 1, 'buy' => 22000, 'sell' => 27000, 'min' => 30],
            ['name' => 'Pembersih Lantai Wipol Karbol Wangi 780ml', 'cat' => 3, 'unit' => 4, 'sup' => 1, 'buy' => 16500, 'sell' => 20500, 'min' => 20],
            ['name' => 'Pasta Gigi Pepsodent Pencegah Gigi Berlubang 190g', 'cat' => 3, 'unit' => 0, 'sup' => 1, 'buy' => 14500, 'sell' => 18000, 'min' => 40],
            ['name' => 'Panci Masak Anti Lengket Maxim Valentino 24cm', 'cat' => 3, 'unit' => 0, 'sup' => 6, 'buy' => 110000, 'sell' => 145000, 'min' => 5],

            // ATK
            ['name' => 'Kertas HVS PaperOne A4 80gsm 1 Rim (500 lbr)', 'cat' => 4, 'unit' => 7, 'sup' => 4, 'buy' => 48000, 'sell' => 58000, 'min' => 25],
            ['name' => 'Pulpen Standard AE7 0.5 Black Box (12 pcs)', 'cat' => 4, 'unit' => 1, 'sup' => 4, 'buy' => 26000, 'sell' => 32000, 'min' => 20],
            ['name' => 'Spidol Whiteboard Snowman Hitam Box (12 pcs)', 'cat' => 4, 'unit' => 1, 'sup' => 4, 'buy' => 88000, 'sell' => 108000, 'min' => 10],
            ['name' => 'Map Odner Bantex Folio 7cm Biru', 'cat' => 4, 'unit' => 0, 'sup' => 4, 'buy' => 32000, 'sell' => 40000, 'min' => 15],

            // Otomotif
            ['name' => 'Oli Mesin Motor Honda AHM Oil MPX2 0.8L', 'cat' => 5, 'unit' => 4, 'sup' => 2, 'buy' => 47000, 'sell' => 58000, 'min' => 20],
            ['name' => 'Kampas Rem Depan Aspira Beat / Vario FI', 'cat' => 5, 'unit' => 8, 'sup' => 2, 'buy' => 32000, 'sell' => 42000, 'min' => 15],
            ['name' => 'Busi Motor Denso U24EPR9 Standar', 'cat' => 5, 'unit' => 0, 'sup' => 2, 'buy' => 18000, 'sell' => 25000, 'min' => 30],

            // Kesehatan
            ['name' => 'Paracetamol 500mg Strip 10 Kaplet', 'cat' => 6, 'unit' => 9, 'sup' => 3, 'buy' => 4500, 'sell' => 7000, 'min' => 50],
            ['name' => 'Vitamin C Enervon-C Botol 30 Tablet', 'cat' => 6, 'unit' => 4, 'sup' => 3, 'buy' => 38000, 'sell' => 46000, 'min' => 25],
            ['name' => 'Tolak Angin Cair Herbal Box 12 Sachet', 'cat' => 6, 'unit' => 1, 'sup' => 8, 'buy' => 46000, 'sell' => 55000, 'min' => 30],
            ['name' => 'Masker Medis Sensi 3-Ply Earloop Box (50 pcs)', 'cat' => 6, 'unit' => 1, 'sup' => 8, 'buy' => 28000, 'sell' => 36000, 'min' => 30],

            // Olahraga
            ['name' => 'Matras Yoga NBR 10mm Tebal Anti Slip', 'cat' => 7, 'unit' => 0, 'sup' => 6, 'buy' => 85000, 'sell' => 115000, 'min' => 8],
            ['name' => 'Bola Sepak Mikasa Classic Size 5', 'cat' => 7, 'unit' => 0, 'sup' => 6, 'buy' => 145000, 'sell' => 190000, 'min' => 5],

            // Bahan Bangunan
            ['name' => 'Cat Tembok Dulux Catylac Putih 5Kg', 'cat' => 8, 'unit' => 5, 'sup' => 9, 'buy' => 135000, 'sell' => 165000, 'min' => 10],
            ['name' => 'Semen Gresik Portland Composite 40Kg', 'cat' => 8, 'unit' => 5, 'sup' => 9, 'buy' => 58000, 'sell' => 68000, 'min' => 40],
            ['name' => 'Obeng Set Tekiro 7 Pcs Magnetik', 'cat' => 8, 'unit' => 8, 'sup' => 9, 'buy' => 75000, 'sell' => 98000, 'min' => 10],

            // Kosmetik
            ['name' => 'Sunscreen Wardah UV Shield SPF 50 PA++++ 30ml', 'cat' => 9, 'unit' => 0, 'sup' => 8, 'buy' => 42000, 'sell' => 52000, 'min' => 25],
        ];

        $createdProducts = [];
        foreach ($catalog as $idx => $item) {
            $sku = 'SKU-' . str_pad($idx + 1, 5, '0', STR_PAD_LEFT);
            $product = Product::updateOrCreate(
                ['sku' => $sku],
                [
                    'name' => $item['name'],
                    'category_id' => $categories[$item['cat']]->id,
                    'unit_id' => $units[$item['unit']]->id,
                    'supplier_id' => $suppliers[$item['sup']]->id,
                    'purchase_price' => $item['buy'],
                    'selling_price' => $item['sell'],
                    'min_stock_threshold' => $item['min'],
                ]
            );
            $createdProducts[] = $product;
        }

        // 7. Bersihkan data mutasi lama untuk disinkronkan rapi 12 bulan
        DB::table('stock_movements')->truncate();
        DB::table('product_warehouses')->truncate();

        // 8. Generate Stock Movements Realistis Sepanjang 12 Bulan Terakhir
        // Baseline pola histogram 12 bulan (Jan - Des) yang bervariasi secara alami
        $monthlyTargetVolumes = [
            11 => 1250, // 11 bulan lalu (Nov tahun lalu)
            10 => 1680, // Des (Peak musim liburan)
            9  => 950,  // Jan (Normal awal tahun)
            8  => 1120, // Feb
            7  => 2850, // Mar (Peak Puasa / Ramadan)
            6  => 3400, // Apr (Peak Lebaran)
            5  => 1400, // Mei
            4  => 1850, // Jun (Tahun Ajaran Baru)
            3  => 2100, // Jul
            2  => 2750, // Agu (HUT RI / Promo)
            1  => 1950, // Sep
            0  => 2300, // Okt (Bulan ini)
        ];

        $movementRows = [];
        $stockTracking = []; // [productId_warehouseId => currentStock]

        foreach ($monthlyTargetVolumes as $monthsAgo => $targetQty) {
            $monthDate = now()->subMonths($monthsAgo)->startOfMonth();
            $daysInMonth = $monthDate->daysInMonth;

            // Alokasikan transaksi Inbound (60%) dan Outbound (40%)
            $inTarget = (int) ($targetQty * 0.58);
            $outTarget = (int) ($targetQty * 0.42);

            // Generate Inbound transactions
            $inBatches = rand(10, 18);
            for ($b = 0; $b < $inBatches; $b++) {
                $p = $createdProducts[array_rand($createdProducts)];
                $wh = $warehouses[array_rand($warehouses)];
                $uId = $userIds[array_rand($userIds)];
                $qty = (int) round($inTarget / $inBatches * (rand(70, 130) / 100));
                if ($qty <= 0) $qty = 15;

                $day = rand(1, min(28, $daysInMonth));
                $txDate = Carbon::create($monthDate->year, $monthDate->month, $day, rand(8, 17), rand(0, 59), rand(0, 59));

                $reasons = [
                    'Penerimaan PO Pembelian Supplier',
                    'Restock pasokan gudang reguler',
                    'Penerimaan kiriman kontainer vendor',
                    'Restock barang fast-moving',
                ];

                $movementRows[] = [
                    'product_id' => $p->id,
                    'warehouse_id' => $wh->id,
                    'user_id' => $uId,
                    'type' => 'in',
                    'quantity' => $qty,
                    'reason' => $reasons[array_rand($reasons)],
                    'created_at' => $txDate,
                    'updated_at' => $txDate,
                ];

                $key = "{$p->id}_{$wh->id}";
                $stockTracking[$key] = ($stockTracking[$key] ?? 0) + $qty;
            }

            // Generate Outbound transactions
            $outBatches = rand(12, 22);
            for ($b = 0; $b < $outBatches; $b++) {
                $p = $createdProducts[array_rand($createdProducts)];
                $wh = $warehouses[array_rand($warehouses)];
                $uId = $userIds[array_rand($userIds)];
                $key = "{$p->id}_{$wh->id}";

                $available = $stockTracking[$key] ?? 0;
                if ($available < 10) continue; // Jangan keluar jika stok tipis

                $maxOut = min($available - 5, (int) round($outTarget / $outBatches * (rand(70, 130) / 100)));
                if ($maxOut <= 0) continue;

                $day = rand(2, min(28, $daysInMonth));
                $txDate = Carbon::create($monthDate->year, $monthDate->month, $day, rand(9, 20), rand(0, 59), rand(0, 59));

                $reasons = [
                    'Distribusi ke toko retail cabang',
                    'Pemenuhan order pelanggan grosir',
                    'Pengiriman pesanan marketplace',
                    'Fulfillment pesanan distributor',
                ];

                $movementRows[] = [
                    'product_id' => $p->id,
                    'warehouse_id' => $wh->id,
                    'user_id' => $uId,
                    'type' => 'out',
                    'quantity' => $maxOut,
                    'reason' => $reasons[array_rand($reasons)],
                    'created_at' => $txDate,
                    'updated_at' => $txDate,
                ];

                $stockTracking[$key] -= $maxOut;
            }
        }

        // Insert batch movements
        foreach (array_chunk($movementRows, 100) as $chunk) {
            DB::table('stock_movements')->insert($chunk);
        }

        // 9. Sinkronisasi Saldo Fisik di ProductWarehouse
        foreach ($stockTracking as $key => $stock) {
            [$pId, $whId] = explode('_', $key);
            if ($stock > 0) {
                ProductWarehouse::updateOrCreate(
                    ['product_id' => $pId, 'warehouse_id' => $whId],
                    ['stock_quantity' => $stock]
                );
            }
        }

        // Pastikan setiap produk minimal punya stok di 1 gudang utama
        foreach ($createdProducts as $p) {
            $hasStock = ProductWarehouse::where('product_id', $p->id)->sum('stock_quantity');
            if ($hasStock <= 0) {
                ProductWarehouse::create([
                    'product_id' => $p->id,
                    'warehouse_id' => $warehouses[0]->id,
                    'stock_quantity' => rand(40, 150),
                ]);
            }
        }

        // 10. Generate Stock Takes (Stock Opname) Realistis
        DB::table('stock_takes')->truncate();
        DB::table('stock_take_items')->truncate();

        $stockTakeSessions = [
            [
                'warehouse_id' => $warehouses[0]->id,
                'user_id' => $admin->id,
                'date' => now()->subMonths(2)->format('Y-m-d'),
                'status' => 'completed',
            ],
            [
                'warehouse_id' => $warehouses[1]->id,
                'user_id' => $staff1->id,
                'date' => now()->subWeeks(3)->format('Y-m-d'),
                'status' => 'completed',
            ],
            [
                'warehouse_id' => $warehouses[2]->id,
                'user_id' => $staff2->id,
                'date' => now()->format('Y-m-d'),
                'status' => 'pending', // Draft sesi aktif yang bisa diinput staf
            ],
        ];

        foreach ($stockTakeSessions as $stData) {
            $st = StockTake::create($stData);

            // Ambil 6-10 produk di gudang tersebut untuk di-opname
            $whProducts = ProductWarehouse::where('warehouse_id', $st->warehouse_id)->limit(8)->get();
            foreach ($whProducts as $pw) {
                $expected = $pw->stock_quantity;
                $diff = ($st->status === 'completed') ? rand(-2, 3) : 0;
                $actual = max(0, $expected + $diff);

                StockTakeItem::create([
                    'stock_take_id' => $st->id,
                    'product_id' => $pw->product_id,
                    'expected_qty' => $expected,
                    'actual_qty' => ($st->status === 'completed') ? $actual : $expected,
                    'difference' => ($st->status === 'completed') ? $diff : 0,
                    'reason' => ($diff !== 0 && $st->status === 'completed') ? 'Selisih wajar saat pergeseran rak display' : 'Sesuai catatan sistem',
                ]);
            }
        }

        // 11. Generate Audit Logs Realistis
        DB::table('audit_logs')->truncate();

        $sampleLogs = [
            ['user_id' => $admin->id, 'action' => 'LOGIN', 'model_type' => 'App\Models\User', 'model_id' => $admin->id, 'details' => ['event' => 'Autentikasi Super Admin Berhasil', 'ip' => '127.0.0.1'], 'created_at' => now()->subMinutes(12)],
            ['user_id' => $admin->id, 'action' => 'PERMISSION_SYNC', 'model_type' => 'Spatie\Permission\Models\Role', 'model_id' => 2, 'details' => ['role' => 'Staff Gudang', 'status' => 'Izin wewenang diperbarui'], 'created_at' => now()->subMinutes(25)],
            ['user_id' => $staff1->id, 'action' => 'STOCK_IN', 'model_type' => 'App\Models\StockMovement', 'model_id' => 1, 'details' => ['sku' => 'SKU-00001', 'qty' => 100, 'wh' => 'Gudang Pusat Cakung'], 'created_at' => now()->subHours(2)],
            ['user_id' => $staff2->id, 'action' => 'STOCK_OUT', 'model_type' => 'App\Models\StockMovement', 'model_id' => 2, 'details' => ['sku' => 'SKU-00003', 'qty' => 25, 'wh' => 'Gudang Distribusi Rungkut'], 'created_at' => now()->subHours(5)],
            ['user_id' => $admin->id, 'action' => 'CREATE_PRODUCT', 'model_type' => 'App\Models\Product', 'model_id' => 12, 'details' => ['name' => 'Kemeja Flannel Pria XL', 'sku' => 'SKU-00012'], 'created_at' => now()->subDays(1)],
            ['user_id' => $staff1->id, 'action' => 'QR_SCAN', 'model_type' => 'App\Models\StockMovement', 'model_id' => 15, 'details' => ['method' => 'Kamera Scanner Barcode', 'sku' => 'SKU-00006'], 'created_at' => now()->subDays(2)],
            ['user_id' => $admin->id, 'action' => 'STOCK_TAKE_COMPLETED', 'model_type' => 'App\Models\StockTake', 'model_id' => 1, 'details' => ['session' => 'Stock Opname Semester 1', 'result' => 'Verified'], 'created_at' => now()->subDays(3)],
            ['user_id' => $staff3->id, 'action' => 'LOGIN', 'model_type' => 'App\Models\User', 'model_id' => $staff3->id, 'details' => ['event' => 'Autentikasi Karyawan Gudang', 'ip' => '192.168.1.45'], 'created_at' => now()->subDays(4)],
        ];

        foreach ($sampleLogs as $log) {
            AuditLog::create([
                'user_id' => $log['user_id'],
                'action' => $log['action'],
                'model_type' => $log['model_type'],
                'model_id' => $log['model_id'],
                'details' => $log['details'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128.0.0.0',
                'created_at' => $log['created_at'],
                'updated_at' => $log['created_at'],
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
