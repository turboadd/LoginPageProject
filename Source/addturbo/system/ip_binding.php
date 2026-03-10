<?php
				
			
			$ARRAY = $API->comm("/ip/hotspot/ip-binding/print");
			// $ARRAY2 = $API->comm("/ip/hotspot/ip-binding/print");
			if(!empty($_REQUEST['check'])){
           if($_REQUEST['active']!="add"){		
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
				
				  
                       $API->comm("/ip/hotspot/ip-binding/".$active."
						                         =.id=".$user."");
				}
                 
				
				echo "<script language='javascript'>swal('".$active." ".$num." จำนวน  สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
				exit();
						
		}else{///add to netwatch
		for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];///if($active=="remove"){$acctive = "DELETE";}index.php?page=con_add_netwatch
		            
                   $host= $API->comm("/ip/hotspot/ip-binding/print", array(
									"from" => $user,
								));
                    $up=":log warning \":host failed:ping ".$host['0']['to-address']." link up\";";
	                $down=":log error \":host failed:ping ".$host['0']['to-address']." link down\";";
                   
				   
				   $ARRAY2 = $API->comm("/tool/netwatch/add", array(
									  "host" => $host['0']['to-address'],	
									  "interval"     => "00:10:00",
									  "timeout" => "5000ms",	
									  "comment"  => $host['0']['comment'] ,
									  "up-script"  => $up ,
									  "down-script"  => $down ,
							));
		}
		echo "<script language='javascript'>swal('Save Done!','เพิ่ม Netwatch จำนวน ".$num." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';
   }})</script>";
		exit();
		
		
		}
        
		}
