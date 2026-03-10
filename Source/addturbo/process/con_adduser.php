<?php
		
	set_time_limit(60);
	$hotspot_server=$_REQUEST['server']; if($hotspot_server==""){$hotspot_server = "all";}
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
	$db_limit_uptime=$_REQUEST['limit_uptime'];
	$profiles=$_REQUEST['package_id'];
	$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	$db_ip=$_REQUEST['ip'];
	$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
	$db_mac=$_REQUEST['mac'];
	$email=$_REQUEST['email'];
	$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
    $db_comment=$_REQUEST['comment'];
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	// set.csv file 
    $fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
	$csv=round(date('YmdHi.s'));
    $objWrite = fopen($fileName, "w");
	 //END .csv file
	if(!empty($username)){
		
	$ARRAY = $API->comm("/ip/hotspot/user/print");
	$num =count($ARRAY);
	$rowsmik=0;
	for($i=0; $i<$num; $i++){if($ARRAY[$i]['name']==$username){$rowsmik="1";}}
	
	$rows=$db->rows_num("SELECT user FROM mt_gen WHERE user='".$username."'");
		if(($rows+$rowsmik)>0){
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$username." แล้วในฐานข้อมูล หรือใน mikrotik กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{

		                  $API->comm("/ip/hotspot/user/add", array(
									  "server" => $hotspot_server,	
									  "name"     => $username,
									  "password" => $password,	
									  "limit-uptime" => $limit_uptime,	
									  "profile"  => $profiles ,
			                          "mac-address"  => $mac ,
		                              "address"  => $ip ,
			                          "email"  => $email ,
			                          "comment"  => $mt_comment ,
							));
	   $group="mikrotik-".$username."";
		///csv start
		fwrite($objWrite,"$username,$password,$mt_comment,$db_limit_uptime \n");
	    ///csv end
		        

		        $db->add_db("mt_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						"limit_uptime"  =>  $db_limit_uptime,
						  "	profile"  =>  $profiles,
						  "server_pro"  =>  $hotspot_server,
                          "mac_address"  =>  $db_mac,
		                  "ip_address"    =>   $db_ip,
		                  "email"  =>  $email,
		                  "comment"  =>  $db_comment,
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
			
                               ));
			
		
		echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
		}
	}
?>