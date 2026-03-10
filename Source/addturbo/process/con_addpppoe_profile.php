<?php
	
	$name=$_REQUEST['name'];
	$local=$_REQUEST['local'];
	$remote=$_REQUEST['remote'];
	$limit=$_REQUEST['limit'];
     $price=$_REQUEST['price'];


	$onup=":local whouser \$user;:local whoip [/ppp active get [find name=\$whouser] address];:local macaddr [/ppp active get [find name=\$whouser] caller-id];:log info \"user logged in: \$whouser Address: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ppp secret get \$whouser comment ] =\"\" ) do={[/ppp secret set \$whouser comment=\"\$date \$time\"];:log info \"New PPPOE user logged in: \$whouser\"; }}";
	
	
	
	
	if(!empty($name)){

		$rows=$db->rows_num("SELECT pro_name FROM pppoe_pro WHERE pro_name='".$name."'");
		
		if($rows>0){
			
			echo "<script language='javascript'>swal('Error!','มีชื่อ ".$name." แล้วในฐานขื้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {
    window.history.back();}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
		}else{
			
			 $db->add_db("pppoe_pro",array(
                                       "pro_name"    =>  $name,
		                              "pro_local"    =>  $local,
	                                    "pro_limit"    =>  $limit,
	                                  "pro_remote"   =>   $remote,
	                                 "pro_price"     =>   $price,
				                     "mt_id"        =>   $id
		                               ));
		
			
			$ARRAY = $API->comm("/ppp/profile/add", array(
									"name" => $name,
									//"session-timeout" => $session,
									"local-address" => $local,
									"remote-address" => $remote,
										"rate-limit" => $limit,
										"on-up" => $onup
									
									
									
								));		
			
			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Profile ".$name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = '../system/index.php?page=pppoe_profile_list';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php?page=pppoe_profile_list';
   }})</script>";
			exit;
		}
	}
?>