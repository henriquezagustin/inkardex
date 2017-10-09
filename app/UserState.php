<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserState extends Model
{
	protected $table = 'user_states';
	protected $primaryKey = 'id';
	protected $fillable = [
		'name'
	];
}
