<?php
namespace App\Reportico;
/**
 * Created by PhpStorm.
 * User: rashmi-dholakiya
 * Date: 22/4/16
 * Time: 9:33 AM
 */

use Illuminate\Support\Facades\Auth;
use \Reportico\Reportico\reportico;
use Reportico\Reportico\reportico_datasource;
use Reportico\Reportico\reportico_object;
use \Reportico\Reportico\Smarty;

include_once('/usr/local/ampps/www/folio/vendor/reportico/laravel-reportico/src/Reportico/Reportico/swutil.php');

class ReporticoExtended extends reportico{

	public function login()
	{
		set_reportico_session_param('admin_password',"1");
		global $g_session_namespace_key;
		$_SESSION[$g_session_namespace_key]['admin_password'] = '1';
	}
}