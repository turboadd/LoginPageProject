<?php
include_once('../config/routeros_api.class.php');
include "../include/config.inc.php";
include_once("../include/conn.php");

$ipRouteros = $IP_ACCOUNT;
$Username=$USER_ACCOUNT;
$Pass=$PASS_ACCOUNT;
$api_port=$PORT_ACCOUNT;
$interface = $_GET["interface"]; 

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_port)) {
$items = $API->comm("/interface/print");
echo "<pre>";print_r($items['0']);die();
}
?>