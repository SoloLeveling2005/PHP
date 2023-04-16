<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class, 'usr_id', 'id');
    }
}
