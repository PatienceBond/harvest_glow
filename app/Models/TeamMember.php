<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'type',
        'photo',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLeadership($query)
    {
        return $query->where('type', 'leadership');
    }

    public function scopeTeam($query)
    {
        return $query->where('type', 'team');
    }

    public function scopeBoard($query)
    {
        return $query->where('type', 'board');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
