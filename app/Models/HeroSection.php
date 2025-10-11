<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'heading',
        'subheading',
        'image',
        'height',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all images for this hero section
     */
    public function images(): HasMany
    {
        return $this->hasMany(HeroImage::class)->ordered();
    }

    /**
     * Get hero section for a specific page with images
     */
    public static function forPage($page)
    {
        return static::where('page', $page)
            ->where('is_active', true)
            ->with('images')
            ->first();
    }

    /**
     * Scope to get only active hero sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
