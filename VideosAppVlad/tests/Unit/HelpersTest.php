<?php

namespace Tests\Unit;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HelpersTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_default_user()
    {
        $user = createDefaultUser('user');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(config('users.user_name'), $user->name);
        $this->assertEquals(config('users.user_email'), $user->email);

        var_dump($user->password);
        var_dump(Hash::make(config('users.user_password')));

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

    public function test_create_default_video()
    {
        $video = createDefaultVideo('default');

        $this->assertInstanceOf(Video::class, $video);
        $this->assertEquals(config('videos.default_title'), $video->title);
        $this->assertEquals(config('videos.default_description'), $video->description);
        $this->assertEquals(config('videos.default_url'), $video->url);
    }
}
