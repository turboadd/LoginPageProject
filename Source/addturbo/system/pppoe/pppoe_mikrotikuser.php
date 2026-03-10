<?php
		
			 $ARRAY = $API->comm("/ppp/secret/print");	
		           $ARRAY2 = $API->comm("/ppp/active/print");
				   $tran = $API->comm("/ppp/secret/print");
                   $copy =count($tran);
				if(!empty($_GET['cancel'])){  
				 $db->del("mt_edit","mt_id='".$id."'");
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_mik_user' />";
				}

		           
		if(!empty($_REQUEST['check'])){
			//if($_REQUEST['active']=="remove"){$multi_function="open";}
				//if($_REQUEST['active']=="disable"){$multi_function="open";}
				//if($_REQUEST['active']=="enable"){$multi_function="open";}
				
	##################################################################
			if(($_REQUEST['active']=="enable")||($_REQUEST['active']=="disable")||($_REQUEST['active']=="remove")){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
					$num3 =count($ARRAY2);
					for($iii=0; $iii<$num3; $iii++){
					if($ARRAY2[$iii]['name']=="".$user.""){
					 $API->comm("/ppp/active/".$active2."
						                         =.id=".$iii."");
												
					}}
					$API->comm("/ppp/secret/".$active."", array(
											"numbers" => $user,));
					if($active=="remove"){$db->del("pppoe_gen","user='".$user."'");}
				
				

				}
				
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href ='index.php?page=pppoe_mik_user';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_mik_user';}})</script>";
				exit();}
	###########################################################################################
			if($_REQUEST['active']=="set"){
			
			$group_code=round(date('YmdHi.s'));
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$active = $_REQUEST['active'];
					$num=count($_REQUEST['check']);
			
			$db->add_db("mt_edit",array(
                                           "user"  =>  $user,
						              "group_code"  =>  $group_code,
						                     "mt_id"  =>  $id
							                            ));
			
			}
			$rows=$db->rows_num("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");
			if($rows==$num){
				
	echo "<script language='javascript'>swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะแก้ไข user ".$rows." จำนวน จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes,Next!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href ='index.php?page=pppoe_edit_all&group_code=".$group_code."';}
					, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel','overlay') {
						   window.location.href ='index.php?page=pppoe_mik_user&cancel=yes';}})</script>";
				exit();
				
				
				}else{echo "<script language='javascript'>swal('Error Count numbers Try again!','เกิดผิดพลาดในการนับจำนวน กรุณาลองใหม่!','error').then(function () {window.location.href = 'index.php?page=pppoe_mik_user&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href ='index.php?page=pppoe_mik_user&cancel=yes';}})</script>";}
			}
#################################################################################################
                    if($_REQUEST['active']=="transfer"){
				$date=date('Y-m-d H:i:s');
				$csv=round(date('YmdHi.s'));
                $group="Transfer-".$csv."";
				$service="pppoe";
				$num_pass=0;
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$usermik=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$rows=$db->rows_num("SELECT * FROM pppoe_gen WHERE user='".$usermik."'");
		if($rows>0){
			///$num_fail=$num_fail+($num_check+1);
			}else{ 
					 for($co=0; $co<$copy; $co++){
		 if($tran[$co]['name']==$usermik){
   
			
						  		$db->add_db("pppoe_gen",array(
                             "user"  =>  $usermik,
						      "pass"  =>  $tran[$co]['password'],
						   "profile"  =>  $tran[$co]['profile'],
						  "caller_id"  =>  $tran[$co]['caller-id'],
		                  "address"    =>   $tran[$co]['address'],
		                  "comment"  =>  iconv("tis-620", "utf-8",$tran[$co]['comment']),
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
							    ));

			 $num_pass++;}}

				}}
									if(($num_pass)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','database สำเร็จ ".($num_pass)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_mik_user';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_pass)." users','success').then(function () {
    window.location.href ='index.php?page=pppoe_mik_user';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_mik_user';
   }})</script>";
		exit();}
					}
