<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_address extends Model
{
    protected $table="customer_address";
    public function address(){
    	return $this->belongsTo('App\address','id_address','id');
    }

    public function customer(){
    	return $this->belongsTo('App\customer','id_user','id');
    }
}
