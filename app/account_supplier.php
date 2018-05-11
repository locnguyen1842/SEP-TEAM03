<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_supplier extends Model
{
      protected $table="account_supplier";
    public function supplier(){
    	return $this->belongsTo('App\supllier','id_supplier','id');
    }
    public function account(){
    	return $this->belongsTo('App\account','id_account','id');
    }

}
