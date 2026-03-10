<?php
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		$hotspot_server =$_REQUEST['server'];if($hotspot_server==""){$hotspot_server = "all";}
	    $profile=$_REQUEST['package_id'];
		$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
		$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
	    $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
        $db_comment=$_REQUEST['comment'];
		$date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		$db_limit_uptime=$_REQUEST['limit_uptime'];
		$db_mac=$_REQUEST['mac'];

		///csv on
		$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
		$csv=round(date('YmdHi.s'));
		$objWrite = fopen($fileName, "w");
		///csv off
		$i=1;
		$mik_add=0;
		do{

		    $username=$_REQUEST['fix_user'].$convert->genUser();		
			$password=$_REQUEST['fix_pass'].$convert->genPass();
			$rows=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$username."'");
				
			if($rows<=0){
				$API->comm("/ip/hotspot/user/add", array(
									"server" => $hotspot_server,	
									"name"		=> $username,
									"password"	=> $password,
                                    "limit-uptime" => $limit_uptime,
									"profile"	=> $profile,
			                        "mac-address"  => $mac ,
		                            ///"address"  => $ip ,
			                       /// "email"  => $email ,
			                        "comment"  => $mt_comment ,
									));
				$group="mikrotik-".$_REQUEST['fix_user']."";
				///csv start
			   fwrite($objWrite, "$username,$password,$mt_comment,$db_limit_uptime \n");
			    ///csv end
				$mik_add++;
				
				 $db->add_db("mt_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						"limit_uptime"  =>  $db_limit_uptime,
						  "	profile"  =>  $profile,
						  "server_pro"  =>  $hotspot_server,
                          "mac_address"  =>  $db_mac,
		                 /// "ip_address"    =>   $db_ip,
		                  ///"email"  =>  $email,
		                  "comment"  =>  $db_comment,
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
			
                               ));
				
				
				
				
				$i++;
				
			}
		}while($i<=$num);
		
       
		echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." user','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
?>
