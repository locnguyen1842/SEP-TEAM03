<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
	protected $table="customer";
	protected $fillable=['name'];
	public $timestamps = false;
	public function bills(){
		return $this->hasMany('App\bill','id_user','id');
	}
	public function address(){
		return $this->belongsToMany('App\address','customer_address','id_user','id_address');
	}
    public function account(){
        return $this->belongsToMany('App\User','account_customer','id_customer','id_account');
    }
	 
}
