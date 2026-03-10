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
				$health = $API->comm("/system/health/print");
				$hotspot = $API->comm("/ip/hotspot/active/print");
				$pppoe = $API->comm("/ppp/active/print");
				$neighbor = $API->comm("/ip/neighbor/print");
				$clock = $API->comm("/system/clock/print");
				
                
	$show0 = array();
	$show1 = array();
	$show2 = array();
	$show3 = array();
	$show4 = array();
	$show5 = array();
	$show6 = array();
	$show7 = array();
			
			 
			
			///////////////////////////////
			if(!empty(count($resource['0']['cpu-load']))){
				$show0['name'] = 'cpu_load';
				$show0['data'][] = $resource['0']['cpu-load']." %";
				
			}else{
			 $show0['name'] = 'cpu_load';
				$show0['data'][] = "0";
			}
             ///////////////////////////	
			if(!empty($resource['0']['uptime'])){	
				$show1['name'] = 'uptime';
				$show1['data'][] = $resource['0']['uptime'];
			} else{
				$show1['name'] = 'uptime';
				$show1['data'][] = "off";
			}
			
			//////////////////////////	
			if(!empty(count($hotspot))){	
				$show2['name'] = 'hotspot-active';
				$show2['data'][] = count($hotspot)." Clients";
				
			}else{
				$show2['name'] = 'hotspot-active';
				$show2['data'][] ="0 Clients";
			}

			/////////////////////////////
			if(!empty(count($pppoe))){
				$show3['name'] = 'pppoe-active';
				$show3['data'][] = count($pppoe)." Clients";
				
            }else{
				$show3['name'] = 'pppoe-active';
				$show3['data'][] = "0 Clients";
			}    
			
			////////////////////////////	
			if(!empty(count($neighbor))){	
				$show4['name'] = 'ap-online';
				$show4['data'][] = count($neighbor)." Clients";
				
			}else{
				$show4['name'] = 'ap-online';
				$show4['data'][] = "0 Clients";
			}
			
			/////////////////////////////	
			if(!empty($resource['0']['uptime'])){	
				$show5['name'] = 'panel-uptime';
				$show5['data'][] = "Uptime : ".($resource['0']['uptime']);
				
			}else{
				$show5['name'] = 'panel-uptime';
				$show5['data'][] = "off";
			}

			 /////////////////////////////
			if(!empty($clock['0']['time'])){
				$show6['name'] = 'time';
				$show6['data'][] = "Time : ".($clock['0']['time']);
				
			}else{
			  $show6['name'] = 'time';
				$show6['data'][] = "off";
			}
			
			//////////////////////////////	
			if(!empty($clock['0']['date'])){	
				$show7['name'] = 'date';
				$show7['data'][] = "Date : ".($clock['0']['date']);
				
			}else{
			  $show7['name'] = 'date';
				$show7['data'][] = "off";
			}

			
			/////////////////////////////	

	}
	$API->disconnect();
    $res = array();
	
	array_push($res,$show0);
	array_push($res,$show1);
	array_push($res,$show2);
	array_push($res,$show3);
	array_push($res,$show4);
	array_push($res,$show5);
	array_push($res,$show6);
	array_push($res,$show7);
	
	print json_encode($res, JSON_NUMERIC_CHECK);

?>
