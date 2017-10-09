<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
	protected $table = 'sale_details';
	protected $primaryKey = 'id';
	protected $fillable = [
		'sale_id',
		'product_id',
		'quantity',
		'amount'
	];

	public function sale() {
		return $this->belongsTo('App\Sale', 'sale_id', 'id');
	}

	public function product() {
		return $this->belongsTo('App\Product', 'product_id', 'id'); 
	}
}
