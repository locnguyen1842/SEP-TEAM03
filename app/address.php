<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table ="address";
    public $timestamps = false;
    public function customer(){
    	return $this->belongsToMany('App\customer','customer_address','id_address','id_user');
    }
}
