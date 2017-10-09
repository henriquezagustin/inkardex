<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'photo_id',
        'name',
        'sku',
        'quantity',
        'price',
        'sell_price'
    ];

    public function photos()
    {
        return $this->MorphMany('App\Photo', 'imageable');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function defaultImage()
    { 
        return $this->photos()->first();
    }
}
