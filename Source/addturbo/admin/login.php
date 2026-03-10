<?php


include "../include/config.inc.php";
include "../include/user_class.php";
$userClass = new userClass();
$input = $userClass->password();
if ( isset( $_REQUEST[ 'am_user' ] ) ) {
	$user = $_REQUEST[ 'am_user' ];
	if ( $input ) {
		$pass = $_REQUEST[ 'am_pass' ];
	} else {
		$pass = $_REQUEST[ 'security_pin' ];
	}
	$userClass->userLogin( $user, $pass );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<title>API Mikrotik</title>

	<!-- CSS -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/form-elements.css">
	<link rel="stylesheet" href="../assets/css/style2.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<!-- Favicon and touch icons -->
	<link rel="shortcut icon" href="assets/ico/favicon.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	<link href="../img/winbox-logo.png" rel="shortcut icon" type="image/x-icon"/>
</head>

<body>

	<!-- Top content -->
	<div class="top-content">

		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 text">
						<h1><strong style="color:#3300FF">ยินดีต้อนรับเข้าสู่ระบบจัดการใช้งาน</strong></h1>
						<div class="description">

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10  col-sm-8 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-2  col-md-offset-3 col-lg-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3><strong><font color="#009900">Login</font></strong></h3>
								<?php
								if ( $input ) {
									?>
								<font color="#0000ff">
									<p>กรุณากรอก
										<font color="#000000"><strong>Username</strong>
										</font> และ
										<font color="#000000"> <strong>Password</strong>
										</font> เพื่อ Login</p>
								</font>
								<?php
								} else {
									?>
								<font color="#0000ff">
									<p>กรุณากรอก
										<font color="#000000"><strong>Username</strong>
										</font> และ
										<font color="#000000"> <strong>PIN</strong>
										</font> เพื่อ Login</p>
								</font>
								<?php
								}
								?>
							</div>
							<div class="form-top-right">
								<i class="fa fa-lock"></i>
							</div>
						</div>
						<div class="form-bottom">
							<form role="form" action="" method="post" name="login" class="login-form">
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="text" name="am_user" placeholder="Username..." class="form-username form-control" id="form-username">
								</div>
								<div class="form-group">
									<?php
									if ( $input ) {
										?>
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="am_pass" placeholder="Password..." class="form-password form-control" id="form-password">
									<?php
									} else {
										?>
									<label class="sr-only" for="form-password">PIN</label>
									<input type="password" name="security_pin" type="password" placeholder="กรุณาใส่รหัส" maxlength="12" class="form-password form-control" id="form-password">
									<?php
									}
									?>
								</div>
								<button type="submit" class="btn">Sign in</button>
							</form>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<font color="#ffffff"><strong>   Open Source API Mikrotik  |<a href="#">  Copyright &copy; 2016 - <?php echo date("Y");?> </a> |  All Right Reserved</strong> </font>
				</div>
				<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<!--
                    <div class="row">
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
			</div>
		</div>

	</div>


	<!-- Javascript -->
	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.backstretch.min.js"></script>
	<script src="../assets/js/scripts3.js"></script>

	<!--[if lt IE 10]>
            <script src="../assets/js/placeholder.js"></script>
        <![endif]-->

</body>

</html>