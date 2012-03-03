<?php

$user = "admin";
$psw = "admin000";

function authenticate() 
{
	header('WWW-Authenticate: Basic realm="Administravimas"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authorization canceled';
    exit;
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    authenticate();
} else {
	if($user !== $_SERVER['PHP_AUTH_USER'] && $psw !== $_SERVER['PHP_AUTH_PW']){
		authenticate();
	}
}
?>