<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemIcon
 * @package App
 */
class SystemIcon extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'system_icons';
    protected $fillable = array(
        'iconkey', 'path'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
