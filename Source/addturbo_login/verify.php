<?php
$UsernameInSite = $_REQUEST[ 'UsernameInSite' ];
$PasswordInSite = $_REQUEST[ 'PasswordInSite' ];
$mac = $_REQUEST[ 'mac' ];
$ip = $_REQUEST[ 'ip' ];
$username = $_REQUEST[ 'username' ];
$linklogin = $_REQUEST[ 'link-login' ];
$linkorig = $_REQUEST[ 'link-orig' ];
$error = $_REQUEST[ 'error' ];
$chapid = $_REQUEST[ 'chap-id' ];
$chapchallenge = $_REQUEST[ 'chap-challenge' ];
$linkloginonly = $_REQUEST[ 'link-login-only' ];
$linkorigesc = $_REQUEST[ 'link-orig-esc' ];
$macesc = $_REQUEST[ 'mac-esc' ];
$idcard = $_REQUEST[ 'idcard' ];
$phone = $_REQUEST[ 'phone' ];
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="pragma" content="no-cache"/>
	<meta http-equiv="expires" content="-1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Register</title>
	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/blog-home.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Trirong" rel="stylesheet">
	<script src="assets/sweetalert/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.all.min.js"></script>
	<?php

	function random_char( $len ) {
		$chars = "1234567890";
		$ret_char = "";
		$num = strlen( $chars );
		for ( $i = 0; $i < $len; $i++ ) {
			$ret_char .= $chars[ rand() % $num ];
			$ret_char .= "";
		}
		return $ret_char;
	}
	$otp = random_char( 4 );
	if ( ( !empty( $_REQUEST[ 'PasswordInSite' ] ) ) && ( !empty( $_REQUEST[ 'UsernameInSite' ] ) ) ) {
		class thsms {
			var $api_url = 'http://www.thsms.com/api/rest';
			var $username = null;
			var $password = null;
			public	function getCredit() {
				$params[ 'method' ] = 'credit';
				$params[ 'username' ] = $this->username;
				$params[ 'password' ] = $this->password;
				$result = $this->curl( $params );
				$xml = @simplexml_load_string( $result );
				if ( !is_object( $xml ) ) {
					return array( FALSE, 'Respond error' );
				} else {
					if ( $xml->credit->status == 'success' ) {
						return array( TRUE, $xml->credit->status );
					} else {
						return array( FALSE, $xml->credit->message );
					}
				}
			}
			public function send( $from = '0000', $to = null, $message = null ) {
				$params[ 'method' ] = 'send';
				$params[ 'username' ] = $this->username;
				$params[ 'password' ] = $this->password;
				$params[ 'from' ] = $from;
				$params[ 'to' ] = $to;
				$params[ 'message' ] = $message;
				if ( is_null( $params[ 'to' ] ) || is_null( $params[ 'message' ] ) ) {
					return FALSE;
				}
				$result = $this->curl( $params );
				$xml = @simplexml_load_string( $result );
				if ( !is_object( $xml ) ) {
					return array( FALSE, 'Respond error' );
				} else {
					if ( $xml->send->status == 'success' ) {
						return array( TRUE, $xml->send->uuid );
					} else {
						return array( FALSE, $xml->send->message );
					}
				}
			}
			private	function curl( $params = array() ) {
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $this->api_url );
				curl_setopt( $ch, CURLOPT_HEADER, 0 );
				curl_setopt( $ch, CURLOPT_POST, 1 );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

				$response = curl_exec( $ch );
				$lastError = curl_error( $ch );
				$lastReq = curl_getinfo( $ch );
				curl_close( $ch );

				return $response;
			}
		}
		$sms = new thsms();
		$sms->username   = 'yongwit';
		$sms->password   = 'ae8380';
		$number = $phone;
		$text = 'OTP : '.$otp;
		$a = $sms->getCredit();
		//var_dump( $a);
		$b = $sms->send( '0000', $number, $text);
		//var_dump( $b);
	}
	?>
</head>

