<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameVersion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    protected $table = "game_versions";

    public function game() {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function version_scores() {
        return $this->hasMany(Score::class, 'game_version_id', 'id');
    }
}
