<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Magazine extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'cover_image',
        'pdf_file',
        'price',
        'publication_date',
        'week_number',
        'year',
        'is_active',
        'is_featured',
        'download_count'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'publication_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCurrentWeek($query)
    {
        $weekNumber = now()->weekOfYear;
        $year = now()->year;
        return $query->where('week_number', $weekNumber)->where('year', $year);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Generate a unique slug for the magazine
     */
    public function generateSlug($title = null)
    {
        $title = $title ?: $this->title;
        $baseSlug = \Illuminate\Support\Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        // Ensure slug is unique
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($magazine) {
            if (empty($magazine->slug)) {
                $magazine->slug = $magazine->generateSlug();
            }
        });

        static::updating(function ($magazine) {
            if ($magazine->isDirty('title') && empty($magazine->slug)) {
                $magazine->slug = $magazine->generateSlug();
            }
        });
    }
}
