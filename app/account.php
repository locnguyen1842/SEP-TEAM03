<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    protected $table="account";
    public function role_account(){
        return $this->hasMany('App\role_account','id_account','id');
    }
    public function account_customer(){
        return $this->hasMany('App\account_customer','id_account','id');
    }
    public function acount_admin(){
        return $this->hasMany('App\acount_admin','id_account','id');
    }
    public function account_supplier(){
        return $this->hasMany('App\account_supplier','id_account','id');
    }
   
}
