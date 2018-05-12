<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table="users";
    public function customer(){
        return $this->belongsToMany('App\customer','account_customer','id_account','id_customer');
    }
    public function admin(){
        return $this->belongsToMany('App\admin','account_admin','id_account','id_admin');
    }
    public function supplier(){
        return $this->belongsToMany('App\supplier','account_supplier','id_account','id_supplier');
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

