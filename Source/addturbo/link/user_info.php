<?php
if(!empty($_GET["return"])){$return= $_GET["return"];}else{ $return= "http://www.sanook.com";}
if(!empty($_GET["username"])){$username= $_GET["username"];}else{ $username= "";}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Airlink user info</title>
<META HTTP-EQUIV="Refresh" CONTENT="300;URL=<?php echo $return;?>">
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=0.9">
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
	<!-- sweetalert STYLES-->
<script src="assets/sweetalert/dist/sweetalert2.min.js"></script><!-- alert -->
  <link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.css"/><!-- alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="assets/css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="assets/css/styleA1.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<!-- //css files -->
<!-- web-fonts -->
<!-- <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700" rel="stylesheet"> -->
<!-- //web-fonts -->
 <link href="images/winbox-logo.png" rel="shortcut icon" type="image/x-icon" />
 		 <style type="text/css">
		
	body {
	background: #414141 url(images/bg2.jpg) no-repeat 0px 0px;
	-webkit-background-size:cover;
	-ms-background-size:cover;
	-o-background-size:cover;
	-moz-background-size:cover;
	background-position:center;
	background-attachment:fixed;
	}
	 html { height: 130%; }
</style>
</head>
<body>
	


		<!--header-->
		<div class="header-w3l">
			<h1>User info</h1>
			
		</div>
		  
		<!--//header-->
		<div class="main-w3layouts-agileinfo">
		
		 <!--form-stars-here--> 
						<div class="wthree-form">
							<h2><font color="#ff8000">ตรวจสอบวันหมดอายุ</font></h2>	
							<form name="userinfo" action="" method="post">
					   
								<div class="form-sub-w3">
									<input name="username" placeholder="ชื่อผู้ใช้" type="text" value="<?php echo $username;?>" required/>
								<div class="icon-w3">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								</div>
								<div class="form-sub-w3">
									<input  name="password" placeholder="รหัสผ่าน" type="text" required/>
								<div class="icon-w3">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								</div>
								</div>

								   <br><br>
								<!-- <label class="anim">
								<input type="checkbox" class="checkbox">
									<span>Remember Me</span> 
									<a href="http://172.0.0.1:81/MyWeb/public/link/change_pass.php?">เปลี่ยน Password</a>
								</label> --> 
								<div class="clear"></div>
								<div class="submit-agileits">
									<input type="submit" value="ตรวจสอบ">
								</div>
								
							</form>

						</div>
				<!--//form-ends-here-->
                   </div>


	<br /><center><div style="color: #ffffff; font-size: 9px">Powered by MikroTik RouterOS</div><br/>
	<!--footer-->
		<div class="footer">  
			<p>&copy;Copyright 2016-2017 | by <a href="https://www.facebook.com/cha.chi.2499">cha chi</a> | <a href="
			<?php echo $return;?>"><span style="color: #f8363c;">ออก</span></a>
			</p>
		</div>
		<!--//footer-->


