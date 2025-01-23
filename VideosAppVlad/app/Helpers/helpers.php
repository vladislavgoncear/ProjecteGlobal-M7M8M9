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
        $teamName = config("users.team_name");

        // Crear o obtener el usuario
        $user = User::firstOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => $password,
        ]);

        // Crear o obtener el Team
        $team = Team::firstOrCreate([
            'name' => $teamName,
            'user_id' => $user->id,
        ]);

        // Asociar el usuario al Team
        $user->teams()->syncWithoutDetaching([$team->id]);

        // Establecer el current_team_id del usuario
        $user->current_team_id = $team->id;
        $user->save();

        return $user;
    }
}

if (!function_exists('createDefaultVideo')) {
    /**
     * Create a default video.
     *
     * @param string $type
     * @return Video
     */
    function createDefaultVideo($type)
    {
        return Video::create([
            'title' => config("videos.{$type}_title"),
            'description' => config("videos.{$type}_description"),
            'url' => config("videos.{$type}_url"),
        ]);
    }
}
