<?php

namespace App\Filament\Widgets;

use App\Models\StockMovement;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockMovementChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Tren Mutasi Stok Barang (Masuk vs Keluar)';
    protected static ?string $description = 'Perbandingan volume arus barang masuk (restock/supplier) dan keluar (penjualan/distribusi) 6 bulan terakhir';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $months = collect(range(0, 5))->map(fn ($i) => now()->subMonths($i)->format('Y-m'))->reverse()->values();

        // Optimized single aggregation query for 6 months
        $rawStats = DB::table('stock_movements')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->whereIn('type', ['in', 'out'])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, type, SUM(quantity) as total_qty")
            ->groupBy('ym', 'type')
            ->get();

        $statsMap = [];
        foreach ($rawStats as $row) {
            $statsMap[$row->ym][$row->type] = (int) $row->total_qty;
        }

        $dataMasuk = [];
        $dataKeluar = [];

        foreach ($months as $m) {
            $dataMasuk[] = $statsMap[$m]['in'] ?? 0;
            $dataKeluar[] = $statsMap[$m]['out'] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Barang Masuk (Inbound)',
                    'data' => $dataMasuk,
                    'borderColor' => '#0ea5e9', // Sky 500
                    'backgroundColor' => 'rgba(14, 165, 233, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#0ea5e9',
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label' => 'Barang Keluar (Outbound)',
                    'data' => $dataKeluar,
                    'borderColor' => '#f43f5e', // Rose 500
                    'backgroundColor' => 'rgba(244, 63, 94, 0.08)',
                    'fill' => true,
                    'tension' => 0.35,
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#f43f5e',
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->translatedFormat('M Y'))->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'align' => 'end',
                    'labels' => [
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                        'padding' => 20,
                        'font' => [
                            'family' => 'Inter',
                            'size' => 12,
                            'weight' => '500',
                        ],
                    ],
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
        return 'line';
    }
}
