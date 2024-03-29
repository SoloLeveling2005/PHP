<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function reason () {
        return $this->belongsTo(Reason::class, 'reason_id', 'id');
    }
}
