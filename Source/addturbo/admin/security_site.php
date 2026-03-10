 <?php
$secu=$db->selectquery("SELECT admin_pin FROM mt_config");
	$ad_pin=$secu['admin_pin'];
	$mdadmin_pin=md5($secu['admin_pin']);
    $Empty_pin="000000000";
	$mdEmpty_pin=md5($Empty_pin);
	if(empty($ad_pin)){
	echo "<script language='javascript'>swal('ERROR SECURITY SITE','ท่านยังไม่ได้สร้าง ไซต์งาน','error').then(function () {
    window.location.href = 'index.php?page';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href = 'index.php?page';}})</script>";
	
	
	
	}else{
 	if(!empty($_REQUEST['active'])){


	    $old=md5($_REQUEST['old']);
		$new=md5($_REQUEST['new']);
		$new1=$_REQUEST['new'];if($new1==""){$new1="000000000";}
		$con=md5($_REQUEST['con']);
	
	if($ad_pin==$mdEmpty_pin){
			
        if($new!=$con){

			echo "<script language='javascript'>swal('รหัสผ่านใหม่ ไม่ตรงกัน','ลองอีกครั้ง!','error')</script>";
			
		}else{
   $num=$db->rows_num("SELECT * FROM mt_config where customer_pin='".$new1."' or user_pin='".$new1."'");
	 if($num==0){
             $show_adminPIN=$_REQUEST['new'];if($_REQUEST['new']==""){$show_adminPIN="ว่าง";}
            
			$db->update_db("mt_config",array(
                                             "admin_pin"=>md5($new1),
                                               ),"admin_pin='".$ad_pin."'");

			echo "<script language='javascript'>swal('บันทึกค่า สำเร็จแล้ว!','รหัส ".$_SESSION['APIUser']." PIN คือ ".$show_adminPIN." ออกจากระบบ!','success').then(function () {
    window.location.href = '../admin/logout.php';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../admin/logout.php';
   }})</script>";
          exit(0);
	 }else{echo "<script language='javascript'>swal('Password ERROR!','ลองอีกครั้ง!','error')</script>";}
}
}else{
            
		$num_pin = $db->rows_num("SELECT * FROM mt_config WHERE admin_pin='".$old."'");		
		if($num_pin==0){
			echo "<script language='javascript'>swal('รหัสผ่าน เก่าไม่ถูกต้อง','ลองอีกครั้ง!','error')</script>";
			
		}else if($new!=$con){
			echo "<script language='javascript'>swal('รหัสผ่านใหม่ ไม่ตรงกัน','ลองอีกครั้ง!','error')</script>";
		
		}else{
			$show_adminPIN=$_REQUEST['new'];if($_REQUEST['new']==""){$show_adminPIN="ว่าง";}
			
			$db->update_db("mt_config",array(
                                             "admin_pin"=>md5($new1),
                                               ),"admin_pin='".$ad_pin."'"); 
			echo "<script language='javascript'>swal('บันทึกค่า สำเร็จแล้ว!','รหัส ".$_SESSION['APIUser']." PIN คือ ".$show_adminPIN." ออกจากระบบ!','success').then(function () {
    window.location.href = '../admin/logout.php';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../admin/logout.php';
   }})</script>";

			
			exit(0);
		}



}


}}	
						  
		?>

  <section class="content">

		   <?php include("convert.php"); $convert=new convert();?>
		  <div class="<?php print $convert->panel_modify();?>">
          <div class="<?php print $panel_heading;?>"><strong>Security Mikrotik Site</strong>
		  <?php print $date_time_show;?></div>
          <div class="modal-body">
         
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
					  
                          <form id="pin" method="POST" action="">
						  <?php
						  
						 if(!empty($ad_pin)&&($ad_pin!=$mdEmpty_pin)){ ?>
						 
                              <div class="form-group">
                                  <label for="username" class="control-label">Old Security PIN </label>
                                  <input type="password" class="form-control"  name="old"  placeholder="กรุณาใส่รหัส PIN 4-8 หลัก" maxlength="8" required>
                                  <span class="help-block"></span>
                              </div>
							  <?php }?>
                              <div class="form-group">
                                  <label for="username" class="control-label">New Security PIN </label>
                                  <input type="password" class="form-control"  name="new"  placeholder="กรุณาใส่รหัส PIN 4-8 หลัก" maxlength="8" >
                                  <span class="help-block"></span>
                              </div>
							   <div class="form-group">
                                  <label for="username" class="control-label">Confirm New Security PIN </label>
                                  <input type="password" class="form-control"  name="con"  placeholder="กรุณาใส่รหัส PIN 4-8 หลัก" maxlength="8" >
                                  <span class="help-block"></span>
                              </div>                                          
                                        
                                     <div class="row">
                            <div class="col-xs-6 col-md-6">
                              
                                   <button id="btnSave" value="pin" name="active" class="btn btn-success btn-block" type="submit"><i class="fa fa-check"></i>&nbsp;Save</button>
							</div>
                            <div class="col-xs-6 col-md-6 pull-right">
                                <button id="btnSave" class="btn btn-danger  btn-block" type="reset"><i class="fa fa-refresh">&nbsp;&nbsp;</i>Reset</button>
                            </div>
                        </div>
                                    </form>
		                        </div>		                        
                        </div>
                        
                    </div>
           
</section>

                             