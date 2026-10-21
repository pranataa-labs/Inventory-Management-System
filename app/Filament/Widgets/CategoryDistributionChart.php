<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class CategoryDistributionChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Distribusi Kategori Barang';
    protected static ?string $description = 'Proporsi jumlah SKU barang per kategori master data';
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();
        
        $labels = [];
        $data = [];
        $backgroundColors = [];

        // Elegant OKLCH-aligned Palette (Sky, Indigo, Emerald, Amber, Rose, Violet, Teal)
        $colors = ['#0ea5e9', '#6366f1', '#10b981', '#f59e0b', '#f43f5e', '#8b5cf6', '#14b8a6', '#ec4899'];

        foreach ($categories as $index => $category) {
            if ($category->products_count > 0) {
                $labels[] = $category->name;
                $data[] = $category->products_count;
                $backgroundColors[] = $colors[$index % count($colors)];
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah SKU Barang',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderWidth' => 2,
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                        'padding' => 15,
                        'font' => [
                            'family' => 'Inter',
                            'size' => 11,
                            'weight' => '500',
                        ],
                    ],
                ],
            ],
            'cutout' => '72%',
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
