<?php
		
			
			$user=$_GET['id'];		
			$userid = $API->comm("/tool/user-manager/user/print", array(
                              "from" => $user,
								));	
					   
				
		if(!empty($_REQUEST['username'])){
					
						$password=$_REQUEST['password'];					
						$username=$_REQUEST['username'];
						$customer=$_REQUEST['customer'];
						$profile=$_REQUEST['profile'];
						$db_comment=$_REQUEST['comment'];
						$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
						$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
						$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						$mac=$_REQUEST['mac'];
						$email=$_REQUEST['email'];

					if($_REQUEST['username']==$_GET['id']){
						
	                   	$db->update_db("mt_gen",array(
                                               "user"    =>   $_REQUEST['username'],
							                   "pass"   =>     $_REQUEST['password'],
							              "ip_address"   =>      $_REQUEST['ip'],
							                "mac_address"   =>    $_REQUEST['mac'],
							                    "comment"  =>     $db_comment,
							                    "email"    =>     $_REQUEST['email']
				                                     ),"user='".$user."'");
						
						
						
						$API->comm("/tool/user-manager/user/set", array(											
											"username"		=> $username,
											"password"  => $password,
											"comment" => $db_comment,
							                "caller-id"  => $mac ,
		                                    "ip-address"  => $ip ,
			                                "email"  => $email ,
									        "numbers"	=> $user
								));	

					if(!empty($profile)){             
                                 
						    $db->update_db("mt_gen",array(
                                               "profile"    =>  $profile
							                    ),"user='".$user."'");


						$API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											"profile" => $profile,
											"customer" => $customer,
							                "numbers"	=> $user
                                )); 
                      
					  }
						
						
						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
						exit();
					}else{

					$num=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$_REQUEST['username']."'");
						if($num==0){
							
	                        

							if($_GET['master']==$_GET['id']){
								echo "<script language='javascript'>swal('Can Not Change Name User  ".$_GET['master']."!','จะมีผลกับการสร้างuser ในprofile ".$_GET['master']."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";}else{
							
							$db->update_db("mt_gen",array(
                                               "user"    =>   $_REQUEST['username'],
							                   "pass"   =>     $_REQUEST['password'],
							              "ip_address"   =>      $_REQUEST['ip'],
							                "mac_address"   =>    $_REQUEST['mac'],
							                    "comment"  =>     $db_comment,
							                    "email"    =>     $_REQUEST['email']
				                                     ),"user='".$user."'");


							
							$API->comm("/tool/user-manager/user/set", array(											
											"username"		=> $username,
											"password"  => $password,
											"comment" => $db_comment,
							                "caller-id"  => $mac ,
		                                    "ip-address"  => $ip ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								));
								if(!empty($profile)){

									$db->update_db("mt_gen",array(
                                               "profile"    => $profile
							                    ),"user='".$username."'");

                                          $API->comm("/tool/user-manager/user/create-and-activate-profile", array(											
											"profile" => $profile,
											"customer" => $customer,
							                "numbers"	=> $username,
								)); 
							
								}			
							
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
							exit();
							}
							}else{							
							
							echo "<script language='javascript'>swal('Error user! ".$_REQUEST['username']."','มีชื่อ ".$_REQUEST['username']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
					}
				} 
			
									   								
?>

<style type="text/css">

.style1 {color: #0000FF}
.style2 {color: #990000}

</style>
<section class="content"> 
 
<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-user"></i>&nbsp;&nbsp;HOTSPOT EDIT USER MANAGER</strong>
                      <?php print $date_time_show;?></div>
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<div class="row">
					<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="style1"> Customers</span></label>
                                   <select name="customer"  id="customer" class="form-control" required>
					      <option value="">ต้องเลือก Owner</option>
						   <?php	   $ARRAY1 = $API->comm("/tool/user-manager/customer/print");
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
						echo '<option value="'.$ARRAY1[$i]['login'].$selected.'">'.$ARRAY1[$i]['login'].'</option>';
													}
												?>						 
							</select>
                                    </div>
                                </div> 
                           	 <!--  --> 
							 <?php if(!empty($userid['0']['actual-profile'])){?>
							   <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Package</span></label>
                                   <option type="text" class="form-control" ><?php echo $userid['0']['actual-profile']; ?>
								    </option>  
							   </div>
                                </div>
							 <?php }else{?>
							<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $userid['0']['actual-profile']; ?>"><?php echo $userid['0']['actual-profile']; ?></option>
                                            	<?php
													
											    $ARRAY = $API->comm("/tool/user-manager/profile/print");
											    $num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$userid['0']['actual-profile']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							      </select>
                                   </div>
                                </div> 
								<?php }?>
								<!--  -->
							</div>
                            
						 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Username</span></label>
                                   <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $userid['0']['username'];?>" required>  
									</div>
                                  </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Password</span></label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?php echo $userid['0']['password'];?>" required>  
						      </div>
                            </div>
                        </div>

						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" class="form-control" placeholder="Ex.172.0.0.3" value="<?php echo $userid['0']['ip-address'];?>">  
									</div>
                                 </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A" class="form-control" value="<?php echo $userid['0']['caller-id'];?>"> 
									</div>
                                   </div>
                                  </div>
							
							<div class="row">
							<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">E-mail</span></label>
                                   <input name="email" type="email" placeholder="Ex.123@hotmail.com" class="form-control" value="<?php echo $userid['0']['email'];?>">  
							  </div>
                               </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="Ex.jen/31/2017 23:00:00"  class="form-control" value="<?php echo $userid['0']['comment'];?>"  maxlength="30">  
							     </div>
                                </div>
								 </div>

							  <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">วันหมดอายุ</span></label>
                                   <option type="text" class="form-control" >
								   <?php 

                     $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$userid['0']['actual-profile']."'");

	                        $ff=$exp['pro_expire'];
							//$sw_time="on";
						   $dd=$userid['0']['comment'];
						   $dr=$convert->expdate($dd,$ff,'');
                          $count=$convert->exp_time($convert_total,$dd,$ff);
	                      $count2=$count; if($count==""){$count2 ="0 วัน";}
	                      if((!empty($count)) || (!empty($dr))){echo "หมดอายุ ".$dr." เหลือเวลาอีก : ".$count2."";}
                        
						
	
	                        ################## END #####################

								?>
	
	
	
	
	</option>  
						  
							  </div>
                              </div>
                            </div>
							

							<div class="row">
						<div class="col-lg-12 col-md-12 " >
             <?php

                         $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
			?>
							<a id="btnCancel" class="btn btn-danger"  href="index.php?page=usermanager">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>
							&nbsp;&nbsp;&nbsp;<span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
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
                    <li>ไม่สามารถเปลี่ยน Packageได้ ถ้าไม่หมดอายุ</li>
					<li>เลือก Package, และ จำนวนวันที่ใช้งาน</li>
                    <li>ตัวอย่าง การเจาะจง IP Address > <strong>192.168.1.20</strong></li>
                    <li>ตัวอย่าง การเจาะจง MAC Address > <strong>00:FD:AE:98:65:AA</strong></li>
                   <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า <strong>default .</strong> </li>
                </ul>
            </p>
            </div>
			</div>
			<script src="../assets/js/date-time.js"></script>
  </section>