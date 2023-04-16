<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'games';

    /**
     * Возвращает все версии игры
     */
    public function versions() {
        return $this->hasMany(GameVersion::class, 'game_id', 'id');
    }

    /**
     * Возвращает автора игры
     */
    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function latestVersion()
    {
        return $this->versions()->latest()->orderBy('id', 'desc')->first();
    }

    public function game_version_with_scores() {
        // return $this->hasManyThrough(GameVersion::class, Score::class, 'game_version_id', 'game_id', 'id', 'id');
        return $this->latestVersion();
        // return $this->versions()->has('version_scores');
    }
    public function game_version_scores() {
        // return $this->hasManyThrough(GameVersion::class, Score::class, 'game_version_id', 'game_id', 'id', 'id');
        return $this->versions()->with('version_scores');
    }
    protected $dates = ['deleted_at'];
}
