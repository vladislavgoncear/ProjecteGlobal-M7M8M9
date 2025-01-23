<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => config('users.user_name'),
                'email' => config('users.user_email'),
                'password' => Hash::make(config('users.user_password')),
            ],
            [
                'name' => config('users.professor_name'),
                'email' => config('users.professor_email'),
                'password' => Hash::make(config('users.professor_password')),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
