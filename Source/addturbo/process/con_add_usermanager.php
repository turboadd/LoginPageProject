<?php
	set_time_limit(60);
	
	$hotspot_server=$_REQUEST['server'];
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	$profile=$_REQUEST['package_id'];
	$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
	$mac=$_REQUEST['mac'];
	$email=$_REQUEST['email'];
	$csv_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
	$comment=$_REQUEST['comment'];
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	//$db_limit_uptime=$_REQUEST['limit_uptime'];
	$db_ip=$_REQUEST['ip'];
	$db_mac=$_REQUEST['mac'];
	// set.csv file 
	$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
	$csv=round(date('YmdHi.s'));
    $objWrite = fopen($fileName, "w");
	 //END .csv file
	if(!empty($username)){
		$rows=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$username."'");
		if($rows>0){
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$username." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
   exit();
		}else{
		$ARRAY = $API->comm("/tool/user-manager/user/add", array(
									  "customer" => $hotspot_server,	
									  "username"     => $username,
									  "password" => $password,	
									 // "limit-uptime" => $limit_uptime,	
									"copy-from"  => $profile ,
                                      //"create-and-activate-profile"  => $profiles ,
			                          "caller-id"  => $mac ,
		                              "ip-address"  => $ip ,
			                          "email"  => $email ,
			                          "comment"  => $comment ,
							));

       $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											//"username"	=> $username,
											//"password"  => $password,
											"profile" => $profile,
											"customer" => $hotspot_server,
							                //"caller-id"  => $caller ,//create-and-activate-profile
		                                   // "ip-address"  => $ip ,
			                              //  "email"  => $email ,
									        "numbers"	=> $username,
								));

		$group="usermanager-".$username."";
		///csv start
		fwrite($objWrite,"$username,$password,$csv_comment,$profile \n");
	    ///csv end
		
		$db->add_db("mt_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						//"limit_uptime"  =>  $db_limit_uptime,
						  "	profile"  =>  $profile,
						 // "server_pro"  =>  $hotspot_server,
                          "mac_address"  =>  $db_mac,
		                  "ip_address"    =>   $db_ip,
		                  "email"  =>  $email,
		                  "comment"  =>  $comment,
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