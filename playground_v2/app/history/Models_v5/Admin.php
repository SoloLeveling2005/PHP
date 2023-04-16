<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Sanctum\HasApiTokens;

class Admin extends AuthUser
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];
}
