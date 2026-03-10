<?php
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		$hotspot_server =$_REQUEST['server'];
	    $profile=$_REQUEST['package_id'];
		$csv_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
        $db_comment=$_REQUEST['comment'];
	    $date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		///csv on
		$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
		$csv=round(date('YmdHi.s'));
		$objWrite = fopen($fileName, "w");
		
        $mik_add=0;
		$i=1;
		do{
		    $username=$_REQUEST['fix_user'].$convert->genUser();		
			$password=$_REQUEST['fix_pass'].$convert->genPass();
			$row=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$username."'");
		
			
				
			if($row<=0){
				$API->comm("/tool/user-manager/user/add", array(
									"customer" => $hotspot_server,	
									"username"	=> $username,
									"password"	=> $password,
                                   // "limit-uptime" => $limit_uptime,
									"copy-from"	=> $profile,
			                       // "caller-id"  => $mac ,
		                           // "address"  => $ip ,
			                       // "email"  => $email ,
			                        "comment"  => $db_comment
									));
				 $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											//"username"	=> $username,
											//"password"  => $password,
											"profile" => $profile,
											"customer" => $hotspot_server,
							                //"caller-id"  => $caller ,//create-and-activate-profile
		                                   // "ip-address"  => $ip ,
			                              //  "email"  => $email ,
									        "numbers"	=> $username
								));
				$group="usermanager-".$_REQUEST['fix_user']."";
				///csv start
			   fwrite($objWrite, "$username,$password,$csv_comment,$profile \n");
			    ///csv end
				$mik_add++;
				
				
				$db->add_db("mt_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						//"limit_uptime"  =>  $db_limit_uptime,
						  "	profile"  =>  $profile,
						  //"server_pro"  =>  $hotspot_server,
                         // "mac_address"  =>  $db_mac,
		                 // "ip_address"    =>   $db_ip,
		                 // "email"  =>  $email,
		                  "comment"  =>  $db_comment,
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
			
                               ));
				
				$i++;			
			}
		}while($i<=$num);
		
       
	   
	   echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." users!','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();
?>
