<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reason_id',
    ];

    public function reason() {
        return $this->belongsTo(Reason::class);
    }

    protected $table="banned_users";
}
