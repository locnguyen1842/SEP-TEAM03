<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = "supplier";

    public function product(){
    	return $this->hasMany('App\product','supplier_id','id');
    }
    
    public function account(){
        return $this->belongsToMany('App\User','account_supplier','id_supplier','id_account');
    }


}
