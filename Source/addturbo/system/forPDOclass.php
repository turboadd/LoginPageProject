	    <?php
	    //นับจำนวน`
	    $rows=$db->rows_num("SELECT user FROM mt_gen WHERE user='".$username."'");
		   
		   
		   //นับกรุ๊ป
	    $count= $db->num_rows("mt_gen","user","csv_code='".$result['csv_code']."'");

	    ///ADD user//
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

	        // UPDATE///
	          $db->update_db("mt_config",array(
         
			"mt_ip" =>     $_REQUEST['ip'], 
			"mt_user" =>     $_REQUEST['username'], 
			"mt_pass" =>      $_REQUEST['password'],
			  "port_api" =>    $_REQUEST['portapi'],
			    "port_web"=>   $_REQUEST['portweb'],
			  "customer_pin"=> $_REQUEST['customerPin'],
			   "user_pin"=>  $_REQUEST['userPin'],
			    "site_name"=> $_REQUEST['siteName']
				),"mt_num='".$_GET['id']."'");


			   $db->update_db("mt_gen",array(
                                               "user"    =>   $_REQUEST['username'],
							                   "pass"   =>     $_REQUEST['password'],
							              "limit_uptime"=>     $_REQUEST['limit_uptime'],
							              "profile"     =>      $_REQUEST['profile'],
							              "ip_address"   =>      $_REQUEST['ip'],
							                "mac_address"   =>    $_REQUEST['mac'],
							                    "comment"  =>     $db_comment,
							                    "email"    =>     $_REQUEST['email']
				                                     ),"user='".$user."'");




         ///เพิ่มล่าสุด
	     $last_id=$db->new_insert_id();


       ///update db
		$db->update_db("mt_config",array(
          "mt_id"=>$last_id,
        ),"mt_ip='".$ip."'");
		
       ////table///
    $sql=$db->DB->prepare("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
	 $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{}


                 //////// 1 select/////////
               	 $secu=$db->selectquery("SELECT * FROM mt_config");
	             $admin_pin=$secu['admin_pin'];

	             ///DEL//
	             $db->del("mt_config","mt_num='".$_GET['id']."'");

	             /// convert //
	             $db->DB->exec("set names utf8");
	             $db->DB->exec("SET NAMES TIS620");

            ?>  
			