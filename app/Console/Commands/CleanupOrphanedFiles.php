<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class CleanupOrphanedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:cleanup {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up orphaned files that are not referenced in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting orphaned files cleanup...');
        
        // Get all files in the books/covers directory
        $files = Storage::disk('public')->files('books/covers');
        
        // Get all cover_photo references from database
        $dbFiles = Book::whereNotNull('cover_photo')
            ->pluck('cover_photo')
            ->filter()
            ->toArray();
        
        $this->info("Found " . count($files) . " files in storage");
        $this->info("Found " . count($dbFiles) . " files referenced in database");
        
        $orphanedFiles = [];
        foreach ($files as $file) {
            if (!in_array($file, $dbFiles)) {
                $orphanedFiles[] = $file;
            }
        }
        
        if (empty($orphanedFiles)) {
            $this->info('No orphaned files found!');
            return 0;
        }
        
        $this->warn("Found " . count($orphanedFiles) . " orphaned files:");
        foreach ($orphanedFiles as $file) {
            $this->line("  - " . $file);
        }
        
        if ($this->option('dry-run')) {
            $this->info('Dry run mode - no files were deleted');
            return 0;
        }
        
        // Auto-delete if running non-interactively
        if (!$this->input->isInteractive()) {
            $deletedCount = 0;
            foreach ($orphanedFiles as $file) {
                if (Storage::disk('public')->delete($file)) {
                    $this->info("Deleted: " . $file);
                    $deletedCount++;
                } else {
                    $this->error("Failed to delete: " . $file);
                }
            }
            
            $this->info("Successfully deleted {$deletedCount} orphaned files");
            return 0;
        }
        
        if ($this->confirm('Do you want to delete these orphaned files?')) {
            $deletedCount = 0;
            foreach ($orphanedFiles as $file) {
                if (Storage::disk('public')->delete($file)) {
                    $this->info("Deleted: " . $file);
                    $deletedCount++;
                } else {
                    $this->error("Failed to delete: " . $file);
                }
            }
            
            $this->info("Successfully deleted {$deletedCount} orphaned files");
        } else {
            $this->info('Cleanup cancelled');
        }
        
        return 0;
    }
}
