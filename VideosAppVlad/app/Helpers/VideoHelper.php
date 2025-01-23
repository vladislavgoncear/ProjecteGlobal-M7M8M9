<?php

namespace App\Helpers;

use App\Models\Video;
use Carbon\Carbon;

class VideoHelper
{
    /**
     * Get default video data.
     *
     * @return array
     */
    public static function getDefaultVideos()
    {
        return [
            [
                'title' => 'Car Wash',
                'description' => 'Day in the life of a Luxury Car Wash',
                'url' => 'https://www.youtube.com/watch?v=53CAROF-w-E',
                'published_at' => Carbon::now(),
                'previous' => null,
                'next' => null,
                'series_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Porche Review',
                'description' => 'Porsche 992 GT3 RS // 306km/h REVIEW on Autobahn',
                'url' => 'https://www.youtube.com/watch?v=_ALtBbXcyXc',
                'published_at' => Carbon::now(),
                'previous' => 1,
                'next' => null,
                'series_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
    }
}
