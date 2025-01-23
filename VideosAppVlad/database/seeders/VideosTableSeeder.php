<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Helpers\VideoHelper;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultVideos = VideoHelper::getDefaultVideos();
        foreach ($defaultVideos as $video) {
            \App\Models\Video::create($video);
        }
    }
}
