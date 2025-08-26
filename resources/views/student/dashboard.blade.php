@extends('layouts.app')

@section('title', 'Dashboard - Literasiku Sekolah')

@section('content')
<!-- Welcome Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10">
        <div class="flex flex-col md:flex-row items-center">
            <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8">
                <img src="{{ $student->photo_url }}" 
                     alt="Foto {{ $student->name }}" 
                     class="h-24 w-24 rounded-full object-cover border-4 border-white/20 shadow-lg"
                     onerror="this.onerror=null; this.src='{{ asset('images/default-student-avatar.svg') }}';">
            </div>
            <div class="text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $student->name }}</h1>
                <p class="text-xl text-blue-100 mb-4">NIS: {{ $student->nis }}</p>
                <div class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-full text-sm font-semibold">
                    <i class="fas fa-check-circle mr-2"></i>
                    Absensi berhasil - {{ now()->format('d M Y H:i') }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-4 right-4 w-16 h-16 bg-white/10 rounded-full"></div>
    <div class="absolute bottom-4 left-4 w-12 h-12 bg-yellow-300/20 rounded-full"></div>
</div>

<!-- Back Button for Next Student -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
    <div class="text-center">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-users mr-2 text-blue-600"></i>
            Siswa Berikutnya
        </h3>
        <p class="text-gray-600 mb-6">
            Jika ada siswa lain yang ingin melakukan absensi, silakan klik tombol di bawah ini untuk kembali ke halaman absensi.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('attendance') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-arrow-left mr-3"></i>
                Kembali ke Absensi
            </a>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                <i class="fas fa-home mr-3"></i>
                Beranda
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">{{ \App\Models\Student::count() }}</div>
                <div class="text-sm text-gray-600">Total Siswa</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-book text-white text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">{{ \App\Models\Book::count() }}</div>
                <div class="text-sm text-gray-600">Total Buku</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">{{ \App\Models\Attendance::whereDate('date', now())->count() }}</div>
                <div class="text-sm text-gray-600">Absensi Hari Ini</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mr-4">
                <i class="fas fa-star text-white text-xl"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-800">4.8</div>
                <div class="text-sm text-gray-600">Rating Sistem</div>
            </div>
        </div>
    </div>
</div>

<!-- Books Collection Section -->
<div class="bg-white rounded-3xl shadow-xl overflow-hidden">
    <div class="p-8 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-book mr-3 text-green-600"></i>
                    Koleksi Buku Perpustakaan
                </h2>
                <p class="text-gray-600">Jelajahi koleksi buku yang tersedia (hanya dapat dibaca di tempat)</p>
            </div>
            <a href="{{ route('books') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg">
                <i class="fas fa-search mr-3"></i>
                Lihat Semua
            </a>
        </div>
    </div>

    <div class="p-8">
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($books->take(8) as $book)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden card-hover">
                        <!-- Book Cover -->
                        <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200">
                            <img src="{{ $book->cover_image_url }}" 
                                 alt="Sampul {{ $book->title }}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-book-cover.svg') }}';">
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">
                                    {{ $book->category }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Book Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 leading-tight">
                                {{ $book->title }}
                            </h3>
                            
                            <div class="space-y-1 mb-3">
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-user mr-2 text-blue-500 w-3"></i>
                                    <span>{{ $book->author }}</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-calendar mr-2 text-green-500 w-3"></i>
                                    <span>{{ $book->publication_year }}</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class="fas fa-file-alt mr-2 text-purple-500 w-3"></i>
                                    <span>{{ $book->pages }} halaman</span>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <a href="{{ route('books.detail', $book) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 text-sm">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($books->count() > 8)
                <div class="text-center mt-8">
                    <a href="{{ route('books') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg">
                        <i class="fas fa-arrow-right mr-3"></i>
                        Lihat Semua {{ $books->count() }} Buku
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-book text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada buku tersedia</h3>
                <p class="text-gray-600 mb-6">Koleksi buku akan segera ditambahkan ke perpustakaan digital.</p>
            </div>
        @endif
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white rounded-3xl shadow-xl p-8 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        <i class="fas fa-history mr-3 text-purple-600"></i>
        Aktivitas Terbaru
    </h2>
    
    <div class="space-y-4">
        <div class="flex items-center p-4 bg-green-50 rounded-2xl border border-green-100">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-check text-white"></i>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-gray-800">Absensi Berhasil</h4>
                <p class="text-sm text-gray-600">Anda telah berhasil melakukan absensi hari ini</p>
            </div>
            <div class="text-sm text-gray-500">{{ now()->format('H:i') }}</div>
        </div>
        
        <div class="flex items-center p-4 bg-blue-50 rounded-2xl border border-blue-100">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-book-open text-white"></i>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-gray-800">Akses Koleksi Buku</h4>
                <p class="text-sm text-gray-600">Anda dapat mengakses semua koleksi buku perpustakaan</p>
            </div>
            <div class="text-sm text-gray-500">{{ now()->format('H:i') }}</div>
        </div>
        
        <div class="flex items-center p-4 bg-purple-50 rounded-2xl border border-purple-100">
            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-user-check text-white"></i>
            </div>
            <div class="flex-1">
                <h4 class="font-semibold text-gray-800">Profil Terverifikasi</h4>
                <p class="text-sm text-gray-600">Data siswa Anda telah terverifikasi dalam sistem</p>
            </div>
            <div class="text-sm text-gray-500">{{ now()->format('H:i') }}</div>
        </div>
    </div>
</div>
@endsection
