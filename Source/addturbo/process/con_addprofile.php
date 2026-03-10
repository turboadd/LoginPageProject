<?php
	$name=$_REQUEST['name'];
	$session=$_REQUEST['session']; if($session==""){$session = "00:00:00";}
	$db_session=$_REQUEST['session'];
	$idle=$_REQUEST['idle']; if($idle==""){$idle = "none";}	
	$use=$_REQUEST['use']; if($use==""){$use = "0";}	
	$limit=$_REQUEST['limit']; if($limit==""){$limit = "";}	
	$keep=$_REQUEST['keep']; if($keep==""){$keep = "00:02:00";}	
	$auto=$_REQUEST['auto']; if($auto==""){$auto = "00:01:00";}
	///$uptime=$_REQUEST['uptime'];
	$price=$_REQUEST['price'];
	$active=$_REQUEST['active'];
	$login=":local whouser \$user;:local whoip \$address;:local macaddr [/ip hotspot active get [find address=\$whoip] mac-address];:log info \"user logged in: \$whouser IP: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ip hotspot user get \$user comment ] = \"\" ) do={[/ip hotspot user set \$user comment=\"\$date \$time\"];:log info \"New Hotspot user logged in: \$whouser\";}}";
    $logout=":log info \"\$user (\$address): logged out: \$cause \";";


	
	
	if(!empty($name)){


		$rows=$db->rows_num("SELECT pro_name FROM mt_profile WHERE pro_name='".$name."'");
		if($rows>0){
			//echo "<script>alert('มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่.')</script>";
			//echo "<script>window.history.back()</script>";
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$name." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
			$db->add_db("mt_profile",array(
                      "pro_name"  =>  $name,
                       "pro_session"  =>  $db_session,
		                "pro_idle"    =>   $idle,
		                "pro_keepalive"  =>  $keep,
		                 "pro_autorefresh"  =>  $auto,
	                      "pro_users" =>    $use,
		                   "pro_limit" =>  $limit,
		                    "pro_price"    =>    $price,
	                         "mt_id"  =>  $id
			                  ));
			
			
			$API->comm("/ip/hotspot/user/profile/add", array(
									"name" => $name,
									"session-timeout" => $session,
									"idle-timeout" => $idle,
									"keepalive-timeout" => $keep,
									"status-autorefresh" => $auto,
									"shared-users" => $use,
									"rate-limit" => $limit,
									"on-login" => $login,
				                    "on-logout" => $logout
								));
			
			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Profile ".$name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=profilelist';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=profilelist';
   }})</script>";
			exit;
		}
	}
?>