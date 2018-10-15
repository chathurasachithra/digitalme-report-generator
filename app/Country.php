<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Country
 * @package App
 */
class Country extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $primaryKey = 'countryId';
    protected $table = 'country';
    protected $fillable = array(
        'name'
    );
    protected $dates = ['deleted_at'];

    public $timestamps = true;
}
