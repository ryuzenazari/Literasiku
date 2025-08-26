# Literasiku (Sistem Manajemen Perpustakaan Digital)

Sistem manajemen perpustakaan modern yang kaya fitur, dibangun dengan Laravel dan Filament. Aplikasi ini menyediakan alat komprehensif untuk mengelola siswa, buku, pelacakan kehadiran, dan operasi perpustakaan dengan antarmuka admin yang indah dan portal siswa.

## 🚀 Fitur

### 📚 Manajemen Buku
- **Katalog Buku Lengkap**: Tambah, edit, dan kelola informasi buku
- **Manajemen Sampul Buku**: Upload dan kelola gambar sampul buku dengan pengubahan ukuran otomatis
- **Kategori Buku**: Atur buku berdasarkan kategori
- **Pencarian & Filter**: Kemampuan pencarian dan filter yang canggih
- **Import/Export Excel**: Import dan export data buku secara massal

### 👥 Manajemen Siswa
- **Profil Siswa**: Manajemen informasi siswa yang lengkap
- **Manajemen Foto**: Upload foto siswa dengan pemrosesan otomatis
- **Sistem NIS**: Identifikasi siswa yang unik
- **Import/Export Excel**: Manajemen data siswa secara massal

### 📊 Pelacakan Kehadiran
- **Kehadiran Harian**: Lacak kunjungan siswa ke perpustakaan
- **Pencatatan Waktu**: Pencatatan waktu masuk otomatis
- **Laporan Kehadiran**: Generate statistik dan laporan kehadiran

### 🎨 Antarmuka Pengguna
- **Panel Admin**: Antarmuka admin yang indah berbasis Filament
- **Portal Siswa**: Antarmuka khusus untuk siswa
- **Desain Responsif**: Layout responsif yang ramah perangkat mobile
- **UI Modern**: Antarmuka bersih dan modern dengan Tailwind CSS

### 📁 Manajemen File
- **Pembersihan File Otomatis**: Deteksi dan pembersihan file yatim pribumi
- **Pemrosesan Gambar**: Pengubahan ukuran dan optimasi gambar otomatis
- **Manajemen Penyimpanan**: Penyimpanan file yang efisien dengan alat pembersihan

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12**: Framework PHP modern
- **Filament 4**: Panel admin dan pembuat form
- **SQLite**: Database ringan (dapat dikonfigurasi untuk produksi)
- **PHP 8.2+**: Fitur dan performa PHP terbaru

### Frontend
- **Tailwind CSS 4**: Framework CSS utility-first
- **Vite**: Alat build modern
- **Blade Templates**: Mesin templating Laravel
- **Alpine.js**: Framework JavaScript ringan

### Alat Tambahan
- **Laravel Excel**: Fungsionalitas import/export Excel
- **Laravel Storage**: Sistem manajemen file
- **Laravel Queue**: Pemrosesan pekerjaan latar belakang

## 📋 Persyaratan

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- SQLite (atau MySQL/PostgreSQL untuk produksi)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <url-repository>
cd Literasiku
```

### 2. Install Dependencies
```bash
# Install dependencies PHP
composer install

# Install dependencies Node.js
npm install
```

### 3. Setup Environment
```bash
# Salin file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database
```bash
# Jalankan migrasi database
php artisan migrate

# Seed database dengan data contoh
php artisan db:seed
```

### 5. Setup Penyimpanan File
```bash
# Buat storage link untuk akses publik
php artisan storage:link

# Generate gambar default
php artisan generate:default-images
```

### 6. Build Assets
```bash
# Build untuk development
npm run dev

# Build untuk produksi
npm run build
```

### 7. Jalankan Aplikasi
```bash
# Jalankan server development Laravel
php artisan serve

# Atau gunakan script development (termasuk queue dan logs)
composer run dev
```

## 📖 Penggunaan

### Akses Panel Admin
- URL: `http://localhost:8000/admin`
- Kredensial default: Periksa database seeder untuk detail user admin

### Akses Portal Siswa
- URL: `http://localhost:8000/student`
- Siswa dapat melihat buku, memeriksa kehadiran, dan mengakses informasi perpustakaan

### Penggunaan Fitur Utama

#### Manajemen Buku
1. Navigasi ke Books di panel admin
2. Tambah buku baru dengan gambar sampul
3. Gunakan import Excel untuk operasi massal
4. Export data buku sesuai kebutuhan

#### Manajemen Siswa
1. Akses bagian Students di panel admin
2. Tambah siswa dengan foto
3. Gunakan import Excel untuk pendaftaran siswa massal
4. Lacak kehadiran siswa

#### Pelacakan Kehadiran
1. Catat kehadiran harian di panel admin
2. Lihat laporan kehadiran dan statistik
3. Export data kehadiran

## 🧹 Perintah Pemeliharaan

### Manajemen File
```bash
# Bersihkan file yatim pribumi (dry run)
php artisan files:cleanup --dry-run

# Bersihkan file yatim pribumi
php artisan files:cleanup

# Bersihkan referensi file yang tidak valid (dry run)
php artisan db:cleanup-file-refs --dry-run

# Bersihkan referensi file yang tidak valid
php artisan db:cleanup-file-refs
```

### Manajemen Database
```bash
# Reset dan seed database
php artisan migrate:fresh --seed

# Generate gambar default
php artisan generate:default-images
```

## 📁 Struktur Proyek

```
Literasiku/
├── app/
│   ├── Console/Commands/     # Perintah Artisan kustom
│   ├── Exports/             # Kelas export Excel
│   ├── Filament/            # Resource panel admin
│   ├── Imports/             # Kelas import Excel
│   ├── Models/              # Model Eloquent
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Migrasi database
│   └── seeders/             # Database seeders
├── resources/
│   └── views/
│       └── student/         # View portal siswa
├── public/
│   ├── images/              # Gambar default
│   └── storage/             # Penyimpanan publik
└── storage/
    └── app/
        └── public/          # File yang diupload
```

## 🔧 Konfigurasi

### Pengaturan Upload File
- **Sampul Buku**: Maks 2MB, JPG/PNG, auto-resize ke 300x400px
- **Foto Siswa**: Maks 2MB, JPG/PNG, auto-resize ke 200x200px
- **Penyimpanan**: Public disk dengan pembersihan otomatis

### Konfigurasi Database
- **Development**: SQLite (default)
- **Produksi**: MySQL/PostgreSQL direkomendasikan

## 🧪 Testing

```bash
# Jalankan tests
composer test

# Jalankan tests dengan coverage
php artisan test --coverage
```

## 📦 Deployment

### Setup Produksi
1. Set `APP_ENV=production` di `.env`
2. Konfigurasi database produksi
3. Setup permission file yang tepat
4. Konfigurasi web server (Apache/Nginx)
5. Setup sertifikat SSL
6. Konfigurasi queue workers untuk pekerjaan latar belakang

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
QUEUE_CONNECTION=database
```

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch
3. Lakukan perubahan Anda
4. Tambah tests jika diperlukan
5. Submit pull request

## 📄 Lisensi

Proyek ini adalah perangkat lunak open-source yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Dukungan

Untuk dukungan dan pertanyaan:
- Buat issue di repository
- Periksa dokumentasi
- Tinjau dokumentasi Laravel dan Filament

## 🔄 Pembaruan

### Pembaruan Terbaru
- Upgrade ke Laravel 12
- Upgrade ke Filament 4
- Tambah manajemen file komprehensif
- Perbaiki antarmuka portal siswa
- Tingkatkan fungsionalitas import/export Excel

---

**Dibuat dengan ❤️ menggunakan Laravel dan Filament**
