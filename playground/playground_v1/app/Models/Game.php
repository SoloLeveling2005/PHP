<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'author_id',
    ];
    protected $table="games";
    protected $softDelete = true;
    public function versions() {
        return $this->hasMany(GameVersion::class, 'game_id', 'id');
    }

    public function author() {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['deleted_at'];
}
