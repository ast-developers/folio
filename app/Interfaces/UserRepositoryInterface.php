<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
	public function getUsers();

	public function getUsersByRole($role);

	public function getUserByIdWithRole($id);

	public function save($values,$id);

}