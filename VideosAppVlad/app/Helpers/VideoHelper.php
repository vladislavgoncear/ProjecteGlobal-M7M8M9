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
        Video::Create([
            'title' => 'Car Wash',
            'description' => 'Day in the life of a Luxury Car Wash',
            'url' => 'https://www.youtube.com/embed/53CAROF-w-E',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
            'user_id' => 1, // Añadir el campo user_id
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Video::Create([
            'title' => 'Porche Review',
            'description' => 'Porsche 992 GT3 RS // 306km/h REVIEW on Autobahn',
            'url' => 'https://www.youtube.com/embed/_ALtBbXcyXc',
            'published_at' => Carbon::now(),
            'previous' => 1,
            'next' => null,
            'series_id' => 1,
            'user_id' => 1, // Añadir el campo user_id
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Video::Create(
            [
                'title' => 'Ferrari Review',
                'description' => 'Ferrari 812 GTS Review',
                'url' => 'https://youtu.be/hXYb0mJM_wQ',
                'published_at' => Carbon::now(),
                'previous' => 2,
                'next' => null,
                'series_id' => 1,
                'user_id' => 1, // Añadir el campo user_id
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

//        return [
//            [
//                'title' => 'Car Wash',
//                'description' => 'Day in the life of a Luxury Car Wash',
//                'url' => 'https://www.youtube.com/embed/53CAROF-w-E',
//                'published_at' => Carbon::now(),
//                'previous' => null,
//                'next' => null,
//                'series_id' => 1,
//                'user_id' => 1, // Añadir el campo user_id
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//            [
//                'title' => 'Porche Review',
//                'description' => 'Porsche 992 GT3 RS // 306km/h REVIEW on Autobahn',
//                'url' => 'https://www.youtube.com/embed/_ALtBbXcyXc',
//                'published_at' => Carbon::now(),
//                'previous' => 1,
//                'next' => null,
//                'series_id' => 1,
//                'user_id' => 1, // Añadir el campo user_id
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//            [
//                'title' => 'Ferrari Review',
//                'description' => 'Ferrari 812 GTS Review',
//                'url' => 'https://youtu.be/hXYb0mJM_wQ',
//                'published_at' => Carbon::now(),
//                'previous' => 2,
//                'next' => null,
//                'series_id' => 1,
//                'user_id' => 1, // Añadir el campo user_id
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ]
//        ];
    }
}
