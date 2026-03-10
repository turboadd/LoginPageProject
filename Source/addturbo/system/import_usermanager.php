<?php


$ARRAY = $API->comm("/tool/user-manager/profile/print");
$ARRAY1 = $API->comm("/tool/user-manager/customer/print");
$ARRAY2 = $API->comm("/ip/hotspot/user/print");
$ARRAY3 = $API->comm("/tool/user-manager/user/print");

?>
<style type="text/css">
<!--
.style1 {color: #0000FF;
          font-weight: bold;
}
.style2 {color: #990000}

-->
</style>
<section class="content"> 


          <div class="row">
           <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <i class="fa fa-upload"></i>&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp;&nbsp;<strong>HOTSPOT IMPORT USER MANAGER </strong> 
					<?php print $date_time_show;?>
                </div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1">
					 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <span class="style1"> Customers</span>
                                    <select name="server"  id="server" class="form-control"  required>
					      <option value="">ต้องเลือก Owner</option>
						   <?php
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY1[$i]['login'].$selected.'">'.$ARRAY1[$i]['login'].'</option>';
													}
												?>						 
							                </select>
                                        </div>
                                      </div>                            
                                    </div>
                     
						<div class="row">
                       <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <span class="style1">เลือก Profiles</span>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="">ต้องเลือก Profiles</option>
						   <?php
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
													}
											 	?>						 
							             </select>
                                         </div>
								       </div>
								      <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <span class="style1">เพิ่ม Comment.</span>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
                                       </div>
									</div>
                                </div>
								
								<br>
                            <input name="fileCSV" type="file" id="fileCSV" />
							<br>
 
  
	 <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php
                                              if($account!="read"){
										   echo "<button name=\"submit\" type=\"submit\"  value=\"submit\" class=\"btn btn-success\" ><i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;</button>&nbsp;&nbsp;&nbsp;";
								}else{
									echo "<a name=\"submit\" type=\"submit\"  value=\"submit\" class=\"btn btn-success\" ><i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;</a>&nbsp;&nbsp;&nbsp;";
								}
				                       ?>
								<button  class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                            </div>
                        </div>
						</div>
						   </form>
			   </div>
			   </div>
			   </div>
			   </div>

                 <div id="manual" class="collapse">
            <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
				    <li>ก่อนที่จะ Import Userได้ ให้ท่านสร้าง User Master เป็นต้นแบบไว้ที่ UserManager ที่มีชื่อเหมือนกันกับ Profileนั้นๆทุกอย่าง และให้ปรับแต่ง userตามต้องการเพื่อเป็นต้นแบบไว้ให้copy   ให้สร้าง Profileละ 1 ชื่อ หรือให้สร้าง โปรไฟล์ก่อนที่ add userman profile ระบบจะสร้าง User Masterให้เอง</li>
					<li>Ex..profile name=1Day ให้สร้าง username=1Day password=xxxxxxxx profile=1Day</li>
                    <li>เลือก Owner , Profile, และเลือกไฟล์ .CSV </li>
                    <li>ระบบจะดึงมาแค่ user คอลั่มA กับ password คอลั่ม B.</li>
					<li>ถ้ามีการเลือก Comment จะเอามาจาก คอลั่ม C .</li>
					<li>Comment ใส่ได้ไม่เกิน 30 ตัวอักษร เพราะค่าจะแสดงที่ตารางยาวเกินไป.</li>
					<li>ทดสอบกับ user manager v6.30.4</li>

                </ul>
               </p>
			</div>
			</div>
			
  </section>
  <section class="content"> 

<?php

