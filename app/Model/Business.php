<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public static $rules = [
    	'name'=>'required',
    	'description'=>'required'
    ];

    protected $fillable = ['name', 'description', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\Model\User');
    }

    public function category(){
    	return $this->hasMany('App\Model\Category');
    }

    public function product(){
        return $this->hasMany('App\Model\Product');
    }

    public function chart_of_accounts(){
        return $this->hasMany('App\Model\ChartOfAccount');
    }
}
