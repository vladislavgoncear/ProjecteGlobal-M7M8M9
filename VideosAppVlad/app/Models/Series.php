<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Series extends Model
{
    protected $fillable = ['title',
        'description',
        'image',
        'published_at',
        'user_name',
        'user_photo_url'
    ];

    /**
     * Relationship: Series has many Videos (1:N).
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    /**
     * Placeholder function for testedBy.
     */
    public function testedBy()
    {
        // Define logic or relationship here if needed
    }

    /**
     * Accessor: Get formatted created_at date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

    /**
     * Accessor: Get human-readable created_at date.
     */
    public function getFormattedForHumansCreatedAtAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Accessor: Get created_at as a Unix timestamp.
     */
    public function getCreatedAtTimestampAttribute(): int
    {
        return $this->created_at->timestamp;
    }
}
