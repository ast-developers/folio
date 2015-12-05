<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'jira_key', 'start_date', 'end_date', 'is_overhead'];

    public function revenue()
    {
        return $this->hasMany(Revenue::class);
    }

}
