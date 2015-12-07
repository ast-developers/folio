<?php

function debugInfo($info)
{

    Debugbar::info($info);
}

function set_active($path, $active = 'active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function money($amount){
    setlocale(LC_MONETARY,"en_US");
    return money_format('%(#10n', $amount);
}

function date_formation($date){
    return date("M jS Y", strtotime( $date ));                 // March 10, 2001, 5:16 pm

}