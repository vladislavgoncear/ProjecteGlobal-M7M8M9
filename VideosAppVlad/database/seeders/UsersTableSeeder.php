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
                'name' => config('users.default_user_name'),
                'email' => config('users.default_user_email'),
                'password' => Hash::make(config('users.default_user_password')),
            ],
            [
                'name' => config('users.default_professor_name'),
                'email' => config('users.default_professor_email'),
                'password' => Hash::make(config('users.default_professor_password')),
            ],
        ];

        foreach ($users as $userData) {
            if (empty($userData['name']) || empty($userData['email'])) {
                throw new \Exception("Name or email configuration is missing for one of the users.");
            }

            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
