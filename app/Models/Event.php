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
        'date' => 'date',
        'points' => 'array',
        'seats' => 'integer', // Add this line
    ];

    // ── Relationships ────────────────────────────────────

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    // ── Scopes ──────────────────────────────────────────

    public function scopeByCategory($query, $slug)
    {
        return $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>', now())->orderBy('date');
    }

    public function scopePast($query)
    {
        return $query->where('date', '<=', now())->orderByDesc('date');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // ── Accessors ──────────────────────────────────────

    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d F Y');
    }

    public function getAvailableSeatsAttribute()
    {
        $registeredCount = $this->registrations()->where('status', 'confirmed')->count();
        $seats = (int) $this->seats; // Cast to integer just in case

        return max(0, $seats - $registeredCount);
    }

    public function getRegistrationCountAttribute()
    {
        return $this->registrations()->count();
    }

    public function getConfirmedCountAttribute()
    {
        return $this->registrations()->where('status', 'confirmed')->count();
    }

    public function getPendingCountAttribute()
    {
        return $this->registrations()->where('status', 'pending')->count();
    }

    // ── Helpers ─────────────────────────────────────────

    public function getRelatedEvents(int $limit = 3)
    {
        return static::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->upcoming()
            ->limit($limit)
            ->get();
    }

    public function isFullyBooked()
    {
        return $this->available_seats <= 0;
    }

    public function hasAvailableSeats()
    {
        return $this->available_seats > 0;
    }

    public function isUserRegistered($email)
    {
        return $this->registrations()->where('email', $email)->exists();
    }

    public function getUserRegistration($email)
    {
        return $this->registrations()->where('email', $email)->first();
    }
}
