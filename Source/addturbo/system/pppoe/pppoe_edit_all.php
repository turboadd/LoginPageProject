<?php
		
			$ARRAY = $API->comm("/ppp/profile/print");
			$group_code=$_GET['group_code'];
			
			if(!empty($_REQUEST['profile'])){
			 $profile=$_REQUEST['profile'];
			$comment=$_REQUEST['comment'];
		


			if(($profile== -1)&&($comment== 0)){
				echo "<script language='javascript'>swal('Your Not Select!','กรุณาเลือกรายการ','error').then(function () {
    window.location.href = 'index.php?page=pppoe_edit_all&group_code=".$group_code."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_edit_all&group_code=".$group_code."';
   }})</script>";
		exit();
			
			}else{
				
				$num=0;
				$query=$db->DB->prepare("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
	            $query->execute();
               while($result = $query->fetch( PDO::FETCH_ASSOC ))	{

					 if($comment=="1"){$comment_set = "";}
			         //if($limit_uptime=="1"){$limit_uptime_set = "00:00:00";}
				  
					               $num++;
				                   $user= $result['user'];
				    if($profile !="-1"){
						
						                       $API->comm("/ppp/secret/set", array(											
												"profile"	=> $profile,
												 "numbers"	=> $user,
									            
									));
									
								
					 $db->update_db("pppoe_gen",array(
                                        "profile"  =>$profile
				                        ),"user='".$user."'");				
									
									
									}
					if($comment !="0"){       
						
						                       $API->comm("/ppp/secret/set", array(											
												"comment"  => $comment_set ,
			                                    "numbers"	=> $user,
						
									            
									));
								$db->update_db("pppoe_gen",array(
                                         "comment"  =>$comment_set
				                       ),"user='".$user."'");	
									}
					
            }
				echo "<script language='javascript'>swal('Save Done!','แก้ไข user ".$num." จำนวนสำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}})</script>";
							exit();
			}
			
			
			}
			
			
									   								
?>

<section class="content"> 
 
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #0000FF}
.style3 {color: #990000}
-->
</style>
<form name="login" action="" method="post">
  <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   <i class="fa fa-user"></i>&nbsp;&nbsp;<strong>PPPOE Edit Group User</strong>
                   <?php print $date_time_show;?> </div>                    
            
                <div class="panel-body">
                    
					<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <span class="style1">เปลี่ยน Package</span>
                                    <select name="profile"  id="profile" class="form-control" >
					      <option value="-1">NO.</option>
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
								    </div>
							
						 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                   <span class="style1">Reset Comment</span>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
                                       
                                    </div>
									</div>
                                </div>
                           
							<br>
							<br>
						

							<div class="row">
						<div class="col-md-7 " > 
						<?php
		               
						 $bottonbtn_success="on";
				$text_success="<i class=\"fa fa-check\"></i>&nbsp;Confirm";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
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

                    <li>1.เปลี่ยน Package</li>
					<li>NO. = ต้องการใช้ Packageเดิม</li>
                    <li>2.Reset Comment</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
					</ul>
            </p>
			</div>
			</div>
			<script src="../assets/js/date-time.js"></script> 
  </section>