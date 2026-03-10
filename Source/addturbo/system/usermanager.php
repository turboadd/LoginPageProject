<?php
		
			$ARRAY = $API->comm("/tool/user-manager/user/print");
				   $ARRAY2 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY3 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY4 = $API->comm("/tool/user-manager/profile/print");
                   $num4 =count($ARRAY4);
					
               
				  if(!empty($_REQUEST['check'])){
                    for($i=0;$i < count($_REQUEST['check']);$i++){
					$username=$_REQUEST['check'][$i];
					$act = $_REQUEST['active'];
					  
					  for($ino1=0; $ino1<$num4; $ino1++){
					if($ARRAY4[$ino1]['name']==$username){$usermaster=$ARRAY4[$ino1]['name'];}}}
					//echo "<script>alert('".$usermaster."')</script>";
					if(!empty($usermaster)){
					echo "<script language='javascript'>swal('Can Not Change User  ".$usermaster."!','จะมีผลกับการสร้างuser ในprofile ".$usermaster."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
	
	                }else
					{
					
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
                    $num3 =count($ARRAY2);
					for($ino2=0; $ino2<$num3; $ino2++){
					if($ARRAY2[$ino2]['user']=="".$user.""){$user2 = "".$ino2."";
					$ARRAY3 = $API->comm("/ip/hotspot/active/".$active2."
						                         =.id=".$user2."");}
					}
					$ARRAY = $API->comm("/tool/user-manager/user/".$active."", array(
											"numbers" => $user,));
					
					if($active=="remove"){$db->del("mt_gen","user='".$user."'");}
					
				}
                



echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})</script>";
				exit();
			}
			}
?>

  <section class="content"> 

