<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    protected $fillable = [
        'path'
    ];
    protected $dates = ['published_at'];

    /**
     * Get the formatted published_at date.
     *
     *
     */
    public function getFormattedPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->format('j \d\e F \d\e Y');
    }

    /**
     * Get the published_at date formatted for humans.
     *
     *
     */
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    /**
     * Get the Unix timestamp of the published_at date.
     *
     * @return int
     */
    public function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
