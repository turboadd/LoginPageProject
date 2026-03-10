<?php
 
	$HOST_NAME = "localhost";
	$DB_NAME = "mikrotik4";
	$CHAR_SET = "charset=utf8"; // เช็ตให้อ่านภาษาไทยได้
 
	$USERNAME = "root";     // ตั้งค่าตามการใช้งานจริง
	$PASSWORD = "channarong2499";  // ตั้งค่าตามการใช้งานจริง
 
 
	try {
	
		$PDO = new PDO('mysql:host='.$HOST_NAME.';dbname='.$DB_NAME.';'.$CHAR_SET,$USERNAME,$PASSWORD);
		date_default_timezone_set('Asia/Bangkok');
		  //echo "connect";
	
	
	} catch (PDOException $e) {
	
		echo "<b><font color=red> ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage()."</font></b>";
	
	}
 
?> 
