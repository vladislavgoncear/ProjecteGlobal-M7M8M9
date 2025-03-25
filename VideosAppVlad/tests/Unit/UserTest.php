<?php

namespace Tests\Unit;

use App\Helpers\helpers;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        helpers::create_permissions();
        helpers::define_gates();
        helpers::create_user_management_permissions();
    }


    #[Test]
    public function user_without_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('view users');
        $this->actingAs($user);

        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function not_logged_users_cannot_see_default_users_page()
    {
        $response = $this->get(route('users.index'));
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function user_without_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('users.show', $user->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function user_with_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('view users');
        $this->actingAs($user);

        $response = $this->get(route('users.show', $user->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function not_logged_users_cannot_see_user_show_page()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user->id));
        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function it_checks_if_user_is_super_admin()
    {
        // Create a user and assign the Super Admin role
        $user = User::factory()->create();
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $user->assignRole($superAdminRole);

        // Assert that the user is a Super Admin
        $this->assertTrue($user->isSuperAdmin());
    }
}
