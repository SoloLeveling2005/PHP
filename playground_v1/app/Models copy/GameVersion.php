<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameVersion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="game_versions";
    protected $softDelete = true;

    public function game() {
        return $this->belongsTo(Game::class);
    }
    public function version_scores() {
        return $this->hasMany(Score::class, 'game_versions_id', 'id');
    }
}
