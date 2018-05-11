<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table ="role";
    protected $fillable=['name','id_role'];
    public function users(){
        return $this->belongsToMany('App\User','role_account','id_role','id_account');
    }



}
