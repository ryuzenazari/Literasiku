<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyAttendanceChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'col-span-1';

    public function getHeading(): string
    {
        return 'Absensi Bulanan Tahun ' . Carbon::now()->format('Y');
    }

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;
        
        $monthlyData = Attendance::select(
            DB::raw('MONTH(date) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $data = array_fill(1, 12, 0);
        $labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        foreach ($monthlyData as $item) {
            $data[$item->month] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Absensi',
                    'data' => array_values($data),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
