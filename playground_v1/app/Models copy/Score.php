<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'game_versions_id',
        'score',
    ];
    protected $table="scores";

    public function game() {
        return $this->belongsTo(Game::class, 'game_versions_id', 'id');
    }

    public function game_versions() {
        return $this->belongsTo(GameVersion::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
