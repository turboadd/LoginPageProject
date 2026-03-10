<?php
	
	
	$server_off=$_GET['system'];

	if(!empty($server_off)){
	 if($server_off=="shutdown"){
		  $API->comm("/system/shutdown");
	echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";}
	 if($server_off=="restart"){
		 $API->comm("/system/reboot");
	 echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";}
	 
	 }else{ 
	echo "<meta http-equiv='refresh' content='0;url=../system/index.php' />";
	}	
	



?>