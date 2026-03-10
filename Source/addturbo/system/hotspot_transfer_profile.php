<?php
		
			$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
			$group_code=$_GET['group_code'];
			$login=":local whouser \$user;:local whoip \$address;:local macaddr [/ip hotspot active get [find address=\$whoip] mac-address];:log info \"user logged in: \$whouser IP: \$whoip Mac: \$macaddr\";{:local date [/system clock get date ];:local time [/system clock get time ];:if ( [/ip hotspot user get \$user comment ] = \"\" ) do={[/ip hotspot user set \$user comment=\"\$date \$time\"];:log info \"New Hotspot user logged in: \$whouser\";}}";
    $logout=":log info \"\$user (\$address): logged out: \$cause \";";
	       
if(!empty($_REQUEST['active'])){
    $num_set=0;$num_addon=0;$num_add=0;
	  $conf=$_REQUEST['on_login'];
		$sql=$db->DB->prepare("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
	     $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
		
		
		$price=$_REQUEST['price'.$result['user'].''];


		$rows=$db->rows_num("SELECT * FROM mt_profile WHERE pro_name='".$result['user']."'");

		$num =count($ARRAY);
	for($i=0; $i<$num; $i++){													
	if($ARRAY[$i]['name']==$result['user']){
		
		if($rows>0){
	$num_set++;


	$db->update_db("mt_profile",array(
         
			"pro_name"     => $result['user'],
			"pro_session"   =>$ARRAY[$i]['session-timeout'],
	       "pro_idle"       => $ARRAY[$i]['idle-timeout'],
	      "pro_keepalive"   =>$ARRAY[$i]['keepalive-timeout'],
	      "pro_autorefresh"  =>$ARRAY[$i]['status-autorefresh'],
	     "pro_users"          =>$ARRAY[$i]['shared-users'],
	    "pro_limit"         =>$ARRAY[$i]['rate-limit'],
	    "pro_price"         =>$price
				),"pro_name='".$result['user']."'");

			}else{
	 $num_add++;
    $name=$ARRAY[$i]['name'];
	$db_session=$ARRAY[$i]['session-timeout'];
    $idle=$ARRAY[$i]['idle-timeout'];
    $keep=$ARRAY[$i]['keepalive-timeout'];
    $auto=$ARRAY[$i]['status-autorefresh'];
	$use=$ARRAY[$i]['shared-users'];
    $limit=$ARRAY[$i]['rate-limit'];
	if($conf==1){
    $API->comm("/ip/hotspot/user/profile/set", array(
									
									"on-login" => $login,
				                    "on-logout" => $logout,
									"numbers" => $name
								));
		 $num_addon++;
	}
	
	$db->add_db("mt_profile",array(
         
			"pro_name"     => $result['user'],
			"pro_session"   =>$ARRAY[$i]['session-timeout'],
	       "pro_idle"       => $ARRAY[$i]['idle-timeout'],
	      "pro_keepalive"   =>$ARRAY[$i]['keepalive-timeout'],
	      "pro_autorefresh"  =>$ARRAY[$i]['status-autorefresh'],
	     "pro_users"          =>$ARRAY[$i]['shared-users'],
	    "pro_limit"         =>$ARRAY[$i]['rate-limit'],
	    "pro_price"         =>$price,
				"mt_id"  =>  $id
				));
			
		}

           
			

	}}}
	echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  Profileเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_set+$num_add)."รายการ  set on-login ".($num_addon)." รายการ','success').then(function () {
    window.location.href ='index.php?page=profilelist&cancel=yes';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=profilelist&cancel=yes';
   }})</script>";
		exit();	
		
		}?>

<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
-->
</style>
<section class="content"> 

 <form name="login" action="" method="post">
 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-exchange"></i>&nbsp;&nbsp;Hotspot Transfer Profile</strong>
                    <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
				 
							  <div class="row">
							  <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                   <span class="style1"><strong>ต้องการ เพิ่มสคริปที่ On-loginใหม่ หรือไม่?.</strong></span>
								    <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ระบบจะ set on-loginใหม่ แนะนำคือต้องเพิ่ม">
                                    <select name="on_login"  id="on_login" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
                                       </div>
									</div>
                                </div>
<?php

		$sql=$db->DB->prepare("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
	 $sql->execute();
               while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
														?>
				
				 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                               <option  type="text"   class="form-control" required ><?php echo $result['user']; ?></option>
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                       <label for="cardExpiry"><span class=" style1">Price <?php echo $result['user']; ?></span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดราคา ของ profile <?php echo $result['user']; ?>"></label>
	<?php 
	$profile=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$result['user']."'");
	?>
                         <input name="price<?php echo $result['user'];?>" type="text" placeholder="Ex.150" value="<?php echo $profile['pro_price']; ?>" class="form-control" required>
                               </div>
							   </div>
                        </div>   
					  <?php }?>
                           
							<br>
							<br>
							<div class="row">
						<div class="col-md-7 " > 

						
						 <?php
		               
						 $bottonbtn_success="on";
				$text_success="<i class=\"fa fa-check\"></i>&nbsp;Confirm";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>
				

				
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=profilelist&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
				<span class="hidden-xs">&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
				</div>
				</div>
				

				
				 </div>
				 </div>
				 </div>
				 </div>
				  </form>
						
                                    
                       <div id="manual" class="collapse">
 <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>

                    <li>เป็นรูปแบบการ copy ข้อมูลจากโปรไฟล์ แล้วถ่ายโอนข้อมูลไปยัง Database</li>
					<li>ให้กรอกข้อมูล จำนวนเงิน เป็นตัวเลข เท่านั้น เพื่อจะกำหนดรายรับแต่ล่ะโปรไฟล์ แล้วจะเป็นข้อมูลแสดง Chart</li>
                    <li>Profile ที่ยังไม่มีใน database ระบบจะ set ค่า On-loginและ On-logoutใหม่ เพื่อจะได้ใช้งานกับ ระบบจัดการ นับวันหมดอายุ และนับจำนวน รายรับ</li>
					<li>เมื่อเพิ่ม Profile ตรงส่วนนี้เสร็จแล้ว ให้ท่านไปสร้าง HotspotScript เพื่อกำหนดวันหมดอายุของUser และ Edit Card เพื่อปริ้นบัตร</li>
					<li>ไม่รองรับโปรไฟล์ในรูปแบบ Add Mac Address และโปรไฟล์ที่ใช้กับ User ใน UserManager ซึ่งท่านต้องสร้างใหม่เท่านั้น</li>
					
            </ul>
            </p>
     
</div>
</div>
<script src="../assets/js/date-time.js"></script>
  </section>