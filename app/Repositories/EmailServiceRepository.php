<?php
/**
 * Created by PhpStorm.
 * User: rashmi-dholakiya
 * Date: 6/4/16
 * Time: 5:10 PM
 */
namespace App\Repositories;
use App\Interfaces\EmailServiceInterface;
use Illuminate\Support\Facades\Mail;


class EmailServiceRepository implements EmailServiceInterface
{
	public function sendEmail($view = null,$data = null)
	{
		$email_data = array('email' => $data['email'],'role' => $data['role'] , 'link' => $data['link']);
		Mail::send($view,$email_data, function($message) use($data){
			$message->to($data['to'])
				->subject($data['subject']);
		});
	}
}
