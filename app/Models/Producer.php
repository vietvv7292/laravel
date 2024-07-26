<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $table = 't_producer';
    public $timestamps = false;
    protected $fillable = ['name'];
}
