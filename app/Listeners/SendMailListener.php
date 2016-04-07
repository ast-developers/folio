<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Interfaces\EmailServiceInterface;
use App\UserRoles;

class SendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
	public  $email;
	public function __construct(EmailServiceInterface $email)
	{
		$this->email=$email;
	}

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
		switch($event->user['role_id'])
		{
			case 1:
				$role = UserRoles::ADMIN;
				break;
			case 2:
				$role = UserRoles::MANAGER;
				break;
			case 3:
				$role = UserRoles::SALES;
				break;
			case 4:
				$role = UserRoles::GUEST;
				break;
		}

		$link = url('password/reset').'/'.urlencode($event->user['email']);
		$set_password = "<b>Click here to set your password:</b> $link";
		$data = ['to'=>$event->user['email'] , 'subject'=>'Welcome to ArsenalTech PortFolio' , 'email'=> $event->user['email'], 'role' => $role ,'link' => $set_password] ;

		$this->email->sendEmail('email.welcome',$data);

    }
}
