<?php 

if(isset($_SESSION['APIUser'] AND $_SESSION['security'])){
	unset($_SESSION['id']);
	unset($_SESSION['APIUser']);
	unset($_SESSION['security']);
	print "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../admin/login.php'>"; 
}else{
	unset($_SESSION['id']);
	unset($_SESSION['APIUser']);
	unset($_SESSION['securityr']);
	print "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=../admin/login.php'>"; 
}
?>
