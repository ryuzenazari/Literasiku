@extends('layouts.app')

@section('title', $book->title . ' - Literasiku Sekolah')

@section('content')
<!-- Breadcrumb -->
<div class="mb-8">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-2"></i>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <a href="{{ route('books') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                        Koleksi Buku
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-sm font-medium text-gray-500">{{ $book->title }}</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<!-- Book Detail Section -->
<div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
        <!-- Book Cover -->
        <div class="lg:col-span-1 bg-gradient-to-br from-gray-50 to-gray-100 p-8 flex items-center justify-center">
            <div class="relative">
                <img src="{{ $book->cover_image_url }}" 
                     alt="Sampul {{ $book->title }}" 
                     class="w-full max-w-sm h-auto rounded-2xl shadow-2xl"
                     onerror="this.onerror=null; this.src='{{ asset('images/default-book-cover.svg') }}';">
                
                <!-- Category Badge -->
                <div class="absolute -top-4 -right-4">
                    <span class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-full shadow-lg">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $book->category }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Book Information -->
        <div class="lg:col-span-2 p-8">
            <div class="space-y-8">
                <!-- Title and Author -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                        {{ $book->title }}
                    </h1>
                    <div class="flex items-center text-xl text-gray-600 mb-6">
                        <i class="fas fa-user mr-3 text-blue-500"></i>
                        <span class="font-semibold">{{ $book->author }}</span>
                    </div>
                </div>
                
                <!-- Book Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-calendar text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Tahun Terbit</div>
                                <div class="text-lg font-semibold text-gray-800">{{ $book->publication_year }}</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-file-alt text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Jumlah Halaman</div>
                                <div class="text-lg font-semibold text-gray-800">{{ $book->pages }} halaman</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-tag text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Kategori</div>
                                <div class="text-lg font-semibold text-gray-800">{{ $book->category }}</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Ditambahkan</div>
                                <div class="text-lg font-semibold text-gray-800">{{ $book->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Books Section -->
@if($relatedBooks->count() > 0)
<div class="bg-white rounded-3xl shadow-xl overflow-hidden">
    <div class="p-8 border-b border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            <i class="fas fa-book mr-3 text-blue-600"></i>
            Buku Serupa
        </h2>
        <p class="text-gray-600">Buku lain dalam kategori {{ $book->category }}</p>
    </div>
    
    <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedBooks as $relatedBook)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden card-hover">
                    <!-- Book Cover -->
                    <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200">
                        <img src="{{ $relatedBook->cover_image_url }}" 
                             alt="Sampul {{ $relatedBook->title }}" 
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.src='{{ asset('images/default-book-cover.svg') }}';">
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2 py-1 bg-blue-500 text-white text-xs font-semibold rounded-full">
                                {{ $relatedBook->category }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Book Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 leading-tight">
                            {{ $relatedBook->title }}
                        </h3>
                        
                        <div class="space-y-1 mb-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-2 text-blue-500 w-4"></i>
                                <span class="text-sm">{{ $relatedBook->author }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar mr-2 text-purple-500 w-4"></i>
                                <span class="text-sm">{{ $relatedBook->publication_year }}</span>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="{{ route('books.detail', $relatedBook) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Back to Books Button -->
<div class="mt-8 text-center">
    <a href="{{ route('books') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300">
        <i class="fas fa-arrow-left mr-3"></i>
        Kembali ke Koleksi Buku
    </a>
</div>
@endsection
