<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_customer extends Model
{
      protected $table="account_customer";
    public function customer(){
    	return $this->belongsTo('App\customer','id_customer','id');
    }
    public function account(){
    	return $this->belongsTo('App\User','id_account','id');
    }

}
