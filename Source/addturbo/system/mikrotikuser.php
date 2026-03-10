
<?php
		
			$ARRAY = $API->comm("/ip/hotspot/user/print");
				   $ARRAY2 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY3 = $API->comm("/ip/hotspot/active/print");
				   $ARRAY4 = $API->comm("/ip/hotspot/user/profile/print");
				   $tran = $API->comm("/ip/hotspot/user/print");
                   $copy =count($tran);
				  if(!empty($_GET['cancel'])){
					  
					 $db->del("mt_edit","mt_id='".$id."'");
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
				}



				if(!empty($_REQUEST['check'])){
					$multi_function="";
				if($_REQUEST['active']=="remove"){$multi_function="open";}
				if($_REQUEST['active']=="disable"){$multi_function="open";}
				if($_REQUEST['active']=="enable"){$multi_function="open";}
				if($_REQUEST['active']=="transfer"){$multi_function="transfer";}
	##############################################################################
					if($multi_function=="open"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];
					$active2 = $_REQUEST['active'];if($active=="disable"){$active2 = "remove";}
                    $num3 =count($ARRAY3);
					
					for($ino1=0; $ino1<$num3; $ino1++){
					if($ARRAY3[$ino1]['user']==$user){
						
						$user2 = $ino1;
						
						$ARRAY2 = $API->comm("/ip/hotspot/active/".$active2."
						                         =.id=".$user2."");
						}}
                     
					$ARRAY = $API->comm("/ip/hotspot/user/".$active."", array(
											"numbers" => $user,));
					if($active=="remove"){$db->del("mt_gen","user='".$user."'");}
					
					
				}
                echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href='index.php?page=mikrotikuser';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href='index.php?page=mikrotikuser';}})</script>";
				exit();
			}
	########################################################################################
			if($_REQUEST['active']=="set"){
			
			$group_code=round(date('YmdHi.s'));
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
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
                    window.location.href = 'index.php?page=edit_all&group_code=".$group_code."';}
					, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel','overlay') {
						   window.location.href = 'index.php?page=mikrotikuser&cancel=yes';}})</script>";
				exit();
				
				
				}else{echo "<script language='javascript'>swal('Error Count numbers Try again!','เกิดผิดพลาดในการนับจำนวน กรุณาลองใหม่!','error').then(function () {window.location.href='index.php?page=mikrotikuser&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href = 'index.php?page=mikrotikuser&cancel=yes';}})</script>";}
			}
	#######################################################################################
			if($multi_function=="transfer"){
				$date=date('Y-m-d H:i:s');
				$csv=round(date('YmdHi.s'));
                $group="Transfer-".$csv."";
				$num_pass=0;
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$usermik=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
		$rows=$db->rows_num("SELECT * FROM mt_gen WHERE user='".$usermik."'");
		if($rows>0){ 
			
			}else{ 
					 for($co=0; $co<$copy; $co++){
		 if($tran[$co]['name']==$usermik){
        $server=$tran[$co]['server'];if($tran[$co]['server']==""){$server="all";}


		$db->add_db("mt_gen",array(
                             "user"  =>  $usermik,
						      "pass"  =>  $tran[$co]['password'],
						   "limit_uptime"  =>  $tran[$co]['limit-uptime'],
						  "	profile"  =>  $tran[$co]['profile'],
						  "server_pro"  =>  $server,
                          "mac_address"  =>  $tran[$co]['mac-address'],
		                  "ip_address"    =>   $tran[$co]['address'],
		                  "email"  =>  $tran[$co]['e-mail'],
		                  "comment"  =>  iconv("tis-620", "utf-8",$tran[$co]['comment']),
	                      "csv_code" =>    $csv,
		                   "group_name" =>  $group,
		                    "date"    =>    $date,
	                         "mt_id"  =>  $id
							    ));


			
			 $num_pass++;
			 }}

				}}
									if(($num_pass)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','database สำเร็จ ".($num_pass)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=mikrotikuser';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userเข้า database สำเร็จแล้ว! จำนวนทั้งหมด ".($num_pass)." users','success').then(function () {
    window.location.href ='index.php?page=mikrotikuser';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=mikrotikuser';
   }})</script>";
		exit();}
					}
##################################################################################
}
?>
  <section class="content">
   	<style type="text/css">
	div.dataTables_wrapper {
        min-width: 1200px;
        margin: 0 auto;
    }
  </style>
