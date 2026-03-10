<?php
		
		
		$user=$_GET['id'];		
			$userid = $API->comm("/ip/hotspot/user/print", array(
									"from" => $user,
								));		
			
				
				if(!empty($_REQUEST['username'])){
					  
					   $user=$_GET['id'];
						$password=$_REQUEST['password'];					
						$username=$_REQUEST['username'];
						$profile=$_REQUEST['profile'];
						$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
						$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
						$db_comment=$_REQUEST['comment'];
						$mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
						$email=$_REQUEST['email'];
                        $reset=$_REQUEST['reset'];

					
					
					
					if($_REQUEST['username']==$_GET['id']){
						
						$db->update_db("mt_gen",array(
                                               "user"    =>   $_REQUEST['username'],
							                   "pass"   =>     $_REQUEST['password'],
							              "limit_uptime"=>     $_REQUEST['limit_uptime'],
							              "profile"     =>      $_REQUEST['profile'],
							              "ip_address"   =>      $_REQUEST['ip'],
							                "mac_address"   =>    $_REQUEST['mac'],
							                    "comment"  =>     $db_comment,
							                    "email"    =>     $_REQUEST['email']
				                                     ),"user='".$user."'");



						
						$API->comm("/ip/hotspot/user/set", array(											
											"name"		=> $username,
											"password"  => $password,
											"profile"	=> $profile,
											"limit-uptime" => $limit_uptime,
							                "mac-address"  => $mac ,
		                                    "address"  => $ip ,
							                "comment"  => $mt_comment ,
			                                "email"  => $email ,
									        "numbers"	=> $user,
								));
						$API->comm("/ip/hotspot/user/".$reset."-counters", array(											
											 "numbers"	=> $user,
								));
						
						
						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
						exit();
					}else{

						$num=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$_REQUEST['username']."'");
						if($num==0){
							
	                     $db->update_db("mt_gen",array(
                                               "user"    =>   $_REQUEST['username'],
							                   "pass"   =>     $_REQUEST['password'],
							              "limit_uptime"=>     $_REQUEST['limit_uptime'],
							              "profile"     =>      $_REQUEST['profile'],
							              "ip_address"   =>      $_REQUEST['ip'],
							                "mac_address"   =>    $_REQUEST['mac'],
							                    "comment"  =>     $db_comment,
							                    "email"    =>     $_REQUEST['email']
				                                     ),"user='".$user."'");


							
							$API->comm("/ip/hotspot/user/set", array(											
												"name"		=> $username,
												"password"  => $password,
												"profile"	=> $profile,
												"limit-uptime" => $limit_uptime,
								                "mac-address"  => $mac ,
		                                        "address"  => $ip ,
								                "comment"  => $mt_comment ,
			                                    "email"  => $email ,
									            "numbers"	=> $user,
									));
							

							$API->comm("/ip/hotspot/user/".$reset."-counters", array(											
											 "numbers"	=> $user,
								));
							
							
							
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';}})</script>";
							exit();
						}else{							
							
							
							echo "<script language='javascript'>swal('Error user! ".$_REQUEST['username']."','มีชื่อ ".$_REQUEST['username']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
					}
				}
			
									   								
?>


<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}

-->
</style>
<section class="content"> 
 

<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   
                        <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Edit Mikrotik User</strong>
                    <?php print $date_time_show;?></div>
					<div class="panel-body">
                    <form name="login" action="" method="post">
					<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $userid['0']['profile']; ?>"><?php echo $userid['0']['profile']; ?></option>
                                            	<?php
													
											    $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
											    $num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$userid['0']['profile']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							</select>
                                        
                                </div>                            
                            </div>
                        </div>
						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Username</span></label>
                                   <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $userid['0']['name'];?>" required>  
									</div>
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Password</span></label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?php echo $userid['0']['password'];?>" >  
									
                                </div>
                            </div>
                        </div>

						 <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือกจำนวนวันที่ใช้งาน</span></label>
                                    <input name="limit_uptime"  id="limit_uptime" placeholder="Ex.1d or 1h" class="form-control" value="<?php echo $userid['0']['limit-uptime'];?>" >
									</div>
                                </div>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Reset All Counters.</span></label>
                                     <select name="reset"  id="reset" class="form-control">
					                <option value="" selected="selected">NO.</option>
									<option value="reset">YES.</option>
									</select>
                                </div>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" class="form-control" placeholder="Ex.172.0.0.3" value="<?php echo $userid['0']['address'];?>">  
									</div>
                                </div>
                              <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A" class="form-control" value="<?php echo $userid['0']['mac-address'];?>">  
									 </div>
                                  </div>
                                 </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="Ex.jen/31/2017 23:00:00"  class="form-control" value="<?php echo iconv("tis-620", "utf-8",$userid['0']['comment']);?>" maxlength="30">  
							  </div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">E-mail</span></label>
                                   <input name="email" type="email" placeholder="Ex.123@hotmail.com" class="form-control" value="<?php echo $userid['0']['email'];?>">  
							  </div>
                                </div>
                            </div>
                            
						
					
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">วันหมดอายุ</span></label>
                                   <option type="text" class="form-control" >
								   <?php 
	                     

	                  $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$userid['0']['profile']."'");
	                        $check_profile=$exp['pro_expire'];
						   $dd=$userid['0']['comment'];
						   $dr=$convert->expdate($dd,$check_profile,'');
                          $count=$convert->exp_time($convert_total,$dd,$check_profile);
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

                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=mikrotikuser'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						 <span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
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
                    <li>เลือก Package, และ จำนวนวันที่ใช้งาน</li>
                    <li>ตัวอย่าง การเจาะจง IP Address > <strong>192.168.1.20</strong></li>
                    <li>ตัวอย่าง การเจาะจง MAC Address > <strong>00:FD:AE:98:65:AA</strong></li>
					<li>วันหมดอายุ จะแสดงเมื่อมี comment และ ได้กำหนด expire ที่ profile แล้วเท่านั้น </li>
                   <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า <strong>default .</strong> </li>
                </ul>
            </p>
			</div>
			</div>
		   <script src="../assets/js/date-time.js"></script>
  </section>