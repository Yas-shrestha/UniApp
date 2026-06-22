<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'author',
        'published_at',
        'excerpt',
        'body',
        'quick_links',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'date',
        'quick_links'  => 'array',
        'is_featured'  => 'boolean',
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

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('excerpt', 'like', "%{$term}%")
                ->orWhere('body', 'like', "%{$term}%");
        });
    }

    // ── Helpers ─────────────────────────────────────────

    public function getFormattedDateAttribute(): string
    {
        return $this->published_at->format('M d, Y');
    }

    public function getRelatedBlogs(int $limit = 3)
    {
        return static::with('category')
            ->where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->published()
            ->limit($limit)
            ->get();
    }
}
