<?php

namespace Tests\Unit;

use App\Helpers\VideoHelper;
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
        $defaultVideos = VideoHelper::getDefaultVideos();

        foreach ($defaultVideos as $videoData) {
            Video::create($videoData);

        }
        foreach ($defaultVideos as $videoData) {
            $this->assertDatabaseHas('videos', [
                'title' => $videoData['title'],
                'description' => $videoData['description'],
                'url' => $videoData['url'],
                'published_at' => $videoData['published_at'],
            ]);


        }
    }
}
