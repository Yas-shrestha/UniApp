<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // No need to specify table - Laravel will use 'contacts' by default

    protected $fillable = [
        'name',
        'email',
        'company_name',
        'job_title',
        'job_details',
        'phone',
        'message',
        'status',
        'read_at',
        'replied_at',
        'admin_reply',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    // Accessors
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    public function markAsReplied($reply = null)
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now(),
            'admin_reply' => $reply,
        ]);
    }

    public function isUnread()
    {
        return $this->status === 'unread';
    }

    public function isRead()
    {
        return $this->status === 'read';
    }

    public function isReplied()
    {
        return $this->status === 'replied';
    }
}
