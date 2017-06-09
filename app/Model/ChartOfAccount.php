<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    public function business(){
    	return $this->belongsTo('App\Model\Business');
    }
}