<body>
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12 col-lg-6 offset-lg-3 text-center">
			<!-- Search Widget -->
			<div class="card my-md-4">
				<h5 class="card-header" style="background-color: #759331">สมัครสมาชิก</h5>
				<div class="card-body">
					<p><img src="images/logo.png" width="200" height="203" alt=""/>
					</p>
					<p><b>Thailand Wifi by MDES</b><br>
						<br>
					</p>
					<form action="register.php" method="post" id="form">
						<div class="input-group">
							<p>รหัสยืนยัน</p>
						</div>
						<div class="input-group">
							<input name="otp_confirm" type="text" id="otp_confirm" placeholder="รหัสยืนยัน" title="รหัสยืนยัน" maxlength="4" class="form-control">
						</div>
						<br><input name="mac" type="hidden" value="<?php echo $mac;?>"/>
						<input name="ip" type="hidden" value="<?php echo $ip;?>"/>
						<input name="username" type="hidden" value="<?php echo $username;?>"/>
						<input name="link-login" type="hidden" value="<?php echo $linklogin;?>"/>
						<input name="link-orig" type="hidden" value="<?php echo $linkorig;?>"/>
						<input name="error" type="hidden" value="<?php echo $error;?>"/>
						<input name="chap-id" type="hidden" value="<?php echo $chapid;?>"/>
						<input name="chap-challenge" type="hidden" value="<?php echo $chapchallenge;?>"/>
						<input name="link-login-only" type="hidden" value="<?php echo $linkloginonly;?>"/>
						<input name="link-orig-esc" type="hidden" value="<?php echo $linkorigesc;?>"/>
						<input name="mac-esc" type="hidden" value="<?php echo $macesc;?>"/>
						<input name="UsernameInSite" type="hidden" value="<?php echo $UsernameInSite;?>"/>
						<input name="PasswordInSite" type="hidden" value="<?php echo $PasswordInSite;?>"/>
						<input name="idcard" type="hidden" value="<?php echo $idcard;?>"/>
						<input name="phone" type="hidden" value="<?php echo $phone;?>"/>
						<input name="otp_md5" type="hidden" value="<?php echo md5($otp);?>"/>
						<div class="input-group">
							<input type="submit" class="form-control" onMouseOver="this.className='colorover'" onMouseOut="this.className='form-control'">
						</div>
					</form>
					<form action="verify.php" method="post" id="form">
						<input name="mac" type="hidden" value="<?php echo $mac;?>"/>
						<input name="ip" type="hidden" value="<?php echo $ip;?>"/>
						<input name="username" type="hidden" value="<?php echo $username;?>"/>
						<input name="link-login" type="hidden" value="<?php echo $linklogin;?>"/>
						<input name="link-orig" type="hidden" value="<?php echo $linkorig;?>"/>
						<input name="error" type="hidden" value="<?php echo $error;?>"/>
						<input name="chap-id" type="hidden" value="<?php echo $chapid;?>"/>
						<input name="chap-challenge" type="hidden" value="<?php echo $chapchallenge;?>"/>
						<input name="link-login-only" type="hidden" value="<?php echo $linkloginonly;?>"/>
						<input name="link-orig-esc" type="hidden" value="<?php echo $linkorigesc;?>"/>
						<input name="mac-esc" type="hidden" value="<?php echo $macesc;?>"/>
						<input name="UsernameInSite" type="hidden" value="<?php echo $UsernameInSite;?>"/>
						<input name="PasswordInSite" type="hidden" value="<?php echo $PasswordInSite;?>"/>
						<input name="idcard" type="hidden" value="<?php echo $idcard;?>"/>
						<input name="phone" type="hidden" value="<?php echo $phone;?>"/>
						<br>
						<div class="input-group">
							<input type="submit" class="form-control" title="ส่งรหัสอีกครั้ง" onMouseOver="this.className='colorover'" onMouseOut="this.className='form-control'" value="ส่งรหัสอีกครั้ง">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container -->
	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html> 
<?php
if ( ( empty( $_REQUEST[ 'PasswordInSite' ] ) ) && ( empty( $_REQUEST[ 'UsernameInSite' ] ) ) ) {
	echo "<script language='javascript'>swal('','กรุณากำหนด username และ password ในไซต์งานด้วยค่ะ !','error').then(function () {
			window.location.href = '" . $return . "';}, function (dismiss) {
		  if (dismiss === 'overlay') {
			window.location.href = '" . $return . "';
		   }})</script>";
}
?>