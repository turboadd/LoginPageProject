<?php
	
	
	$username=$_REQUEST['user'];
	$password=$_REQUEST['pass'];
	$profiles=$_REQUEST['package_id'];
	$db_mac=$_REQUEST['mac'];
    $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
    $db_comment=$_REQUEST['comment'];
	//$db_ip=$_REQUEST['ip'];
	$service="pppoe";
	$id=$_SESSION['id'];
	$date=date('Y-m-d H:i:s');
	// set.csv file 
	$filName = "../csv/org_csv/Gen".date("YmdHi").".csv";
	$csv=round(date('YmdHi.s'));
    $objWrite = fopen($filName, "w");
	 //END .csv file
	if(!empty($username)){
		
		$rows=$db->rows_num("SELECT user FROM pppoe_gen WHERE user='".$username."'");
		if($rows>0){
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$username." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
		$ARRAY = $API->comm("/ppp/secret/add", array(
									  
		            "service"	=> $service,
						"name"  => $username,
						"password" => $password,	
							"profile"  => $profiles ,
								"caller-id"  => $db_mac ,
		                             "comment"  => $mt_comment
								  
							));
		$group=$username;

		fwrite($objWrite, "$username,$password,$mt_comment,$profiles \n");
		 $db->add_db("pppoe_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						 "profile"  =>  $profiles,
						  "caller_id"  =>  $db_mac,
		                  //"address"    =>   $db_ip,
		                  "comment"  =>  $db_comment,
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
			
                               ));

		
		echo "<script language='javascript'>swal('Save Done!','เพิ่ม ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();
	}
	}
?>