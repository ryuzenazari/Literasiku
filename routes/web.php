<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

// Your existing routes
Route::get('/', [StudentController::class, 'index'])->name('home');
Route::match(['get', 'post'], '/attendance', [StudentController::class, 'attendance'])->name('attendance');
Route::get('/books', [StudentController::class, 'books'])->name('books');
Route::get('/books/{book}', [StudentController::class, 'bookDetail'])->name('books.detail');

// Excel Import/Export Routes
Route::prefix('excel')->group(function () {
    // Export routes
    Route::get('/export/students', [ExcelController::class, 'exportStudents'])->name('excel.export.students');
    Route::get('/export/books', [ExcelController::class, 'exportBooks'])->name('excel.export.books');
    
    // Import routes
    Route::post('/import/students', [ExcelController::class, 'importStudents'])->name('excel.import.students');
    Route::post('/import/books', [ExcelController::class, 'importBooks'])->name('excel.import.books');
    
    // Template download routes
    Route::get('/template/students', [ExcelController::class, 'downloadStudentsTemplate'])->name('excel.template.students');
    Route::get('/template/books', [ExcelController::class, 'downloadBooksTemplate'])->name('excel.template.books');
});

// Dynamic URL Examples
Route::get('/examples/dynamic-urls', function () {
    return view('examples.dynamic-urls');
})->name('examples.dynamic-urls');


