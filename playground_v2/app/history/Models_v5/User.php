<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthUser
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];

    public function authored_games () {
        return $this->hasMany(Game::class, 'author_id', 'id');
    }

    public function scores () {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    public function is_ban () {
        return $this->belongsTo(BannedUser::class, 'user_id', 'id');
    }

}
