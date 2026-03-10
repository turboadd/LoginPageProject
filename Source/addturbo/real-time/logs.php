<?php
include_once('../config/routeros_api.class.php');
include "../include/config.inc.php";
include_once("../include/conn.php");

$ipRouteros = $IP_ACCOUNT;
$Username=$USER_ACCOUNT;
$Pass=$PASS_ACCOUNT;
$api_port=$PORT_ACCOUNT;


	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_port)) {
						$log = $API->comm("/log/print");
						$clog = count($log);
						for($a=0;$a<$clog;$a++){ 
						
						echo $log[$a]['time'] . '&nbsp;&nbsp; ' . $log[$a]['topics'] . '&nbsp;&nbsp; ' . $log[$a]["message"] . "<br>";
						  }
} ?>