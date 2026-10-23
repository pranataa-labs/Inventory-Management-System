<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\StockMovement;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockMovementTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;
    private Warehouse $warehouse;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create([
            'name' => 'Hardware',
        ]);

        $this->product = Product::create([
            'name' => 'Monitor Dell 27 Inch 4K',
            'sku' => 'MON-DELL-27',
            'category_id' => $category->id,
            'purchase_price' => 4500000,
            'selling_price' => 5800000,
            'min_stock_threshold' => 3,
        ]);

        $this->warehouse = Warehouse::create([
            'name' => 'Gudang Utama Cikarang',
            'location' => 'Kawasan Industri GIIC',
        ]);
    }

    /**
     * Test inbound stock movement increments warehouse stock quantity.
     */
    public function test_inbound_stock_movement_increases_warehouse_quantity(): void
    {
        // Arrange: Inisialisasi awal stok 10 unit
        ProductWarehouse::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'stock_quantity' => 10,
        ]);

        // Act: Masukkan barang masuk (inbound) 15 unit
        StockMovement::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'type' => 'in',
            'quantity' => 15,
            'reason' => 'Restock PO-2026-001',
        ]);

        // Assert: Stok gudang harus menjadi 25
        $productWarehouse = ProductWarehouse::where([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
        ])->first();

        $this->assertNotNull($productWarehouse);
        $this->assertEquals(25, $productWarehouse->stock_quantity);
        $this->assertEquals(25, $this->product->fresh()->total_stock);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $this->product->id,
            'type' => 'in',
            'quantity' => 15,
        ]);
    }

    /**
     * Test outbound stock movement decrements warehouse stock quantity when stock is sufficient.
     */
    public function test_outbound_stock_movement_decreases_warehouse_quantity(): void
    {
        // Arrange: Inisialisasi awal stok 50 unit
        ProductWarehouse::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'stock_quantity' => 50,
        ]);

        // Act: Barang keluar 20 unit
        StockMovement::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'type' => 'out',
            'quantity' => 20,
            'reason' => 'Pengiriman Pesanan INV-889',
        ]);

        // Assert: Stok gudang berkurang menjadi 30
        $productWarehouse = ProductWarehouse::where([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
        ])->first();

        $this->assertEquals(30, $productWarehouse->stock_quantity);
        $this->assertEquals(30, $this->product->fresh()->total_stock);
    }

    /**
     * Test outbound stock movement throws exception and prevents negative stock when quantity exceeds available stock.
     */
    public function test_outbound_stock_movement_throws_exception_when_stock_is_insufficient(): void
    {
        // Arrange: Inisialisasi stok hanya ada 5 unit
        ProductWarehouse::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'stock_quantity' => 5,
        ]);

        // Expect Exception (Aturan Domain: Stok tidak boleh minus)
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Stok tidak mencukupi untuk dikeluarkan/retur.");

        // Act: Coba keluarkan 10 unit (melebihi stok yang ada)
        try {
            StockMovement::create([
                'product_id' => $this->product->id,
                'warehouse_id' => $this->warehouse->id,
                'type' => 'out',
                'quantity' => 10,
                'reason' => 'Mencoba transaksi ilegal',
            ]);
        } finally {
            // Assert: Stok tidak boleh berubah atau menjadi minus
            $productWarehouse = ProductWarehouse::where([
                'product_id' => $this->product->id,
                'warehouse_id' => $this->warehouse->id,
            ])->first();

            $this->assertEquals(5, $productWarehouse->stock_quantity);
        }
    }

    /**
     * Test stock adjustment movement increases stock appropriately.
     */
    public function test_stock_adjustment_movement_increments_stock(): void
    {
        // Arrange: Inisialisasi stok awal 10 unit
        ProductWarehouse::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'stock_quantity' => 10,
        ]);

        // Act: Penyesuaian stok opname +5 unit
        StockMovement::create([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
            'type' => 'adjustment',
            'quantity' => 5,
            'reason' => 'Koreksi Stock Opname Bulanan',
        ]);

        // Assert: Stok menjadi 15
        $productWarehouse = ProductWarehouse::where([
            'product_id' => $this->product->id,
            'warehouse_id' => $this->warehouse->id,
        ])->first();

        $this->assertEquals(15, $productWarehouse->stock_quantity);
    }
}
