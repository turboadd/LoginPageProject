

  <?php
		
			if(!empty($_REQUEST['check'])){
############################################################################
			if($_REQUEST['active']=="remove"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
					$db->del("mt_gen","user='".$user."'");
				   /*  $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
											"numbers" => $user,
										));
					$ARRAY = $API->comm("/tool/user-manager/user/remove", array(
											"numbers" => $user,
										)); */
							
										
				}
				
				
				echo "<script language='javascript'>swal('Delete Successfully!','ลบจำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
				window.location.href = 'index.php?page=user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {window.location.href = 'index.php?page=user&id=".$_GET['id']."';}})</script>";
				exit();
						
		}
##########################################################################
		if($_REQUEST['active']=="print"){
			$group_print=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
        
        $db->update_db("mt_gen",array(
            "group_code" => $group_print
				),"user='".$user."'");

                                     }


      echo "<script language='javascript'>javascript:window.open('../csv/print_card.php?to=group_code&id=".$group_print."')</script>";}
####################################################################
		if($_REQUEST['active']=="csv"){
			$group_print=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
        $db->update_db("mt_gen",array(
            "group_code" => $group_print
				),"user='".$user."'");
    }

      echo "<script language='javascript'>javascript:window.open('../csv/export_csv.php?to=group_code&code=hotspot&id=".$group_print."')</script>";}
################################################################
            $ARRAY1 = $API->comm("/ip/hotspot/print");
            $ARRAY2 = $API->comm("/ip/hotspot/user/print");
            $ARRAY3 = $API->comm("/tool/user-manager/user/print");
			$ARRAY4 = $API->comm("/ip/hotspot/user/profile/print");
			$num1 =count($ARRAY1);
	            $num4 =count($ARRAY4);				
				$num2 =count($ARRAY2);
	            $num3 =count($ARRAY3);
	  		if($_REQUEST['active']=="transfer"){
				
				$mik_check=0;
			
			for($d=0;$d < count($_REQUEST['check']);$d++){
					$user_db=$_REQUEST['check'][$d];
					$num=count($_REQUEST['check']);
					
			


	$sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE user='".$user_db."'");
	 $sql->execute();
               while($db_export = $sql->fetch( PDO::FETCH_ASSOC ))	{


		      $db_user=$db_export['user'];                       $db_pass=$db_export['pass'];
          $db_profile=$db_export['profile'];                      //$db_new_group=$db_export['group_name'];
		  $db_limituptime=$db_export['limit_uptime'];if($db_limituptime=="")
		  {$db_limituptime = "00:00:00";}$db_server=$db_export['server_pro'];
		  if($db_server==""){$db_server = "all";}
		  $db_comment=iconv("utf-8", "tis-620",$db_export['comment']);

if($db_server=="all"){
for($p=0; $p<$num4; $p++){if($db_profile==$ARRAY4[$p]['name']){
for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$db_user){$db_user="";$new_mik_fail=$new_mik_fail+($mik_check+1);}}
for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$db_user){$db_user="";$new_man_fail=$new_man_fail+($mik_check+1);}}
    if($db_user!=""){
	$mik_newadd1=$mik_newadd1+($mik_check+1);
					 $ARRAY = $API->comm("/ip/hotspot/user/add", array(
									"server" => $db_server,	
									"name"		=> $db_user,
									"password"	=> $db_pass,
                                    "limit-uptime" => $db_limituptime,
						             "comment"  =>  $db_comment ,
									"profile"	=> $db_profile
			                       ));
	}}}}else{
		for($s=0;$s<$num1; $s++){if($db_server==$ARRAY1[$s]['name']){
		//echo "pass=".$db_user."<br>";
	for($p=0; $p<$num4; $p++){if($db_profile==$ARRAY4[$p]['name']){
for($i=0; $i<$num2; $i++){if($ARRAY2[$i]['name']==$db_user){$db_user="";$new_mik_fail=$new_mik_fail+($mik_check+1);}}	
for($i=0; $i<$num3; $i++){if($ARRAY3[$i]['username']==$db_user){$db_user="";$new_man_fail=$new_man_fail+($mik_check+1);}}
    if($db_user!=""){
	$mik_newadd2=$mik_newadd2+($mik_check+1);
	 $ARRAY = $API->comm("/ip/hotspot/user/add", array(
									"server" => $db_server,	
									"name"		=> $db_user,
									"password"	=> $db_pass,
                                    "limit-uptime" => $db_limituptime,
		                             "comment"  =>  $db_comment ,
									"profile"	=> $db_profile
			                       ));
	
	}}}   }}}}}
					if(($mik_newadd1+$mik_newadd2)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','hotspotสำเร็จ ".($mik_newadd1+$mik_newadd2)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=user&id=".$_GET['id']."';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userสำเร็จแล้ว! จำนวนทั้งหมด ".($mik_newadd1+$mik_newadd2)." users','success').then(function () {
    window.location.href ='index.php?page=user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=user&id=".$_GET['id']."';
   }})</script>";
		exit();}
					
					}	
