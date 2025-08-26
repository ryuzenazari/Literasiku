<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image_url')
                    ->label('Cover')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(asset('images/default-book-cover.svg')),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

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
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('pages')
                    ->label('Halaman')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Fiksi' => 'Fiksi',
                        'Non-Fiksi' => 'Non-Fiksi',
                        'Pendidikan' => 'Pendidikan',
                        'Teknologi' => 'Teknologi',
                        'Sejarah' => 'Sejarah',
                        'Sains' => 'Sains',
                        'Seni' => 'Seni',
                        'Olahraga' => 'Olahraga',
                        'Lainnya' => 'Lainnya',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->searchable();
    }
}
