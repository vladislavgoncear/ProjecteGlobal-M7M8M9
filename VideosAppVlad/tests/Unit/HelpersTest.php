<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Team;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class HelpersTest extends TestCase
{
    public function test_create_default_user()
    {
        $user = createDefaultUser('user');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(config('users.user_name'), $user->name);
        $this->assertEquals(config('users.user_email'), $user->email);
        $this->assertTrue(Hash::check(config('users.user_password'), $user->password));
        $this->assertNotNull($user->teams()->first());
    }

    public function test_create_default_professor()
    {
        $professor = createDefaultUser('professor');

        $this->assertInstanceOf(User::class, $professor);
        $this->assertEquals(config('users.professor_name'), $professor->name);
        $this->assertEquals(config('users.professor_email'), $professor->email);
        $this->assertTrue(Hash::check(config('users.professor_password'), $professor->password));
        $this->assertNotNull($professor->teams()->first());
    }
}

