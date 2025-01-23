<?php

namespace Tests\Unit;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    public function can_get_formatted_published_at_date()
    {
        $video = Video::create([
            'title' => 'Sample Video',
            'description' => 'This is a sample video.',
            'url' => 'https://example.com/video.mp4',
            'published_at' => Carbon::now(),
        ]);

        $this->assertEquals(
            Carbon::now()->translatedFormat('j \d\e F \d\e Y'),
            $video->formatted_published_at
        );
    }

    public function can_get_formatted_published_at_date_when_not_published()
    {
        $video = Video::create([
            'title' => 'Sample Video',
            'description' => 'This is a sample video.',
            'url' => 'https://example.com/video.mp4',
            'published_at' => null,
        ]);

        $this->assertNull($video->formatted_published_at);
    }
}