<form name="name" action="" method="post">
	<div class="<?php print $convert->panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong>HOTSPOT USER MANAGER</strong>   <?php print $date_time_show;?>
	  </div>
	  <div class="panel-body">
	  <?php echo "<span class=\"\">";           
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
                               $small_del=$convert->botton_small_account($account,$small_delete_use,'','','','','','','');
                               $small_dis=$convert->botton_small_account($account,'',$small_disable_use,'','','','','','');
							   $small_ena=$convert->botton_small_account($account,'','',$small_enable_use,'','','','','');
									echo $small_del ;echo $small_dis; echo $small_ena;
									echo"</span><br><br>";?>
	<div class="table-responsive">
    <table class="table table-striped table-hover" id="dataTables-example">
	<thead>
    <tr>   
		<th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>MAC ADDRESS</th>
											<th>PROFILE</th>
                                             <th>UP/DOWNLOAD</th>
											<!-- <th>START DATE/TIME</th> -->
											<th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>
											</tr>
											 <tfoot>   
		<th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>MAC ADDRESS</th>
											<th>PROFILE</th>
                                             <th>UP/DOWNLOAD</th>
											<!-- <th>START DATE/TIME</th> -->
											<th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>
											</tfoot>
                                             </thead>
                                               <?php
									   
												   $i=0;
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
			$result=$db->selectquery("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['username']."'");						if(!empty($ARRAY[$i]['actual-profile'])){$profile =$ARRAY[$i]['actual-profile'];}else{$profile = "";}
			if(!empty($ARRAY[$i]['caller-id'])){$mac =$ARRAY[$i]['caller-id'];}else{$mac = "";}
			if(!empty($ARRAY[$i]['comment'])){$comment =$ARRAY[$i]['comment'];}else{$comment = "";}
			$check_status=$ARRAY[$i]['disabled'];
			$color=$convert->Expire_color('','',$check_status,$profile);
													echo "<tr>";
														echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$ARRAY[$i]['username']."\"></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['username']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
					
			

														echo "".$mac."";
														echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                        if(empty($profile)){
                                                        echo "<a class=\"btn btn-danger btn-xs\"\"><span></span> Expires </a>";
                                                        }else{echo $profile;
						                                 }
                                                       echo "</span></td>";
													   echo "<td><span style=\"color:".$color.";\">";
								if((!empty($ARRAY[$i]['upload-used']))&&(!empty($ARRAY[$i]['download-used']))){
								$upload=$ARRAY[$i]['upload-used'];if($ARRAY[$i]['upload-used']==""){$upload="";}
								else if($ARRAY[$i]['upload-used']<1073741824){$upload="".(round($ARRAY[$i]['upload-used']/1048576,1))."Mbs/";}else if($ARRAY[$i]['upload-used']>1073741824){$upload="".(round($ARRAY[$i]['upload-used']/1073741824,2))."Gbs/";}
								$download=$ARRAY[$i]['download-used'];if($ARRAY[$i]['download-used']==""){$download="";}else if($ARRAY[$i]['download-used']<1073741824){$download="".(round($ARRAY[$i]['download-used']/1048576,1))."Mbs";}else 
									
								if($ARRAY[$i]['download-used']>1073741824){$download="".(round($ARRAY[$i]['download-used']/1073741824,2))."Gbs";}}else{$upload="";$download="";}
														echo "".$upload."".$download."";
                                                        
						                              echo "<td><span style=\"color:".$color.";\">";
													
					               
					
   
	$exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$profile."'");
	                    $ff=$exp['pro_expire'];
						$sw_time="on";
						$dr=$convert->expdate($comment,$ff,$sw_time);
						if($dr){ echo "หมดอายุ ".$dr;
						 }else{echo $comment;}


							   echo "</span></td>";
													
														 
                          echo "<td class=\"text-right\">";
						  if($account!="read"){
							  $connect=0;
                       
					   for($ii=0; $ii<$num2; $ii++){
					   if($ARRAY2[$ii]['user']==$ARRAY[$i]['username']){
						   $connect=($connect+1);
					   // <!--start update mac-address and ip-address to databases-->  //
				$db->update_db("mt_gen",array(
         									"mac_address"  =>  $ARRAY2[$ii]['mac-address'], 
						                    "ip_address"  =>$ARRAY2[$ii]['address']
				                              ),"user='".$ARRAY2[$ii]['user']."'");	
											  /*<!--End update --> */
					  }}   
                       if($connect > 0){ echo "<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะKick  ".$ARRAY[$i]['username']."  จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, kicked it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=kick&return=userman&user=".$ARRAY[$i]['username']."';});\"><span class=\"fa fa-wifi\">  </span>OnLine ".$connect." </a>&nbsp;&nbsp;";
                       }
						if($ARRAY[$i]['disabled']=="false"){
							for($ino1=0; $ino1<$num4; $ino1++){
					if($ARRAY4[$ino1]['name']==$ARRAY[$i]['username']){$error=$ARRAY4[$ino1]['name'];}else{$error="";}}
					if($error!=$ARRAY[$i]['username']){
						echo "<a class=\"btn btn-success btn-xs\" title= \"click to disable\" href=\"index.php?page=disable&return=userman&user=".$ARRAY[$i]['username']."\"><span></span> Enable </a>&nbsp;&nbsp;";}else{
							
						echo "<a class=\"btn btn-success btn-xs\" title= \"click to disable\" onclick=\"
					swal('Can Not Disable User  ".$ARRAY[$i]['username']."!','จะมีผลกับการสร้างuser ในprofile ".$ARRAY[$i]['username']."','error').then(function () {
    window.location.href = 'index.php?page=usermanager';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=usermanager';}})\";><span></span> Enable </a>&nbsp;&nbsp;";}
					
                        
                         }else{
							 
                         echo "<a class=\"btn btn-black btn-xs\" title= \"click to enable\"href=\"index.php?page=enable&return=userman&user=".$ARRAY[$i]['username']."\"><span></span> Disable </a>&nbsp;&nbsp;";
                         }

						 #########################EDIT####################################
				
		//$result=$db->selectquery("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['username']."'");

				$xs_edit="on";
				   $onclick_edit="onclick=\"swal({
                    title: 'name: ".$ARRAY[$i]['username']."<br>pass: ".$ARRAY[$i]['password']."',
                    text: '".$comment."',             
                    type: 'question',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Edit!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
              window.location.href='index.php?page=editusermanager&master=".$error."&id=".$ARRAY[$i]['username']."';})\"";	 
					echo  $edit_btn_xs=$convert->button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit,'','','',''); 	

                         
						 ############################################################
						
						 
						 
						 echo"<a class=\"btn btn-danger btn-xs\" title= \"click to remove\" 
						 onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['username']."  จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=delete&return=userman&id=".$ARRAY[$i]['username']."';})\"><span class=\"fa fa-times\"></span>ลบ</a></td>";
                          }else{

						  for($ii=0; $ii<$num2; $ii++){
					   if($ARRAY2[$ii]['user']=="".$ARRAY[$i]['username']."");
					  // <!--start update mac-address and ip-address to databases-->  //
			$db->update_db("mt_gen",array(
         									"mac_address"  =>  $ARRAY2[$ii]['mac-address'], 
						                    "ip_address"  =>$ARRAY2[$ii]['address']
				                              ),"user='".$ARRAY2[$ii]['user']."'");
						/*<!--End update --> */
					  }   
                       if($ARRAY[$i]['active-sessions']==""){
                       
                        }else{ echo "<button class=\"btn btn-success2 disabled btn-xs\" type=\"button\" data-toggle=\"tooltip\"  title= \"click to kick user online\" ><span class=\"fa fa-wifi\">  </span> ".$ARRAY[$i]['active-sessions']." </button>&nbsp;&nbsp;";
                        }
						if($ARRAY[$i]['disabled']=="false"){
                        echo "<button class=\"btn btn-success disabled btn-xs\" type=\"button\"  data-toggle=\"tooltip\" title= \"click to disable\" ><span></span> Enable </button>&nbsp;&nbsp;";
                         }else{
                         echo "<button class=\"btn btn-black disabled btn-xs\" type=\"button\" data-toggle=\"tooltip\"  title= \"click to enable\"><span></span> Disable </button>&nbsp;&nbsp;";
                         }
						 echo"<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" href='index.php?page=editusermanager&id=".$ARRAY[$i]['username']."'><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";
                         echo"<button class=\"btn btn-danger disabled btn-xs\" type=\"button\" data-toggle=\"tooltip\"  title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</button></td>";
						  }

						 echo "</tr>";
													
						}
						?>
                         </table>
                         </div>
                         </div>
                           
                        
					                  <div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php

					                  $delete_use="on";
									  $disable_use="on";
									  $enable_use="on";
                               $del=$convert->botton_account($account,$delete_use,'','','','','','');
                               $dis=$convert->botton_account($account,'',$disable_use,'','','','','');
							   $ena=$convert->botton_account($account,'','',$enable_use,'','','','');
									echo $del ;echo $dis; echo $ena;
									  
				                       ?>
								
                      </div>
					    </div>
					 
					  </form>
			<script src="../assets/js/date-time.js"></script>		 
  </section>
    
