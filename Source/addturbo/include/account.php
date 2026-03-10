<?php	
include_once('../config/routeros_api.class.php');
include_once("../include/conn.php");
$acc = $API->comm("/user/print");

$numuser =count($acc);
for($i=0; $i<$numuser; $i++){
	if($acc[$i]['name']=="".$USER_ACCOUNT.""){$account=$acc[$i]['group'];}
	} 
	if(empty($account)){
	  echo "<script language='javascript'>alert('ERROR ACCOUNT CONNECT...')</script>";	
	echo "<meta http-equiv='refresh' content='0;url=../admin/index.php' />";
	}
?>