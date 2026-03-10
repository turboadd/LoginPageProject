<?php
	include_once("../include/config.inc.php");
	include_once('../config/routeros_api.class.php');			
	include_once('../include/conn.php');
	

	if($_GET['return']=="dhcp"){
	$ARRAY = $API->comm("/ip/dhcp-server/lease/print");
	
	                      $mac=$_REQUEST['mac'];
	                     $rate_limit=$_REQUEST['rate_limit'];
	                     $comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
                       $server=$_REQUEST['server'];
	                     $address=$_REQUEST['address'];
						 $num =count($ARRAY);
						for($i=0; $i<$num; $i++){
					if($ARRAY[$i]['address']==$address){$Fail=1;}
													}
							if(!empty($Fail)){//add new address error //
								echo "<script language='javascript'>swal('Error address! ".$address."','มีไอพี  ".$address." แล้วใน dhcp lease  กรุณาตั้งใหม่!','error').then(function () {
								window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
								window.history.back();}})</script>";}else{///add new address pass//

									$API->comm("/ip/dhcp-server/lease/add", array(											
												"server"	=> $server,
												"rate-limit" => $rate_limit,
								                "mac-address"  => $mac ,
		                                        "address"  => $address ,
								                "comment"  => $comment ,
			                                   
									));
                     echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$address." สำเร็จแล้ว!','success').then(function () {
                        window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
                       if (dismiss === 'overlay') {
                                window.location.href = 'index.php?page=dhcp';
                    }})</script>";
		              exit();

							}
	}
	#######################################
	if($_GET['return']=="netwatch"){
		 	$host=$_REQUEST['host'];
	$interval=$_REQUEST['interval'];
	$timeout=$_REQUEST['timeout']."ms";
	$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);

	if(!empty($_REQUEST['on_up'])){
		 $up=$_REQUEST['on_up'];
	}else{
	$up=":log warning \":host failed:ping ".$host." link up\";";
	}
    if(!empty($_REQUEST['on_down'])){
	$down=$_REQUEST['on_down'];
	}else{
	$down=":log error \":host failed:ping ".$host." link down\";";
	}
	
	

		$ARRAY = $API->comm("/tool/netwatch/add", array(
									  "host" => $host,	
									  "interval"     => $interval,
									  "timeout" => $timeout,	
									  "comment"  => $mt_comment ,
									  "up-script"  => $up ,
									  "down-script"  => $down ,
							));
		

		echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$host." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';
   }})</script>";
		exit();

	}
  ##########################################
  if($_GET['return']=="ip_binding"){
              if($_REQUEST['mac']){
		      $mac_address    = $_REQUEST['mac'];
                $address=$_REQUEST['address'];if($address==""){$address="0.0.0.0";}
				$to_address=$_REQUEST['to_address'];if($to_address==""){$to_address="0.0.0.0";}
                $type= $_REQUEST['type'];
                $comment=iconv("utf-8","tis-620",$_REQUEST['comment']);
				$server = $_REQUEST['server'];
                $ARRAY = $API->comm("/ip/hotspot/ip-binding/add", array(
                    "mac-address"   => $mac_address,
                    "address"       => $address,
                    "to-address"    => $to_address,
                    "type"          => $type,
                    "comment"       => $comment,
					"server"       => $server,
                ));
				echo "<script language='javascript'>swal('เพิ่ม ".$mac_address."  สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
				exit();}else{
			  echo "<script language='javascript'>swal('Error!','กรุณากำหนด mac-address','error').then(function () {
     window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {
  if (dismiss === 'overlay') {
     window.location.href = 'index.php?page=ip_binding';
   }})</script>";}
			  }	
##################################	
if($_GET['return']=="wg"){
             
		      $src_address    = $_REQUEST['src_addr'];
			  $dst_address    = $_REQUEST['dst_addr'];
			  $dst_port    = $_REQUEST['dst_port'];
			  $dst_host    = $_REQUEST['dst_host'];
			  $server = $_REQUEST['server'];
			  $action= $_REQUEST['action'];
			 $num= $_REQUEST['count'];
              $comment=iconv("utf-8","tis-620",$_REQUEST['comment']);
		 if((!empty($dst_address))&&(!empty($dst_host))){		
               
			   echo "<script language='javascript'>swal('Error!','กรุณากำหนด Dst.address หรือ Dst.host อย่างใดอย่างหนึ่ง','error').then(function () {
     window.location.href = 'index.php?page=walled_garden_ip';}, function (dismiss) {
  if (dismiss === 'overlay') {
     window.location.href = 'index.php?page=walled_garden_ip';
   }})</script>";
   exit();
				}else{
					$API->comm("/ip/hotspot/walled-garden/ip/add",array(
						
					               "comment"=>$comment               ));
			if(!empty($src_address)){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "src-address" => $src_address,	
									 
									"numbers"=> $num, 
							));}
			if(!empty($dst_address)){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "dst-address" => $dst_address,	
									 
									"numbers"=> $num, 
							));}
			if(!empty($dst_port)){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "dst-port" => $dst_port,	
									 
									"numbers"=> $num, 
							));}
			if(!empty($dst_host)){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "dst-host" => $dst_host,	
									 
									"numbers"=> $num, 
							));}
			if($server){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "server" => $server,	
									 
									"numbers"=> $num, 
							));}
			if(!empty($action)){
			$API->comm("/ip/hotspot/walled-garden/ip/set", array(
									  "action" => $action,	
									 
									"numbers"=> $num, 
							));}

					echo "<script language='javascript'>swal('เพิ่ม No. ".($num+1)."  สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=walled_garden_ip';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=walled_garden_ip';}})</script>";
				exit();
			  }
			  }	
##################################	
?>