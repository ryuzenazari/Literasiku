<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentsTemplateExport implements FromArray, WithHeadings, ShouldAutoSize, WithStyles, WithTitle
{
    public function array(): array
    {
        // Return example data for template
        return [
            [
                'Nama Lengkap' => 'Contoh Siswa 1',
                'NIS' => '2024001'
            ],
            [
                'Nama Lengkap' => 'Contoh Siswa 2',
                'NIS' => '2024002'
            ],
            [
                'Nama Lengkap' => 'Contoh Siswa 3',
                'NIS' => '2024003'
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NIS'
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
        return 'Template Import Siswa';
    }
}
