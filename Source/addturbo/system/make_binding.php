<?php
		$host_id=$_GET['id'];
			$from=$_GET['from'];
			$host = $API->comm("/ip/hotspot/".$from."/print", array(
									"from" => $host_id,
								));
			
						if(!empty($_REQUEST['mac'])){
						if($from=="ip-binding"){
						$mac=$_REQUEST['mac'];
								$address=$_REQUEST['address'];if($address==""){$address="0.0.0.0";}
								$to_address=$_REQUEST['to_address'];if($to_address==""){$to_address="0.0.0.0";}
								$type=$_REQUEST['type'];
								$comment=iconv("utf-8","tis-620",$_REQUEST['comment']);
								$server=$_REQUEST['server'];

						$ARRAY= $API->comm("/ip/hotspot/ip-binding/set", array(
                    "mac-address"   => $mac,
                    "address"       => $address,
                    "to-address"    => $to_address,
                    "type"          => $type,
                    "comment"       => $comment,
					"server"       => $server,
					"numbers"       => $host_id,
                ));

						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$mac." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
						exit();
						
						}
						if($from=="host"){
						$ARRAY = $API->comm("/ip/hotspot/ip-binding/print"); 
							$num =count($ARRAY);
							for($i=0; $i<$num; $i++){
							if($_REQUEST['mac']==$ARRAY[$i]['mac-address']){
							$bind_mac=$i;}}
						 if($bind_mac){
						        $mac=$_REQUEST['mac'];
								$address=$_REQUEST['address'];if($address==""){$address="0.0.0.0";}
								$to_address=$_REQUEST['to_address'];if($to_address==""){$to_address="0.0.0.0";}
								$type=$_REQUEST['type'];
								$comment=iconv("utf-8","tis-620",$_REQUEST['comment']);
								$server=$_REQUEST['server'];

						$ARRAY= $API->comm("/ip/hotspot/ip-binding/set", array(
                    "mac-address"   => $mac,
                    "address"       => $address,
                    "to-address"    => $to_address,
                    "type"          => $type,
                    "comment"       => $comment,
					"server"       => $server,
					"numbers"       => $bind_mac,
                ));

						echo "<script language='javascript'>swal('Save Done!','แก้ไข  ".$mac." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
						exit();		 
								
						 }else{
							 
							    $mac=$_REQUEST['mac'];
								$address=$_REQUEST['address'];if($address==""){$address="0.0.0.0";}
								$to_address=$_REQUEST['to_address'];if($to_address==""){$to_address="0.0.0.0";}
								$type=$_REQUEST['type'];
								$comment=iconv("utf-8","tis-620",$_REQUEST['comment']);
								$server=$_REQUEST['server'];

						$ARRAY= $API->comm("/ip/hotspot/ip-binding/add", array(
                    "mac-address"   => $mac,
                    "address"       => $address,
                    "to-address"    => $to_address,
                    "type"          => $type,
                    "comment"       => $comment,
					"server"       => $server,
					    ));
							 
						echo "<script language='javascript'>swal('Save Done!','เพิ่ม  ".$mac." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=ip_binding';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=ip_binding';}})</script>";
						exit();	 
							 
							 
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
                   
                        <strong><i class="fa fa-thumb-tack"></i>&nbsp;&nbsp;Set Binding</strong>
                    <?php print $date_time_show;?></div>
					<div class="panel-body">
                    <form name="login" action="" method="post">
					
                         
						   
						   <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Mac-address</span></label>
                                   <input name="mac" type="text" placeholder="mac-address" class="form-control" value="<?php echo $host['0']['mac-address'];?>" required>  
									</div>
                                </div>
								<?php $host_server=$host['0']['server'];if($host_server==""){$host_server="all";} ?>
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Server</span></label>
                                   <select name="server"  id="server" class="form-control" required>
					      <option value="<?php echo $host_server; ?>"><?php echo $host_server; ?></option>
						 
                                            	<?php
												$ARRAY = $API->comm("/ip/hotspot/print");
													$num =count($ARRAY);
													if($host_server!="all"){
																echo '<option value="all">all</option>';}
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$host['0']['server']){
															
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
                                    <label for="cardExpiry"><span class=" style1">Address</span></label>
                                   <input name="address" type="text" placeholder="address" class="form-control" value="<?php echo $host['0']['address'];?>" >  
									</div>
                                </div>
								

							<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">To-address</span></label>
                                   <input name="to_address" type="text" placeholder="to-address" class="form-control" value="<?php echo $host['0']['to-address'];?>" >  
									</div>
                                </div>
								</div>

								
								

								<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Bridge Port</span></label>
                                   <input name="bridge_port" type="text" placeholder="unknown" class="form-control" value="<?php echo $host['0']['bridge-port'];?>" >  
									</div>
                                </div>
								
                               <div class="col-xs-12  col-md-6">
							   <?php
								$ARRAY = $API->comm("/ip/hotspot/ip-binding/print"); 
								$num4 =count($ARRAY);
													for($i=0; $i<$num4; $i++){
														if($host['0']['to-address']==$ARRAY[$i]['to-address']){
								$bind=$ARRAY[$i]['type'];}}?>
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Type</span></label>
									<select class="form-control" name="type" required>
                                  
						<?php if(!empty($bind)){  ?><option value="<?php echo $bind;?>"><?php echo $bind;?></option><?php };?>
                                    <?php if($bind!="regular"){  ?><option value="regular">regular</option><?php };?>
                                    <?php if($bind!="bypassed"){  ?><option value="bypassed">bypassed</option><?php };?>
                                    <?php if($bind!="blocked"){  ?><option value="blocked">blocked</option><?php };?>
                                </select> 
									</div>
                                </div>
								</div>

								<div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="Comment"  class="form-control" value="<?php echo iconv("tis-620", "utf-8",$host['0']['comment']);?>">  
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
						 <?php	if($_GET['from']=="host"){ ?>
                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=hostonline'">&nbsp;&nbsp;&nbsp;
						 <?php	}else{ ?>
						  <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=ip_binding'">&nbsp;&nbsp;&nbsp;
						 <?php	} ?>
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
                    
                   
                    <li>ตัวอย่าง การเจาะจง MAC Address > <strong>00:FD:AE:98:65:AA</strong></li>
					 <li>ตัวอย่าง การเจาะจง Address > <strong>192.168.1.20</strong></li>
					  <li>ตัวอย่าง การเจาะจง To Address > <strong>192.168.1.20</strong></li>
					<li>regular รูปแบบปกติ </li>
					<li>bypassed รูปแบบ การเข้าถึงอินเตอร์เน็ตโดยไม่ต้อง login </li>
                   <li>blocked รูปแบบ การปิดกัน ไม่ไห้เข้าถึงอินเตอร์เน็ต โดยกำหนดเป็นรูปแบบเฉพาะ mac-address ก็ได้</strong> </li>
                </ul>
            </p>
			</div>
			</div>
		 <script src="../assets/js/date-time.js"></script>
  </section>