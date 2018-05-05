<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billdetail extends Model
{
    //
    protected $table ="bill_detail";
    public function bills(){
    	return $this->belongsTo('App\bill','id_bill','id');
    }
    public function product(){
    	return $this->belongsTo('App\product','id_product','id');
    }

}
