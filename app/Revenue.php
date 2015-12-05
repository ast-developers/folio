<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'revenue';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'amount', 'received_on', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
