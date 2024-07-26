<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 't_status';
    public $timestamps = false;
    protected $fillable = ['name'];
}
