<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccountConfiguration extends Model
{
	public function business(){
		return $this->belongsTo('App\Model\Business');
	}

	public function account(){
		return $this->belongsTo('App\Model\Account');
	}
}
