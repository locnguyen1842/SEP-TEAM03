<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class customer extends Authenticatable
{
	protected $table="customer";
	public function bills(){
		return $this->hasMany('App\bill','id_user','id');
	}

	public function customer_address(){
		return $this->hasMany('App\customer_address','id_user','id');
	}
	 use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
