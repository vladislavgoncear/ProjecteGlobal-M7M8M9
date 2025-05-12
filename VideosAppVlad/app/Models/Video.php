<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    protected $fillable = [
        'path',
        'title',
        'description',
        'published_at',
        'url',
        'user_id',
        'previous',
        'next',
        'series_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $dates = ['published_at'];

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->format('j \d\e F \d\e Y');
    }

    public function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    public function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
