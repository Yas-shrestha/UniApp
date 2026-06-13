<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'date',
        'time',
        'location',
        'seats',
        'admission',
        'intro',
        'points',
        'audience',
        'speaker_name',
        'speaker_role',
        'speaker_image',
    ];

    protected $casts = [
        'date'   => 'date',
        'points' => 'array',
    ];

    // ── Relationships ────────────────────────────────────

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ── Scopes ──────────────────────────────────────────

    public function scopeByCategory($query, $slug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $slug));
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date');
    }

    // ── Helpers ─────────────────────────────────────────

    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d F Y');
    }

    public function getRelatedEvents(int $limit = 3)
    {
        return static::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->upcoming()
            ->limit($limit)
            ->get();
    }
    public function scopePast($query)
    {
        return $query->where('date', '<', now())->orderByDesc('date');
    }
}
