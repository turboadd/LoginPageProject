<?php
error_reporting( 0 );
if ( !empty( $_POST[ "link-login" ] ) ) {
	$return = "https://chainatpao.go.th/";
} else {
	$return = "https://chainat.go.th/";
}
date_default_timezone_set( "Asia/Bangkok" );
$_REQUEST[ 'UsernameInSite' ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<META HTTP-EQUIV="Refresh" CONTENT="300;URL=<?php echo $return;?>">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<title>Register</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/form-elementsA.css">
	<script src="assets/sweetalert/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.all.min.js"></script>
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
	<div class="top-content">
		<div class="inner-bg">
		</div>
	</div>

	</div>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
</body>
</html>
<?php
/* if(md5($_POST['otp_confirm']) != $_POST['otp_md5'] ) {
	echo "<script language='javascript'>swal('','รหัสยืนยันไม่ถูกต้อง !','error').then(function () {
    window.location.href = '" . $return . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '" . $return . "';
   }})</script>";
	exit();
} */
if ( ( !empty( $_REQUEST[ 'PasswordInSite' ] ) ) && ( !empty( $_REQUEST[ 'UsernameInSite' ] ) ) ) {
	include( "include/config.inc.php" );
	$db = new ConnectDB();
	$CCC = $db->DB->prepare( "SELECT * FROM mt_gen where user = :MTuser and pass = :MTpass" );
	$CCC->bindParam( "MTuser", $_REQUEST[ 'UsernameInSite' ], PDO::PARAM_STR );
	$CCC->bindParam( "MTpass", $_REQUEST[ 'PasswordInSite' ], PDO::PARAM_STR );
	$CCC->execute();
	$count_CCC = $CCC->rowCount();
	if ( $count_CCC == 1 ) {
		if ( !empty( $_POST[ "mac" ] ) ) {
			//idcard
			$idcard = $_POST[ "idcard" ];
			$id_num1 = $idcard[0] * 13;
			$id_num2 = $idcard[1] * 12;
			$id_num3 = $idcard[2] * 11;
			$id_num4 = $idcard[3] * 10;
			$id_num5 = $idcard[4] * 9;
			$id_num6 = $idcard[5] * 8;
			$id_num7 = $idcard[6] * 7;
			$id_num8 = $idcard[7] * 6;
			$id_num9 = $idcard[8] * 5;
			$id_num10 = $idcard[9] * 4;
			$id_num11 = $idcard[10] * 3;
			$id_num12 = $idcard[11] * 2;
			$value2 = $idcard[12];
			$sumM = $id_num1 + $id_num2 + $id_num3 + $id_num4 + $id_num5 + $id_num6 + $id_num7 + $id_num8 + $id_num9 + $id_num10 + $id_num11 + $id_num12;
			$totalsumM = $_POST[ "idcard" ];
			$value1 = ( 11 - ( $sumM % 11 ) ) % 10;
			$username = $_POST[ "mac" ];
			$count_username = strlen( $username );
			$password = $_POST[ "password" ];
			$count_password = strlen( $password );
			$email = $_POST[ "email" ];
			$phone = $_POST[ "phone" ];
			$csv = round( date( 'YmdHi.s' ) );
			$date = date( 'Y-m-d H:i:s' );
			$group = "Register-" . $username . "";
			if ( ( $count_username >= 0 ) && ( $count_password >= 0 ) ) {
				if ( $value1 == $value2 ) {
					$db = new ConnectDB();
					//check idcard
					$AAA = 0;
					if ( $AAA == 0 ) {
						$BBB = $db->DB->prepare( "SELECT * FROM mt_gen where user = :checkuser" );
						$BBB->bindParam( "checkuser", $username, PDO::PARAM_STR );
						$count_BBB = $BBB->rowCount();
						if ( $count_BBB == 0 ) {
							include( 'include/routeros_api.class.php' );
							$data = $CCC->fetch( PDO::FETCH_OBJ );
							$user_id = $data->mt_id;
							$profile = $data->profile;
							$limit_uptime = $data->limit_uptime;
							if ( $limit_uptime == "" ) {
								$limit_uptime = "00:00:00";
							}
							$dblimit_uptime = $data->limit_uptime;
							$hotspot_server = $data->server_pro;
							$result = $db->selectquery( "SELECT * FROM mt_config WHERE mt_num='" . $user_id . "'" );
							$ip = $result[ 'mt_ip' ];
							$user = $result[ 'mt_user' ];
							$pass = $result[ 'mt_pass' ];
							$port_api = $result[ 'port_api' ];
							$API = new routeros_api();
							$API->debug = false;
							if ( $API->connect( $ip, $user, $pass, $port_api ) ) {
								$API->write( '/ip/hotspot/user/getall', false );
								$API->write( '?name=' . $username );
								$READ = $API->read( false );
								$ARRAY = $API->parse_response( $READ );
								$check_userMT = count( $ARRAY );
								if ( $check_userMT == 0 ) {
									$API->comm( "/ip/hotspot/user/add", array(
										"server" => $hotspot_server,
										"name" => $username,
										"password" => $password,
										"profile" => $profile,
										"limit-uptime" => $limit_uptime,
										"email" => $email,
										"comment" => $idcard
										
									) );
									$text_script = "/ip hotspot host remove [find mac-address=\"".$username."\"];";
									$API->comm("/system/script/add
												=name=".$username."-Auth
												=source=".$text_script);

									$API->comm("/system/script/run
												=.id=".$username."-Auth");

									$API->comm("/system/script/remove
												=.id=".$username."-Auth");
									
									$db->add_db( "mt_gen", array(
										"user" => $username,
										"pass" => $password,
										"profile" => $profile,
										"server_pro" => $hotspot_server,
										"email" => $email,
										"id_card" => $totalsumM,
										"phone" => $phone,
										"csv_code" => $csv,
										"group_name" => $group,
										"limit_uptime" => $dblimit_uptime,
										"date" => $date,
										"mt_id" => $user_id
									) );
									$API->write( '/ip/hotspot/user/getall', false );
									$API->write( '?name=' . $username );
									$READ2 = $API->read( false );
									$ARRAY2 = $API->parse_response( $READ2 );
									$check_userPROCESS = count( $ARRAY2 );
									if ( $check_userPROCESS == 1 ) {
										echo "<script language='javascript'>swal('','ระบบได้สร้าง ผู้ใช้งานสำเร็จแล้วค่ะ<br>ขอบคุณคะ','success').then(function () {
    window.location.href = 'ad.html?username=" . $username . "&password=" . $password . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'ad.html?username=" . $username . "&password=" . $password . "';
   }})</script>";
									} else {
										$db->del( "mt_gen", "user ='" . $username . "'" );
										echo "<script language='javascript'>swal('','ไม่สามารถเพิ่มผู้ใช้งานได้ <br>กรุณาตรวจเช็คความถูกต้องของข้อมูลใหม่คะ !','error')</script>";
									}
								} else {
									echo "<script language='javascript'>swal('','กรุณากำหนด ผู้ใช้งานของท่านใหม่คะ !','error')</script>";
								}

							} ///API connect
							else {
								echo "<script language='javascript'>swal('','ไม่สามารถเชื่อมต่อกับอุปกรณ์ Mikrotikได้ กรุณาแจ้งผู้ดูแลระบบคะ !','error').then(function () {
    window.location.href = '" . $return . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '" . $return . "';
   }})</script>";
							}

						} else {
							echo "<script language='javascript'>swal('','กรุณาสร้าง ชื่อผู้ใช้งานใหม่คะ !','error')</script>";
						}
					} else {
						echo "<script language='javascript'>swal('','หมายเลขบัตรประชาชน มีในฐานข้อมูลแล้วคะ !','error')</script>";
					}
				} else {
					echo "<script language='javascript'>swal('','หมายเลขบัตรประชาชน ไม่ถูกต้องคะ !','error')</script>";
				}
			} else {
				echo "<script language='javascript'>swal('','ชื่อผู้ใช้งาน หรือรหัสผ่านของท่าน<br>กรุณากำหนดตัวอักษรหรือเลข มากกว่า 4ตัว คะ !','error')</script>";
			}
			//////check user/pass
		}
	} else {
		echo "<script language='javascript'>swal('','ไซต์นี้ username และpassword ไม่มีในฐานข้อมูลคะ !','error').then(function () {
    window.location.href = '" . $return . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '" . $return . "';
   }})</script>";

	}
} else {
	/// echo "<script language='javascript'>swal('','กรุณากำหนด username และ password ในไซต์งานด้วยคะ !','error')</script>";
	echo "<script language='javascript'>swal('','กรุณากำหนด username และ password ในไซต์งานด้วยคะ !','error').then(function () {
    window.location.href = '" . $return . "';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '" . $return . "';
   }})</script>";
}
?>