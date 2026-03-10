<?php


if ( !empty( $_GET[ "username" ] ) ) {
	$old_name = $_GET[ "username" ];
} else {
	$old_name = "";
}
if ( !empty( $_GET[ "return" ] ) ) {
	$return = $_GET[ "return" ];
} else {
	$return = "http://www.sanook.com";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<META HTTP-EQUIV="Refresh" CONTENT="300;URL=<?php echo $return;?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<title>Airlink change pass</title>

	<!-- CSS -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/form-elements.css">
	<link rel="stylesheet" href="assets/css/styleB1.css">
	<!-- sweetalert STYLES-->
	<script src="assets/sweetalert/dist/sweetalert2.min.js"></script>
	<!-- alert -->
	<link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.css"/>
	<!-- alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.all.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<!-- Favicon and touch icons -->

	<!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png"> -->
	<link href="img/winbox-logo.png" rel="shortcut icon" type="image/x-icon"/>
	<style type="text/css">

	</style>
	<style type="text/css">
		body {
			background: #414141 url(images/bg5.jpg) no-repeat 0px 0px;
			-webkit-background-size: cover;
			-ms-background-size: cover;
			-o-background-size: cover;
			-moz-background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}
		
		html {
			height: 130%;
		}
	</style>
</head>

<body>

	<!-- Top content -->
	<div class="top-content">

		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 text">
						<h1><strong style="color:#000000">Change Password</strong></h1>
						<div class="description">

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12  col-sm-8 col-md-6 col-lg-6  col-xs-offset-0 col-sm-offset-2  col-md-offset-3 col-lg-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>เปลี่ยนพาสเวิร์ด user <font color="#000000"><strong><?php echo $old_name;?></h3>
								</strong>
								</font>
								<p>กรุณากรอก
									<font color="#000000"><strong>Password </strong>
									</font> เพื่อ ยืนยัน</p>

							</div>
							<div class="form-top-right">

								<i class="fa fa-key"></i>
								<!-- <h3><a href="<?php echo $_GET["return"]?>">X</a></h3> -->
							</div>

						</div>
						<div class="form-bottom">
							<form role="form" action="" method="post" name="change_pass" class="login-form">

								<?php if(empty($old_name)){?>
								<div class="form-group">
									<label class="control-label" for="form-password"><h4>ชื่อผู้ใช้งาน</h4></label>
									<input type="text" name="username" placeholder="Username" class="form-control" required/>

								</div>

								<?php }else{?>

								<input class="form-control" type="hidden" value="<?php echo $old_name;?>" name="username" id="username" required>
								<?php }?>
								<div class="form-group">
									<label class="control-label" for="form-password"><h4>รหัสผ่าน เก่า</h4></label>
									<input type="password" name="old_pass" placeholder="Old Password" class="form-control" required/>

								</div>

								<div class="form-group">

									<label class="control-label" for="form-new-password"><h4>รหัสผ่าน ใหม่</h4></label>
									<input type="password" name="new_pass" placeholder="New Password" class="form-control" required/>

								</div>
								<div class="form-group">

									<label class="control-label" for="form-old-password"><h4>ยืนยัน รหัสผ่าน ใหม่</h4></label>
									<input type="password" name="conf_pass" placeholder="Confirm New Password" class="form-control" required>

								</div>
								<br>
								<div class="row">


									<div class="col-xs-4 col-md-4">
										<button type="submit" class="btn btn-block"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;ตกลง</button>
									</div>
									<div class="col-xs-4 col-md-4">
										<button type="reset" class="btn btn-block "> <i class="fa fa-refresh"></i>&nbsp;&nbsp;รีเซ็ต</button>
									</div>
									<div class="col-xs-4 col-md-4">
										<a type="button" class="btn btn-block btn-link-1" href="
									<?php echo $return; ?>"><i class="fa fa-times"></i>  ออก</a>
									</div>
								</div>

						</div>
						</form>
					</div>
				</div>
			</div>
			<br>
			<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

			<!-- <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div>
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
			<!--  <div class="row">
	 <div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="http://172.0.0.3/link/change_pass.php?&username=$(username)&return=$(link-login)">
	                        		<i class="fa fa-key"></i> เปลี่ยนรหัสผ่าน
	                        	</a>
	                        	<a class="btn btn-link-2" href="http://172.0.0.3/link/user_info.php?&return=$(link-login)">
	                        		<i class="fa fa-address-card-o"></i> วันหมดอายุ
	                        	</a>
	                 <a class="btn btn-link-2" href="#"  onclick="swal('','ไอพี ของคุณคือ : $(ip)<br>แม็คแอดเดรส ของคุณคือ : $(mac)<br><br>โทรติดต่อ 0849137468 (อ้อย)','info')">
	                        		<i class="fa fa-info"></i> รายละเอียด
	                        	</a>
                        	</div>
							</div>
							<!-- **************************************************************8 -->
			<br>
			<div class="row">
				<strong>
					<font color="#ffffff">Open Source API Mikrotik</font> <a href="#">  Copyright &copy; 2016 - 2017 </a>
				</strong>
			</div>

		</div>
	</div>

	</div>


	<!-- Javascript -->
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<!-- <script src="assets/js/scripts2.js"></script> -->
	<!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

</body>

</html>

<?php
if ( !empty( $_POST[ "username" ] ) ) {
	$old_name = $_POST[ "username" ];
	$old_password = iconv( "utf-8", "tis-620", $_POST[ "old_pass" ] );
	$new_password = iconv( "utf-8", "tis-620", $_POST[ "new_pass" ] );
	$conf_password = iconv( "utf-8", "tis-620", $_POST[ "conf_pass" ] );
	$cmd = "=password=";
	$cmd .= $new_password;
	if ( $new_password == $conf_password ) {
		///	database zone ////
		include( "include/config.inc.php" );
		include( 'include/routeros_api.class.php' );
		$db = new ConnectDB();

		$pp = $db->DB->prepare( "SELECT * FROM mt_gen where user = :userA and pass= :passA" );
		$pp->bindParam( "userA", $old_name, PDO::PARAM_STR );
		$pp->bindParam( "passA", $old_password, PDO::PARAM_STR );
		$pp->execute();
		$sec_count = $pp->rowCount();

		if ( $sec_count > 0 ) {
			$data = $pp->fetch( PDO::FETCH_OBJ );
			$user_id = $data->mt_id;
			$result = $db->selectquery( "SELECT * FROM mt_config WHERE mt_num='" . $user_id . "'" );
			$ip = $result[ 'mt_ip' ];
			$user = $result[ 'mt_user' ];
			$pass = $result[ 'mt_pass' ];
			$port_api = $result[ 'port_api' ];
			$API = new routeros_api();
			$API->debug = false;
			if ( $API->connect( $ip, $user, $pass, $port_api ) ) {
				/////
				$API->write( '/ip/hotspot/user/getall', false );
				$API->write( '?name=' . $old_name );
				$READ = $API->read( false );
				$ARRAY = $API->parse_response( $READ );
				$userfrom_pass = $ARRAY[ 0 ][ 'password' ];
				if ( $userfrom_pass == $old_password ) {
					/////
					$API->write( '/ip/hotspot/user/set', false );
					$API->write( '=.id=' . $old_name, false );
					$API->write( '=name=' . $old_name, false );
					$API->write( $cmd );
					$READ = $API->read( false );
					$ARRAY = $API->parse_response( $READ );
					$API->disconnect();
					$db->update_db( "mt_gen", array(
						"pass" => $new_password
					), "user='" . $old_name . "'" );

					//// end /////

					echo "<script language='javascript'>swal('Save Done!','บันทึกค่า สำเร็จแล้ว! Passward ใหม่คือ " . $_POST[ "new_pass" ] . "','success').then(function () {
    window.location.href = '" . $return . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '" . $return . "';
   }})</script>";
				} else {
					echo "<script language='javascript'>swal('','กรุณาตรวจสอบพิมพ์เล็ก และพิมพ์ใหญให้ถูกต้องค่ะ','error')</script>";
				}


			} else {
				echo "<script language='javascript'>swal('','ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้ ลองใหม่ภายหลังค่ะ','error')</script>";
			}
		} else {
			echo "<script language='javascript'>swal('ชื่อ และ รหัสผ่านไม่ตรง','ลองอีกครั้ง!','error')</script>";
		}
	} else {
		echo "<script language='javascript'>swal('รหัสผ่านใหม่ ไม่ตรงกันค่ะ','ลองอีกครั้ง!','error')</script>";
	}

}
?>