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

        $response = $this->get('/videosmanage');
        $response->assertStatus(200);
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

}
