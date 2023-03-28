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
        return $this->belongsTo(User::class, 'id', 'author_id');
    }

    protected $dates = ['deleted_at'];
}
