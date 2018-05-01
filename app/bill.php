<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    //
    protected $table = "bills";
    public function bill_detail(){
    	return $this->hasMany('App\billdetail','id_bill','id');
    }
    public function users(){
    	return $this->belongsTo('App\users','id_user','id');
    }
}
