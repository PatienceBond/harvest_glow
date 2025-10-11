<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeroImage extends Model
{
    protected $fillable = [
        'hero_section_id',
        'image_path',
        'order',
    ];

    /**
     * Get the hero section this image belongs to
     */
    public function heroSection(): BelongsTo
    {
        return $this->belongsTo(HeroSection::class);
    }

    /**
     * Scope to order images
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
