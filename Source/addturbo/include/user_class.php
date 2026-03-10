 <?php
class userClass
{

/* User Login */
public function userLogin($user,$pass)
{
try{
  $db = new ConnectDB();
  $result=$db->selectquery("SELECT admin_pin FROM mt_config");
  $ad_pin=$result['admin_pin'];
  $mdEmpty_pin=md5("000000000");
   $md_security_pin=md5($pass);
   ///check security off //
   if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){
	$stmt = $db->DB->prepare("SELECT * FROM am where am_user = :user and am_pass= :pass"); 
    $stmt->execute( Array(':user' => $user,':pass' => $md_security_pin));
    $count=$stmt->rowCount();
    $data=$stmt->fetch(PDO::FETCH_OBJ);
	if($count > 0){
   $_SESSION['APIUser']=$data->am_user;
   $_SESSION['APIID']=$data->am_id;
   $_SESSION['security']=$mdEmpty_pin;
   
   echo "<meta http-equiv='refresh' content='0;url=index.php' />";
   return true;
   }
   else
   {
	unset($_SESSION['APIID']);
	unset($_SESSION['APIUser']);
	unset($_SESSION['security']);
   $db = null;
   echo "<script language='javascript'>alert('Username or Password incorrect')</script>";
   return false;
   }
   }else{
   	 ///check security on ///
   	$stmt = $db->DB->prepare("SELECT * FROM am where am_user = :user");
   	$stmt->bindParam("user", $user,PDO::PARAM_STR);
	$stmt->execute();
    $count=$stmt->rowCount();
	$data=$stmt->fetch(PDO::FETCH_OBJ);
   	if($count > 0){
	   ///check security on => admin_pin and customer_pin and user_pin ///
	   
$stmtA = $db->DB->prepare("SELECT * FROM mt_config where admin_pin = :passADMIN OR customer_pin = :passCUSTOMER OR user_pin = :passUSER");
      	$stmtA->bindParam("passADMIN", $md_security_pin,PDO::PARAM_STR);
		 $stmtA->bindParam("passCUSTOMER", $pass,PDO::PARAM_STR);
		 $stmtA->bindParam("passUSER", $pass,PDO::PARAM_STR);
        $stmtA->execute();
		$countA=$stmtA->rowCount();
		$dataA=$stmtA->fetch(PDO::FETCH_OBJ);
		
		if($countA > 0){
			if($dataA->admin_pin == $md_security_pin )
			{ 
			$_SESSION['APIUser']=$data->am_user;
             $_SESSION['APIID']=$data->am_id;
             $_SESSION['security']=$dataA->admin_pin;
			 }else{
			if($dataA->customer_pin == $pass )
			{
			$_SESSION['APIUser']=$data->am_user;
             $_SESSION['APIID']=$data->am_id;
             $_SESSION['security']=$dataA->customer_pin;
			}else{
			$_SESSION['APIUser']=$data->am_user;
             $_SESSION['APIID']=$data->am_id;
             $_SESSION['security']=$dataA->user_pin;
             $_SESSION['customer_login']=1;
			}}
		 echo "<meta http-equiv='refresh' content='0;url=index.php' />";
		return true;
		}else{
		
		 unset($_SESSION['APIID']);
	     unset($_SESSION['APIUser']);
	     unset($_SESSION['security']);
         $db = null;
         echo "<script language='javascript'>alert('Username or Password incorrect')</script>";
		 $db = null;
         return false;
		}
	}else{
	unset($_SESSION['APIID']);
	unset($_SESSION['APIUser']);
	unset($_SESSION['security']);
	unset($_SESSION['customer_login']);
   
   echo "<script language='javascript'>alert('Username or Password incorrect')</script>";
   $db = null;
   return false;
	}
   }
   /////////
   }
   catch(PDOException $e) {
   echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    }

   /**** password login ****/
   public function password()
{
try{
$db = new ConnectDB();
 
  $result=$db->selectquery("SELECT admin_pin FROM mt_config");
  $ad_pin=$result['admin_pin'];
  $mdEmpty_pin=md5("000000000");
  if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){ return true;}else{return false;}
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
 


 



}
?>