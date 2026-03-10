<?php
	
	$userfrom=$_GET['id'];
    $cancel="no";
	if($account=="read"){$cancel="yes";}
	if($account=="write"){$cancel="yes";}
	
    	if($cancel!="yes"){
	if($_GET['return']=="mik"){
	 $API->comm("/ip/hotspot/user/remove", array(
								"numbers" => $userfrom,
							));

	 $db->del("mt_gen","user ='".$userfrom."'");
	
	echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
		exit;}

	
	
	if($_GET['return']=="userman"){
		$from= $API->comm("/tool/user-manager/user/print", array(
                              "from" => $userfrom,
								));
		if(!empty($from['0']['actual-profile'])){
		if($from['0']['actual-profile']==$from['0']['username']){
		echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','จะมีผลกับการสร้างuser ในprofile ".$userfrom."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
		}else{echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";}
		
		}else{echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";}
}

	
	
	if($_GET['return']=="pppoe"){
	 $API->comm("/ppp/secret/remove", array(
								"numbers" => $userfrom,
							));	
		$db->del("pppoe_gen","user = '".$userfrom."'");
		echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
		exit;}

	
	
	if($_GET['return']=="allDB"){
	$db->del("mt_gen","user = '".$userfrom."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom." สำเร็จแล้ว!','success').then(function () {
      window.location.href = 'index.php?page=all_data_users&id=".$id."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="DB"){
	$db->del("mt_gen","user = '".$userfrom."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom." สำเร็จแล้ว!','success').then(function () {
      window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_allDB"){
		
		$db->del("pppoe_gen","user = '".$userfrom."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_DB"){
		$db->del("pppoe_gen","user = '".$userfrom."'");
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ ".$userfrom."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
	exit;}


	if($_GET['return']=="binding"){

		$ARRAY = $API->comm("/ip/hotspot/ip-binding/print", array(
									"from" => $userfrom,
								));
		 $API->comm("/ip/hotspot/ip-binding/remove", array(
								"numbers" => $userfrom,
							));
		 
		
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ MAC. ".$ARRAY[0]['mac-address']."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
	exit;}

	if($_GET['return']=="net"){

		$ARRAY = $API->comm("/tool/netwatch/print", array(
									"from" => $userfrom,
								));
		 $API->comm("/tool/netwatch/remove", array(
								"numbers" => $userfrom,
							));
		 
		
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ HOST. ".$ARRAY[0]['host']."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';}})</script>";
	exit;}
	  

		if($_GET['return']=="dhcp"){
		  $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
									"from" => $userfrom,
								));

		 $API->comm("/ip/dhcp-server/lease/remove", array(
								"numbers" => $userfrom,
							));
		
					
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ IP. ".$ARRAY[0]['address']." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=dhcp';}})</script>";
	exit;}

		if($_GET['return']=="wg"){


		 $API->comm("/ip/hotspot/walled-garden/ip/remove", array(
								"numbers" => $userfrom,
							));
		 
		
     echo "<script language='javascript'>swal('Delete Successfully!','ลบ No. ".($userfrom+1)."  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=walled_garden_ip';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=walled_garden_ip';}})</script>";
	exit;}
		}else{
			
	##############################################################################################################		
	if($_GET['return']=="mik"){

		echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
		exit;}

	
	
	if($_GET['return']=="userman"){

    echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	}

	
	
	if($_GET['return']=="pppoe"){

		echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
		exit;}

	
	
	if($_GET['return']=="allDB"){

     echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
      window.location.href = 'index.php?page=all_data_users&id=".$id."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="DB"){

     echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
      window.location.href = 'index.php?page=user&id=".$_GET['code']."';}, function (dismiss) {
      if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=user&id=".$_GET['code']."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_allDB"){
     echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = 'index.php?page=pppoe_all_data_users&id=".$id."';}})</script>";
	exit;}

	
	
	if($_GET['return']=="pppoe_DB"){
	
     echo "<script language='javascript'>swal('Can Not Remove User  ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['code']."';}})</script>";
	exit;}
	
	if($_GET['return']=="binding"){

		echo "<script language='javascript'>swal('Can Not Remove id ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
		exit;}

			if($_GET['return']=="net"){

		echo "<script language='javascript'>swal('Can Not Remove id ".$userfrom."!','ระบบไม่อนุญาตสิทธิ์ ในการลบ!','error').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';}})</script>";
		exit;}
			
}

?>