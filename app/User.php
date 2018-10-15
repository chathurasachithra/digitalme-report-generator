<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','company', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }



    /**
     * @return mixed
     */
    public function userType()
    {
        return $this->user_type;
    }

    /**
     * @return bool
     */
    public  function  isStaff()
    {
        if($this->user_type == 'Staff'){
            return true;
        }else{
            false;
        }
    }


    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        if($this->role()->first()->name == 'super_admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function plans()
    {
        return $this->hasMany('App\Plan', 'user_id', 'id');
    }
}
