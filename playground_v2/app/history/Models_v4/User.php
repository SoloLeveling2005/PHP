<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Auth
{
    use HasFactory, HasApiTokens;
    protected $guarded = [];

    public function author_games () {
        return $this->hasMany(Game::class, 'author_id', 'id');
    }

    public function scores () {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    public function ban () {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }

}
