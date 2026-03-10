<?php
if($_GET['cmd']=="testcon"){
	
	include("../include/config.inc.php");

	$ip = $_POST['ip'];
	//$user = $_POST['username'];
	//$pass = $_POST['password'];
	$papi = $_POST['portapi'];
	$pweb = $_POST['portweb'];
		
$wait = 1; // wait Timeout In Seconds
$host = $ip;
$ports = array($papi,$pweb);


echo "===== ping ip & check port ====<br>";
foreach ($ports as $value) {
    $fp = @fsockopen($host,$value, $errCode, $errStr, $wait);
    if ($fp) {
		echo "Ping $host:$value => ";
        echo 'SUCCESS.<br>';
        fclose($fp);
    } else {
        echo "ERROR: $errCode - $errStr <br>";
    }
    echo PHP_EOL;
}
echo "=========================";
 
}

?>




