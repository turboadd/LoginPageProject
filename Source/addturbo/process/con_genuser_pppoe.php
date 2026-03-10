<?php
	set_time_limit(60);	
	$num=$_REQUEST['max_user'];
		
		$profile=$_REQUEST['package_id'];
		$mac=$_REQUEST['mac'];
	    $db_mac=$_REQUEST['mac'];
		 $service="pppoe";
		$date=date('Y-m-d H:i:s');
	    $id=$_SESSION['id'];
		$group=$_REQUEST['fix_user'];
		$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
        $db_comment=$_REQUEST['comment'];
		///csv on
		$fileName = "../csv/org_csv/Gen".date("YmdHi").".csv";
		$csv=round(date('YmdHi.s'));
		$objWrite = fopen($fileName, "w");
		///csv off
		$i=1;
		$num_check=0;$mik_add=0;

		do{
		    $username=$_REQUEST['fix_user'].$convert->genUser();		
			$password=$_REQUEST['fix_pass'].$convert->genPass();
			$rows=$db->rows_num("SELECT * FROM pppoe_gen WHERE user='".$username."'");	
			if($rows<=0){
				$ARRAY = $API->comm("/ppp/secret/add", array(
									"service"	=> $service,
									"name"		=> $username,
									"password"	=> $password,
                                    "profile"	=> $profile,
			                        "caller-id"  => $mac ,
		                            "comment"  => $mt_comment ,
									));
				
				///csv start
			   fwrite($objWrite, "$username,$password,$mt_comment,$profile \n");
			    ///csv end
				$mik_add++;
				$db->add_db("pppoe_gen",array(
                        "user"  =>  $username,
						"pass"  =>  $password,
						 "	profile"  =>  $profile,
						  "caller_id"  =>  $db_mac,
		                 "comment"  =>  $db_comment,
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
			
                               ));

				$i++;			
			}
		}while($i<=$num);
		//echo "<script>alert('สร้างรายชื่อจำนวน  ".$num." users  สำเร็จแล้ว')</script>";
		//echo "<meta http-equiv='refresh' content='0;url=../system/index.php?page=pppoe_dtb_user' />";
		echo "<script language='javascript'>swal('Save Done!','สร้างรายชื่อจำนวน  ".$num." users สำเร็จ ".$mik_add." users!','success').then(function () {
    window.location.href = '../system/index.php?page=pppoe_dtb_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=pppoe_dtb_user';
   }})</script>";
		exit();
?>
