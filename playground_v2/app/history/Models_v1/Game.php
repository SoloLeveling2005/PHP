<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded=[];

    public function game_versions () {
        return $this->hasMany(GameVersion::class, 'game_id', 'id');
    }

    public function author () {
        return $this->belongsTo(User::class, 'id', 'author_id');
    }

    public function scores () {
        return $this->hasManyThrough(Score::class, GameVersion::class, 'game_version_id', 'game_id', 'id', 'id');
    }
}
