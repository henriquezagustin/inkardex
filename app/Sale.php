<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $table = 'sales';
	protected $primaryKey = 'id';
	protected $fillable = [
		'status_id',
		'user_id',
		'receipt',
		'quantity',
		'amount'
	];

	public function detail() {
		return $this->hasMany('App\SaleDetail', 'sale_id', 'id');
	}

	public function user() {
		return $this->hasOne('App\User', 'id', 'user_id');
	}
}
