<?php
				
			$ARRAY = $API->comm("/ip/hotspot/walled-garden/ip/print");
			if(!empty($_REQUEST['check'])){
       	
				for($i=0;$i < count($_REQUEST['check']);$i++){
					$user=$_REQUEST['check'][$i];
					$num1=count($_REQUEST['check']);
					$active = $_REQUEST['active'];if($active=="remove"){$acctive = "DELETE";}
				
				  
                        $API->comm("/ip/hotspot/walled-garden/ip/".$active."
						                         =.id=".$user."");
				}
                 
				
				echo "<script language='javascript'>swal('".$active." ".$num1." จำนวน  สำเร็จแล้ว!','','success').then(function () {
    window.location.href = 'index.php?page=walled_garden_ip';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=walled_garden_ip';}})</script>";
				exit();
						
	
        
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
     <div class="<?php print $panel_heading;?>"><i class="fa fa-internet-explorer "></i><i class="fa fa-us"></i>
                            <strong> Walled Garden ip List</strong><?php print $date_time_show;?></div>
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
							   ///$small_edi=$convert->botton_small_account($account,'','','',$small_edit_use,'','','','');
									echo $small_del ;
									echo $small_dis;
									echo $small_ena;
									///echo $small_edi;
							        
									$add_wg="on";
									
									$text="Walled Garden ip";
									
							  $wg=$convert->botton_small_account($account,'','','','','',$text,$add_wg,'');
							 
							  echo "<span  style=\"float: right; \">".$wg."</span>";		
	                       ?>
     </span><br><br>
     <div class="table-responsive">

    <table class="table table-striped table-hover" id="dataTables-example">
    <thead>
    <tr>
            <th width="3%"><input type="checkbox" id="selecctall"/></th>
			<th>NO.</th>
            <th>SERVER</th>
            <th>Scr. ADDRESS</th>
			<th>Dst. ADDRESS</th>
			<th>PROTOCOL</th>
			<th>Dst.PORT</th>
			<th>Dst.HOST</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tr>
													 <tfoot>
           <th width="3%"><input type="checkbox" id="selecctall1"/></th>
			<th>NO.</th>
            <th>SERVER</th>
            <th>Scr. ADDRESS</th>
			<th>Dst. ADDRESS</th>
			<th>PROTOCOL</th>
			<th>Dst.PORT</th>
			<th>Dst.HOST</th>
			<th>COMMENT</th>
			<th class="text-center">ACTION</th>
                                                     </tfoot>
                                                      </thead>
	                                                  <?php

                                         

		                                           $num2 =count($ARRAY);
                                                      // $num2 =count($ARRAY2);
		                                              for($i=0; $i<$num2; $i++){	
		                                               $no=$i+1;

													   
													$check_status=$ARRAY[$i]['disabled'];
													$profile_check="off";
													$xs_dis="on";
													
				$xs_enab="on";
                $href_dis="href=\"index.php?page=disable&return=wg&user=".$i."\"";
                $href_enab="href=\"index.php?page=enable&return=wg&user=".$i."\"";    
				$dis_btn_xs=$convert->button_btn_xs_account($account,$href_dis,'',$xs_dis,'','','','','','');
				$enab_btn_xs=$convert->button_btn_xs_account($account,$href_enab,'','',$xs_enab,'','','','','');
				$color=$convert->Expire_color('','',$check_status,$profile_check);
	

                                                        echo "<tr>";
													    echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"".$i."\"></center></td>";		
													    echo "<td><span style=\"color:".$color.";\">".$no."</span></td>";													
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['server']."</span></td>";											
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['src-address']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['dst-address']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['protocol']."</span></td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['dst-port']."</span></td>";
							echo "<td><span style=\"color:".$color.";\">".$ARRAY[$i]['dst-host']."</span></td>";
														echo "<td><span style=\"color:".$color.";\">".iconv("tis-620", "utf-8",$ARRAY[$i]['comment'])."</span></td>";
														echo "<td class=\"text-right\">";
				echo "<button class=\"btn btn-primary btn-xs\"  data-toggle=\"tooltip\" type=\"button\" title=\"สถานะ ".$ARRAY[$i]['action']."\" >".$ARRAY[$i]['action']."</button>&nbsp;&nbsp;";				
			    if($ARRAY[$i]['disabled']=="false"){echo $dis_btn_xs;}else{ echo $enab_btn_xs;}
			   echo"<a class=\"btn btn-warning disabled btn-xs\"  href=\"index.php?page=edit_wg&id=".$i."\" title=\"click to edit\"  ><span class=\"fa fa-edit \"></span> แก้ไข </a>&nbsp;&nbsp;&nbsp;";
				###########################################################			
		   ####################################################################			 
					$xs_delete="on";
				$onclick_del="onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  No.".($i+1)." จริงหรือไม่ ?',
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
                    window.location.href = 'index.php?page=delete&return=wg&id=".$i."';})\"";
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
							   ///$edi=$convert->botton_account($account,'','','',$edit_use,'','','');
							    
									echo $del ;
									echo $dis;
									echo $ena;
									///echo $edi;
						
										                       ?>

									    </div>
										 </div>
										  </div>
										  </form>
										  <!-- Modal add-->
					<form name="add" action="index.php?page=add&return=wg" method="post">
        <div class="modal fade" id="modeladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="width: 500px;">
                 <div class="<?php print $convert->panel_modify();?>">
                        <div class="box-header with-border">
                           <h3 class="box-title">Add Walled Garden ip </h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body"> 
                         <div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Src.Address</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ไอพีเครื่องในวง hotspot ที่ต้องการ bypass ให้ใช้งานเว็บไซต์ได้">
                                   <input name="src_addr" type="text" placeholder="0.0.0.0" class="form-control" >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Dst.Address</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ไอพีเว็บไซต์ ที่จะให้ user สามารถเข้าไปดูได้ ถ้ากำหนดตรงนี้ไม่ต้องกำหนดที่ Dst.Host">
                                   <input name="dst_addr" type="text" placeholder="0.0.0.0" class="form-control"  >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Dst.Port</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ถ้ากำหนด จะหมายถึงเจาะจง TCP port number ที่จะให้ใช้งานได้">
                                   <input name="dst_port" type="text" placeholder="0-65535" class="form-control" >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Dst.Host</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ชื่อเวปไซต์หรือโฮสติ้ง ที่จะ bypass ให้userใช้งาน เช่น www.google.com ถ้ากำหนดตรงนี้ไม่ต้องกำหนดที่ Dst.Address">
                                   <input name="dst_host" type="text" placeholder="www.google.com" class="form-control" >  
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Server</span></label>
                                   <select name="server"  id="server" class="form-control" >
					      <option value="">all</option>
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
                                    <label for="cardExpiry"><span class=" style1">Action</span></label>
									<img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="accept=อนุญาตให้เข้าถึงหน้าเว็บโดยไม่ต้องlogin">
                                   <select class="form-control" name="action" required>
                                    <option value="accept">accept</option>
                                    <option value="drop">drop</option>
                                    <option value="reject">reject</option>
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
                            
                            
						
							
            		   <input type="hidden" value="<?php echo $num2;?>" name="count">
                      <div class="row">
						<div class="col-lg-12 col-md-12 " >
					                    <?php
		                
						 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>

                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=walled_garden_ip'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
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