<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
	protected $table = 'user_roles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_role_name'];

	public function user()
	{
		return $this->hasMany('App\User');
	}
}
