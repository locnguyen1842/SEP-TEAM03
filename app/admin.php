<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $talbe="admin";
    public function account(){
    	return $this->belongsToMany('App\User','account_admin','id_admin','id_account');
    }
}
