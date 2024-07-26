<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $table = 't_models';
    public $timestamps = false;
    protected $fillable = ['name'];
}
