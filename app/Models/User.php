<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public $incrementing = false; // Use UUIDs instead of auto-incrementing IDs
    protected $keyType = 'string'; // Specify that the primary key is a string (

    //
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone',
    ];
}
