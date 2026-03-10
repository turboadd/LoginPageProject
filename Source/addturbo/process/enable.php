<?php
	$username=$_GET['user'];
	if($_GET['return']=="mik"){
	 $API->comm("/ip/hotspot/user/enable
						=.id=".$username."");	
	 echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();}})</script>";
	exit;}
	if($_GET['return']=="userman"){
	 $API->comm("/tool/user-manager/user/enable
						=.id=".$username."");
	 	
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	exit;}
	if($_GET['return']=="pppoe"){
	 $API->comm("/ppp/secret/enable
						=.id=".$username."");		
		
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable User ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
	exit;}

			if($_GET['return']=="dhcp"){
	 $API->comm("/ip/dhcp-server/lease/enable		
	            =.id=".$username."");
	$ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
									"from" => $username,
								));
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable IP. ".$ARRAY[0]['address']." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=dhcp';}})</script>";
	exit;}

			if($_GET['return']=="binding"){
	 $API->comm("/ip/hotspot/ip-binding/enable		
	            =.id=".$username."");
	 $ARRAY = $API->comm("/ip/hotspot/ip-binding/print", array(
									"from" => $username,
								));
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable MAC. ".$ARRAY[0]['mac-address']." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
	exit;}
				if($_GET['return']=="net"){
	 $API->comm("/tool/netwatch/enable		
	            =.id=".$username."");
	$ARRAY = $API->comm("/tool/netwatch/print", array(
									"from" => $username,
								));
	echo "<script language='javascript'>swal('Enabled Successfully!','Enable HOST. ".$ARRAY[0]['host']." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';}})</script>";
	exit;}
				if($_GET['return']=="wg"){
	 $API->comm("/ip/hotspot/walled-garden/ip/enable		
	            =.id=".$username."");

	echo "<script language='javascript'>swal('Enabled Successfully!','Enable No. ".($username+1)." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=walled_garden_ip';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=walled_garden_ip';}})</script>";
	exit;}
		

?>