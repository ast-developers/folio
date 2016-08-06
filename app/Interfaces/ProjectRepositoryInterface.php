<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
	public function getFilteredProjects();
	public function getAssignedProjects();
	public function getAllProjects();
	public function getProject($project_id = NULL);
	public function getProjectByRole($id);
	public function getSelectedProjectList($user);
}