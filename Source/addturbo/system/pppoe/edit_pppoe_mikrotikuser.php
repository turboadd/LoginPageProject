<?php
		
			$user=$_GET['id'];		
			$userid = $API->comm("/ppp/secret/print", array(
									"from" => $user,
								));		
			
				
				if(!empty($_REQUEST['username'])){
					$user=$_GET['id'];
							$password=$_REQUEST['password'];					
							$username=$_REQUEST['username'];
							$profile=$_REQUEST['profile'];
							$db_comment=$_REQUEST['comment'];
							$mac=$_REQUEST['mac'];
						    $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);

					if($_REQUEST['username']==$_GET['id']){
						   $db->update_db("pppoe_gen",array(
                                               
							                    "pass"=>$password,
							                    "profile"=>$profile,
							                    "caller_id"=>$mac,
							                    "comment"=>$db_comment
				                                     ),"user='".$user."'");
	                   
					   
					   
					   
					  
						
						$ARRAY = $API->comm("/ppp/secret/set", array(											
											
											"password"  => $password,
											"profile"	=> $profile,
											"caller-id"  => $mac ,
		                                     "comment"  => $mt_comment ,
									        "numbers"	=> $user,
								));		
						
						
                        echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
						exit();
					}else{

						$num=$db->rows_num("SELECT * FROM pppoe_gen WHERE user='".$_REQUEST['username']."'");
						if($num==0){
							
	                        		 $db->update_db("pppoe_gen",array(
                                               	"user"=>$username,
							                    "pass"=>$password,
							                    "profile"=>$profile,
							                    "caller_id"=>$mac,
							                    "comment"=>$db_comment
				                                     ),"user='".$user."'");
							
							
							
							$ARRAY = $API->comm("/ppp/secret/set", array(											
												"name"		=> $username,
												"password"  => $password,
												"profile"	=> $profile,
												"caller-id"  => $mac ,
		                                        "comment"  => $mt_comment ,
									            "numbers"	=> $user,
									));		
							
							
							echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$username." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user';}})</script>";
							exit();
						}else{							
							
							echo "<script language='javascript'>swal('Error user! ".$_REQUEST['username']."','มีชื่อ ".$_REQUEST['username']." แล้วในฐานข้อมูล กรุณาตั้งชื่อใหม่!','error').then(function () {}, function (dismiss) {if (dismiss === 'overlay') {}})</script>";
						}
					}
				}
			
									   								
?>

<style type="text/css">
<!--
.style1 {
	color: #0000FF;
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
                    <i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Edit Mikrotik User</strong>
                     <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
                                    <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $userid['0']['profile']; ?>"><?php echo $userid['0']['profile']; ?></option>
                                            	<?php
													
											    $ARRAY = $API->comm("/ppp/profile/print");
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
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Caller ID</span>
                                   <input name="mac" type="text" class="form-control" placeholder="Ex.172.0.0.3" value="<?php echo $userid['0']['caller-id'];?>">  
							  </div>
                                </div>
                            </div>
						 
						 <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Username</span>
                                   <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $userid['0']['name'];?>" required>  
								 </div>	
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Password</span>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?php echo $userid['0']['password'];?>" required>  
								</div>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Comment</span>
                                   <input name="comment" type="comment" class="form-control" placeholder="Ex.jen/31/2017 23:00:00" value="<?php echo iconv("tis-620", "utf-8",$userid['0']['comment']);?>" maxlength="30">  
							  </div>
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">วันหมดอายุ</span>
                                   <option type="text" class="form-control" >
								   <?php 


	         $exp=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$userid['0']['profile']."'");	
							
						$check_profile=$exp['pro_expire'];
						$comment=$userid['0']['comment'];	
		                $sw_time="on";
						$dr=$convert->expdate($comment,$check_profile,'');
                          $count=$convert->exp_time($convert_total,$comment,$check_profile);
	                      $count2=$count; if($count==""){$count2 ="0 วัน";}
	                       if((!empty($count)) || (!empty($dr))){echo "หมดอายุ ".$dr." เหลือเวลาอีก : ".$count2."";}
                        
						  
	
	                        ################## END #####################
	
	
	                             ?>
	
	                               </option>  
							  </div>
                               </div>
                            </div>
							
							
							
							<br><br>
            
                        <div class="row">
						<div class="col-lg-12 col-md-12 " >
					                    <?php
		                
						 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>
				 <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=pppoe_mik_user'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
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
                    
                    <li>วันหมดอายุ จะแสดงเมื่อมี comment และ ได้กำหนด expire ที่ profile แล้วเท่านั้น </li>
                    <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า <strong>default .</strong> </li>
                </ul>
            </p>
			</div>
			</div>
			<script src="../assets/js/date-time.js"></script>
  </section>