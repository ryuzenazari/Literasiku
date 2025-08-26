<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }

    public function attendance(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nis' => 'required|string|max:255',
            ]);

            $student = Student::where('nis', $request->nis)->first();

            if (!$student) {
                return back()->withErrors(['nis' => 'NIS tidak ditemukan.']);
            }

            // Check if already attended today
            $todayAttendance = Attendance::where('student_id', $student->id)
                ->whereDate('date', now())
                ->first();

            if ($todayAttendance) {
                return back()->withErrors(['nis' => 'Anda sudah melakukan absensi hari ini.']);
            }

            // Create attendance record
            Attendance::create([
                'student_id' => $student->id,
                'date' => now(),
                'time_in' => now(),
            ]);

            $books = Book::all();

            return view('student.dashboard', compact('student', 'books'));
        }

        return view('student.attendance');
    }

    public function books(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        $books = $query->paginate(12);
        $categories = Book::distinct()->pluck('category');
        $authors = Book::distinct()->pluck('author');

        return view('student.books', compact('books', 'categories', 'authors'));
    }

    public function bookDetail(Book $book)
    {
        // Get related books from the same category
        $relatedBooks = Book::where('category', $book->category)
            ->where('id', '!=', $book->id)
            ->limit(4)
            ->get();

        return view('student.book-detail', compact('book', 'relatedBooks'));
    }
}
