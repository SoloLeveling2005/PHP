<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function game_version () {
        return $this->belongsTo(GameVersion::class, 'game_version_id', 'id');
    }

    public function game () {
        return $this->hasManyThrough(Game::class, GameVersion::class, 'id', 'id', 'game_version_id', 'game_id');
    }
}
