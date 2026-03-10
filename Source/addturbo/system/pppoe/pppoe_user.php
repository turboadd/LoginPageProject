<?php
		
		
			$ARRAY = $API->comm("/ppp/secret/print");
			
			
		if(!empty($_REQUEST['check'])){
	############################################################
						if($_REQUEST['active']=="remove"){

				for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					
					
					
					$db->del("pppoe_gen","user='".$user."'");
					
					/*$ARRAY = $API->comm("/ppp/secret/remove", array(
											"numbers" => $user,
										));	*/
							
					
				}
				
				echo "<script language='javascript'>swal('Delete Successfully!','ลบจำนวน ".$num."  users สำเร็จแล้ว.!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['id']."';
   }})</script>";
				exit();}
	#########################################################
			if($_REQUEST['active']=="print"){
			$group_print=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
		$db->update_db("pppoe_gen",array(
            "group_code" => $group_print
				),"user='".$user."'");	
				
     


}echo "<script language='javascript'>javascript:window.open('../csv/print_pppoecard.php?to=group_code&id=".$group_print."')</script>";}
		
####################################################################		
		if($_REQUEST['active']=="csv"){
			$group_code=date('YmdHis');
			for($i=0;$i < count($_REQUEST['check']);$i++){
					
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);

					$db->update_db("pppoe_gen",array(
            "group_code" => $group_code
				),"user='".$user."'");
					
      
		
		}


      echo "<script language='javascript'>javascript:window.open('../csv/export_csv.php?to=group_code&code=pppoe&id=".$group_code."')</script>";


}
####################################################################
          $ARRAY1 = $API->comm("/ppp/secret/print");
           $ARRAY2 = $API->comm("/ppp/profile/print");
			$num1 =count($ARRAY1);
	        $num2 =count($ARRAY2);
	        
	  		if($_REQUEST['active']=="transfer"){
				
				
				$mik_newadd=0;
			for($d=0;$d < count($_REQUEST['check']);$d++){
					$user_db=$_REQUEST['check'][$d];
					$num=count($_REQUEST['check']);
					
			
	$sql=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE user='".$user_db."'");
	 $sql->execute();
               while($db_export = $sql->fetch( PDO::FETCH_ASSOC ))	{

		      $db_user=$db_export['user'];                       $db_pass=$db_export['pass'];
         $db_profile=$db_export['profile'];                       $db_comment=iconv("utf-8", "tis-620",$db_export['comment']);                   
		    $service="pppoe";
for($p=0; $p<$num2; $p++){if($db_profile==$ARRAY2[$p]['name']){
for($i=0; $i<$num1; $i++){if($ARRAY1[$i]['name']==$db_user){$db_user="";}}
if(!empty($db_user)){	$mik_newadd++;
                
				$ARRAY = $API->comm("/ppp/secret/add", array(
									  
		            "service"	=> $service,
						"name"  => $db_user,
						"password" => $db_pass,	
							"profile"  => $db_profile, 
							//	caller-id"  => $db_mac ,
		                        //      "remote-address"  => $ip ,
			                      "comment"  => $db_comment
								  
							));
}
}}
}
}
if(($mik_newadd)!=($num)){
			 echo "<script language='javascript'>swal('Error transfer from ".$num." user!','pppoeสำเร็จ ".($mik_newadd)." กรุณาตรวจสอบ!','info').then(function () {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_user&id=".$_GET['id']."';
   }})</script>";
		exit();}else{echo "<script language='javascript'>swal('transfer Successfully','เพิ่ม  userสำเร็จแล้ว! จำนวนทั้งหมด ".($mik_newadd)." users','success').then(function () {
    window.location.href ='index.php?page=pppoe_user&id=".$_GET['id']."';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href ='index.php?page=pppoe_user&id=".$_GET['id']."';
   }})</script>";
		exit();}
}        
######################################################################
}								   								
?>

<section class="content"> 
 
       <form name="user" action="" method="post">
          <div class="row">
            <div class="col-lg-12" >
                  <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
						<i class="fa fa-user"></i>
                            <strong> PPPOE DATABASES USER </strong>                           
                        <?php print $date_time_show;?></div>
						 <div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=pppoe_dtb_user" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=pppoe_user&id=<?php echo $_GET['id']; ?>" class="btn btn-default fa fa-rotate-right"></a> </span><?php  echo "<span class=\"\">";           
	                                
									$tran_use="on";
									$text="select transfer to mikrotik user";
							   $tran=$convert->botton_small_account($account,'','','','',$tran_use,$text,'','');
							  echo "<span  class=\"box-tools pull-right\">".$tran."</span>";
	                        ?><br><br>
	                        <div class="table-responsive">
							<table class="table table-striped table-hover" id="dataTables-example">
                                  <thead>
                                        <tr>   
											<th width="3%"><center><input type="checkbox" id="selecctall"/></center></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th>
											<th>PASSWORD</th>
                                            <th>PROFILE</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th>ACTION</th>                                                                                        
                                        </tr>
										 <tfoot>   
											<th width="3%"><center><input type="checkbox" id="selecctall1"/></center></th>  
                                        	<th>NO.</th>                                                                         	
                                            <th>USERNAME</th> 
											<th>PASSWORD</th>
                                            <th>PROFILE</th>
											<th>COMMENT</th>
											<th class="text-center">วันที่ Login</th>
                                            <th>ACTION</th>                                                                                        
                                        </tfoot>
                                    </thead>
									<tbody>
                                    <?php
													$csv_code=$_GET['id'];
													
				 $no=0;									
			$sql=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE csv_code='".$csv_code."'");
	        $sql->execute();
	          
            while($result = $sql->fetch( PDO::FETCH_ASSOC )){	
		         $no++;  
														echo "<tr>";
															echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$result['user']."\"></center></td>";		
															echo "<td>".$no."</td>";								
															echo "<td>".$result['user']."</td>";
															echo "<td>".$result['pass']."</td>";
															echo "<td>".$result['profile']."</td>";
															echo "<td>".$result['comment']."</td>";
															echo "<td class=\"text-center\">";
                                                          echo $convert->Convert_time($result['comment']);
															echo"</td>";
															echo "<td >";
													
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
                                                              window.location.href = 'index.php?page=pppoe_edituser&return=pppoe_DB&code=".$_GET['id']."&id=".$result['user']."';
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
                    window.location.href = 'index.php?page=delete&return=pppoe_DB&code=".$csv_code."&id=".$result['user']."';})}})\"> เลือกดำเนินการ <span ></button></div>";			
														   echo "</td>";								
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
									      </div>
										  </div>
										  </div>
										    </form>
			<script src="../assets/js/date-time.js"></script>								
  </section>
    

