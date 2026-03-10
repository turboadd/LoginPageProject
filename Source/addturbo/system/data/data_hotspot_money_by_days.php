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

 #############################################################################################


			 $sql=$db->DB->prepare("SELECT * FROM mt_money WHERE mt_id='".$id."'");
	        $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{

					$utc_data=substr("".$result['utc_time_for_chart']."",-20,10);	                   
				$rows[]=array(($utc_data)."000",$result['money']); //"000"=00:00:00 time
				}
	###################################################################################											
												}
	
//	$hot_days_money = array();
	//array_push($hot_days_money,$rows);
	//array_push($hot_days_money,$rows2);
	print json_encode($rows, JSON_NUMERIC_CHECK);

?>