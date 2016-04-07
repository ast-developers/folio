<?php

namespace App\Interfaces;

interface EmailServiceInterface
{
	public function sendEmail($view = null,$data = null);
}