####################################################################		
if($_REQUEST['active']==""){echo "<script language='javascript'>swal('select error!','ลดจำนวนตัวเลือกลง 999!','error'
).then(function () {
    window.location.href = 'index.php?page=user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=user&id=".$_GET['id']."';
   }})</script>";
				exit();}
#######################################################################
}?>

<section class="content"> 
 
       <div class="row">
         <div class="col-lg-12" >
       <form name="user" action="" method="post">
        <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
						<strong><i class="fa fa-user"></i> HOTSPOT DATABASES USERS</strong>                            
                       <?php print $date_time_show;?> </div>
						 <div class="panel-body">
						 <span ><a href="index.php?page=listuser" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=user&id=<?php echo $_GET['id']; ?>" class="btn btn-default fa fa-rotate-right"></a><?php  echo "<span class=\"\">";           
	                                
									$tran_use="on";
									$text="select transfer to mikrotik user";
							   $tran=$convert->botton_small_account($account,'','','','',$tran_use,$text,'','');
							  echo "<span  style=\"float: right; \">".$tran."</span>";
	                        ?></span><br><br>
                       <div class="table-responsive">
						<table class="table table-striped table-hover" id="dataTables-example">
                                  <thead>
                                        <tr>   
											<th width="3%"><input type="checkbox" id="selecctall"/></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th> 
											<th>PASSWORD</th>
                                            <th>PROFILES</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tr>
										 <tfoot>   
											<th width="3%"><input type="checkbox" id="selecctall1"/></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th> 
											<th>PASSWORD</th>
                                            <th>PROFILES</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th class="text-center">ACTION</th>                                                                                        
                                        </tfoot>
                                    </thead>
                                    <?php
										
													$id=$_GET['id'];
													 $no=1;
													
				
			$sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE profile='".$id."'");
	        $sql->execute();
	          
            while($result = $sql->fetch( PDO::FETCH_ASSOC )){	
		         $no++;        
														echo "<tr>";
															echo "<td><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$result['user']."\"></td>";		
															echo "<td>".$no."</td>";								
															echo "<td>".$result['user']."</td>";
															echo "<td>".$result['pass']."</td>";
															echo "<td>".$result['profile']."</td>";	
															echo "<td>".$result['comment']."</td>";
															echo "<td class=\"text-center\">";
                                                      echo $convert->Convert_time($result['comment']);
						
															echo"</td>";
															echo "<td class=\"text-center\">";
														if($_SESSION['customer_login'] != 1) {
													   echo "<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-info btn-xs dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" onclick=\"swal({
                                                         title: 'เลือกดำเนินการ?',
                                                          text: '".$result['user']."',
                                                       type: 'question',
                                                      showCloseButton: true,
                                                showCancelButton: true,
                                                 confirmButtonColor: '#ff8000',
                                                  cancelButtonColor: '#d33',
                                                   confirmButtonText: 'แก้ไข!',
                                                    cancelButtonText: 'ลบ!',
                                                    //confirmButtonClass: 'btn btn-success',
                                                       //cancelButtonClass: 'btn btn-black',
                                                               // buttonsStyling: false
                                                               }).then(function () {
                                                              window.location.href = 'index.php?page=edituser&return=DB&code=".$_GET['id']."&id=".$result['user']."';
                                                          }, function (dismiss) {
                       // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                           if (dismiss === 'cancel') {
                      swal({
                     title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$result['user']."  จริงหรือไม่ ?',
                    type: 'warning',
	                showCloseButton: true,
	                showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
														}).then(
                    function () {
                    window.location.href = 'index.php?page=delete&return=DB&code=".$csv_code."&id=".$result['user']."';})}})\"> เลือกดำเนินการ <span ></button></div>";
			}
													   echo "</td>";
														echo "</tr>";
													
													}
												?>
                                  </table>
                                  </div>
                         </div>
								<div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php
									  $print_use="on";
									   $csv_use="on";

									    $bottonbtn_danger="on";
				$text_danger="<i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;";
               $delete =$convert->button_btn_submit_account($account,$text_danger,'',$bottonbtn_danger,'','','','');
                              $pri=$convert->botton_account($account,'','','','',$print_use,'','');
							   $csv=$convert->botton_account($account,'','','','','',$csv_use,'');
									echo $delete;echo $pri;echo $csv;
				                        ?>
									</div>
									   </div>
                                   
									</form>
									 </div>
									   </div>
	<script src="../assets/js/date-time.js"></script>								  
  </section>
									
    