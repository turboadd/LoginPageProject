<?php
if(!empty($_GET['id'])){
		$db->del("mt_config","mt_num='".$_GET['id']."'");
		
	   echo "<script language='javascript'>swal('ลบ SERVER  สำเร็จแล้ว!','You clicked the button!','success').then(
  function () {
  window.location.href = window.location.href = 'index.php';;}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php';
   }})</script>";
		exit(0);
	}	
?>