<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table = "product";
    public function product_type(){
    	return $this->belongsTo('App\productType','id_type','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\billdetail','id_product','id');
    }

    public function supplier(){
    	return $this->belongsTo('App\supplier','supplier_id','id');
    }
}
