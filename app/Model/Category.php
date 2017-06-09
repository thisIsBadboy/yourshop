<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public function business(){
		return $this->belongsTo('App\Model\Business');
	}

	public function product(){
		return $this->hasMany('App\Model\Product');
	}
}
