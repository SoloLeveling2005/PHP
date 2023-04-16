<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Auth
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];
}
