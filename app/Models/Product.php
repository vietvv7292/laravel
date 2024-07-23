<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 't_products';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    public function models()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }
    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
