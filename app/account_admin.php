<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_admin extends Model
{
    protected $table="account_admin";
    public function admin(){
    	return $this->belongsTo('App\admin','id_admin','id');
    }
    public function account(){
    	return $this->belongsTo('App\account','id_account','id');
    }


}
