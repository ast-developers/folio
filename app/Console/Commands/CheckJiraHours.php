<?php

namespace App\Console\Commands;

use App\Staff;
use App\Timelog;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;


class CheckJiraHours extends Command
{
	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'Ems:CheckJiraHours';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'EMS Post API';

	/**
	 * Create a new command instance.
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 * @return mixed
	 */
	public function handle()
	{
		$client = new Client();
		//Call to EMS API to get the employee details
		$date = Carbon::yesterday()->format('Y-m-d');
		//$date = '2016-03-03';
		$ems_data  = $client->get(env(APP_HOST) . "/" . EMS_API_PATH . 'employee_list/' . $date);
		if ($ems_data->getStatusCode() == STATUS_OK) {
			$data = json_decode($ems_data->getBody()->getContents());
			foreach ($data as $key => $ems) {
				$staff = Staff::whereEmail($ems->employee_email_id)->first();
				if (!empty($staff)) {
					//Find JIRA hours
					$worklog           = Timelog::whereStaffId($staff->id)->whereStarted($date)->sum('time_spent');
					$actual_jira_hours = gmdate('H:i:s', ($worklog));
					$actual_ems_hours  = $ems->actual_hours;
					//Comparing EMS and JIRA hours
					if ($actual_jira_hours != NULL && $actual_jira_hours != '00:00:00' && $actual_ems_hours != NULL && $actual_ems_hours != '00:00:00') {
						$diffrence = $actual_ems_hours - $actual_jira_hours;
						//IF difference is greater then 1 hour, then update EMS
							// Call back to EMS to mark employee as half absent
							$client->get(env(APP_HOST) . "/" . EMS_API_PATH . 'update_employee_timesheet/' . $ems->emp_id . '/' . $date . ($diffrence > ONE && $diffrence < FOUR) ? '/half' : '/full');
					}
				}
			}
		}
	}
}
