<?php
$UsernameInSite = "registertest";
$PasswordInSite = "registertest";
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
</head>

<body>
	<!-- $(if chap-id) -->

	<form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
		<input type="hidden" name="username"/>
		<input type="hidden" name="password"/>
		<input type="hidden" name="dst" value="<?php echo $linkorig; ?>"/>
		<input type="hidden" name="popup" value="true"/>
	</form>

	<script type="text/javascript" src="md5.js"></script>
	<script type="text/javascript">
		<!--
		function doLogin() {
			<?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
			document.sendin.username.value = document.login.username.value;
			document.sendin.password.value = hexMD5( '<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>' );
			document.sendin.submit();
			return false;
		}
		//-->
	</script>
	<!-- $(endif) -->
	<div class="container">
		<div class="col-md-8 offset-md-2 col-sm-12 col-lg-6 offset-lg-3 text-center">
			<!-- Search Widget -->
			<div class="card my-md-4">
				<h5 class="card-header" style="background-color: #759331">สมัครสมาชิก</h5>
				<form action="register.php" method="post">
				  <div class="card-body">
						<p><img src="images/logo.png" width="200" height="203" alt=""/>
						</p>
						<p><b>Thailand Wifi by MDES</b><br>
							<br>
						</p>
						<div class="input-group">
							<p>เลขประจำตัวประชาชน</p>
						</div>
						<div class="input-group">
							<input name="idcard" type="text" id="idcard" placeholder="เลขประจำตัวประชาชน" title="เลขประจำตัวประชาชน" maxlength="13" class="form-control">
						</div>
						<br>
						<div class="input-group">
							<p>เลขหมายโทรศัพท์</p>
						</div>
						<div class="input-group">
							<input name="phone" type="text" id="phone" placeholder="เลขหมายโทรศัพท์" title="เลขหมายโทรศัพท์" maxlength="10" class="form-control">
						</div>
						<br>
					<div class="input-group">
							<input type="submit" class="form-control" onMouseOver="this.className='colorover'" onMouseOut="this.className='form-control'">
					  </div>
					  <input name="mac" type="hidden" value="<?php echo $mac;?>" />
					  <input name="ip" type="hidden" value="<?php echo $ip;?>" />
					  <input name="username" type="hidden" value="<?php echo $username;?>" />
					  <input name="link-login" type="hidden" value="<?php echo $linklogin;?>" />
					  <input name="link-orig" type="hidden" value="<?php echo $linkorig;?>" />
					  <input name="error" type="hidden" value="<?php echo $error;?>" />
					  <input name="chap-id" type="hidden" value="<?php echo $chapid;?>" />
					  <input name="chap-challenge" type="hidden" value="<?php echo $chapchallenge;?>" />
					  <input name="link-login-only" type="hidden" value="<?php echo $linkloginonly;?>" />
					  <input name="link-orig-esc" type="hidden" value="<?php echo $linkorigesc;?>" />
					  <input name="mac-esc" type="hidden" value="<?php echo $macesc;?>" />
					  <input name="UsernameInSite" type="hidden" value="<?php echo $UsernameInSite;?>" />
					  <input name="PasswordInSite" type="hidden" value="<?php echo $PasswordInSite;?>" />
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container -->
	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>