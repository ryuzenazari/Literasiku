@extends('layouts.app')

@section('title', 'Absensi - Literasiku Sekolah')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl mb-6">
            <i class="fas fa-clock text-white text-3xl"></i>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-4">
            Absensi Digital
        </h1>
        <p class="text-xl text-gray-600 leading-relaxed">
            Masukkan NIS Anda untuk melakukan absensi masuk perpustakaan
        </p>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white rounded-3xl shadow-xl p-8 card-hover">
        <form method="POST" action="{{ route('attendance') }}" class="space-y-8">
            @csrf
            
            <div class="space-y-4">
                <label for="nis" class="block text-lg font-semibold text-gray-800">
                    <i class="fas fa-id-card mr-3 text-blue-600"></i>
                    Nomor Induk Siswa (NIS)
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-user-graduate text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           name="nis" 
                           id="nis" 
                           value="{{ old('nis') }}"
                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300"
                           placeholder="Contoh: 2024001"
                           required
                           autofocus>
                </div>
                <p class="text-sm text-gray-500 ml-4">
                    <i class="fas fa-info-circle mr-2"></i>
                    Masukkan NIS yang sudah terdaftar di sistem
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <a href="{{ route('home') }}" class="flex-1 inline-flex items-center justify-center px-6 py-4 border-2 border-gray-300 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Kembali ke Beranda
                </a>
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Absen Masuk
                </button>
            </div>
        </form>
    </div>

    <!-- Information Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- How to Use -->
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-question-circle text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Cara Menggunakan</h3>
            </div>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start">
                    <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</span>
                    <span>Masukkan NIS Anda di kolom input</span>
                </li>
                <li class="flex items-start">
                    <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</span>
                    <span>Klik tombol "Absen Masuk"</span>
                </li>
                <li class="flex items-start">
                    <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</span>
                    <span>Sistem akan memverifikasi data Anda</span>
                </li>
                <li class="flex items-start">
                    <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</span>
                    <span>Setelah berhasil, Anda dapat melihat koleksi buku</span>
                </li>
            </ul>
        </div>

        <!-- Rules -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-shield-alt text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-800">Ketentuan Absensi</h3>
            </div>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-3 mt-0.5"></i>
                    <span>Absensi hanya bisa dilakukan sekali per hari</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-3 mt-0.5"></i>
                    <span>NIS harus sudah terdaftar di sistem</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-3 mt-0.5"></i>
                    <span>Buku hanya dapat dibaca di perpustakaan</span>
                </li>
                <li class="flex items-start">
                    <i class="fas fa-check-circle text-green-500 mr-3 mt-0.5"></i>
                    <span>Tidak ada peminjaman buku keluar</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">
            <i class="fas fa-chart-pie mr-2 text-purple-600"></i>
            Statistik Hari Ini
        </h3>
        <div class="grid grid-cols-3 gap-4 text-center">
            <div>
                <div class="text-2xl font-bold text-blue-600">{{ \App\Models\Attendance::whereDate('date', now())->count() }}</div>
                <div class="text-sm text-gray-600">Absensi</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-green-600">{{ \App\Models\Student::count() }}</div>
                <div class="text-sm text-gray-600">Siswa</div>
            </div>
            <div>
                <div class="text-2xl font-bold text-purple-600">{{ \App\Models\Book::count() }}</div>
                <div class="text-sm text-gray-600">Buku</div>
            </div>
        </div>
    </div>
</div>
@endsection
