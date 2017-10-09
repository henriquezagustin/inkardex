<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id';
	protected $fillable = [
		'name'
	];

	public function photos()
    {
        return $this->MorphMany('App\Photo', 'imageable');
    }

	public function products() {
    	return $this->hasMany('App\Product', 'category_id', 'id');
    }	
}
