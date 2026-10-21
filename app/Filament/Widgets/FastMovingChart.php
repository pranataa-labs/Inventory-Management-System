<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class FastMovingChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Top 5 Barang Fast-Moving';
    protected static ?string $description = 'Katalog dengan perputaran stok keluar tertinggi 30 hari terakhir';
    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $products = Product::query()
            ->withSum(['stockMovements' => function($q) {
                $q->where('type', 'out')->where('created_at', '>=', now()->subDays(30));
            }], 'quantity')
            ->having('stock_movements_sum_quantity', '>', 0)
            ->orderBy('stock_movements_sum_quantity', 'desc')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Terjual / Keluar',
                    'data' => $products->pluck('stock_movements_sum_quantity')->toArray(),
                    'backgroundColor' => '#6366f1', // Indigo 500
                    'borderRadius' => 6,
                    'borderSkipped' => false,
                ],
            ],
            'labels' => $products->pluck('name')->map(fn($n) => str($n)->limit(14))->toArray(),
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
