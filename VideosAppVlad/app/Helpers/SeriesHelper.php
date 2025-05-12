<?php

namespace App\Helpers;

use App\Models\Series;
use Carbon\Carbon;

class SeriesHelper
{
    public static function create_series()
    {
        $seriesData = [
            [
                'title' => 'Laravel Basics',
                'description' => 'Learn the basics of Laravel framework.',
                'image' => 'laravel_basics.jpg',
                'user_name' => 'Admin',
                'user_photo_url' => 'admin_photo.jpg',
                'published_at' => now(),
            ],
            [
                'title' => 'Advanced PHP',
                'description' => 'Master advanced PHP programming techniques.',
                'image' => 'advanced_php.jpg',
                'user_name' => 'Admin',
                'user_photo_url' => 'admin_photo.jpg',
                'published_at' => now(),
            ],
            [
                'title' => 'JavaScript Essentials',
                'description' => 'A complete guide to JavaScript essentials.',
                'image' => 'javascript_essentials.jpg',
                'user_name' => 'Admin',
                'user_photo_url' => 'admin_photo.jpg',
                'published_at' => now(),
            ],
        ];

        foreach ($seriesData as $data) {
            \App\Models\Series::firstOrCreate(['title' => $data['title']], $data);
        }
    }
}
