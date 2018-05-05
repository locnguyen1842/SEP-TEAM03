<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipper extends Model
{
    protected $table='shipper';
    public function bills(){
    	return $this->hasMany('App\bill','shipper_id','id');
    }
}
