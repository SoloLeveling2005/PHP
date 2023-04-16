<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    public function authored_games () {
        return $this->hasMany(Game::class, 'user_id', 'id');
    }

    public function scores () {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    public function is_ban () {
        return $this->belongsTo(BannedUser::class, 'id', 'user_id');
    }
}
