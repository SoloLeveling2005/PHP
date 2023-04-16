<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;

class Admin extends Auth
{
    use HasFactory;
    protected $guarded = [];
}