#######################################################################


}?>
<section class="content"> 

    
<form name="name" action="" method="post">
	<div class="<?php print $convert->panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong> PPPOE MIKROTIK USERS </strong>
	 <?php print $date_time_show;?> </div>
	  <div class="panel-body">
						   <?php           
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
									  $small_edit_use="on";
                               $small_del=$convert->botton_small_account($account,$small_delete_use,'','','','','','','');
                               $small_dis=$convert->botton_small_account($account,'',$small_disable_use,'','','','','','');
							   $small_ena=$convert->botton_small_account($account,'','',$small_enable_use,'','','','','');
							   $small_edi=$convert->botton_small_account($account,'','','',$small_edit_use,'','','','');
									echo $small_del ;echo $small_dis; echo $small_ena;echo $small_edi;
									$tran_use="on";
									$text="select transfer to database user";
							  $tran=$convert->botton_small_account($account,'','','','',$tran_use,$text,'','');
							
	                       ?>
						   
				<span  style="float: right;">
						   	<!--  -->
               <div class="btn-group">
               <button type="button" class="btn btn-primary fa fa-user-plus dropdown-toggle" data-toggle="dropdown" title="click Add" ></button>
              <ul class="dropdown-menu" role="menu">
    <li><a href="#" data-toggle="modal" data-target="#add" data-toggle="tooltip" data-placement="top" title="">add user</a></li>
    <li><a href="#" data-toggle="modal" data-target="#gen" data-toggle="tooltip" data-placement="top" title="">Generate user</a></li>
  </ul>
