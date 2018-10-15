<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\DB;

/**
 * Class Role
 * @package App
 */
class Role extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'roles';

    protected $fillable = [
        'name', 'display_name','description', 'status',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'role_id', 'id');
    }
}
