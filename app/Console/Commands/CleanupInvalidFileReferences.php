<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class CleanupInvalidFileReferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:cleanup-file-refs {--dry-run : Show what would be cleaned without actually cleaning}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up database references to files that do not exist on the filesystem';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting invalid file reference cleanup...');
        
        $books = Book::whereNotNull('cover_photo')->get();
        $invalidRefs = [];
        
        foreach ($books as $book) {
            if (!empty($book->cover_photo) && !Storage::disk('public')->exists($book->cover_photo)) {
                $invalidRefs[] = [
                    'id' => $book->id,
                    'title' => $book->title,
                    'cover_photo' => $book->cover_photo
                ];
            }
        }
        
        if (empty($invalidRefs)) {
            $this->info('No invalid file references found!');
            return 0;
        }
        
        $this->warn("Found " . count($invalidRefs) . " invalid file references:");
        foreach ($invalidRefs as $ref) {
            $this->line("  - Book ID {$ref['id']} ({$ref['title']}): {$ref['cover_photo']}");
        }
        
        if ($this->option('dry-run')) {
            $this->info('Dry run mode - no database records were updated');
            return 0;
        }
        
        // Auto-clean if running non-interactively
        if (!$this->input->isInteractive()) {
            $cleanedCount = 0;
            foreach ($invalidRefs as $ref) {
                $book = Book::find($ref['id']);
                if ($book) {
                    $book->update(['cover_photo' => null]);
                    $this->info("Cleaned: Book ID {$ref['id']} ({$ref['title']})");
                    $cleanedCount++;
                }
            }
            
            $this->info("Successfully cleaned {$cleanedCount} invalid file references");
            return 0;
        }
        
        if ($this->confirm('Do you want to clean up these invalid references?')) {
            $cleanedCount = 0;
            foreach ($invalidRefs as $ref) {
                $book = Book::find($ref['id']);
                if ($book) {
                    $book->update(['cover_photo' => null]);
                    $this->info("Cleaned: Book ID {$ref['id']} ({$ref['title']})");
                    $cleanedCount++;
                }
            }
            
            $this->info("Successfully cleaned {$cleanedCount} invalid file references");
        } else {
            $this->info('Cleanup cancelled');
        }
        
        return 0;
    }
}
