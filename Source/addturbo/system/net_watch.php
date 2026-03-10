<?php
		
			$ARRAY = $API->comm("/tool/netwatch/print");
			
			if(!empty($_REQUEST['check'])){
           if($_REQUEST['active']){		
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
				
				  
                        $API->comm("/tool/netwatch/".$active."
						                         =.id=".$user."");
				}
                 
				
				echo "<script language='javascript'>swal('".$active." ".$num." จำนวน  สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';}})</script>";
				exit();
						
		}}
									   								
?>
                 <section class="content"> 
				 
                     <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-link"></i>
                           <strong>NET WATCH</strong><?php print $date_time_show;?>
                        </div>
						 <div class="panel-body">
						 <form name="name" action="" method="post">
						 <span><?php            
	                                 $small_delete_use="on";
									  $small_disable_use="on";
									  $small_enable_use="on";
									 // $small_edit_use="on";
									 $text_del="select to remove"; $text_dis="select to disable";
                               $small_del=$convert->botton_small_account($account,$small_delete_use,'','','','',$text_del,'','');
                               $small_dis=$convert->botton_small_account($account,'',$small_disable_use,'','','',$text_dis,'','');
							   $small_ena=$convert->botton_small_account($account,'','',$small_enable_use,'','','','','');
							 //  $small_edi=$convert->botton_small_account($account,'','','',$small_edit_use,'','','','');
									echo $small_del ;
									echo $small_dis;
									echo $small_ena;
									///echo $small_edi;
							        
									$add_bin="on";
									$text="Add netwatch";
							  $bind=$convert->botton_small_account($account,'','','','','',$text,$add_bin,'');
							  echo "<span  style=\"float: right; \">".$bind."</span>";		
	                       ?>
     </span><br><br>
						 <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
										<th width="3%"><input type="checkbox" id="selecctall"/></th>
                                        	<th>No.</th>
											<th>HOST</th>
											<th>INTERVAL</th>
											<th>TIME OUT</th>
                                            <th>SINCE</th>
											<th>COMMENT</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>

										<tfoot>
										<th width="3%"><input type="checkbox" id="selecctall1"/></th>
                                        	<th>No.</th>
											<th>HOST</th>
											<th>INTERVAL</th>
											<th>TIME OUT</th>
                                            <th>SINCE</th>
											<th>COMMENT</th>
                                            <th class="text-center">ACTION</th>
                                        </tfoot>
                                    <tbody>
                
												<?php
													$num =count($ARRAY);													
													for($i=0; $i<$num; $i++){	
													$no=$i+1;
								$check_status=$ARRAY[$i]['disabled'];
								$profile_check="off";					
								$color=$convert->Expire_color('','',$check_status,$profile_check);					
													
													
													echo "<tr>";
							echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$i."\"></center></td>";																										                    echo "<td><span style=\"color:".$color.";\">".$no."</td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['host']."</td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['interval']."</td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['timeout']."</td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['since']."</td>";
							echo "<td><span style=\"color:".$color.";\">".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</td>";
													   
							echo "<td class=\"text-center\">";
                             if($ARRAY[$i]['status']=="up"){
                            echo "<button href=\"#\" class=\"btn btn-xs btn-success2\" type=\"button\" data-toggle=\"tooltip\" title= \"status up\"><i class=\"fa fa-cog fa-spin\"></i> UP</button>&nbsp;&nbsp;";    
                            }else{
                            echo "<button href=\"#\" class=\"btn btn-xs btn-black\"  type=\"button\" data-toggle=\"tooltip\" title= \"status down\"><i class=\"fa fa-cog\"></i> DN</button>&nbsp;&nbsp;";
                             }
					$xs_dis="on";
					$xs_enab="on";
                   $href_dis="href=\"index.php?page=disable&return=net&user=".$ARRAY[$i]['.id']."\"";
                    $href_enab="href=\"index.php?page=enable&return=net&user=".$ARRAY[$i]['.id']."\"";    
					$dis_btn_xs=$convert->button_btn_xs_account($account,$href_dis,'',$xs_dis,'','','','','','');
					$enab_btn_xs=$convert->button_btn_xs_account($account,$href_enab,'','',$xs_enab,'','','','','');                                  if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs;}else{ echo $enab_btn_xs;} 
					echo"<a class=\"btn btn-warning btn-xs\"  href=\"index.php?page=edit_netwatch&id=".$ARRAY[$i]['.id']."&from=net\" title=\"click to edit\"  ><span class=\"fa fa-edit \"></span> แก้ไข </a>&nbsp;&nbsp;&nbsp;";

					####################################################################			 
					$xs_delete="on";
				$onclick_del="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  ".$ARRAY[$i]['host']."  จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=delete&return=net&id=".$i."';})\"";
                   echo  $del_btn_xs=$convert->button_btn_xs_account($account,$onclick_del,$xs_delete,'','','','','','','');      
				####################################################################
				
							}
							?>
                                                                                                   
                                                                               
                                   </tbody>
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
							 //  $edi=$convert->botton_account($account,'','','',$edit_use,'','','');
							    
									echo $del ;
									echo $dis; 
									echo $ena;
									//echo $edi;
										                       ?>
									    </div>
								</form>
                            </div> 
							 </div>
							  <!-- Modal add-->
        <div class="modal fade" id="modeladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document">
			 <form name="add" action="index.php?page=add&return=netwatch" method="post">
                 <div class="<?php print $convert->panel_modify();?>">
                        <div class="box-header with-border">
                           <h3 class="box-title">Add Netwatch </h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body"> 
                         
						 <div class="row">
                          <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Host</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="โฮสหรือไอพี ที่ต้องการ ping">
                                   <input name="host" type="text" placeholder="Ex. 192.168.1.1" class="form-control" required >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Interval</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="เวลา ที่จะping ต่อครั้ง">
                                   <input name="interval"  value="00:10:00" type="text" placeholder="Ex. 00:10:00" class="form-control" required>  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Timeout/ms</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="1000=1s">
                                   <input name="timeout"  value="5000" type="text" placeholder="Ex. 5000" class="form-control" required>  
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
                         <div class="col-xs-12  col-md-6">
							<div class="form-group">
							<label for="cardExpiry"><span class=" style1">On up</span></label>
								<textarea id="on_up" class="form-control" rows="5" name="on_up" placeholder="Script here" ></textarea>
								
							</div>
						</div>
						<div class="col-xs-12  col-md-6">
							<div class="form-group">
							<label for="cardExpiry"><span class=" style1">On down</span></label>
								<textarea id="on_down" class="form-control" rows="5" name="on_down" placeholder="Script here" ></textarea>
								
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

                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=net_watch'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						 <span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button></span>
                        </div>
						</div>   
                                
                            </div>
                        </div>
                    </form>
                    </div>
					</div>

           
			
		<!-- ##############/.Modal add ####################### -->
      <script src="../assets/js/date-time.js"></script>                		 
  </section>