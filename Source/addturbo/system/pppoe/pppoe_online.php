<?php
				
		$ARRAY = $API->comm("/ppp/active/print");
			$ARRAY2 = $API->comm("/ppp/secret/print");
			if(!empty($_REQUEST['check'])){	
				if($_REQUEST['active']!="set"){
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];
					$num3 =count($ARRAY);
					for($iii=0; $iii<$num3; $iii++){
					if($ARRAY[$iii]['name']=="".$user.""){$user2 = "".$iii."";}
					
					
					
					
				}
				if($active=="remove"){$db->del("pppoe_gen","user='".$user."'");}
					
						$API->comm("/ppp/secret/".$active."", array(
											"numbers" => $user,));
						
						$API->comm("/ppp/active/remove
						                         =.id=".$user2."");
				}
                 
				echo "<script language='javascript'>swal('".$active." Successfully!','".$active." จำนวน ".$num."  users สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=pppoe_online';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=pppoe_online';}})</script>";
				exit();
						
				}}
?>
<section class="content"> 
 
	<form name="name" action="" method="post">
	<div class="<?php print $convert->panel_modify();?>">
     <div class="<?php print $panel_heading;?>"><i class="fa fa-flash"></i><i class="fa fa-user"></i>
                            <strong> PPPOE ONLINE </strong>
         <?php print $date_time_show;?></div>
     <div class="panel-body">
     <div class="table-responsive">
    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>NAME</th>
            <th>IP ADDRESS</th>
			<th>CALLER ID</th>
			<th>UPTIME</th>
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>NAME</th>
            <th>IP ADDRESS</th>
			<th>CALLER ID</th>
			<th>UPTIME</th>
			<th>SESSION TIMELEFT</th>
			<th>COMMENT</th>
            <th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
													   <tbody>
	                                                  <?php
		                                               $num =count($ARRAY);
                                                       $num2 =count($ARRAY2);
		                                              for($i=0; $i<$num; $i++){	
		                                               $no=$i+1;
				// <!--start update mac-address and ip-address to databases-->  //
						$db->update_db("pppoe_gen",array(
         									"caller_id"  =>  $ARRAY[$i]['caller-id'], 
						                    "address"  =>$ARRAY[$i]['address']
				                              ),"user='".$ARRAY[$i]['name']."'");
						/*<!--End update --> */
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$ARRAY[$i]['name']."\"></center></td>";		
													    echo "<td>".$no."</td>";													
														echo "<td>".$ARRAY[$i]['name']."</td>";						echo "<td>".$ARRAY[$i]['address']."</td>";
														echo "<td>".$ARRAY[$i]['caller-id']."</td>";
														echo "<td>".$ARRAY[$i]['uptime']."</td>";
														 echo "<td>";
									$user_seek= $API->comm("/ppp/secret/print", array(
									"from" => $ARRAY[$i]['name'],));
		
							$exp=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$user_seek['0']['profile']."'");
					 echo $convert->exp_time($convert_total,$ARRAY[$i]['comment'],$exp['pro_expire']);


				                                       echo "</td>";
														 echo "<td>";
                                                        for($ii=0; $ii<$num2; $ii++){
                                                                if($ARRAY2[$ii]['name']==$ARRAY[$i]['name']){
                                                            echo iconv("tis-620", "utf-8",$ARRAY2[$ii]['comment']);

                                                                }else{//
																}

                                                        }       echo "</td>";
														 echo "<td class=\"text-center\">";
                                                        $xs_kick="on";
														$text_kick="Kick";
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
                    window.location.href = 'index.php?page=kick&return=pppoe&user=".$ARRAY[$i]['name']."';})\"";
					echo  $convert->button_btn_xs_account($account,$onclick_kick,'','','','',$xs_kick,$text_kick,'','');
					                        
				
				                                               echo "</td>";
			                                                   echo "</tr>";

}
?>
                                                  </tbody>
                                                 </table>
                                                 </div>

                                       <div class="form-group input-group">                                        
                                       &nbsp;&nbsp;&nbsp;
									   <?php
                                             $delete_use="on";
									  $disable_use="on";
									 
                               $del=$convert->botton_account($account,$delete_use,'','','','','','');
                               $dis=$convert->botton_account($account,'',$disable_use,'','','','','');
							   
									echo $del ;
									echo $dis;
									
				                             ?>
                      </div>
					   </div>
					    </div>
						</form>
				<script src="../assets/js/date-time.js"></script>		
  </section>

	   