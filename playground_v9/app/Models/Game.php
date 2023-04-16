<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function author () {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function versions () {
        return $this->hasMany(GameVersion::class, 'game_id', 'id');
    }

    public function scores () {
        return $this->hasManyThrough(Score::class, GameVersion::class, 'game_id', 'game_version_id', 'id', 'id');
    }

    public function last_v () {
        return $this->versions()->orderBy('id', 'desc')->first();
    }
}
