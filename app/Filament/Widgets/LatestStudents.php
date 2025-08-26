<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestStudents extends BaseWidget
{
    protected static ?string $heading = 'Siswa Terbaru';
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = 'col-span-1';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Student::query()
                    ->latest()
                    ->limit(3)
            )
            ->columns([
                ImageColumn::make('photo_url')
                    ->label('Foto')
                    ->circular()
                    ->size(32)
                    ->defaultImageUrl(asset('images/default-student-avatar.svg')),
                TextColumn::make('name')
                    ->label('Nama')
                    ->limit(15)
                    ->searchable(),
                TextColumn::make('nis')
                    ->label('NIS')
                    ->limit(8)
                    ->copyable()
                    ->copyMessage('NIS berhasil disalin!'),
                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
