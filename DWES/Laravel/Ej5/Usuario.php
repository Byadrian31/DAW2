<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'usuarios';
    
    protected $fillable = [
        'login',
        'password',
    ];
}
