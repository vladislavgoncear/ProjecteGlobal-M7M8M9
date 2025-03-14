<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApiMultimediaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_upload_a_video()
    {
        Storage::fake('public');

        $response = $this->postJson('/upload/video', [
            'video' => UploadedFile::fake()->create('video.mp4', 20000, 'video/mp4'),
        ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Video uploaded successfully']);
        Storage::disk('public')->assertExists('videos/video.mp4');
    }

    /** @test */
    public function it_can_upload_a_photo()
    {
        Storage::fake('public');

        $response = $this->postJson('/upload/photo', [
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Photo uploaded successfully']);
        Storage::disk('public')->assertExists('photos/photo.jpg');
    }

    /** @test */
    public function it_validates_video_upload()
    {
        $response = $this->postJson('/upload/video', [
            'video' => 'not-a-file',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('video');
    }

    /** @test */
    public function it_validates_photo_upload()
    {
        $response = $this->postJson('/upload/photo', [
            'photo' => 'not-a-file',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('photo');
    }
}
