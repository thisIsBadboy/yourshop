<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
	protected $hidden = [];

    public function business(){
    	return $this->belongsTo('App\Model\Business');
    }
}
