<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function game_version () {
        return $this->belongsTo(GameVersion::class, 'id', 'game_version_id');
    }

    public function user () {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
