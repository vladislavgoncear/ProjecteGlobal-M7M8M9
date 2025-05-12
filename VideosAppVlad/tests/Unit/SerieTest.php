<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Serie;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function serie_have_videos()
    {
        // Create a Serie
        $serie = Serie::factory()->create();

        // Create Videos and associate them with the Serie
        $videos = Video::factory()->count(3)->create(['series_id' => $serie->id]);

        // Assert that the Serie has the correct number of Videos
        $this->assertCount(3, $serie->videos);

        // Assert that the Videos belong to the Serie
        foreach ($videos as $video) {
            $this->assertTrue($serie->videos->contains($video));
        }
    }
}