</div>
<!--  -->
						   
						   <?php print $tran;?></span>
						   

     </span><br><br>

	                        <div class="table-responsive">
							<table class="table table-striped table-hover" id="dataTables-example">
	                           <thead>
                               <tr>   
		                      <th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>                                           
                                            <!-- <th>PASSWORD</th> -->
                                            <th>PROFILE</th>
										    <th>CALLER ID</th>
											 <th>COMMENT</th>
											<th class="text-center">EXPIRE DATE/TIME</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tr>
										<tfoot>   
		                      <th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>                                           
                                            <!-- <th>PASSWORD</th> -->
                                            <th>PROFILE</th>
										    <th>CALLER ID</th>
											<th>COMMENT</th>
											<th class="text-center">EXPIRE DATE/TIME</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tfoot>
                                  </thead>
                                    <tbody>
                                        
                                            
												<?php
													$i=0;
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
			                                        ##$check_limit=$ARRAY[$i]['limit-uptime'];
													##$check_uptime=$ARRAY[$i]['uptime'];
						$check_status=$ARRAY[$i]['disabled'];
					   $profile_check="0ff";
					   $xs_dis="on";
					   $xs_enab="on";
					
					
					
					
					$color=$convert->Expire_color('','',$check_status,$profile_check);
					$href_dis="href=\"index.php?page=disable&return=pppoe&user=".$ARRAY[$i]['name']."&return=pppoe\"";
                    $href_enab="href=\"index.php?page=enable&return=pppoe&user=".$ARRAY[$i]['name']."\"";    
					$dis_btn_xs=$convert->button_btn_xs_account($account,$href_dis,'',$xs_dis,'','','','','','');
					$enab_btn_xs=$convert->button_btn_xs_account($account,$href_enab,'','',$xs_enab,'','','','','');


					$result=$db->selectquery("SELECT * FROM pppoe_gen WHERE user='".$ARRAY[$i]['name']."'");
					
					
					
					$mac =$ARRAY[$i]['caller-id'];if($mac==""){$mac = $result['caller_id'];}
					if(!empty($ARRAY[$i]['comment'])){$comment=iconv("tis-620", "utf-8",$ARRAY[$i]['comment']);
		           }else{$comment ="";}


													echo "<tr>";
														echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$ARRAY[$i]['name']."\"></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['name']."</span></td>";														
														//echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['password']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['profile']."</span></td>";
														//echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['caller-id']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                     
											
														echo "".$mac."";
                                                        echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$comment."</span></td>";
								                      echo "<td><center><span style=\"color:".$color.";\">";
				
					
                           
                        $exp=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$ARRAY[$i]['profile']."'");
            $check_profile=$exp['pro_expire'];
				$sw_time="on";
				
				$dr=$convert->expdate($comment,$check_profile,$sw_time);
                 
				 if(!empty($dr)){echo "หมดอายุ ".$dr; }
							   echo "</span></center></td>";
														echo "<td class=\"text-right\">";
			
			
			
			#######################################################################################
			
			
			
                                                        for($ii=0; $ii<$num2; $ii++){
                       if($ARRAY2[$ii]['name']==$ARRAY[$i]['name']){


                       // <!--start update mac-address and ip-address to databases-->// 
						$db->update_db("pppoe_gen",array(
         									"caller_id"  =>  $ARRAY2[$ii]['caller-id'], 
						                    "address"  =>$ARRAY2[$ii]['address']
				                              ),"user='".$ARRAY[$i]['name']."'");
					   						///////////
					   
					   $xs_kick="on";
					   $text_online="OnLine";
							$onclick_kick="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะKick  ".$ARRAY[$i]['name']."  จริงหรือไม่ ?',
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
                    window.location.href ='index.php?page=kick&return=pppoe&user=".$ARRAY[$i]['name']."';})\"";
					echo  $kick_btn_xs=$convert->button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$text_online,'','');
                        }}
						######################################################
                    if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs; }else{ echo $enab_btn_xs;}


                    $xs_edit="on";
				   $onclick_edit="onclick=\"swal({
                    title: 'name: ".$ARRAY[$i]['name']."<br>pass: ".$ARRAY[$i]['password']."',
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
                    window.location.href ='index.php?page=edit_pppoe_mik_user&id=".$ARRAY[$i]['name']."';})\"";	 
					echo  $edit_btn_xs=$convert->button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit,'','','',''); 
        ######################################################################################
                   	$xs_delete="on";
				$onclick_del="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['name']."  จริงหรือไม่ ?',
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
                    window.location.href ='index.php?page=delete&return=pppoe&id=".$ARRAY[$i]['name']."';})\"";
                   echo  $del_btn_xs=$convert->button_btn_xs_account($account,$onclick_del,$xs_delete,'','','','','','',''); 


						                                  
                  echo "</td>";
					echo "</tr>";
                                                            
															
													
													}
												?>
                                  </thead>
								     <tbody>
									 </table>
									 </div>
									 <br>
								<div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
								 <?php
								     $delete_use="on";
									  $disable_use="on";
									  $enable_use="on";
									  $edit_use="on";
                               $del=$convert->botton_account($account,$delete_use,'','','','','','');
                               $dis=$convert->botton_account($account,'',$disable_use,'','','','','');
							   $ena=$convert->botton_account($account,'','',$enable_use,'','','','');
							   $edi=$convert->botton_account($account,'','','',$edit_use,'','','');
									echo $del ;echo $dis; echo $ena;echo $edi;
				                  ?>
                                  
                      </div>
					  </div>
					   </div>
					   </form>

					   <!--### Modal ###-->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" >
		   <style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
