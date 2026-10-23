<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductStockTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test total stock attribute correctly aggregates stock from multiple warehouses.
     */
    public function test_total_stock_attribute_sums_stock_across_all_warehouses(): void
    {
        // Arrange
        $category = Category::create([
            'name' => 'Elektronik',
        ]);

        $product = Product::create([
            'name' => 'Laptop ThinkPad X1',
            'sku' => 'TP-X1-001',
            'category_id' => $category->id,
            'purchase_price' => 15000000,
            'selling_price' => 18500000,
            'min_stock_threshold' => 5,
        ]);

        $warehouseA = Warehouse::create([
            'name' => 'Gudang Pusat Jakarta',
            'location' => 'Jakarta Barat',
        ]);

        $warehouseB = Warehouse::create([
            'name' => 'Gudang Cabang Surabaya',
            'location' => 'Surabaya Timur',
        ]);

        ProductWarehouse::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouseA->id,
            'stock_quantity' => 25,
        ]);

        ProductWarehouse::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouseB->id,
            'stock_quantity' => 15,
        ]);

        // Act
        $totalStock = $product->fresh()->total_stock;

        // Assert (Pola Asersi Ketat Rule 04)
        $this->assertEquals(40, $totalStock);
        $this->assertDatabaseHas('products', [
            'sku' => 'TP-X1-001',
            'name' => 'Laptop ThinkPad X1',
        ]);
    }

    /**
     * Test total stock returns zero when product has no warehouse assignments.
     */
    public function test_total_stock_returns_zero_when_no_stock_records_exist(): void
    {
        // Arrange
        $category = Category::create([
            'name' => 'ATK',
        ]);

        $product = Product::create([
            'name' => 'Kertas A4 80gr',
            'sku' => 'ATK-A4-001',
            'category_id' => $category->id,
            'purchase_price' => 45000,
            'selling_price' => 55000,
            'min_stock_threshold' => 10,
        ]);

        // Act
        $totalStock = $product->fresh()->total_stock;

        // Assert
        $this->assertEquals(0, $totalStock);
    }
}
