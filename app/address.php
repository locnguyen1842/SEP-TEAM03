<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table ="address";
    public function customer_addreses(){
    	return $this->hasMany('App\customerAddress','id_address','id');
    }
}
