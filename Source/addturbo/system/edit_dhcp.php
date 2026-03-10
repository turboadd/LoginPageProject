<?php
		
		
		$host_id=$_GET['id'];
			$host = $API->comm("/ip/dhcp-server/lease/print", array(
									"from" => $host_id,
								));
			
						if(!empty($_REQUEST['address'])){
							$mac=$_REQUEST['mac'];
	                     $rate_limit=$_REQUEST['rate_limit'];
	                     $comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
                       $server=$_REQUEST['server'];
	                     $address=$_REQUEST['address'];
						 $h_orig=$host['0']['address'];
                        
						if($host['0']['dynamic']=="false"){
						if($h_orig==$address){//set old address  //
						$API->comm("/ip/dhcp-server/lease/set", array(											
												"server"	=> $server,
												"rate-limit" => $rate_limit,
								                "mac-address"  => $mac ,
		                                       /// "address"  => $address ,
								                "comment"  => $comment ,
			                                   "numbers"	=> $host_id,
									));
                     echo "<script language='javascript'>swal('Save Done!','แก้ไข ".$address." สำเร็จแล้ว!','success').then(function () {
                        window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
                       if (dismiss === 'overlay') {
                                window.location.href = 'index.php?page=dhcp';
                    }})</script>";
		              exit();
						
						}else{//set new address 
							$ARRAY = $API->comm("/ip/dhcp-server/lease/print");
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
												if($ARRAY[$i]['address']==$address){$Fail=1;}
													}
							if($Fail){//set new address error //
								echo "<script language='javascript'>swal('Error address! ".$address."','มีไอพี  ".$address." แล้วใน dhcp lease  กรุณาตั้งใหม่!','error').then(function () {
								window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
								window.history.back();}})</script>";}else{///set new address pass//
									$API->comm("/ip/dhcp-server/lease/set", array(											
												"server"	=> $server,
												"rate-limit" => $rate_limit,
								                "mac-address"  => $mac ,
		                                        "address"  => $address ,
								                "comment"  => $comment ,
			                                   "numbers"	=> $host_id,
									));
                     echo "<script language='javascript'>swal('Save Done!','แก้ไข ".$address." สำเร็จแล้ว!','success').then(function () {
                        window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
                       if (dismiss === 'overlay') {
                                window.location.href = 'index.php?page=dhcp';
                    }})</script>";
		              exit();

							}
							}
							}else{//set make static
                                  

							if($h_orig==$address){//set old address  //
								$API->comm("/ip/dhcp-server/lease/make-static", array(												
												 "numbers"	=> $host_id,));
								$API->comm("/ip/dhcp-server/lease/set", array(											
												"server"	=> $server,
												"rate-limit" => $rate_limit,
								                "mac-address"  => $mac ,
		                                       /// "address"  => $address ,
								                "comment"  => $comment ,
			                                   "numbers"	=> $host_id,
									));
                     echo "<script language='javascript'>swal('Save Done!','แก้ไข ".$address." สำเร็จแล้ว!','success').then(function () {
                        window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
                       if (dismiss === 'overlay') {
                                window.location.href = 'index.php?page=dhcp';
                    }})</script>";
		              exit();
							}else{//set new address 
							$ARRAY = $API->comm("/ip/dhcp-server/lease/print");
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
												if($ARRAY[$i]['address']==$address){$Fail=1;}
													}
							if($Fail){//set new address error //
								echo "<script language='javascript'>swal('Error address! ".$address."','มีไอพี  ".$address." แล้วใน dhcp lease  กรุณาตั้งใหม่!','error').then(function () {
								window.history.back();}, function (dismiss) {if (dismiss === 'overlay') {
								window.history.back();}})</script>";}else{///set new address pass//

									$API->comm("/ip/dhcp-server/lease/make-static", array(												
												 "numbers"	=> $host_id,));
									$API->comm("/ip/dhcp-server/lease/set", array(											
												"server"	=> $server,
												"rate-limit" => $rate_limit,
								                "mac-address"  => $mac ,
		                                        "address"  => $address ,
								                "comment"  => $comment ,
			                                   "numbers"	=> $host_id,
									));
                     echo "<script language='javascript'>swal('Save Done!','แก้ไข ".$address." สำเร็จแล้ว!','success').then(function () {
                        window.location.href = 'index.php?page=dhcp';}, function (dismiss) {
                       if (dismiss === 'overlay') {
                                window.location.href = 'index.php?page=dhcp';
                    }})</script>";
		              exit();

							}
							
							
							}
                                 
							

								}


				
				
				}
			
									   								
?>


<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}

-->
</style>
<section class="content"> 
 

<div class="row">
         <div class="col-lg-12" >
            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                   
                        <strong><i class="fa fa-edit"></i>&nbsp;&nbsp;EDIT DHCP LEASE</strong>
                    <?php print $date_time_show;?></div>
					<div class="panel-body">
                    <form name="login" action="" method="post">
					
                         
						   
						   <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1"><strong>Address</strong></span>
                                   <input name="address" type="text" placeholder="Ex. 192.168.1.50" class="form-control" value="<?php echo $host['0']['address'];?>" required>  
									</div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1"><strong>Mac-address</strong></span>
                                   <input name="mac" type="text" placeholder="Ex. 00:73:E0:B2:23:64" class="form-control" value="<?php echo $host['0']['mac-address'];?>" required>
									</div>
                                </div>
								</div>

								<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1"><strong>Rate-limit</strong></span>
                                   <input name="rate_limit" type="text" placeholder="Ex. 1M/20M (upload/download)" class="form-control" value="<?php echo $host['0']['rate-limit'];?>" >  
									</div>
                                </div>
								
                              
							   <?php $host_server=$host['0']['server'];if($host_server==""){$host_server="all";} ?>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1"><strong>Server</strong></span>
                                   <select name="server"  id="server" class="form-control" required>
					      <option value="<?php echo $host_server; ?>"><?php echo $host_server; ?></option>
						 <?php
												$ARRAY = $API->comm("/ip/dhcp-server/print");
													$num =count($ARRAY);
													if($host_server!="all"){
																echo '<option value="all">all</option>';}
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$host_server){
															
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							</select>
									</div>
                                </div>
								 </div>
								
                                <div class="row">
							   <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <span class=" style1"><strong>Comment</strong></span>
                                   <input name="comment" type="text" placeholder="comment"  class="form-control" value="<?php echo iconv("tis-620", "utf-8",$host['0']['comment']);?>">  
							  </div>
                                </div>
	                        	 </div>
								 <br>
							  
						
						
							
            
                      <div class="row">
						<div class="col-lg-12 col-md-12 " >
					                    <?php
		                
						 $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>
						 <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=dhcp'">&nbsp;&nbsp;&nbsp;
						<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
						 <span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
                        </div>
						</div>
						</form>
						 </div>
                       </div>
                      </div>           
			         </div>
             
                   <div id="manual" class="collapse">
                    <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    
                   
                    <li><strong>Address</strong>  กำหนดไอพีที่จะจองไว้ เช่น 192.168.1.20</li>
					 <li> <strong>Mac-Address</strong>  กำหนด Mac Addressของเครื่อง เช่น 18:CF:5E:FF:15:AA</li>
					  <li><strong>Rate-limit</strong>  กำหนดความเร็ว upload/download ของเครื่องที่เรากำหนด bypass ไว้ก็ได้ เช่น 1M/20M</li>
					  <li><strong>Server</strong>  เลือก dhcp server ชุดไอพีที่ออกเน็ต </li>
					</ul>
            </p>
			</div>
			</div>
	   <script src="../assets/js/date-time.js"></script>
  </section>