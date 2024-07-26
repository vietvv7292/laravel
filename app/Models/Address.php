<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 't_address';
    public $timestamps = false;
    protected $fillable = ['name'];
}
