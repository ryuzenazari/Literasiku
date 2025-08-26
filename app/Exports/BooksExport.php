<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class BooksExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithTitle
{
    public function collection()
    {
        return Book::orderBy('title')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Penulis',
            'Tahun Terbit',
            'Kategori',
            'Jumlah Halaman',
            'Cover',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            $book->author,
            $book->publication_year,
            $book->category,
            $book->pages,
            $book->cover_photo ? 'Ada' : 'Tidak ada',
            $book->created_at->format('d/m/Y H:i:s'),
            $book->updated_at->format('d/m/Y H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2E8F0']
                ]
            ],
        ];
    }

    public function title(): string
    {
        return 'Data Buku';
    }
}
