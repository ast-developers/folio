<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_name', 'email'];

}
