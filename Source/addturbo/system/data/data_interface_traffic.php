<?php
include_once('../../config/routeros_api.class.php');
include "../../include/config.inc.php";
include_once("../../include/conn.php");

$ipRouteros = $IP_ACCOUNT;
$Username=$USER_ACCOUNT;
$Pass=$PASS_ACCOUNT;
$api_port=$PORT_ACCOUNT;
$interface = $_GET["interface"]; 

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_port)) {
		$rows = array(); $rows2 = array();	
		   $API->write("/interface/monitor-traffic",false);
		   $API->write("=interface=".$interface,false);  
		   $API->write("=once=",true);
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);

				$rx = number_format($ARRAY[0]["rx-bits-per-second"]/1048576,2);
				$tx = number_format($ARRAY[0]["tx-bits-per-second"]/1048576,2);
				$rows['name'] = 'Tx';
				$rows['data'][] = $tx;
				$rows2['name'] = 'Rx';
				$rows2['data'][] = $rx;
			

	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
