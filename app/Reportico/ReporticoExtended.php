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

class ReporticoExtended extends reportico{

	function __construct()
	{
		reportico::__construct();
	}
	public function login()
	{

		global $g_project;

		if ( !$this->datasource )
		{
			$this->datasource = new reportico_datasource($this->external_connection, $this->available_connections);
		}
		$loggedon = false;

		//if ( $g_project == "admin" && $mode == "MENU" )
		if ( $g_project == "admin" )
		{
			// Allow access to Admin Page if already logged as admin user, or configuration does not contain
			// an Admin Password (older version of reportico) or Password is blank implying site congired with
			// No Admin Password security or user has just reset password to blank (ie open access )
			if (isset_reportico_session_param('admin_password') || !defined ('SW_ADMIN_PASSWORD') || ( defined ('SW_ADMIN_PASSWORD_RESET' ) && SW_ADMIN_PASSWORD_RESET == '' ) )
			{
				$loggedon = "ADMIN";
			}
			else
			{
				if (array_key_exists("login", $_REQUEST) && isset($_REQUEST['admin_password']))
				{
					// User has supplied an admin password and pressed login
					if ( $_REQUEST['admin_password'] == SW_ADMIN_PASSWORD )
					{
						set_reportico_session_param('admin_password',"1");
						$loggedon = "ADMIN";
					}
					else
					{
						$smarty->assign('ADMIN_PASSWORD_ERROR', template_xlate("PASSWORD_ERROR"));
					}
				}
			}

			if ( array_key_exists("adminlogout", $_REQUEST) )
			{
				unset_reportico_session_param('admin_password');
				$loggedon = false;
			}

			// If Admin Password is set to blank then force logged on state to true
			if ( SW_ADMIN_PASSWORD == "" )
			{
				set_reportico_session_param('admin_password',"1");
				$loggedon = true;
			}
			$this->login_type = $loggedon;
			if ( !$this->login_type )
				$this->login_type = "ADMIN";
			return $loggedon;
		}

		$matches=array();
		/*if ( preg_match("/_drilldown(.*)/", reportico_namespace(), $matches) )
		{
			$parent_session = $matches[1];
			if ( isset ( $_SESSION[$parent_session]['project_password'] ) )
			{
				set_reportico_session_param('project_password', $_SESSION[$parent_session]['project_password']);
			}
		}*/

		if (
			( !defined ('SW_PROJECT_PASSWORD') ) ||
			( SW_PROJECT_PASSWORD == '' ) ||
			( isset_reportico_session_param('admin_password') ) ||
			( $this->execute_mode != "MAINTAIN" && isset_reportico_session_param('project_password') &&
				get_reportico_session_param('project_password') == SW_PROJECT_PASSWORD )  ||
			( isset_reportico_session_param('project_password') && get_reportico_session_param('project_password') == SW_PROJECT_PASSWORD && $this->allow_maintain == "DEMO" )

		)
		{
			// After logging on to project allow user access to design mode if user is admin or if we
			// are running in "DEMO" mode
			if (Auth::user()->role_id == ONE)
				$loggedon = "DESIGN";
			else
				$loggedon = "NORMAL";
		}
		else
		{
			// User has attempted to login .. allow access to report PREPARE and MENU modes if user has entered either project
			// or design password or project password is set to blank. Allow access to Design mode if design password is entered
			// or design mode password is blank
			if (isset($_REQUEST['project_password']) || $this->initial_project_password  )
			{
				if ( $this->initial_project_password )
					$testpassword = $this->initial_project_password;
				else
					$testpassword = $_REQUEST['project_password'];

				if ( isset_reportico_session_param('admin_password') ||
					( $this->execute_mode != "MAINTAIN" && $testpassword == SW_PROJECT_PASSWORD  )
				)
				{
					set_reportico_session_param('project_password',$testpassword);
					$loggedon = true;
					if (isset_reportico_session_param('admin_password'))
						$loggedon = "DESIGN";
					else
						$loggedon = "NORMAL";
				}
				else
				{
					if ( isset($_REQUEST["login"]) )
						$smarty->assign('PROJ_PASSWORD_ERROR', "Error");
				}
			}
		}

		// User has pressed logout button, default then to MENU mode
		if ( array_key_exists("logout", $_REQUEST) )
		{
			if ( array_key_exists("admin_password", $_SESSION[reportico_namespace()]) )
			{
				unset_reportico_session_param('admin_password');
			}
			unset_reportico_session_param('project_password');
			set_reportico_session_param("execute_mode","MENU");
			$loggedon = false;
			if ( SW_PROJECT_PASSWORD == '' )
			{
				$loggedon = "NORMAL";
			}
		}

		$this->login_type = $loggedon;
		if ( !$this->login_type )
			$this->login_type = "NORMAL";
		return $loggedon;
	}
}