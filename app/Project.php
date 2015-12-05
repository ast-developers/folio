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

    public function revenues()
    {
        return $this->hasMany(Revenue::class);
    }

    public function timelog() {
        return $this->hasMany(Timelog::class);
    }

    public function costs() {
        return $this->hasMany(ProjectCost::class);
    }

}
