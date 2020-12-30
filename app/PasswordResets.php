<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'token';
    protected $fillable = [
        'email'
    ];
}