<form name="name" action="" method="post">
	<div class="<?php print $convert->panel_modify();?>">
	<div class="<?php print $panel_heading;?>"><i class="fa fa-user"></i>
      <strong>HOTSPOT MIKROTIK USERS</strong><?php print $date_time_show;?></div>
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
		                 <th  width="3%"><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>PROFILE</th>
                                            <th>MAC ADDRESS</th>
                                            <th>UP / DOWNLOAD</th>
                                             <!-- <th>START DATE/TIME</th> -->
											 <th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>                                                 </tr>
											<tfoot>   
		                <th  width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                            <th>NO.</th>
											<th>USERNAME</th>
											<th>PROFILE</th>
                                            <th>MAC ADDRESS</th>
                                            <th>UP / DOWNLOAD</th>
                                             <!-- <th>START DATE/TIME</th> -->
											 <th>EXPIRE or COMMENT</th>
											<th class="text-center">ACTION USERS</th>                                                 </tfoot>
                                             </thead>
											  <tbody>
                                               <?php
	                                                $no=0;
													$num =count($ARRAY);
													$num2 =count($ARRAY2);
													for($i=0; $i<$num; $i++){	
													$no++;
													
	if(!empty($ARRAY[$i]['limit-uptime'])){$check_limit=$ARRAY[$i]['limit-uptime'];}else{$check_limit="";}
	
													$check_uptime=$ARRAY[$i]['uptime'];
													$check_status=$ARRAY[$i]['disabled'];
													$profile_check="off";
                                                    $xs_dis="on";
													$xs_enab="on";

					
					$color=$convert->Expire_color($check_limit,$check_uptime,$check_status,$profile_check);
					$href_dis="href=\"index.php?page=disable&return=mik&user=".$ARRAY[$i]['name']."\"";
                    $href_enab="href=\"index.php?page=enable&return=mik&user=".$ARRAY[$i]['name']."\"";    
					$dis_btn_xs=$convert->button_btn_xs_account($account,$href_dis,'',$xs_dis,'','','','','','');
					$enab_btn_xs=$convert->button_btn_xs_account($account,$href_enab,'','',$xs_enab,'','','','','');
                    

					
		$result=$db->selectquery("SELECT * FROM mt_gen WHERE user='".$ARRAY[$i]['name']."'");
		if(!empty($ARRAY[$i]['mac-address'])){$mac =$ARRAY[$i]['mac-address'];}else{$mac = $result['mac_address'];}
		if(!empty($ARRAY[$i]['comment'])){$comment=iconv("tis-620", "utf-8",$ARRAY[$i]['comment']);
		if($ARRAY[$i]['comment']=="counters and limits for trial users"){$comment="";}
		}else{$comment ="";}
		if(!empty($ARRAY[$i]['address'])){$ip =$ARRAY[$i]['address'];}else{$ip = $result['ip_address'];}
		if(!empty($ARRAY[$i]['profile'])){$profile =$ARRAY[$i]['profile'];}else{$profile = "";}
		if(!empty($ARRAY[$i]['password'])){$password =$ARRAY[$i]['password'];}else{$password = "";}

													
													echo "<tr>";
													echo "<td>";
													if($ARRAY[$i]['name']!="default-trial"){
														echo "<center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$ARRAY[$i]['name']."\"></center>";}
														echo "</td>";
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
														if($ARRAY[$i]['dynamic']=="true"){echo "trial";}else{
															echo $ARRAY[$i]['name'];}
                                                        echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                     echo "".$profile."";
						                               echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
                                                     
											
														echo "".$mac."";
                                                        echo "</span></td>";
                                                        echo "<td><span style=\"color:".$color.";\">";
														$bytes_in=$ARRAY[$i]['bytes-in'];if($ARRAY[$i]['bytes-in']=="0"){$bytes_in="";}else if($ARRAY[$i]['bytes-in']<1073741824){$bytes_in="".(round($ARRAY[$i]['bytes-in']/1048576,1))."Mbs/";}
														else if($ARRAY[$i]['bytes-in']>1073741824){$bytes_in="".(round($ARRAY[$i]['bytes-in']/1073741824,2))."Gbs/";}
														$bytes_out=$ARRAY[$i]['bytes-out'];if($ARRAY[$i]['bytes-out']=="0"){$bytes_out="";}else if($ARRAY[$i]['bytes-out']<1073741824){$bytes_out="".(round($ARRAY[$i]['bytes-out']/1048576,1))."Mbs";}
														else if($ARRAY[$i]['bytes-out']>1073741824){$bytes_out="".(round($ARRAY[$i]['bytes-out']/1073741824,2))."Gbs";}
														echo "".$bytes_in."".$bytes_out."";
                                                       echo "</span></td>";
														echo "<td><span style=\"color:".$color.";\">";
							
			
			 $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$profile."'");
            $check_profile=$exp['pro_expire'];
				$sw_time="on";
				
				$dr=$convert->expdate($comment,$check_profile,$sw_time);
                 
				 if(!empty($dr)){echo "หมดอายุ ".$dr; }else{echo $comment;}
                          
                      
					   
					   echo "</span></td>";
						echo "<td class=\"text-right\">";
							$connect=0;
                       for($ii=0; $ii<$num2; $ii++){
						   
						  if($ARRAY2[$ii]['user']==$ARRAY[$i]['name']){
							  $connect=($connect+1);
							
							 
							 // <!--start update mac-address and ip-address to databases-->  //
					$db->update_db("mt_gen",array(
         									"mac_address"  =>  $ARRAY2[$ii]['mac-address'], 
						                    "ip_address"  =>$ARRAY2[$ii]['address']
				                              ),"user='".$ARRAY[$i]['name']."'");
						
						       /*<!--End update --> */
                       
						}}
			##########################################################
						if($connect > 0){
                             $xs_kick="on";
							 $text_online="OnL ".$connect;
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
                    window.location.href = 'index.php?page=kick&return=mik&user=".$ARRAY[$i]['name']."';})\"";
					echo  $kick_btn_xs=$convert->button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$text_online,'','');
					}
			###########################################################			
		   if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs;}else{ echo $enab_btn_xs;}
					
        	###############################################################
					$xs_edit="on";
				   $onclick_edit="onclick=\"swal({
                    title: 'name: ".$ARRAY[$i]['name']."<br>pass: ".$password."',
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
                    window.location.href ='index.php?page=editmikrotikuser&id=".$ARRAY[$i]['name']."';})\"";	 
					echo  $edit_btn_xs=$convert->button_btn_xs_account($account,$onclick_edit,'','','',$xs_edit,'','','',''); 	 
			####################################################################			 
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
                    window.location.href = 'index.php?page=delete&return=mik&id=".$ARRAY[$i]['name']."';})\"";
                   echo  $del_btn_xs=$convert->button_btn_xs_account($account,$onclick_del,$xs_delete,'','','','','','','');      
				####################################################################		
						echo"</td>";
						echo "</tr>";
													
						}
						?>
						 </tbody>
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
		  <form name="add" action="index.php?page=con_adduser_process" method="post"> 
            <div class="<?php print $convert->panel_modify();?>">

                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">Hotspot Add User - สร้างยูสเซอร์</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
						<div class="panel-body">
						<!-- edit here -->
                    <?php

