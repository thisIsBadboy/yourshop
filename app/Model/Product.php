<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public static $rules = [
		'business_id'=>'required',
		'category_id'=>'required',
		'title'=>'required',
		'price'=>'required',
	];
	
	public function business(){
		return $this->belongsTo('App\Model\Business');
	}

    public function category(){
    	return $this->belongsTo('App\Model\Category');
    }
}
