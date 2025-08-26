<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Exports\BooksExport;
use App\Imports\StudentsImport;
use App\Imports\BooksImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ExcelController extends Controller
{
    /**
     * Export students to Excel
     */
    public function exportStudents()
    {
        try {
            $filename = 'data_siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
            return Excel::download(new StudentsExport, $filename);
        } catch (\Exception $e) {
            Log::error('Error exporting students: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengexport data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Export books to Excel
     */
    public function exportBooks()
    {
        try {
            $filename = 'data_buku_' . date('Y-m-d_H-i-s') . '.xlsx';
            return Excel::download(new BooksExport, $filename);
        } catch (\Exception $e) {
            Log::error('Error exporting books: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengexport data buku: ' . $e->getMessage());
        }
    }

    /**
     * Import students from Excel
     */
    public function importStudents(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return back()->with('success', 'Data siswa berhasil diimport!');
        } catch (\Exception $e) {
            Log::error('Error importing students: ' . $e->getMessage());
            return back()->with('error', 'Gagal import data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Import books from Excel
     */
    public function importBooks(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new BooksImport, $request->file('file'));
            return back()->with('success', 'Data buku berhasil diimport!');
        } catch (\Exception $e) {
            Log::error('Error importing books: ' . $e->getMessage());
            return back()->with('error', 'Gagal import data buku: ' . $e->getMessage());
        }
    }

    /**
     * Download template for students import
     */
    public function downloadStudentsTemplate()
    {
        try {
            $filename = 'template_import_siswa.xlsx';
            return Excel::download(new StudentsExport, $filename);
        } catch (\Exception $e) {
            Log::error('Error downloading students template: ' . $e->getMessage());
            return back()->with('error', 'Gagal download template: ' . $e->getMessage());
        }
    }

    /**
     * Download template for books import
     */
    public function downloadBooksTemplate()
    {
        try {
            $filename = 'template_import_buku.xlsx';
            return Excel::download(new BooksExport, $filename);
        } catch (\Exception $e) {
            Log::error('Error downloading books template: ' . $e->getMessage());
            return back()->with('error', 'Gagal download template: ' . $e->getMessage());
        }
    }
}
