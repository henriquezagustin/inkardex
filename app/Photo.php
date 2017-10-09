<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $table = 'photos';
	protected $primaryKey = 'id';
	protected $fillable = [	
		'name',
		'path',
		'type'
	];

	public function imageable()
	{
		return $this->morphTo();
	}
}
