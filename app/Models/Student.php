<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nis',
        'photo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'photo_url',
        'photo_url_for_admin',
    ];

    /**
     * Get the student photo URL with fallback to default
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->hasValidPhoto()) {
            return Storage::disk('public')->url($this->photo);
        }
        
        return asset('images/default-student-avatar.svg');
    }

    /**
     * Get the student photo URL for admin panel
     */
    public function getPhotoUrlForAdminAttribute()
    {
        if ($this->hasValidPhoto()) {
            return Storage::disk('public')->url($this->photo);
        }
        
        return asset('images/default-student-avatar.svg');
    }

    /**
     * Check if the student has a valid photo
     */
    public function hasValidPhoto()
    {
        if (!$this->photo) {
            return false;
        }

        try {
            return Storage::disk('public')->exists($this->photo);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Delete the photo file when the student is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($student) {
            $student->deletePhoto();
        });

        static::updating(function ($student) {
            // If photo is being updated, delete the old file
            if ($student->isDirty('photo') && $student->getOriginal('photo')) {
                $oldPhoto = $student->getOriginal('photo');
                $student->deletePhoto($oldPhoto);
            }
        });
    }

    /**
     * Delete photo file
     */
    public function deletePhoto($path = null)
    {
        $imagePath = $path ?? $this->photo;
        
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            try {
                Storage::disk('public')->delete($imagePath);
            } catch (\Exception $e) {
                // Log error but don't throw exception
                \Log::error('Failed to delete student photo: ' . $e->getMessage(), [
                    'student_id' => $this->id,
                    'photo_path' => $imagePath
                ]);
            }
        }
    }

    /**
     * Set photo with validation
     */
    public function setPhotoAttribute($value)
    {
        if ($value && is_string($value)) {
            // Validate file exists
            if (!Storage::disk('public')->exists($value)) {
                throw ValidationException::withMessages([
                    'photo' => 'File foto tidak ditemukan.'
                ]);
            }
        }
        
        $this->attributes['photo'] = $value;
    }

    /**
     * Scope to get students with valid photos
     */
    public function scopeWithValidPhotos($query)
    {
        return $query->whereNotNull('photo');
    }

    /**
     * Scope to get students without photos
     */
    public function scopeWithoutPhotos($query)
    {
        return $query->whereNull('photo');
    }

    /**
     * Search students by name or NIS
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('nis', 'like', "%{$search}%");
        });
    }

    /**
     * Get recent students
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Get active students (with recent attendance)
     */
    public function scopeActive($query, $days = 30)
    {
        return $query->whereHas('attendances', function ($q) use ($days) {
            $q->where('created_at', '>=', now()->subDays($days));
        });
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
