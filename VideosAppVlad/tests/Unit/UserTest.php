<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class UserTest extends TestCase
{
    use RefreshDatabase;

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
