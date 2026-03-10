<?php
		
			$ARRAY = $API->comm("/ppp/profile/print");	
		
		if(!empty($_GET['cancel'])){$db->del("mt_edit","mt_id ='".$id."'");
				//echo "<meta http-equiv='refresh' content='0;url=index.php?page=mikrotikuser' />";
				}
		if(!empty($_REQUEST['check'])){	
			if($_REQUEST['active']=="remove"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$profile=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
					$db->del("pppoe_pro","pro_name = '".$profile."'");
		
		
		$ARRAY = $API->comm("/ppp/profile/remove", array(
											"numbers" => $profile,
										));	
							
				}
				
				echo "<script language='javascript'>swal('Delete Successfully!','ลบ  ".$num." จำนวน  สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_profile_list';}, function (dismiss) {
  if (dismiss === 'overlay') {
    
     window.location.href = 'index.php?page=pppoe_profile_list';
   
  }
})</script>";
				exit();
			}
	#######################################################
			if($_REQUEST['active']=="transfer"){
			
			$group_code=round(date('YmdHi.s'));
			$num_check=0;
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$pro_add=$_REQUEST['check'][$i];
					
		$rows1=$db->rows_num("SELECT * FROM pppoe_pro WHERE pro_name='".$pro_add."'");
		
		if($rows1 >0){
			
		
         echo "<script language='javascript'>swal('Error Profile name Try again!','มีชื่อ นี้แล้วใน database กรุณาเลือกใหม่!','error').then(function () {window.location.href='index.php?page=pppoe_profile_list';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href = 'index.php?page=pppoe_profile_list';}})</script>";
		
		 
		}else{	
		
					$num=count($_REQUEST['check']);
			
			$db->add_db("mt_edit",array(
				         "user"        =>  $pro_add,
				         "group_code"   =>   $group_code,
				          "mt_id"        => $id
				)); 
			
			}} 
			
			
	if(!empty($num)){
		$rows=$db->rows_num("SELECT * FROM mt_edit WHERE group_code='".$group_code."'");		
			
	    if($rows==$num){
				
	echo "<script language='javascript'>swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะเพิ่ม โปรไฟล์เข้า database ".$rows." จำนวน จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=pppoe_transfer_profile&group_code=".$group_code."';}
					, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel','overlay') {
						   window.location.href = 'index.php?page=pppoe_profile_list&cancel=yes';}})</script>";
				exit();
				
				
				}else{echo "<script language='javascript'>swal('Error to Count Try again!','เกิดผิดพลาดในการนับจำนวน หรือชื่อซํ้า กรุณาลองใหม่!','error').then(function () {window.location.href='index.php?page=pppoe_profile_list&cancel=yes';}, function (dismiss) {if (dismiss === 'overlay') {window.location.href = 'index.php?page=pppoe_profile_list&cancel=yes';}})</script>";}	
					
					
					
				}}	
			
	##########################################
			
		}
		
									   								
	
?>
   
   <section class="content"> 
  
   <form name="name" action="" method="post">
                     <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong> PPPOE PROFILES LIST </strong>
                        <?php print $date_time_show;?></div>
                        <div class="panel-body">
						<?php 
									$tran_use="on";
									$text="select transfer to database profile";
							  $tran=$convert->botton_small_account($account,'','','','',$tran_use,$text,'','');
							  echo "<span  style=\"float: right; \">".$tran."</span>";
	                       ?><br><br>
	                       <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>   
											<th width="3%"><center><input type="checkbox" id="selecctall"/></th>  
                                            <th>NO.</th>                                                                         	
                                            <th>NAME</th>
                                            <th>RATE LIMIT</th>                                            
                                            <th>SESSION TIMEOUT</th>
                                            <th>LOCAL ADDRESS</th>
                                            <th>REMOTE ADDRESS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php
													$i=0;
													$num =count($ARRAY);													
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
													echo "<tr>";
														echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$ARRAY[$i]['name']."\"></center></td>";		
													    echo "<td>".$no."</td>";																																							
														echo "<td>".$ARRAY[$i]['name']."</td>";
														echo "<td>";
															if($ARRAY[$i]['rate-limit']==""){
																echo "Unlimited";
															}else{
																echo $ARRAY[$i]['rate-limit'];
															}																
														echo "</td>";
														echo "<td>".$ARRAY[$i]['session-timeout']."</td>";
														echo "<td>".$ARRAY[$i]['local-address']."</td>";
														echo "<td>".$ARRAY[$i]['remote-address']."</td>";
														//echo "<td><a href='index.php?page=editprofile&name=".$ARRAY[$i]['name']."'><button type=\"button\" class=\"btn btn-warning\"><i class=\"fa fa-pencil-square-o\" title='Edit Profile'></i></button></a></td>";
														echo "<td><a class='btn btn-info btn-xs' title=\"click to edit\" href='index.php?page=pppoe_edit_profile&name=".$ARRAY[$i]['name']."'><span class=\"glyphicon glyphicon-edit\"></span> แก้ไข  </a></td>";
														
													echo "</tr>";
													}
												?>
												 </tbody>
                               </table>
                               </div>
                            <div class="form-group input-group">                                        
                              </br>        
									   <?php
									    $bottonbtn_danger="on";
				$text_danger="<i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_danger,'',$bottonbtn_danger,'','','','');
									  
				                       ?>
                                     </div>
				  </div>
				  </div>
				 
				  </form>
				<script src="../assets/js/date-time.js"></script>  
  </section>
    
