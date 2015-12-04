<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffRate extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff_rates';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['staff_id', 'rate', 'effective_date'];

}
