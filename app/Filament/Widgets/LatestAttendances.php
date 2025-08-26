<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAttendances extends BaseWidget
{
    protected static ?string $heading = 'Absensi Terbaru';
    protected static ?int $sort = 6;
    protected int|string|array $columnSpan = 'col-span-1';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Attendance::query()
                    ->with('student')
                    ->latest()
                    ->limit(3)
            )
            ->columns([
                ImageColumn::make('student.photo_url')
                    ->label('Foto')
                    ->circular()
                    ->size(32)
                    ->defaultImageUrl(asset('images/default-student-avatar.svg')),
                TextColumn::make('student.name')
                    ->label('Nama Siswa')
                    ->limit(15)
                    ->searchable(),
                TextColumn::make('student.nis')
                    ->label('NIS')
                    ->limit(8),
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('time_in')
                    ->label('Waktu Masuk')
                    ->time('H:i')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
