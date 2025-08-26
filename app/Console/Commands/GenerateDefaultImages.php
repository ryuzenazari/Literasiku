<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class GenerateDefaultImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:generate-defaults {--force : Force regenerate all default images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate default cover images for books and photos for students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting default image generation...');
        
        // Check if default images exist
        $defaultBookCover = public_path('images/default-book-cover.svg');
        $defaultStudentAvatar = public_path('images/default-student-avatar.svg');
        
        if (!file_exists($defaultBookCover)) {
            $this->error('Default book cover image not found at: ' . $defaultBookCover);
            return 1;
        }
        
        if (!file_exists($defaultStudentAvatar)) {
            $this->error('Default student avatar image not found at: ' . $defaultStudentAvatar);
            return 1;
        }
        
        $this->info('Default images found ✓');
        
        // Count books and students
        $booksCount = Book::count();
        $studentsCount = Student::count();
        $booksWithCovers = Book::whereNotNull('cover_photo')->count();
        $studentsWithPhotos = Student::whereNotNull('photo')->count();
        
        $this->info("Books: {$booksCount} total, {$booksWithCovers} with covers");
        $this->info("Students: {$studentsCount} total, {$studentsWithPhotos} with photos");
        
        if (!$this->option('force')) {
            if ($this->confirm('Do you want to continue?')) {
                $this->generateImages();
            } else {
                $this->info('Operation cancelled');
                return 0;
            }
        } else {
            $this->generateImages();
        }
        
        return 0;
    }
    
    private function generateImages()
    {
        $this->info('Generating images...');
        
        // Generate book cover images
        $books = Book::whereNull('cover_photo')->get();
        if ($books->count() > 0) {
            $this->info("Found {$books->count()} books without cover images");
            
            $bar = $this->output->createProgressBar($books->count());
            $bar->start();
            
            foreach ($books as $book) {
                // Create a simple text-based cover image
                $this->createBookCoverImage($book);
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();
            $this->info("Generated {$books->count()} book cover images");
        }
        
        // Generate student photos
        $students = Student::whereNull('photo')->get();
        if ($students->count() > 0) {
            $this->info("Found {$students->count()} students without photos");
            
            $bar = $this->output->createProgressBar($students->count());
            $bar->start();
            
            foreach ($students as $student) {
                // Create a simple text-based avatar
                $this->createStudentAvatar($student);
                $bar->advance();
            }
            
            $bar->finish();
            $this->newLine();
            $this->info("Generated {$students->count()} student avatars");
        }
        
        $this->info('Default image generation completed!');
    }
    
    private function createBookCoverImage($book)
    {
        // Create a simple SVG cover with book title
        $svg = $this->generateBookCoverSVG($book);
        $filename = 'books/covers/' . uniqid() . '.svg';
        
        if (Storage::disk('public')->put($filename, $svg)) {
            $book->update(['cover_photo' => $filename]);
        }
    }
    
    private function createStudentAvatar($student)
    {
        // Create a simple SVG avatar with student initials
        $svg = $this->generateStudentAvatarSVG($student);
        $filename = 'students/photos/' . uniqid() . '.svg';
        
        if (Storage::disk('public')->put($filename, $svg)) {
            $student->update(['photo' => $filename]);
        }
    }
    
    private function generateBookCoverSVG($book)
    {
        $title = $book->title;
        $author = $book->author;
        $category = $book->category;
        $year = $book->publication_year;
        
        return <<<SVG
<svg width="300" height="400" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg">
  <!-- Background -->
  <rect width="300" height="400" fill="#f8f9fa" stroke="#e9ecef" stroke-width="2"/>
  
  <!-- Book spine -->
  <rect x="20" y="40" width="260" height="320" fill="#6c757d" stroke="#495057" stroke-width="1"/>
  
  <!-- Book pages -->
  <rect x="25" y="45" width="250" height="310" fill="#ffffff" stroke="#dee2e6" stroke-width="1"/>
  
  <!-- Title area -->
  <rect x="35" y="80" width="230" height="60" fill="#e9ecef" stroke="#ced4da" stroke-width="1"/>
  
  <!-- Title text -->
  <text x="150" y="105" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" fill="#495057" font-weight="bold">
    {$title}
  </text>
  
  <!-- Author text -->
  <text x="150" y="125" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" fill="#6c757d">
    {$author}
  </text>
  
  <!-- Category badge -->
  <rect x="35" y="160" width="80" height="25" fill="#007bff" rx="5"/>
  <text x="75" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="8" fill="#ffffff" font-weight="bold">
    {$category}
  </text>
  
  <!-- Year badge -->
  <rect x="185" y="160" width="80" height="25" fill="#28a745" rx="5"/>
  <text x="225" y="175" text-anchor="middle" font-family="Arial, sans-serif" font-size="8" fill="#ffffff" font-weight="bold">
    {$year}
  </text>
  
  <!-- Decorative elements -->
  <circle cx="50" cy="50" r="3" fill="#007bff"/>
  <circle cx="250" cy="50" r="3" fill="#007bff"/>
  <circle cx="50" cy="350" r="3" fill="#007bff"/>
  <circle cx="250" cy="350" r="3" fill="#007bff"/>
</svg>
SVG;
    }
    
    private function generateStudentAvatarSVG($student)
    {
        $name = $student->name;
        $nis = $student->nis;
        $initials = $this->getInitials($name);
        
        return <<<SVG
<svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <!-- Background circle -->
  <circle cx="100" cy="100" r="100" fill="#e3f2fd" stroke="#2196f3" stroke-width="2"/>
  
  <!-- Inner circle for face -->
  <circle cx="100" cy="90" r="35" fill="#ffccbc" stroke="#ff8a65" stroke-width="1"/>
  
  <!-- Initials -->
  <text x="100" y="100" text-anchor="middle" font-family="Arial, sans-serif" font-size="24" fill="#2196f3" font-weight="bold">
    {$initials}
  </text>
  
  <!-- Name -->
  <text x="100" y="140" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" fill="#495057" font-weight="bold">
    {$name}
  </text>
  
  <!-- NIS -->
  <text x="100" y="155" text-anchor="middle" font-family="Arial, sans-serif" font-size="8" fill="#6c757d">
    NIS: {$nis}
  </text>
  
  <!-- Decorative elements -->
  <circle cx="30" cy="30" r="3" fill="#2196f3" opacity="0.6"/>
  <circle cx="170" cy="30" r="3" fill="#2196f3" opacity="0.6"/>
  <circle cx="30" cy="170" r="3" fill="#2196f3" opacity="0.6"/>
  <circle cx="170" cy="170" r="3" fill="#2196f3" opacity="0.6"/>
</svg>
SVG;
    }
    
    private function getInitials($name)
    {
        $words = explode(' ', trim($name));
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }
}