if(isset($_POST['submit']) && $_POST['submit']=='submit'){
		// Allow certain file formats
$target_dir = "index.php?page=import_usermanager";
$target_file = $target_dir . basename($_FILES["fileCSV"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "csv" ) {
  echo "<script language='javascript'>swal('Error Import!','กรุณาเลือกไฟล์นามสกุล .csv!','info').then(function () {
    window.location.href ='index.php?page=import_usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=import_usermanager';
   }})</script>";
		exit();
}else{
		$server=$_REQUEST['server'];
    $id=$_SESSION['id'];
	$num2 =count($ARRAY2);
	$num3 =count($ARRAY3);
	

$objCSV = fopen($_FILES["fileCSV"]['tmp_name'], "r");

while (($objArr = fgetcsv($objCSV, 1000, ",")) != FALSE) {


    $username_add=$objArr[0];    //user ดึงมาจาก .csv (col A)
    $password_add=$objArr[1];    //password ดึงมาจาก .csv (col B)
    $server =$_REQUEST['server'];
	$hotspot_profile = $_REQUEST['profile'];
    	if($_REQUEST['comment']==1){
	$comment_add=iconv("tis-620","utf-8",$objArr[2]);  //comment ดึงมาจาก .csv (col C)
	}else{
	$comment_add="";
	}
	
	$date=date('Y-m-d H:i');
	$num_check=0;
	

    if(!empty($username_add)){
		$project=$project+($num_check+1);
		

	  $rows=$db->rows_num("SELECT user FROM mt_gen WHERE user='".$username_add."'");
		if($rows>0){
			$fail=$username_add;$num_fail=$num_fail+($num_check+1);
for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$fail){$fail="";$mik_fail=$mik_fail+($num_check+1);}}
	for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$fail){$fail="";$man_fail=$man_fail+($num_check+1);}}
			//$mik_total=$mik_total+($num_check+1);
			if(!empty($fail)){
				
				/////////////////////////////step1/////////////////////////////
				$mik_add=$mik_add+($num_check+1);
                          $ARRAY = $API->comm("/tool/user-manager/user/add", array(
									"customer" => $server,	
									"username"		=> $fail,
							        "comment"		=> $comment_add,
									"password"	=> $password_add,
                                    "copy-from"	=> $hotspot_profile
			                       ));
						  $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											"profile" => $hotspot_profile,
											"customer" => $server,
							                "numbers"	=> $fail,
								));

		$part1=$db->selectquery("SELECT * FROM mt_gen WHERE user='".$fail."'");
			    $group_fail="".($part1['group_name'])."";}}else{
				
				/////////////////////////////step2/////////////////////////////
				$db_add=$db_add+($num_check+1);

				$csv=round(date('YmdHi.s'));
		$group="ImportUserman-".$csv."";
		


                 $db->add_db("mt_gen",array(
                                         "user"  =>  $username_add,
						                  "pass"  =>  $password_add,
						          "profile"  =>  $hotspot_profile,
						             "server_pro"  =>  $server,
                                       "comment"  => $comment_add,
	                                    "csv_code" =>    $csv,
		                              "group_name" =>  $group,
		                                 "date"    =>    $date,
	                                     "mt_id"  =>  $id
							    ));



}}else{
echo "<script language='javascript'>swal('Error Empty file!','ไม่มีข้อมูลในไฟล์!','info').then(function () {
    window.location.href ='index.php?page=import_usermanager';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=import_usermanager';
   }})</script>";
		exit();}}fclose($objCSV);
               /////////////////////////////step3/////////////////////////////
	$mik_check=0;
	
				$sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE csv_code='".$csv."'");
	         $sql->execute();
               while($db_export = $sql->fetch( PDO::FETCH_ASSOC ))	{

		      $db_users=$db_export['user'];                       $db_pass=$db_export['pass'];
          $db_profile=$db_export['profile'];                      $db_new_group=$db_export['group_name'];
		$db_limituptime=$db_export['limit_uptime'];if($db_limituptime==""){$db_limituptime = "00:00:00";}             $db_server=$db_export['server_pro'];
		  $db_comment=$db_export['comment'];
		  $new_user=$db_users;$num_newadd=$num_newadd+($mik_check+1);
		for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$new_user){$new_user="";$new_mik_fail=$new_mik_fail+($mik_check+1);}}
	for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$new_user){$new_user="";$new_man_fail=$new_man_fail+($mik_check+1);}}			
		                                    if(!empty($new_user)){
										$mik_newadd=$mik_newadd+($mik_check+1);
					  $ARRAY = $API->comm("/tool/user-manager/user/add", array(
									"customer" => $db_server,	
									"username"	=> $new_user,
									"password"	=> $db_pass,
						            "comment" => $db_comment,
                                    "copy-from"	=> $db_profile
			                       ));
						  $ARRAY = $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											"profile" => $db_profile,
											"customer" => $db_server,
							                "numbers"	=> $new_user
								));}}			
				
				/////////////////////////////step4/////////////////////////////
                
                $check_group="".$group_fail." , ".$db_new_group."";
				$updateDB = $API->comm("/tool/user-manager/user/print");
				$num2 =count($updateDB);
				if(($mik_fail+$man_fail+$new_mik_fail+$new_man_fail+$mik_add)>0){
					for($i=0; $i<$num2; $i++){
	
	
	
							  $db->update_db("mt_gen",array(
                                               "pass"       =>$updateDB[$i]['password'],
							                     "profile"    =>$updateDB[$i]['actual-profile'],
							                      "comment"     =>$updateDB[$i]['comment']
				                                     ),"user='".$updateDB[$i]['username']."'");
	
	
	}
	             echo "<script language='javascript'>swal('Error Import from ".$project." Table!','databaseสำเร็จ ".($db_add+0)." และ hotspotสำเร็จ ".($mik_add+$mik_newadd)." กรุณาตรวจสอบ! ".$check_group."','info').then(function () {
    window.location.href = 'index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=listuser';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('Save Done from ".$project." Table!','เพิ่ม  Group ".$db_new_group." สำเร็จแล้ว! จำนวนทั้งหมด ".$mik_newadd." users','success').then(function () {
    window.location.href ='index.php?page=listuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=listuser';
   }})</script>";
		exit();}

}}
?>
<script src="../assets/js/date-time.js"></script>
  </section>
            