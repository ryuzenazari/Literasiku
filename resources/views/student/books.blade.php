@extends('layouts.app')

@section('title', 'Koleksi Buku - Literasiku Sekolah')

@section('content')
<!-- Header Section -->
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-3xl mb-6">
        <i class="fas fa-book text-white text-3xl"></i>
    </div>
    <h1 class="text-4xl font-bold text-gray-800 mb-4">
        Koleksi Buku Digital
    </h1>
    <p class="text-xl text-gray-600 leading-relaxed">
        Jelajahi ribuan koleksi buku dari berbagai kategori dan penulis
    </p>
</div>

<!-- Search and Filter Section -->
<div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
    <form method="GET" action="{{ route('books') }}" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Search Input -->
            <div class="md:col-span-2">
                <label for="search" class="block text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-search mr-3 text-green-600"></i>
                    Cari Buku
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-lg"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           id="search" 
                           value="{{ request('search') }}"
                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-green-100 focus:border-green-500 transition-all duration-300"
                           placeholder="Judul buku atau nama penulis...">
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-tag mr-3 text-blue-600"></i>
                    Kategori
                </label>
                <select name="category" 
                        id="category"
                        class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300">
                    <option value="">Semua Kategori</option>
                    <option value="Novel" {{ request('category') == 'Novel' ? 'selected' : '' }}>Novel</option>
                    <option value="Pendidikan" {{ request('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Teknologi" {{ request('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Sejarah" {{ request('category') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                    <option value="Sains" {{ request('category') == 'Sains' ? 'selected' : '' }}>Sains</option>
                    <option value="Fiksi" {{ request('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                    <option value="Non-Fiksi" {{ request('category') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                    <option value="Lainnya" {{ request('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <!-- Year Filter -->
            <div>
                <label for="year" class="block text-lg font-semibold text-gray-800 mb-3">
                    <i class="fas fa-calendar mr-3 text-purple-600"></i>
                    Tahun Terbit
                </label>
                <select name="year" 
                        id="year"
                        class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-300">
                    <option value="">Semua Tahun</option>
                    @for($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-2xl font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-search mr-3"></i>
                    Cari Buku
                </button>
                <a href="{{ route('books') }}" class="inline-flex items-center px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-2xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                    <i class="fas fa-refresh mr-3"></i>
                    Reset
                </a>
            </div>
            
            <div class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-2"></i>
                Ditemukan {{ $books->total() }} buku
            </div>
        </div>
    </form>
</div>

<!-- Books Grid -->
<div class="space-y-8">
    @if($books->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($books as $book)
                <div class="bg-white rounded-3xl shadow-lg card-hover overflow-hidden">
                    <!-- Book Cover -->
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200">
                        <img src="{{ $book->cover_image_url }}" 
                             alt="Sampul {{ $book->title }}" 
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.src='{{ asset('images/default-book-cover.svg') }}';">
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $book->category }}
                            </span>
                        </div>
                        
                        <!-- Year Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 bg-purple-500 text-white text-xs font-semibold rounded-full">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $book->publication_year }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Book Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 leading-tight">
                            {{ $book->title }}
                        </h3>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-3 text-blue-500 w-4"></i>
                                <span class="text-sm">{{ $book->author }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-file-alt mr-3 text-green-500 w-4"></i>
                                <span class="text-sm">{{ $book->pages }} halaman</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('books.detail', $book) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-300 text-sm">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Detail
                            </a>
                            <button class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition-all duration-300">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($books->hasPages())
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $books->firstItem() }} - {{ $books->lastItem() }} dari {{ $books->total() }} buku
                    </div>
                    <div class="flex gap-2">
                        @if($books->onFirstPage())
                            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-2"></i>
                                Sebelumnya
                            </span>
                        @else
                            <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                                <i class="fas fa-chevron-left mr-2"></i>
                                Sebelumnya
                            </a>
                        @endif
                        
                        @if($books->hasMorePages())
                            <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                                Selanjutnya
                                <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed">
                                Selanjutnya
                                <i class="fas fa-chevron-right ml-2"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Tidak ada buku ditemukan</h3>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                Coba ubah filter pencarian Anda atau gunakan kata kunci yang berbeda untuk menemukan buku yang Anda cari.
            </p>
            <a href="{{ route('books') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-semibold hover:from-blue-700 hover:to-blue-800 transition-all duration-300">
                <i class="fas fa-refresh mr-3"></i>
                Lihat Semua Buku
            </a>
        </div>
    @endif
</div>
@endsection