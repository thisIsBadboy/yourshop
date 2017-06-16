<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function business(){
    	return $this->belongsTo('App\Model\Business');
    }

    public function account_configurations(){
    	return $this->hasMany('App\Model\AccountConfiguration');
    }

    public function journal_items(){
    	return $this->hasMany('App\Model\JournalItem');
    }
}
