<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 't_users';
    public $timestamps = false;
    protected $fillable = ['name'];
}
