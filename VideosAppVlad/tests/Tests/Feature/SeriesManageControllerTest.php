<?php

namespace tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function loginAsVideoManager(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Video Manager');
        $this->actingAs($user);
    }

    private function loginAsSuperAdmin()
    {
        $user = User::factory()->create(['super_admin' => true]);
        $this->actingAs($user);
    }

    private function loginAsRegularUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[Test]
    public function user_with_permissions_can_see_add_series()
    {
        $this->loginAsVideoManager();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_series_manage_create_cannot_see_add_series()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('series.manage.create'));
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_series()
    {
        $this->loginAsVideoManager();
        $response = $this->post(route('series.store'), ['name' => 'New Series']);
        $response->assertRedirect(route('series.index'));
        $this->assertDatabaseHas('series', ['name' => 'New Series']);
    }

    #[Test]
    public function user_without_permissions_cannot_store_series()
    {
        $this->loginAsRegularUser();
        $response = $this->post(route('series.store'), ['name' => 'New Series']);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('series', ['name' => 'New Series']);
    }

    #[Test]
    public function user_with_permissions_can_destroy_series()
    {
        $this->loginAsVideoManager();
        $series = Serie::factory()->create();
        $response = $this->delete(route('series.destroy', $series));
        $response->assertRedirect(route('series.index'));
        $this->assertDatabaseMissing('series', ['id' => $series->id]);
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_series()
    {
        $this->loginAsRegularUser();
        $series = Serie::factory()->create();
        $response = $this->delete(route('series.destroy', $series));
        $response->assertStatus(403);
        $this->assertDatabaseHas('series', ['id' => $series->id]);
    }

    #[Test]
    public function user_with_permissions_can_see_edit_series()
    {
        $this->loginAsVideoManager();
        $series = Serie::factory()->create();
        $response = $this->get(route('series.edit', $series));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_series()
    {
        $this->loginAsRegularUser();
        $series = Serie::factory()->create();
        $response = $this->get(route('series.edit', $series));
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_series()
    {
        $this->loginAsVideoManager();
        $series = Serie::factory()->create();
        $response = $this->put(route('series.update', $series), ['name' => 'Updated Series']);
        $response->assertRedirect(route('series.index'));
        $this->assertDatabaseHas('series', ['id' => $series->id, 'name' => 'Updated Series']);
    }

    #[Test]
    public function user_without_permissions_cannot_update_series()
    {
        $this->loginAsRegularUser();
        $series = Serie::factory()->create();
        $response = $this->put(route('series.update', $series), ['name' => 'Updated Series']);
        $response->assertStatus(403);
        $this->assertDatabaseMissing('series', ['name' => 'Updated Series']);
    }

    #[Test]
    public function user_with_permissions_can_manage_series()
    {
        $this->loginAsVideoManager();
        $response = $this->get(route('series.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function regular_users_cannot_manage_series()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('series.index'));
        $response->assertStatus(403);
    }

    #[Test]
    public function guest_users_cannot_manage_series()
    {
        $response = $this->get(route('series.index'));
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function videomanagers_can_manage_series()
    {
        $this->loginAsVideoManager();
        $response = $this->get(route('series.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function superadmins_can_manage_series()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('series.index'));
        $response->assertStatus(200);
    }
}
