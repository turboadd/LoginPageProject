<?php


			$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
			$ARRAY2 = $API->comm("/ip/hotspot/user/print");
			 $group_code=$_GET['group_code'];
			
		
		
			if(!empty($_POST['active'])){
			
			 $profile=$_REQUEST['profile'];
			$comment=$_REQUEST['comment'];
			$counters=$_REQUEST['counters'];
			$limit_uptime=$_REQUEST['limit_uptime'];
			 $total=$comment+$limit_uptime+$counters;
            if((!empty($profile))||($total != 0)){

			 $num1=0;
				$query=$db->DB->prepare("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
	            $query->execute();
               while($result = $query->fetch( PDO::FETCH_ASSOC ))	{	
				  
					               $num1++;
				                   $user= $result['user'];
								   $mik_use =count($ARRAY2);
								 

for($us=0; $us<$mik_use; $us++){if($ARRAY2[$us]['name']==$user){
		if(empty($ARRAY2[$us]['comment'])){$Fcomment="";}else{$Fcomment=$ARRAY2[$us]['comment'];}
		if(empty($ARRAY2[$us]['limit-uptime'])){$Flimit_uptime="00:00:00";$db_limit_uptime="";
		}else{$Flimit_uptime=$ARRAY2[$us]['limit-uptime'];$db_limit_uptime=$ARRAY2[$us]['limit-uptime'];}
		

		
				
 if(!empty($profile)){$pro=$profile;}else{$pro=$ARRAY2[$us]['profile'];}
			
 if($comment==1){$comm="";$db_comm="";}else{$comm=$Fcomment;$db_comm=iconv("tis-620", "utf-8",$Fcomment);}
			
 if($limit_uptime==1){$limit="00:00:00";$db_limit="";}else{$limit=$Flimit_uptime;$db_limit=$db_limit_uptime;}			

		  	 $API->comm("/ip/hotspot/user/set", array(											
												"profile"	=> $pro,
												"comment"  => $comm ,
                                                "limit-uptime" => $limit,
												 "numbers"	=> $user
									            
									));
				
				
			 $db->update_db("mt_gen",array(
                                        "profile"  =>$pro,
				                         "comment"  =>$db_comm,
				                       "limit_uptime"=>$db_limit
                                        ),"user='".$user."'");

          if($counters==1){  $API->comm("/ip/hotspot/user/reset-counters", array(												
												 "numbers"	=> $user,
									            
									)); }

}}
	

}	
				
			echo "<script language='javascript'>swal('Save Done!','แก้ไข user ".$num1." จำนวนสำเร็จแล้ว!','success').then(function () {
    window.location.href='index.php?page=mikrotikuser&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href='index.php?page=mikrotikuser&cancel=yes';}})</script>";
							exit();
					
				
				
				}else{
echo "<script language='javascript'>swal('You Not Select!','กรุณาเลือกรายการ','error').then(function () {
    window.location.href='index.php?page=edit_all&group_code=".$group_code."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href='index.php?page=edit_all&group_code=".$group_code."';
   }})</script>";
		exit();
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

 <form name="login" action="" method="post">
 <div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-user"></i>&nbsp;&nbsp;Hotspot Edit Group</strong>
                    <?php print $date_time_show;?></div>                    
              
                <div class="panel-body">
                   
					<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เปลี่ยน Package</span></label>
                                     <select name="profile"  id="profile" class="form-control" >
					      <option value="">NO.</option>
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
                                    <label for="cardNumber"><span class="style1">Reset Limit Uptime.</span></label>
                                    <select name="limit_uptime"  id="limit_uptime" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
									</div>
									</div>
									</div>

                        <div class="row">
                       <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <label for="cardNumber"><span class="style1">Reset Comment.</span></label>
                                    <select name="comment"  id="comment" class="form-control">
					                <option value="0" selected="selected">NO.</option>
									<option value="1">YES.</option>
									</select>
									</div>
									</div>
                               <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <label for="cardNumber"><span class="style1">Reset Counters.</span></label>
                                    <select name="counters"  id="counters" class="form-control">
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
				

				
				<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=mikrotikuser&cancel=yes'"><i class="fa fa-times"></i>&nbsp;Cancel</button>
			
				
				
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
                    <li>2.Reset Limit Uptime</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
					<li>3.Reset Comment</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
                    <li>4.Reset Counters</li>
					<li>NO. = ต้องการใช้ ค่าเดิม</li>
					<li>YES. = เปลี่ยนเป็นค่า default</li>
            </ul>
            </p>
     
</div>
 <script src="../assets/js/date-time.js"></script>
  </section>