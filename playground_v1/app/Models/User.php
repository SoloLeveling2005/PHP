<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];


    public function ban() {
        return $this->hasOne(BannedUser::class);
    }

    /**
     * Выводит авторские игры
     */
    public function author_games() {

        return $this->hasMany(Game::class, 'author_id', 'id');
    }

    /**
     * Выводит очки игрока
     */
    public function scores() {

        return $this->hasMany(Score::class, 'user_id', 'id');

    }


}
