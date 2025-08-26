<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Student;
use App\Models\Attendance;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        return [
            Stat::make('Total Buku', Book::count())
                ->description('Koleksi buku perpustakaan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Siswa', Student::count())
                ->description('Siswa terdaftar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info')
                ->chart([3, 5, 2, 8, 4, 6, 9]),

            Stat::make('Absensi Hari Ini', Attendance::whereDate('date', $today)->count())
                ->description('Siswa yang hadir hari ini')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([2, 4, 1, 3, 5, 2, 4]),

            Stat::make('Siswa Aktif', Student::whereHas('attendances', function ($query) use ($thisMonth) {
                $query->where('date', '>=', $thisMonth);
            })->count())
                ->description('Siswa dengan absensi bulan ini')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([8, 12, 10, 15, 13, 18, 16]),
        ];
    }
}
