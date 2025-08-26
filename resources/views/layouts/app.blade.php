<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMPN 36 Surabaya - Literasiku')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] {
            display: none !important;
        }
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.1); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .animate-fade-in { animation: fadeIn 0.6s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .text-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="flex items-center text-gray-800 text-xl font-bold">
                            <div class="mr-3">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo SMPN 36 Surabaya" class="h-10 w-10 brand-logo">
                            </div>
                            <span class="text-gradient font-bold hidden sm:block">SMPN 36 Surabaya - Literasiku</span>
                            <span class="text-gradient font-bold sm:hidden">Literasiku</span>
                        </a>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('attendance') }}" class="text-gray-800 hover:text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-clock mr-2 text-blue-500"></i> Absensi
                    </a>
                    <a href="{{ route('books') }}" class="text-gray-800 hover:text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-book mr-2 text-green-500"></i> Koleksi
                    </a>
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-800 hover:text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-cog mr-2 text-purple-500"></i> Admin
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-800 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-all duration-200 p-2 rounded-lg hover:bg-gray-100 active:bg-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg">
                    <a href="{{ route('attendance') }}" class="block text-gray-800 hover:text-blue-600 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-clock mr-3 text-blue-500"></i> Absensi
                    </a>
                    <a href="{{ route('books') }}" class="block text-gray-800 hover:text-blue-600 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-book mr-3 text-green-500"></i> Koleksi
                    </a>
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="block text-gray-800 hover:text-blue-600 px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-300 text-sm font-medium">
                        <i class="fas fa-cog mr-3 text-purple-500"></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fade-in">
        @if(session('success'))
            <div class="mb-6 bg-green-50 text-green-800 px-6 py-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 text-red-800 px-6 py-4 rounded-xl shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    <span class="font-medium">Terjadi kesalahan:</span>
                </div>
                <ul class="ml-8 space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-sm">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    @livewire('notifications')

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-800 to-slate-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="mr-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo SMPN 36 Surabaya" class="h-8 w-8 brand-logo">
                        </div>
                        <span class="text-xl font-bold">SMPN 36 Surabaya - Literasiku</span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Sistem digitalisasi perpustakaan SMPN 36 Surabaya yang modern dan user-friendly untuk mendukung literasi digital siswa.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Fitur Utama</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Absensi Digital
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Katalog Buku Digital
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Manajemen Siswa
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Laporan Real-time
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>
                            SMPN Negeri 36 Surabaya
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-2 text-blue-400"></i>
                            +62 31 1234 5678
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>
                            smp36surabaya@gmail.com
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Admin Login Section -->
            <div class="border-t border-gray-700 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <p class="text-gray-400 text-sm">
                            &copy; {{ date('Y') }} Literasiku Sekolah. Semua hak dilindungi.
                        </p>
                        <p class="text-gray-500 text-xs mt-2">
                            Dibuat dengan ❤️ untuk pendidikan Indonesia yang lebih baik
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Admin panel removed -->
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @filamentScripts
    @vite('resources/js/app.js')
    
    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    // Toggle mobile menu visibility
                    mobileMenu.classList.toggle('hidden');
                    
                    // Change hamburger icon to X when menu is open
                    const svg = mobileMenuButton.querySelector('svg');
                    if (mobileMenu.classList.contains('hidden')) {
                        // Show hamburger icon
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
                    } else {
                        // Show X icon
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
                    }
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                        const svg = mobileMenuButton.querySelector('svg');
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
                    }
                });
                
                // Close mobile menu when window is resized to desktop size
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768) { // md breakpoint
                        mobileMenu.classList.add('hidden');
                        const svg = mobileMenuButton.querySelector('svg');
                        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
                    }
                });
            }
        });
    </script>
</body>
</html>
