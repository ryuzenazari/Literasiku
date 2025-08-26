<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Buku')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul buku'),

                TextInput::make('author')
                    ->label('Penulis')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama penulis'),

                TextInput::make('publication_year')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(date('Y') + 1)
                    ->placeholder('Contoh: 2024'),

                Select::make('category')
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
                    ])
                    ->required()
                    ->placeholder('Pilih kategori'),

                TextInput::make('pages')
                    ->label('Jumlah Halaman')
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('Contoh: 250'),

                FileUpload::make('cover_photo')
                    ->label('Foto Cover')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('3:4')
                    ->imageResizeTargetWidth('300')
                    ->imageResizeTargetHeight('400')
                    ->directory('books/covers')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 2MB. Rasio 3:4 direkomendasikan.'),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(1000)
                    ->placeholder('Masukkan deskripsi singkat tentang buku'),
            ]);
    }
}
