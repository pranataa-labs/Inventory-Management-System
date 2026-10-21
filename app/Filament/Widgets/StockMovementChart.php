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

    protected static ?string $heading = 'Overview Mutasi Stok';
    protected static ?string $description = 'Total perputaran arus barang (inbound & outbound) per bulan sepanjang 12 bulan terakhir';
    protected static ?string $maxHeight = '320px';

    protected function getData(): array
    {
        // 12 bulan terakhir (Jan - Des)
        $months = collect(range(0, 11))->map(fn ($i) => now()->subMonths($i)->format('Y-m'))->reverse()->values();

        // Agregasi total volume mutasi per bulan (in + out)
        $rawStats = DB::table('stock_movements')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->whereIn('type', ['in', 'out'])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, SUM(quantity) as total_qty")
            ->groupBy('ym')
            ->pluck('total_qty', 'ym')
            ->toArray();

        $data = [];
        foreach ($months as $m) {
            $data[] = (int) ($rawStats[$m] ?? 0);
        }

        $isDark = request()->cookie('theme') === 'dark';
        $barColor = $isDark ? '#f8fafc' : '#0f172a';

        return [
            'datasets' => [
                [
                    'label' => 'Total Mutasi (Pcs)',
                    'data' => $data,
                    'backgroundColor' => $barColor,
                    'borderRadius' => [
                        'topLeft' => 6,
                        'topRight' => 6,
                        'bottomLeft' => 0,
                        'bottomRight' => 0,
                    ],
                    'borderSkipped' => false,
                    'maxBarThickness' => 42,
                ],
            ],
            'labels' => $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->translatedFormat('M'))->toArray(),
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
                            'size' => 12,
                            'weight' => '500',
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
