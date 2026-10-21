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
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->limit(8)
            ->get();
        
        $labels = [];
        $data = [];
        $backgroundColors = [];

        // Elegant Shadcn-aligned palette (Sky, Indigo, Emerald, Amber, Rose, Violet, Teal, Pink)
        $colors = ['#0ea5e9', '#6366f1', '#10b981', '#f59e0b', '#f43f5e', '#8b5cf6', '#14b8a6', '#ec4899'];

        foreach ($categories as $index => $category) {
            $labels[] = str($category->name)->limit(14);
            $data[] = $category->products_count;
            $backgroundColors[] = $colors[$index % count($colors)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah SKU Barang',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderRadius' => 6,
                    'borderSkipped' => false,
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
                    'display' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'font' => [
                            'family' => 'Inter',
                            'size' => 11,
                        ],
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'color' => 'rgba(148, 163, 184, 0.1)',
                    ],
                    'ticks' => [
                        'stepSize' => 1,
                        'font' => [
                            'family' => 'Inter',
                            'size' => 11,
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
