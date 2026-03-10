<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>mikrotik hotspot > login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="-1" />
</head>

<body>

<?php
$ip = "1.10.230.5";
$user = "admin";
$pass = "totadmin";
$port_api = "8728";
$test = "08:62:66:DD:1A:50";
include( 'include/routeros_api.class.php' );
$API = new routeros_api();
$API->debug = false;
$API->connect( $ip, $user, $pass, $port_api );
//$API->comm("/ip/hotspot/active/remove=mac-address=".$test.""); 
$ARRAY = $API->comm("/ip/hotspot/host/print");
for ($i=0; $i<250; $i++) {
	$regtable = $ARRAY[$i];
	echo $regtable['.id'] . "<br>";
	echo $regtable['mac-address'];
	
	if($test == $regtable['mac-address'] ) {
		echo $regtable['.id'] ."OK";
		$id = $regtable['.id'];
		$API->comm("/ip/hotspot/host/remove=.id=".$i."");
	}
}
$API->comm("/ip/hotspot/host/remove=.id='0'");
   $API->disconnect();



?>
</body>
</html>