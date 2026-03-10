<?php
		
			
			$host_id=$_GET['id'];
			$host = $API->comm("/tool/netwatch/print", array(
									"from" => $host_id,
								));
			
						if(!empty($_REQUEST['host'])){
						$hostset=$_REQUEST['host'];
	                     $interval=$_REQUEST['interval'];
	                     $timeout=$_REQUEST['timeout']."ms";
	                     $mt_comment=iconv("utf-8", "tis-620",$_REQUEST['comment']);
                         $up=$_REQUEST['on_up'];
	                     $down=$_REQUEST['on_down'];
							$ARRAY = $API->comm("/tool/netwatch/set", array(
									  "host" => $hostset,	
									 "interval"     => $interval,
									"timeout" => $timeout,	
									  "comment"  => $mt_comment ,
									  "up-script"  => $up ,
									  "down-script"  => $down ,
									"numbers"=> $host_id, 
							));
		

		echo "<script language='javascript'>swal('Save Done!','แก้ไข ".$hostset." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=net_watch';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=net_watch';
   }})</script>";
		exit();
				
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
                   
                        <strong><i class="fa fa-edit"></i>&nbsp;&nbsp;EDIT NETWATCH</strong>
                    <?php print $date_time_show;?></div>
					<div class="panel-body">
                    <form name="login" action="" method="post">
					
                         
						   
						   <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Host</span></label>
                                   <input name="host" type="text" placeholder="Ex. 192.168.1.1" class="form-control" value="<?php echo $host['0']['host'];?>" required>  
									</div>
                                </div>
								<div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Interval</span></label>
                                   <input name="interval" type="text" placeholder="Ex. 00:01:00" class="form-control" value="00:10:00" required>
									</div>
                                </div>
								</div>

								
								

								<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Timeout</span></label>
                                   <input name="timeout" type="text" placeholder="Ex. 1000" class="form-control" value="5000" required>  
									</div>
                                </div>
								
                               <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style1">Comment</span></label>
                                   <input name="comment" type="text" placeholder="comment"  class="form-control" value="<?php echo iconv("tis-620", "utf-8",$host['0']['comment']);?>">  
							  </div>
                                </div>
	                        	 </div>
							  
						<div class="row">
                         <div class="col-xs-12  col-md-6">
							<div class="form-group">
							<label for="cardExpiry"><span class=" style1">On up</span></label>
								<textarea id="on_up" class="form-control" rows="5" name="on_up" placeholder="Script here" value="<?php echo $host['0']['up-script'];?>"><?php echo $host['0']['up-script'];?></textarea>
								
							</div>
						</div>
						<div class="col-xs-12  col-md-6">
							<div class="form-group">
							<label for="cardExpiry"><span class=" style1">On down</span></label>
								<textarea id="on_down" class="form-control" rows="5" name="on_down" placeholder="Script here" value="<?php echo $host['0']['down-script'];?>"><?php echo $host['0']['down-script'];?></textarea>
								
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
                         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=net_watch'">&nbsp;&nbsp;&nbsp;
						 <?php	}else{ ?>
						  <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="window.location.href = 'index.php?page=net_watch'">&nbsp;&nbsp;&nbsp;
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
                    
                   
                    <li>ตัวอย่าง การ ping host > <strong>192.168.1.20</strong></li>
					 <li> <strong>Interval</strong> คือ ระยะเวลาระหว่างที่จะส่ง ping ไปแต่ละครั้ง เช่น 00:10:00 หมายถึง netwatch จะ ping ไปยัง ip ที่ระบุไว้ทุกๆ 10 นาที</li>
					  <li><strong>Timeout</strong> คือ เวลาที่รอการตอบกลับ (response time) ถ้าหาก host ที่ ping ไปตอบกลับมาช้ากว่า (มากกว่า) ค่าของ Timeout<br> ก็จะถือว่า host นั้นมีสถานะเป็น down แต่ถ้าน้อยกว่าก็เป็น up<br>
					  ค่า 1000 = 1วินาที</li>
					</ul>
            </p>
			</div>
			</div>
			 <script src="../assets/js/date-time.js"></script>
  </section>