?>
 <section class="content"> 

	<form name="name" action="" method="post">
	<div class="<?php print $convert->panel_modify();?>">
     <div class="<?php print $panel_heading;?>"><i class="fa fa-thumb-tack "></i><i class="fa fa-us"></i>
                            <strong> IP BINDING</strong><?php print $date_time_show;?></div>
     <div class="panel-body">
	 <span><?php            
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
									 // $small_edit_use="on";
									 $text_del="select to remove"; $text_dis="select to disable";
                               $small_del=$convert->botton_small_account($account,$small_delete_use,'','','','',$text_del,'','');
                               $small_dis=$convert->botton_small_account($account,'',$small_disable_use,'','','',$text_dis,'','');
							   $small_ena=$convert->botton_small_account($account,'','',$small_enable_use,'','','','','');
							   //$small_edi=$convert->botton_small_account($account,'','','',$small_edit_use,'','','','');
									echo $small_del ;
									echo $small_dis; 
									echo $small_ena;
									///echo $small_edi;
							        
									$add_bin="on";
									$add_net="on";
									$text="Add binding";
									$text_net="select to add netwatch";
							  $bind=$convert->botton_small_account($account,'','','','','',$text,$add_bin,'');
							  $netw=$convert->botton_small_account($account,'','','','','',$text_net,'',$add_net);
							  echo "<span  style=\"float: right; \">".$bind."".$netw."</span>";		
	                       ?>
     </span><br><br>
     <div class="table-responsive">

    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>ADDRESS</th>
            <th>TO ADDRESS</th>
			<th>MAC ADDRESS</th>
			<th>SERVER</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
            <th width="3%"><input type="checkbox" id="selecctall1"/></th>
			<th>NO.</th>
            <th>ADDRESS</th>
            <th>TO ADDRESS</th>
			<th>MAC ADDRESS</th>
			<th>SERVER</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
	                                                  <?php

                                         

		                                               $num =count($ARRAY);
                                                      // $num2 =count($ARRAY2);
		                                              for($i=0; $i<$num; $i++){	
		                                               $no=$i+1;

													   
													$check_status=$ARRAY[$i]['disabled'];
													$profile_check="off";
													$xs_dis="on";
													
				$xs_enab="on";
                $href_dis="href=\"index.php?page=disable&return=binding&user=".$i."\"";
                $href_enab="href=\"index.php?page=enable&return=binding&user=".$i."\"";    
				$dis_btn_xs=$convert->button_btn_xs_account($account,$href_dis,'',$xs_dis,'','','','','','');
				$enab_btn_xs=$convert->button_btn_xs_account($account,$href_enab,'','',$xs_enab,'','','','','');
				$color=$convert->Expire_color('','',$check_status,$profile_check);
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$i."\"></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";													
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['address']."</span></td>";											
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['to-address']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['mac-address']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['server']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</span></td>";
														echo "<td class=\"text-right\">";
													
				
				$P = $ARRAY[$i]['type'];if($P=="bypassed"){$P = "P";}else{$P = "";}
				$B = $ARRAY[$i]['type'];if($B=="blocked"){$B = "B";}else{$B = "";}
				$R = $ARRAY[$i]['type'];if($R==""){$R = "R";}else{$R = "";}
                $TP = "".$P."".$B."".$R."-".$ARRAY[$i]['type'];

				
				
               
                if($ARRAY[$i]['type']){
               echo "<button class=\"btn btn-default btn-xs\" title= \"".$TP."\" data-toggle=\"tooltip\" type=\"button\" ><span>".$P."".$B."".$R."</span></button>&nbsp;&nbsp;";}

			    if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs;}else{ echo $enab_btn_xs;}
			   echo"<a class=\"btn btn-warning btn-xs\"  href=\"index.php?page=make_binding&id=".$i."&from=ip-binding\" title=\"click to edit\"  ><span class=\"fa fa-edit \"></span> แก้ไข </a>&nbsp;&nbsp;&nbsp;";
				###########################################################			
		   ####################################################################			 
					$xs_delete="on";
				$onclick_del="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['mac-address']."  จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=delete&return=binding&id=".$i."';})\"";
                   echo  $del_btn_xs=$convert->button_btn_xs_account($account,$onclick_del,$xs_delete,'','','','','','','');      
				####################################################################
			   echo "</td>";
			   echo "</tr>";

}
?>
 
    </table>
    </div>
	 <br>
	<div class="form-group input-group">

	 <?php

	  

								
									  $delete_use="on";
									  $disable_use="on";
									  $enable_use="on";
									 // $edit_use="on";
									$text_del=	"select to remove";
	                               $text_dis="select to disable"; 
                               $del=$convert->botton_account($account,$delete_use,'','','','','',$text_del);
                               $dis=$convert->botton_account($account,'',$disable_use,'','','','',$text_dis);
							   $ena=$convert->botton_account($account,'','',$enable_use,'','','','');
							   //$edi=$convert->botton_account($account,'','','',$edit_use,'','','');
							    
									echo $del ;
									echo $dis; 
									echo $ena;
									//echo $edi;
						
										                       ?>

									    </div>
										 </div>
										  </div>
										  </form>
										  <!-- Modal add-->
										  <form name="add" action="index.php?page=add&return=ip_binding" method="post">
        <div class="modal fade" id="modeladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="width: 500px;">
                 <div class="<?php print $convert->panel_modify();?>">
                        <div class="box-header with-border">
                           <h3 class="box-title">Add Binding </h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body"> 
                         <div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Mac-address</span></label>
                                   <input name="mac" type="text" placeholder="mac-address" class="form-control" required>  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Address</span></label>
                                   <input name="address" type="text" placeholder="address" class="form-control"  >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">To-address</span></label>
                                   <input name="to_address" type="text" placeholder="to-address" class="form-control" >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Server</span></label>
                                   <select name="server"  id="server" class="form-control" required>
					      <option value="all">all</option>
						   <?php
													$ARRAY = $API->comm("/ip/hotspot/print");
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
                                    <label for="cardExpiry"><span class=" style1">Type</span></label>
                                   <select class="form-control" name="type" required>
                                    <option value="regular">regular</option>
                                    <option value="bypassed">bypassed</option>
                                    <option value="blocked">blocked</option>
                                </select> 
									</div>
                                </div>
								</div>

								<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="comment"  class="form-control" >  
							  </div>
                                </div>
	                        	 </div>
                            
                            
						
							
            
                      <div class="row">
						<div class="col-lg-12 col-md-12 " >
					                    <?php
		                
						 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>

                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=ip_binding'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						 <span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button></span>
                        </div>
						</div>   
                                
                            </div>
                        </div>
                    </div>
                    </div>

					 </form>
           
			
		<!-- ##############/.Modal PINDetail ####################### -->
										  

										   

	  <script src="../assets/js/date-time.js"></script>
  </section>