$ARRAY1 = $API->comm("/ip/hotspot/print");
$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
?>
                        <div class="row">
                            <div class="col-md-12 col-md-6">
                                <div class="form-group">
                                   <label for="cardNumber"> <span class="style1">เลือก Servers</span></label>
                                    
                                        <select name="server"  id="server" class="form-control" >
					      <option value="">all</option>
						   <?php
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY1[$i]['name'].$selected.'">'.$ARRAY1[$i]['name'].'</option>';
													}
												?>						 
							</select>
                                        
                                   
                                </div>                            
                            </div>
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
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
                        </div>

						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Username</span></label>
                                   <input name="user" type="text" placeholder="Username" class="form-control" required>  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Password</span></label>
                                    <input name="pass" type="text" placeholder="Password" class="form-control" required>  
									
                                </div>
                            </div>
                        </div>

						 <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">จำกัดเวลาใช้งาน</span></label>
                                    <input name="limit_uptime"  id="limit_uptime" placeholder="Ex.1d or 1h" class="form-control" >
						           </div>                            
                            </div>
							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="style1">E-mail</span></label>
                                   <input name="email" type="email" placeholder="Ex.123@hotmail.com"  class="form-control">  
							  </div>
                                </div>
                            </div>

                        
						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">เจาะจง IP Address</span></label>
                                   <input name="ip" type="text" placeholder="Ex.172.0.0.3"  class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A"  class="form-control">  
									
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

		  <form name="gen" action="index.php?page=con_genuser_process" method="post"> 
            <div class="<?php print $convert->panel_modify();?>">

                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">Hotspot Generate User - สร้างบัตรอินเตอร์เน็ต</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
						<div class="panel-body">
						<!-- edit here -->
                    <?php

$ARRAY1 = $API->comm("/ip/hotspot/print");
$ARRAY = $API->comm("/ip/hotspot/user/profile/print");
?>
                       <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for=""><span class="style1">เลือก Servers</span></label>
                                    <select name="server"  id="server" class="form-control" >
					      <option value="">all</option>
						   <?php
													$num =count($ARRAY1);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														echo '<option value="'.$ARRAY1[$i]['name'].$selected.'">'.$ARRAY1[$i]['name'].'</option>';
													}
												?>						 
							</select>
                                        
                                    </div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">เลือก Package</span></label>
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
                            </div>
                       
						<div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">จำกัดเวลาใช้งาน</span></label>
                                   <input name="limit_uptime" type="text" placeholder="Ex.1d or 1h"  class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">เจาะจง MAC Address</span></label>
                                    <input name="mac" type="text" placeholder="Ex.1A:2A:3A:4A:5A:6A"  class="form-control">  
									
                                </div>
                            </div>
                        </div>
							<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style1">Pattern Charactors</span></label>
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
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style2">Number of users</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="จำนวนuserที่ต้องการสร้าง">
                                    <input name="max_user" type="text"  placeholder="จำนวนuserที่ต้องการสร้าง" value="10" maxlength="3" required class="form-control">
                                </div>
                            </div>                        
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Prefix User</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="Ex. wifishop@  Gen ออกมาจะได้ wifishop@userบัตร"></label>
                                   <input name="fix_user" type="text" placeholder="นำหน้า user"  value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 ">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Prefix Password</span>&nbsp;<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="Ex. pass@ Gen ออกมาจะได้ pass@PassWordบัตร"></label>
                                    <input name="fix_pass" type="text"  placeholder="นำหน้า  password" value="" maxlength="5" class="form-control">  
									
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Username length</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="จำนวนที่ต่อท้าย Prefix User">
                                    <select name="num_user" class="form-control">
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
                        <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Password length</span></label>
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


	
