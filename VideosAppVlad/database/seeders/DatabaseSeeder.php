<?php

namespace Database\Seeders;

use App\Helpers\helpers;
use App\Helpers\VideoHelper;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            //SeriesTableSeeder::class,
            //VideosTableSeeder::class,
        ]);

        //Crear permisos
        helpers::define_gates();
        helpers::create_permissions();
        helpers::create_user_management_permissions();

        //Crear usuaris per defecte
        helpers::create_superadmin_user();
        helpers::create_regular_user();
        helpers::create_video_manager_user();

        VideoHelper::getDefaultVideos();
    }
}
