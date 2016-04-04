<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

define('MANAGER','Manager');
define('SALES','Sales');
define('ADMIN','Admin');
define('GUEST','Guest');

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
