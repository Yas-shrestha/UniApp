<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'slug',
        'image',
        'icon',
        'short_description',
        'body',
        'points',
        'catalog_pdf',
        'catalog_doc',
        'is_featured',
    ];

    protected $casts = [
        'points'      => 'array',
        'is_featured' => 'boolean',
    ];

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getRelatedServices(int $limit = 4)
    {
        return self::where('type', $this->type)
            ->where('id', '!=', $this->id)
            ->limit($limit)
            ->get();
    }

    protected static function booted()
    {
        static::saving(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }
}
