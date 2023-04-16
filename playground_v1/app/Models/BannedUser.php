<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    use HasFactory;

    public $guarded = [];
    protected $table = 'banned_users';

    public function reason() {
        return $this->belongsTo(Reason::class, 'id', 'reason_id');
    }
}
