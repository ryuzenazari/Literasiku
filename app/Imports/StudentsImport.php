<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, WithBatchInserts, WithChunkReading, \Maatwebsite\Excel\Concerns\SkipsEmptyRows
{
    use SkipsErrors;
    public function model(array $row)
    {
        // Get the name from the correct column
        $name = $row['nama_lengkap'] ?? $row['name'] ?? $row['nama'] ?? '';
        $nis = $row['nis'] ?? $row['nomor_induk'] ?? '';
        
        // Skip if name or NIS is empty
        if (empty($name) || empty($nis)) {
            return null;
        }
        
        // Skip if NIS already exists
        if (Student::where('nis', $nis)->exists()) {
            return null;
        }

        return new Student([
            'name' => $name,
            'nis' => $nis,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'nis' => 'nullable|string|max:20',
            'nomor_induk' => 'nullable|string|max:20',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'name.string' => 'Nama harus berupa teks.',
            'nama.string' => 'Nama harus berupa teks.',
            'nis.string' => 'NIS harus berupa teks.',
            'nomor_induk.string' => 'Nomor induk harus berupa teks.',
        ];
    }

    public function onError(\Throwable $e)
    {
        // Log import errors for debugging
        Log::error('Student import error: ' . $e->getMessage(), [
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
