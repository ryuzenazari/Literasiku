@extends('layouts.app')

@section('title', 'Beranda - Literasiku Sekolah')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden rounded-3xl mb-12">
    <div class="gradient-bg relative z-10">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-20 px-8 py-16 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-6">
                        <i class="fas fa-book-open text-3xl"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Selamat Datang di
                        <span class="block text-yellow-300">Literasiku</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-blue-100 leading-relaxed">
                        Jelajahi dunia pengetahuan melalui koleksi digital kami yang lengkap dan modern
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('attendance') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-sign-in-alt mr-3 text-lg"></i>
                        Mulai Absensi
                    </a>
                    <a href="{{ route('books') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-book mr-3 text-lg"></i>
                        Lihat Koleksi
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full"></div>
    <div class="absolute top-1/2 left-20 w-16 h-16 bg-yellow-300/20 rounded-full"></div>
</div>

<!-- Features Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    <!-- Absensi Card -->
    <div class="bg-white rounded-2xl shadow-clean p-8 card-hover">
        <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-4">
                <i class="fas fa-clock text-white text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Absensi Digital</h3>
                <p class="text-gray-600 text-sm">Sistem absensi modern dengan NIS</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6 leading-relaxed">
            Lakukan absensi dengan mudah menggunakan Nomor Induk Siswa (NIS) Anda. Sistem yang cepat dan akurat untuk mencatat kehadiran di perpustakaan.
        </p>
        <a href="{{ route('attendance') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
            Mulai Absensi
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Koleksi Buku Card -->
    <div class="bg-white rounded-2xl shadow-clean p-8 card-hover">
        <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-4">
                <i class="fas fa-book text-white text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Koleksi Digital</h3>
                <p class="text-gray-600 text-sm">Ribuan buku dalam genggaman</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6 leading-relaxed">
            Jelajahi koleksi buku digital yang lengkap. Dari buku pelajaran hingga novel, semua tersedia dengan tampilan yang menarik dan mudah dinavigasi.
        </p>
        <a href="{{ route('books') }}" class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
            Lihat Koleksi
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>

    <!-- Statistik Card -->
    <div class="bg-white rounded-2xl shadow-clean p-8 card-hover">
        <div class="flex items-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                <i class="fas fa-chart-line text-white text-2xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-800">Statistik Real-time</h3>
                <p class="text-gray-600 text-sm">Data kunjungan terkini</p>
            </div>
        </div>
        <p class="text-gray-600 mb-6 leading-relaxed">
            Pantau statistik kunjungan perpustakaan secara real-time. Lihat tren kunjungan dan popularitas buku yang sedang diminati siswa.
        </p>
        <div class="text-purple-600 font-semibold">
            <i class="fas fa-eye mr-2"></i>
            Data Terkini
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="bg-white rounded-2xl shadow-clean p-8 mb-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        <i class="fas fa-chart-bar mr-3 text-blue-600"></i>
        Statistik Perpustakaan
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <div class="text-3xl font-bold text-gray-800 mb-2">{{ \App\Models\Student::count() }}</div>
            <div class="text-gray-600">Siswa Terdaftar</div>
        </div>
        
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book text-white text-2xl"></i>
            </div>
            <div class="text-3xl font-bold text-gray-800 mb-2">{{ \App\Models\Book::count() }}</div>
            <div class="text-gray-600">Koleksi Buku</div>
        </div>
        
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-clock text-white text-2xl"></i>
            </div>
            <div class="text-3xl font-bold text-gray-800 mb-2">{{ \App\Models\Attendance::whereDate('date', now())->count() }}</div>
            <div class="text-gray-600">Kunjungan Hari Ini</div>
        </div>
        
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-white text-2xl"></i>
            </div>
            <div class="text-3xl font-bold text-gray-800 mb-2">{{ \App\Models\Attendance::count() }}</div>
            <div class="text-gray-600">Total Kunjungan</div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 text-center text-white">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold mb-4">
            <i class="fas fa-rocket mr-3"></i>
            Siap Memulai Petualangan Literasi?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Bergabunglah dengan ribuan siswa yang telah merasakan kemudahan akses perpustakaan digital
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('attendance') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg">
                <i class="fas fa-play mr-3"></i>
                Mulai Sekarang
            </a>
            <a href="{{ route('books') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-700 text-white rounded-xl font-semibold hover:bg-blue-800 transition-all duration-300 shadow-lg">
                <i class="fas fa-search mr-3"></i>
                Jelajahi Koleksi
            </a>
        </div>
    </div>
</div>
@endsection
