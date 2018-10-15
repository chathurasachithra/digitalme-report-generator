<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreConfig
 * @package App
 */
class CoreConfig extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'core_config';
    protected $fillable = array(
        'key', 'field', 'value'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