-->
</style>
		  <form name="add" action="index.php?page=con_addpppoe_process" method="post"> 
            <div class="<?php print $convert->panel_modify();?>">

                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">PPPOE Add User - สร้างยูสเซอร์</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
						<div class="panel-body">
						<!-- edit here -->
						<?php $ARRAY = $API->comm("/ppp/profile/print"); ?>
                   <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
                                    <select name="package_id"  id="package_id" class="form-control" required>
					      <option value="">ต้องเลือก Package</option>
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
                                    <div class="col-xs-12 col-md-6">
                                  <div class="form-group">
                                    <span class=" style1">Caller-id</span>
                                   <input name="mac" placeholder="Ex.11:22:33:44:55:66" type="text" class="form-control">  
							     </div>
                                </div>
                            </div>


						 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Username</span>
                                     <input name="user"  id="user" placeholder="Username" class="form-control"  required>
						         </div>
                                </div>                            
                              <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <span class="style1">Password</span>
                                     <input name="pass"  id="pass" placeholder="Password" class="form-control"  required>
						           </div>
                                </div>                            
                            </div>

							<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style1">Comment - เพิ่มเติม</span></label>
                                   <input name="comment" type="text" class="form-control"  maxlength="30"  placeholder="สูงสุด 30ตัวอักษร" >  
							  </div>
                                </div>
                            </div> 
            
                        <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php
		
		                    $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				                  ?>
								<button  class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                           
                        </div>
						</div>
						</div>
			        
                    <!-- end edit-->       
					</div>
					<!--/.panel-body  -->
                        </div>
						<!-- /.panel_modify -->
						</form> 
                    </div>
                    </div>


        				
		<!-- ################ /.Model ##################### -->

		<!--### Modal ###-->
        <div class="modal fade" id="gen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" >

		  <form name="gen" action="index.php?page=con_genuser_pppoe_process" method="post"> 
            <div class="<?php print $convert->panel_modify();?>">

                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title"> PPPOE Generate User</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
						<div class="panel-body">
						<!-- edit here -->
                   	<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">เลือก Package</span>
                                    <select name="package_id"  id="package_id" class="form-control" required>
					      <option value="">ต้องเลือก Packege</option>
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
                                   <span class="style1">เจาะจง MAC Address</span>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A"  class="form-control">
									</div>
                                </div>
                             </div>

						<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Pattern Charactors</span>
                                    <select name="str_char"  id="str_char" class="form-control">
					                <option value="abcdefghijklmnpqrstuvwxyz">a-z</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZ">A-Z</option>
									<option value="123456789">1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz">a-z,A-Z</option>
									<option value="abcdefghijkmnpqrstuvwxyz123456789">a-z,1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789">A-Z,1-9</option>
									<option value="ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz123456789">a-z,A-Z,1-9</option>
  		                            </select>
									</div>
                                </div>                            
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label  class="style2">Number of users</label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="จำนวนuserที่ต้องการสร้าง">
                                    <input name="max_user" type="text" placeholder="จำนวนuserที่ต้องการสร้าง" value="10" maxlength="3" required class="form-control">
                                </div>
                            </div>                        
                        </div>


                        <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1">Prefix User</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="Ex. wifishop@  Gen ออกมาจะได้ wifishop@userบัตร">
                                   <input name="fix_user" type="text" placeholder="นำหน้า user"  value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                   <span class="style1">Prefix Password</span>&nbsp;<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="Ex. pass@ Gen ออกมาจะได้ pass@PassWordบัตร">
                                    <input name="fix_pass" type="text"  placeholder="นำหน้า  password"  value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Username length</span>
									<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="จำนวนที่ต่อท้าย Prefix User">
                                    <select name="num_user"  class="form-control">
									<option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6" selected="selected">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                            </select>
                                </div>
                            </div>                        
                        <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class="style1">Password length</span>
									<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="จำนวนที่ต่อท้าย Prefix Password">
                                    <select name="num_pass"  class="form-control">
									<option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6" selected="selected">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                            </select>
                                </div>
								</div>
                            </div> 
							
							<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style1">Comment - เพิ่มเติม</span></label>
                                   <input name="comment" type="text" class="form-control"  maxlength="30"  placeholder="สูงสุด 30ตัวอักษร" >  
							  </div>
                                </div>
                            </div> 
            
                        <div class="row">
						<div class="col-lg-7 col-md-9 " >
                            <div class="form-group">
							<?php
		
		                    $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Generate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				                  ?>
								<button  class="btn btn-danger" type="reset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                           
                        </div>
						</div>
						</div>
			        
                    <!-- end edit-->       
					</div>
					<!--/.panel-body  -->
                        </div>
						<!-- /.panel_modify -->
						</form> 
                    </div>
                    </div>


        				
		<!-- ################ /.Model ##################### -->
	<script src="../assets/js/date-time.js"></script>
  </section>