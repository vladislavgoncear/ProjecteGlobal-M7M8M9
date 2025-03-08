<?php

namespace Tests\Feature\Videos;

use App\Helpers\helpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use PHPUnit\Framework\Attributes\Test;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    #[Test]
    public function user_with_permissions_can_manage_videos()
    {
        $this->loginAsVideoManager();

        // Create 3 videos
        $videos = \App\Models\Video::factory()->count(3)->create();

        $response = $this->get('/videosmanage');
        $response->assertStatus(200);

        // Optionally, you can assert that the videos are present in the response
        $response->assertSee($videos[0]->title);
        $response->assertSee($videos[1]->title);
        $response->assertSee($videos[2]->title);
    }

    #[Test]
    public function regular_users_cannot_manage_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->get('/videosmanage');
        $response->assertStatus(500);
    }

    #[Test]
    public function guest_users_cannot_manage_videos()
    {
        $response = $this->get('/videosmanage');
        $response->assertRedirect('/login');
    }

    #[Test]

    public function superadmins_can_manage_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/videosmanage');
        $response->assertStatus(200);
    }

    private function loginAsVideoManager(): Void
    {
        //$user = helpers::create_video_manager_user();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    private function loginAsSuperAdmin(): Void
    {
        //$user = helpers::create_superadmin_user();
        $user = User::factory()->create(['super_admin' => true]);
        $this->actingAs($user);
    }

    private function loginAsRegularUser(): Void
    {
        //$user = helpers::create_regular_user();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[Test]
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get('/videos/create');
        $response->assertStatus(200);
        $response->assertSee('Add Video');
    }

    #[Test]
    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->get('/videos/create');
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->post('/videos', [
            'title' => 'New Video',
            'description' => 'Video description',
            'url' => 'http://example.com/video.mp4',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('videos', ['title' => 'New Video']);
    }

    #[Test]
    public function user_without_permissions_cannot_store_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->post('/videos', [
            'title' => 'New Video',
            'description' => 'Video description',
            'url' => 'http://example.com/video.mp4',
        ]);

        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_destroy_videos()
    {
        $this->loginAsVideoManager();

        $video = \App\Models\Video::factory()->create();

        $response = $this->delete("/videos/{$video->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_videos()
    {
        $this->loginAsRegularUser();

        $video = \App\Models\Video::factory()->create();

        $response = $this->delete("/videos/{$video->id}");

        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->loginAsVideoManager();

        $video = \App\Models\Video::factory()->create();

        $response = $this->get("/videos/{$video->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Edit Video');
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_videos()
    {
        $this->loginAsRegularUser();

        $video = \App\Models\Video::factory()->create();

        $response = $this->get("/videos/{$video->id}/edit");

        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_videos()
    {
        $this->loginAsVideoManager();

        $video = \App\Models\Video::factory()->create();

        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Video Title',
            'description' => 'Updated description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('videos', ['title' => 'Updated Video Title']);
    }

    #[Test]
    public function user_without_permissions_cannot_update_videos()
    {
        $this->loginAsRegularUser();

        $video = \App\Models\Video::factory()->create();

        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Video Title',
            'description' => 'Updated description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);

        $response->assertStatus(403);
    }

}
