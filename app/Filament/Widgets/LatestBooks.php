<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBooks extends BaseWidget
{
    protected static ?string $heading = 'Buku Terbaru';
    protected static ?int $sort = 7;
    protected int|string|array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Book::query()
                    ->latest()
                    ->limit(3)
            )
            ->columns([
                ImageColumn::make('cover_image_url')
                    ->label('Cover')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(asset('images/default-book-cover.svg')),
                TextColumn::make('title')
                    ->label('Judul')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->limit(25),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Fiksi' => 'info',
                        'Non-Fiksi' => 'success',
                        'Pendidikan' => 'warning',
                        'Teknologi' => 'danger',
                        'Sejarah' => 'primary',
                        'Sains' => 'secondary',
                        'Seni' => 'gray',
                        'Olahraga' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('publication_year')
                    ->label('Tahun')
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
