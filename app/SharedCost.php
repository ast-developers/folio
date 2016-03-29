<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedCost extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shared_costs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'amount', 'incurred_on'];

}
