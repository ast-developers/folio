<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{
	protected $table = 'assign_project';
	protected $fillable = ['project_id', 'assigned_to'];

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
