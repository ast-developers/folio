<?php
/**
 * Created by PhpStorm.
 * User: Mehul
 * Date: 12/5/15
 * Time: 2:31 PM
 */

namespace App\Http\Controllers;

use Jira\JiraClient;



class SyncController extends Controller{

    public function index()
    {
        $host = 'https://arsenaltech.atlassian.net';
        $username = 'mehul';
        $password = 'Ars3naltech';

        $jira = new JiraClient($host);
        $jira->login($username, $password);
    }

}