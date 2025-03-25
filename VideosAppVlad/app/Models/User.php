<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, HasProfilePhoto, HasTeams, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password', 'current_team_id'];

    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('Super Admin');
    }

    // In User.php model
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
