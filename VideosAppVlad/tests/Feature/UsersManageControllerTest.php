<?php

namespace Tests\Unit;

use App\Helpers\helpers;
use App\Helpers\VideoHelper;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Test;

class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        helpers::define_gates();
        helpers::create_permissions();
        helpers::create_user_management_permissions();
    }

    private function loginAsVideoManager()
    {
        $user = User::factory()->create();
        $role = Role::firstOrCreate(['name' => 'Video Manager']);
        $user->assignRole($role);
        $this->actingAs($user);
        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(['view users', 'create users', 'edit users', 'delete users']);
        $this->actingAs($user);
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }

    #[Test]
    public function user_with_permissions_can_see_add_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.manage.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_users_manage_create_cannot_see_add_users()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('users.manage.create'));
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_store_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->post(route('users.manage.store'), [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
    }

    #[Test]
    public function user_without_permissions_cannot_store_users()
    {
        $this->loginAsRegularUser();
        $response = $this->post(route('users.manage.store'), [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_destroy_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->delete(route('users.manage.destroy', $user->id));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    #[Test]
    public function user_without_permissions_cannot_destroy_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->delete(route('users.manage.destroy', $user->id));
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_see_edit_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get(route('users.manage.edit', $user->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_without_permissions_cannot_see_edit_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->get(route('users.manage.edit', $user->id));
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_update_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => $user->email,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['name' => 'Updated Name']);
    }

    #[Test]
    public function user_without_permissions_cannot_update_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => $user->email,
        ]);
        $response->assertStatus(403);
    }

    #[Test]
    public function user_with_permissions_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function regular_users_cannot_manage_users()
    {
        $this->loginAsRegularUser();
        $response = $this->get(route('users.index'));
        $response->assertStatus(403);
    }

    #[Test]
    public function guest_users_cannot_manage_users()
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function superadmins_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }
}
