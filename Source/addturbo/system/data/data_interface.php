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
				/////////////////////////////////////////////////
				$resource = $API->comm("/system/resource/print");
				$health = $API->comm("/system/health/print");
                $cpu=$health['0']['cpu-temperature'];
				$tem=$health['0']['temperature'];
				$volt=$health['0']['voltage'];
				$current=$health['0']['current'];
				$load=$resource['0']['cpu-load'];
				$show = array(); $show2 = array();$show3 = array();$show4 = array();$show5 = array();

				if(!empty($cpu)){
				$show['name'] = 'cpu';
				$show['data'][] = $cpu;
				}else{
				$show['name'] = 'cpu';
				$show['data'][] = "0";
				
				}
				////////////////////////
				if(!empty($tem)){
				$show2['name'] = 'tem';
				$show2['data'][] = $tem;
				 }else{
				$show2['name'] = 'tem';
				$show2['data'][] = "0"; 
				 }

				//////////////////////////
				if(!empty($volt)){
				$show3['name'] = 'volt';
				$show3['data'][] = $volt;
				}else{
				$show3['name'] = 'volt';
				$show3['data'][] = "0";
				}

				//////////////////////////
				if(!empty($current)){
				$show4['name'] = 'current';
				$show4['data'][] = $current;
				}else{
				$show4['name'] = 'current';
				$show4['data'][] = "0";
				}

				/////////////////////////
				if(!empty($load)){
				$show5['name'] = 'load';
				$show5['data'][] = $load;
				}else{
				 $show5['name'] = 'load';
				$show5['data'][] = "0";
				}
	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	array_push($result,$show);
	array_push($result,$show2);
	array_push($result,$show3);
	array_push($result,$show4);
	array_push($result,$show5);
	print json_encode($result, JSON_NUMERIC_CHECK);

?>
