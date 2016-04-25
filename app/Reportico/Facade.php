<?php
namespace App\Reportico;

class Facade extends \Illuminate\Support\Facades\Facade
{
	protected static function getFacadeAccessor()
	{
		return 'reportico_extended';
	}
}