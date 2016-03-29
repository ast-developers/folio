<?php
/**
 * Created by PhpStorm.
 * User: shabbir
 * Date: 12/4/15
 * Time: 11:02 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCost extends Model
{
    public $incrementing = false;

    protected $table = 'project_costs';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function staff() {
        return $this->belongsTo(Staff::class);
    }
}