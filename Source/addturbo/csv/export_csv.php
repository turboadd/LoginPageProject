
<?php
    // include_once('../config/routeros_api.class.php');
	include("../include/config.inc.php");
	include_once('../include/account.php');
    //$fileName =$_GET['file'];
	 $to_export=$_GET['to'];
	set_time_limit(60);	
	// $id=$_SESSION['id'];
	$fileName = "../csv/select_csv/Gen".$_GET['id'].".csv";
      $csv=date("YmdHi");
    
	  $db->DB->exec("SET NAMES TIS620");
       $objWrite = fopen($fileName, "w");
       $i=1;
	   if($_GET['code']=="pppoe"){
       
       

       $sql=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE ".$to_export."='".$_GET['id']."'");
	   $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
                            
                             $username =  $result['user'];
							 $password  =$result['pass'];
							 $comment  =$result['comment'];
							 $pro  =$result['profile'];

		  fwrite($objWrite, "$username,$password,$comment,$pro\n");
		  $i++;
	  } fclose($objWrite);
	  echo "<meta http-equiv='refresh' content='0;url=".$fileName."' />";
	   }else{
       
       $sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE ".$to_export."='".$_GET['id']."'");
	   $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
                           $username = $result['user'];
							 $password  =$result['pass'];
							 $comment  =$result['comment'];
							 $pro  =$result['profile'];

		  fwrite($objWrite, "$username,$password,$comment,$pro\n");
		  $i++;
	  } fclose($objWrite);
	  echo "<meta http-equiv='refresh' content='0;url=".$fileName."' />";
	   }

	/*	echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จแล้ว".$no."! user','success').then(function () {
    window.location.href = '../system/index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=listuser';
   }})</script>";
		exit();*/
?>




	

