<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable , ImageTrait ;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password', 'image',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
