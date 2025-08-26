<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class BooksImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading
{
    use SkipsErrors;
    public function model(array $row)
    {
        return new Book([
            'title' => $row['judul_buku'] ?? $row['title'] ?? '',
            'author' => $row['penulis'] ?? $row['author'] ?? '',
            'publication_year' => $row['tahun_terbit'] ?? $row['publication_year'] ?? date('Y'),
            'category' => $row['kategori'] ?? $row['category'] ?? 'Lainnya',
            'pages' => $row['jumlah_halaman'] ?? $row['pages'] ?? 100,
        ]);
    }

    public function rules(): array
    {
        return [
            'judul_buku' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'publication_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'jumlah_halaman' => 'nullable|integer|min:1|max:10000',
            'pages' => 'nullable|integer|min:1|max:10000',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'judul_buku.required' => 'Judul buku wajib diisi.',
            'title.required' => 'Judul wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'author.required' => 'Author wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'publication_year.integer' => 'Publication year harus berupa angka.',
            'jumlah_halaman.integer' => 'Jumlah halaman harus berupa angka.',
            'pages.integer' => 'Pages harus berupa angka.',
        ];
    }

    public function onError(\Throwable $e)
    {
        // Log import errors for debugging
        Log::error('Book import error: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
