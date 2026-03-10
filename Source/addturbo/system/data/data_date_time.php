<?php

include_once('../../config/routeros_api.class.php');
include "../../include/config.inc.php";
include_once("../../include/conn.php");
$ipRouteros = $IP_ACCOUNT;
$Username=$USER_ACCOUNT;
$Pass=$PASS_ACCOUNT;
$api_port=$PORT_ACCOUNT;
$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_port)) {

	
                $resource = $API->comm("/system/resource/print");
                $clock = $API->comm("/system/clock/print");
				
                
	$show0 = array();
	$show1 = array();
	$show2 = array();

			
			 
			

			/////////////////////////////	
			if(!empty($resource['0']['uptime'])){	
				$show0['name'] = 'panel-uptime';
				$show0['data'][] = "Uptime : ".($resource['0']['uptime']);
				
			}else{
				$show0['name'] = 'panel-uptime';
				$show0['data'][] = "off";
			}

			 /////////////////////////////
			if(!empty($clock['0']['time'])){
				$show1['name'] = 'time';
				$show1['data'][] = "Time : ".($clock['0']['time']);
				
			}else{
			  $show1['name'] = 'time';
				$show1['data'][] = "off";
			}
			
			//////////////////////////////	
			if(!empty($clock['0']['date'])){	
				$show2['name'] = 'date';
				$show2['data'][] = "Date : ".($clock['0']['date']);
				
			}else{
			  $show2['name'] = 'date';
				$show2['data'][] = "off";
			}

			
			/////////////////////////////	

	}
	$API->disconnect();
    $res = array();
	
	array_push($res,$show0);
	array_push($res,$show1);
	array_push($res,$show2);

	
	print json_encode($res, JSON_NUMERIC_CHECK);

?>
