<?php	
			
	  $db = new ConnectDB();
     $id=$_SESSION['id'];
	$status=$_SESSION['status'];
	if((isset($status))&&(isset($id))&&(isset($_SESSION['security']))&&(isset($_SESSION['APIUser']))){
	 $result=$db->selectquery("SELECT * FROM mt_config WHERE mt_num='".$status."'");
		$IP_ACCOUNT=$result['mt_ip'];
		$USER_ACCOUNT=$result['mt_user'];
		$PASS_ACCOUNT=$result['mt_pass'];
		$PORT_ACCOUNT=$result['port_api'];
		$API = new routeros_api();
	    $API->debug = false;
	    $API->connect($IP_ACCOUNT, $USER_ACCOUNT, $PASS_ACCOUNT, $PORT_ACCOUNT);	
				
		}else{	
			echo "<script language='javascript'>alert('Mikrotik Disconnect')</script>";	
			echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";
			exit(0);
			$API->disconnect();
			$db->DisConnectDB();
		}		
		
?>