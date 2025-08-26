<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'category',
        'pages',
        'cover_photo',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
    ];

    protected $appends = [
        'cover_image_url',
        'cover_image_url_for_admin',
    ];

    /**
     * Get the cover image URL with fallback to default
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->hasValidCoverImage()) {
            return Storage::disk('public')->url($this->cover_photo);
        }
        
        return asset('images/default-book-cover.svg');
    }

    /**
     * Get the cover image URL for admin panel
     */
    public function getCoverImageUrlForAdminAttribute()
    {
        if ($this->hasValidCoverImage()) {
            return Storage::disk('public')->url($this->cover_photo);
        }
        
        return null; // Return null for admin panel to show default image
    }

    /**
     * Check if the book has a valid cover image
     */
    public function hasValidCoverImage()
    {
        if (!$this->cover_photo) {
            return false;
        }

        try {
            return Storage::disk('public')->exists($this->cover_photo);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete the cover image file when the book is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            $book->deleteCoverImage();
        });

        static::updating(function ($book) {
            // If cover_photo is being updated, delete the old file
            if ($book->isDirty('cover_photo') && $book->getOriginal('cover_photo')) {
                $oldCover = $book->getOriginal('cover_photo');
                $book->deleteCoverImage($oldCover);
            }
        });
    }

    /**
     * Delete cover image file
     */
    public function deleteCoverImage($path = null)
    {
        $imagePath = $path ?? $this->cover_photo;
        
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            try {
                Storage::disk('public')->delete($imagePath);
            } catch (\Exception $e) {
                // Log error but don't throw exception
                \Log::error('Failed to delete book cover image: ' . $e->getMessage());
            }
        }
    }

    /**
     * Set cover photo with validation
     */
    public function setCoverPhotoAttribute($value)
    {
        if ($value && is_string($value)) {
            // Validate file exists
            if (!Storage::disk('public')->exists($value)) {
                throw ValidationException::withMessages([
                    'cover_photo' => 'File cover tidak ditemukan.'
                ]);
            }
        }
        
        $this->attributes['cover_photo'] = $value;
    }

    /**
     * Scope to get books with valid cover images
     */
    public function scopeWithValidCovers($query)
    {
        return $query->whereNotNull('cover_photo');
    }

    /**
     * Scope to get books without cover images
     */
    public function scopeWithoutCovers($query)
    {
        return $query->whereNull('cover_photo');
    }

    /**
     * Get books by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Search books by title or author
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }

    /**
     * Get books by publication year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('publication_year', $year);
    }

    /**
     * Get recent books
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Get popular books (by attendance)
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('attendances')
                    ->orderBy('attendances_count', 'desc')
                    ->limit($limit);
    }
}
