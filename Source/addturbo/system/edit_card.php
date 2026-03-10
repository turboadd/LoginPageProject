<?php
		
			
            if(!empty($_REQUEST['profile'])){
                        $pro_name=$_REQUEST['profile'];
						$time_limit=$_REQUEST['time_limit'];					
						$home_page=$_REQUEST['home_page'];
						$vat=$_REQUEST['vat'];
						$package_name=$_REQUEST['package_name'];
						$card_name=$_REQUEST['card_name'];
						$phone=$_REQUEST['phone'];
						$server_ip=$_REQUEST['server_ip'];
						$color="#".$_REQUEST['color']."";
	                  	
						 
						 $db->update_db("mt_profile",array(
							                "package_name"   =>$package_name,
							               "card_name"       =>$card_name, 
							               "home_page"        =>$home_page,
							              "time_limit"        =>$time_limit,
							              "vat"              => $vat,
							            "phone"             =>$phone,
							           "server_ip"          =>$server_ip,
							          "color"              =>$color
                                              ),"pro_name='".$pro_name."'");
					   
					   

						echo "<script language='javascript'>swal('Save Done!','แก้ไข  Card ".$pro_name." สำเร็จแล้ว!','success').then(function () {
    window.location.href = 'index.php?page=card';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page=card';}})</script>";
						exit();
						}
						
			
									   								
?>


<style type="text/css">
<!--

.style2 {color: #0000FF}
.style1 {color: #990000}
-->
</style>
<section class="content"> 
 
       <div class="row">
         <div class="col-lg-12" >

            <div class="<?php print $convert->panel_modify();?>">
                <div class="<?php print $panel_heading;?>" >
                    <strong><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Hotspot Edit Card - แก้ไขการ์ด</strong>
                    <?php print $date_time_show;?></div>                    
               
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<?php
					$result=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$_GET['name']."'");
					?>
					<div class="row">
                           <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2"> Profile</span></label>
                         <option type="text" class="form-control" ><?php echo $result['pro_name']; ?></option>
                         <!--hide  -->
							  <input type="hidden" value="<?php echo $result['pro_name'];?>" name="profile">
							 <!--hide  -->
                                 </div>     
                                </div>                            
                            </div>


					 <div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2"> Package Name</span></label>
                            <input name="package_name"  id="package_name" placeholder=" Ex. Package Name" class="form-control" value="<?php echo $result['package_name']; ?>" >  
                                </div>                            
                            </div>
                        <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2">Card Name</span></label>
                                    <input name="card_name"  id="card_name" placeholder=" Ex. WIFI CARD " class="form-control" value="<?php echo $result['card_name']; ?>" required >
						         </div>
                                </div>                            
                            </div>
                     
                        <div class="row">
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">Home Page</span></label>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="ip login">
                                   <input name="home_page" type="text" class="form-control" placeholder="Ex.172.0.0.1/login"  value="<?php echo $result['home_page']; ?>" >  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style2">Time Limit</span></label>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="จำนวนวันที่จะกำหนดให้ใช้งาน">
                                    <input name="time_limit" type="text" class="form-control" placeholder="Ex.อายุใช้งาน 1วัน"  value="<?php echo $result['time_limit']; ?>" >  
									
                                </div>
                            </div>
                        </div>
						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">VAT.</span></label>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="ราคา vat + Price">
                                   <input name="vat" type="text" class="form-control" placeholder="Ex.5 or 7"  value="<?php echo $result['vat']; ?>">  
									
                                </div>
                            </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style2">Server IP</span></label>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="IP server Login ด้วยQR">
                                    <input name="server_ip" type="text" class="form-control" placeholder="Ex.192.168.10.1"  value="<?php echo $result['server_ip']; ?>">  
									
                                </div>
                            </div>
                        </div>
						<div class="row">
                           <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">Call Number</span></label>
									<img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="เบอร์ติอต่อ">
                                   <input name="phone" type="text"  placeholder="Ex.084-7986-564" class="form-control" value="<?php echo $result['phone']; ?>">  
							  </div>
                                </div>
                            <div class="col-xs-12  col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class=" style2">Color Card</span></label>
                                 <img src="../img/help.png" width="16" height="16" data-toggle="tooltip" data-placement="right" title="กำหนดสีพื้นหลังของบัตร"><br>
				<input name="color"  id="color"  class="jscolor" value="<?php echo $result['color']; ?>">
                                    </div>
                                </div>                            
                            </div>
                      <br><br>
                        <div class="row">
						<div class="col-lg-12 col-md-12 " >                                    
                                       <?php
									    $bottonbtn_success="on";
				$text_success="&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
               echo $convert->button_btn_submit_account($account,$text_success,$bottonbtn_success,'','','','','');
				?>
				         <button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="javascript:history.back()">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;
                      
					 <span class="hidden-xs"> <button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;</button>
							&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#manual"><span class="style2">ข้อแนะนำการใช้งาน </span></button></span>
							
							</div>
							</div>
							</form>
							</div>
							</div>
							</div>
							</div>



           <div id="manual" class="collapse">
               <div  class="panel content" style="font-size: 12pt; line-height: 2em;">
                  <p><h1 class="style1">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
				       <li> Package Name ชื่อแพ๊คเกจที่ใช้ แทนชื่อโปรไฟล์ </li>
                    <li>Card name ตั้งชื่อการ์ด</li>
					<li>Data Limit จำนวนข้อมูลที่จะกำหนดให้ใช้งาน</li>
					<li>Time Limit จำนวนวันที่จะกำหนดให้ใช้งาน</li>
					<li>VAT ราคาบัตรรวมกับ vat</li>
					<li>Server IP ไอพี Login ด้วยQR</li>
					<li>Call Number เบอร์ติอต่อ</li>
					<li>Color Cardr สีพื้นหลังของบัตร</li>
                    </ul>
            </p>
			</div>
			</div>
	<script src="../assets/js/date-time.js"></script>	
  </section>