 <?php
class userClass
{

/* User Login */
public function userLogin($user, $pass)
{
try{
  $db = new ConnectDB();
  $adminSQL= $db->DB->prepare("SELECT admin_pin FROM mt_config");
  $adminSQL->execute();
  $result = $adminSQL->fetch( PDO::FETCH_ASSOC );
  $ad_pin=$result['admin_pin'];
  $mdEmpty_pin=md5("000000000");

   ///check account //
   if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){
	$stmt = $db->DB->prepare("SELECT * FROM am where am_user = :user and am_pass= :pass"); 
    $stmt->execute( Array(':user' => $user,':pass' => $pass,));
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
   }else{echo'Empty';
   return true;}
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
  $adminSQL= $db->DB->prepare("SELECT admin_pin FROM mt_config");
  $adminSQL->execute();
  $result = $adminSQL->fetch( PDO::FETCH_ASSOC );
  $ad_pin=$result['admin_pin'];
  $mdEmpty_pin=md5("000000000");
  if(empty($ad_pin)||($ad_pin==$mdEmpty_pin)){ return true;}else{return false;}
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
 


 


/* User Registration */
public function userRegistration($username,$password,$email,$name)
{
try{
$db = getDB();
$st = $db->prepare("SELECT uid FROM users WHERE username=:username OR email=:email");
$st->bindParam("username", $username,PDO::PARAM_STR);
$st->bindParam("email", $email,PDO::PARAM_STR);
$st->execute();
$count=$st->rowCount();
if($count<1)
{
$stmt = $db->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
$hash_password= hash('sha256', $password); //Password encryption
$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
$stmt->bindParam("name", $name,PDO::PARAM_STR) ;
$stmt->execute();
$uid=$db->lastInsertId(); // Last inserted row id
$db = null;
$_SESSION['uid']=$uid;
return true;
}
else
{
$db = null;
return false;
}

} 
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}'; 
}
}

/* User Details */
public function userDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT email,username,name FROM users WHERE uid=:uid"); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
return $data;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
}
?>