<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 't_category';
    public $timestamps = false;
    protected $fillable = ['name'];
}
