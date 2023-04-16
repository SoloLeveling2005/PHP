<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasFactory;

    protected $guarded=[];


    public function games() {
        return $this->hasMany(Game::class, 'author_id', 'id');
    }

    public function scores() {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    public function is_ban() {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }
}