</center>						
</body>
</html>
<?php
   
		if(!empty($_POST["password"])){
    $old_name = $_POST["username"];
    $password = iconv("utf-8","tis-620",$_POST["password"]);


	///	database zone ////
    include("include/config.inc.php");
	include('include/routeros_api.class.php');
   	$db = new ConnectDB();
	$pp= $db->DB->prepare("SELECT * FROM mt_gen where user = :userA and pass= :passA");
	$pp->bindParam("userA", $old_name,PDO::PARAM_STR);
	$pp->bindParam("passA", $password,PDO::PARAM_STR);
	$pp->execute();
	$sec_count=$pp->rowCount();
	if($sec_count > 0){
	$data=$pp->fetch(PDO::FETCH_OBJ);
	$user_id=$data->mt_id;
   $result=$db->selectquery("SELECT * FROM mt_config WHERE mt_num='".$user_id."'");
    $ip=$result['mt_ip'];
		$user=$result['mt_user'];
		$pass=$result['mt_pass'];
		$port_api=$result['port_api'];
		//$local=$result['am_local'];
		 $local="Asia/Bangkok";
    $API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ip,$user,$pass,$port_api)) {
		/////
		$API->write('/ip/hotspot/user/getall',false);
      $API->write('?name='.$old_name);
      $READ = $API->read(false);
       $ARRAY = $API->parse_response($READ);
        if(!empty($ARRAY['0']['comment'])){$comment = $ARRAY['0']['comment']; }else{$comment ="";}
		$profile = $ARRAY['0']['profile'];
		 if(!empty($comment)){
			include("include/convert.php");
			$convert=new convert();

			   $now_date = $API->comm("/system/clock/print");
							   $miktime=$now_date['0']['time'];
							   $mikdate=$now_date['0']['date'];
                               $convert_total="".$mikdate." ".$miktime."";
		    $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$profile."'");
	                        $check_profile=$exp['pro_expire'];
			 ########################################################
			  ########################################################
		            if(($check_profile)>0){
						   $check_comment=substr("".$comment."",-30,20);
						    $time_comment=substr("".$check_comment."",-8);
							$date_comment=substr("".$check_comment."",-20,11);
						  $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
                          $comm3_check_arr=substr("".$check_comment."",-20,3);
		                  $comm3_arr_arr=array("jan"=>1,"feb"=>1,"mar"=>1,"apr"=>1,"may"=>1,"jun"=>1,"jul"=>1,"aug"=>1,"sep"=>1,"oct"=>1,"nov"=>1,"dec"=>1);
		                  $check3_comment=$comm3_arr_arr[$comm3_check_arr];
	                      $check1_comment=array("/"=>1);
		                 $date1_check=$check1_comment[$comm1_check_arr];
		               $date2_check=$check1_comment[$comm2_check_arr];
		              $time_arr1=array(":"=>1);
			            $time1_check_str=substr("".$check_comment."",-6,1);
			            $time2_check_str=substr("".$check_comment."",-3,1);
                         $time1_check=$time_arr1[$time1_check_str];
			              $time2_check=$time_arr1[$time2_check_str];
                            $total_pass=($check3_comment+$date1_check+$date2_check+$time1_check+$time2_check);
				    ###ถ้า commentมาจากที่ระบบสร้างให้###
		            if($total_pass==5){
					########  ######จบสคริปคัดกรอง comment ###
					   
		          $in=$convert->Convert_time($comment);
						   $dr=$convert->expdate($comment,$check_profile,'');
                          $count=$convert->exp_time($convert_total,$comment,$check_profile);
	                      $count2=$count; if($count==""){$count2 ="0 วัน";}
	                     if((!empty($count)) || (!empty($dr))){
							if($local=="Asia/Bangkok"){ 
							$ee="หมดอายุ  ".$dr." <br>เหลือเวลาอีก : ".$count2."";
						  $st="เริ่มใช้งาน ".$in." ".$time_comment."<br>";
						   unset($old_name);
						  echo "<script language='javascript'>swal('','".$st."<br>".$ee."','info').then(function () {
    window.location.href = '".$return."';
	}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = '".$return."';
   }})</script>"; 
							}else{
							$st2="Start date ".$comment."<br>";
							$ee="To expire  ".$convert->Engexpdate($comment,$check_profile,'')." <br>Session time left : ".$count2."";
						  
						   unset($old_name);
						  echo "<script language='javascript'>swal('','".$st2."<br>".$ee."','info').then(function () {
    window.location.href = '".$return."';
	}, function (dismiss) {
  if (dismiss === 'overlay') {
   window.location.href = '".$return."';
   }})</script>"; 
							
							}
						 }
						 
					}else{
						   echo "<script language='javascript'>swal('','ระบบไม่สามารถคำนวนได้<br>(The system can not calculate.)','question').then(function () {
    //window.location.href = '".$return."';
	}, function (dismiss) {
  if (dismiss === 'overlay') {
    //window.location.href = '".$return."';
   }})</script>";}
   
					 }else{
   	    echo "<script language='javascript'>swal('','ระบบยังไม่ได้กำหนดวันหมดอายุ ที่โปรไฟล์ค่ะ<br>(The profile expiration date has not been set.)','warning').then(function () {
    //window.location.href = '".$return."';
	}, function (dismiss) {
  if (dismiss === 'overlay') {
    //window.location.href = '".$return."';
   }})</script>";
   
   } // */
	
	                        ################## END ##################### 
 
		
	}else{echo "<script language='javascript'>swal('','บัตรนี้ยังไม่ได้ถูกใช้งานค่ะ<br>(This card has not been used.)','success')</script>";}	

		 
	}else{echo "<script language='javascript'>swal('','ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้ ลองใหม่ภายหลังค่ะ<br>(already authorizing, retry later)','error')</script>";}	
	}else{echo "<script language='javascript'>swal('','ชื่อ และ รหัสผ่านไม่ตรงกับฐานข้อมูล <br>(invalid username or password)','error')</script>";}	


}
?>