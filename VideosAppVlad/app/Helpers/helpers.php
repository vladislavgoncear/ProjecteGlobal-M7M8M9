<?php

use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

if (!function_exists('createDefaultUser')) {
    /**
     * Crear un usuari per defecte.
     *
     * @param string $role
     * @return User
     */
    function createDefaultUser($role = 'user')
    {
        $name = config("users.{$role}_name");
        $email = config("users.{$role}_email");
        $password = Hash::make(config("users.{$role}_password"));

        // Crear o obtenir l'usuari
        $user = User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => $password,
        ]);

        // Crear o obtenir el Team
        $team = Team::where('name', 'Default Team')->first();

        if (!$team) {
            $team = Team::create([
                'name' => 'Default Team',
                'user_id' => $user->id,
            ]);
        }

        // Associar l'usuari al Team (si cal)
        $user->teams()->syncWithoutDetaching([$team->id]);

        return $user;
    }
}
