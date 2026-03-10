
<?php

   include_once('data/update_money.function.php');
	   $money= new money();
  		$money->user_info();
	     
		 if(!empty($_REQUEST['update_money'])){
        if($_REQUEST['update_money']=="hotspot"){
			       /// $money->user_info();
					$new_update=$money->hotspot_money();	
					}
 if($_REQUEST['update_money']=="pppoe"){
	                 ////$money->user_info();
					$new_update=$money->pppoe_money();                 
			
}

if(($new_update)>0){
echo "<script language='javascript'>swal('Save Done!','UPDATE ข้อมูล ".$_REQUEST['update_money']." จำนวน ".$new_update." รายการสำเร็จแล้ว','success').then(function () {
   }, function (dismiss) {
	   window.location.href='index.php?page';
  if (dismiss === 'overlay') {
      window.location.href='index.php?page';
   }})</script>";
}else{
	echo "<script language='javascript'>swal('NO! UPDATE',' ไม่มีข้อมูล ".$_REQUEST['update_money']." ใหม่ ','question').then(function () {
		window.location.href='index.php?page';
   }, function (dismiss) {
  if (dismiss === 'overlay') {
       window.location.href='index.php?page';
   }})</script>";
} }

	 
									
								    
										?>	
<section class="content"> 
				
		 <div class="row">
		 <!--row 1  -->

        <div class="col-lg-3 col-xs-6">
        <div class="small-box <?php echo $convert->bg_color_modify(1);?>">
            <div class="inner">
             <h3><span class="cpu-load"> %</span></h3>
              <p>CPU Load</p>
            </div>
            <div class="icon">
              <i class="ion-ios-speedometer"></i>
            </div>
            <a href="#" class="small-box-footer">
              สถานะ CPU <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box1 col -->

        <div class="col-lg-3 col-xs-6">
        <div class="small-box <?php echo $convert->bg_color_modify(2);?>">
            <div class="inner">
             <h3><span class=""><?php $ARRAY = $API->comm("/interface/print", array(
												"count-only"=> "",));
			  echo($ARRAY)?> Port</span></h3>
			  <p>Interface</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="javascript:popup('index.php?page=interface')" class="small-box-footer">
              ช่องใช้งาน<i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box2 col -->

	<?php if($_SESSION['hotspot_cus'] == 1) { ?>
        <div class="col-lg-3 col-xs-6">
         <div class="small-box <?php echo $convert->bg_color_modify(3);?>">
            <div class="inner">
            <h3><span class="user-online"> Clients</span></h3>
			  <p>ผู้ใช้ออนไลน์</p>
            </div>
            <a href="javascript:popup('index.php?page=useronline')">
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            </a>
            <a href="javascript:popup('index.php?page=useronline')"  class="small-box-footer">
              จำนวนผู้ใช้ <?php $ARRAY = $API->comm("/ip/hotspot/user/print", array(
																			"count-only"=> "",
																			"~active-address" => "1.1.",
																		));
																			print_r($ARRAY)?> User    <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
	<?php } ?>
        <!-- ./box3 col -->

		<?php if($_SESSION['pppoe_cus'] == 1) { ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box <?php echo $convert->bg_color_modify(3);?>">
            <div class="inner">
              <h3><span class="pppoe-online"> Clients</span></h3>
              <p>PPPOE Secret Online</p>
            </div>
			<a href="javascript:popup('index.php?page=pppoe_online')">
            <div class="icon">
              <i class="ion-android-globe"></i>
            </div>
            </a>
            <a href="javascript:popup('index.php?page=pppoe_mik_user')"  class="small-box-footer">
              PPPoe <?php $ARRAY = $API->comm("/ppp/secret/print", array(
																			"count-only"=> "",
																			"~active-address" => "1.1.",
																		));
																			print_r($ARRAY)?> User    <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
		<?php } ?>
		<div class="col-lg-3 col-xs-6">
         <div class="small-box <?php echo $convert->bg_color_modify(4);?>">
            <div class="inner">
            <h3><span><?php $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
								"count-only"=> "",
								"~active-address" => "1.1.",
							));
								print_r($ARRAY)?> User</span></span></h3>
			  <p>DHCP LEASE</p>
            </div>
            <a href="javascript:popup('index.php?page=useronline')">
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            </a>
            <a href="javascript:popup('index.php?page=dhcp')"  class="small-box-footer">
              DHCP LEASE <?php $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
								"count-only"=> "",
								"~active-address" => "1.1.",
							));
								print_r($ARRAY)?> User    <i class="fa fa-rocket"></i>
            </a>
          </div>
        </div>
        <!-- ./box4 col -->

      </div>
	  <!-- ./row 1 -->
  <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->                                     
                                            
		                           <div class="row">  
                                <!-- row 2 -->
                                      <div id="mapDiv" class="col-lg-9 col-md-12">
                                              <div class="<?php print $convert->panel_modify();?>">
                                                        <div class="<?php print $panel_heading;?>">
                                                               
                     <span class="hidden-md hidden-sm hidden-xs">    
                    <div id="maximize" class="allsize" style="display:block;float: left;" >
						<button  id="sidebar-show-btn" type="button" class="btn btn-box-tool" data-toggle="tooltip" title= "คลิก เพื่อขยาย มอนิเตอร์" onclick="toggle_visibility('pull-right-on'),toggle_visibility('pull-right-off'),toggle_visibility_size('restore')"><h3 class="box-title"><i class="fa fa-window-maximize"></i>&nbsp;&nbsp;&nbsp;MONITOR</h3></button></div>
						</span>
						
						<div id="restore" class="allsize" style="display:none;float: left;" >
						<button  id="sidebar-hide-btn" type="button" class="btn btn-box-tool" data-toggle="tooltip"  title= "คลิก เพื่อลดขนาด มอนิเตอร์" onclick="toggle_visibility('pull-right-off'),toggle_visibility('pull-right-on'),toggle_visibility_size('maximize')"><h3 class="box-title"><i class="fa fa-window-restore"></i>&nbsp;&nbsp;&nbsp;MONITOR</h3></button>
						<span class="hidden-md hidden-sm hidden-xs">
						<button  id="sizeplus" class="btn btn-box-tool"><h3 class="box-title">+</h3></button>
						 <button  id="sizeminus" class="btn btn-box-tool"><h3 class="box-title">-</h3></button>
						 <button  id="sizenormal" class="btn btn-box-tool"><h3 class="box-title">1:1</h3></button>
						 </span>
						 </div>
                        
                                                        

                   
				   
				   
				   
				<span style="float: right;"> 
				  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Interface Traffic" onclick="toggle_visibility_double('Traffic-on');"><h3 class="box-title"><i class="fa fa-line-chart"></i></h3></button>&nbsp;&nbsp;
				    <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Log Detail" onclick="toggle_visibility_double('log-on');"><h3 class="box-title"><i class="fa fa-edit"></i></h3></button>&nbsp;&nbsp;
					<?php if($_SESSION['hotspot_cus'] == 1) { ?> 
					 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot User Profile Chart" onclick="toggle_visibility_double('hotspot-on');"><h3 class="box-title"><i class="fa fa-wifi"></i></h3></button>&nbsp;&nbsp;
					<?php } ?>
					  <?php if($_SESSION['pppoe_cus'] == 1) { ?>					  
					  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="PPPOE User Profile Chart" onclick="toggle_visibility_double('pppoe-on');"><h3 class="box-title"><i class="fa fa-podcast"></i></h3></button>&nbsp;&nbsp;
					  <?php } ?>
					   <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Harddisk Detail" onclick="toggle_visibility_double('hd-on');"><h3 class="box-title"><i class="fa fa-pie-chart"></i></h3></button>&nbsp;&nbsp;
					    <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Memory Detail" onclick="toggle_visibility_double('mem-on');"><h3 class="box-title"><i class="fa fa-microchip"></i></h3></button>&nbsp;&nbsp;
						 <?php if($_SESSION['hotspot_cus'] == 1 && $_SESSION['money_cus'] == 1) { ?> 
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot Money Chart" onclick="toggle_visibility_double('hotspot_money-on');"><h3 class="box-title">H <i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
						  <?php } ?>
					  <?php if($_SESSION['pppoe_cus'] == 1 && $_SESSION['money_cus'] == 1) { ?>	
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="PPPOE Money Chart" onclick="toggle_visibility_double('pppoe_money-on');"><h3 class="box-title">P <i class="fa fa-bar-chart"></i></h3></button>&nbsp;&nbsp;
						  <?php } ?>
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Hotspot TxRx bytes Chart" onclick="toggle_visibility_double('hotspot_load-on');"><h3 class="box-title">H <i class="fa fa-exchange "></i></h3></button>&nbsp;&nbsp;
						  <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Interface TxRx bytes Chart" onclick="toggle_visibility_double('interface_load-on');"><h3 class="box-title">IF <i class="fa fa-exchange "></i></h3></button>&nbsp;&nbsp;
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Mikrotik Resource" onclick="toggle_visibility_double('mikrotik-resource');"><h3 class="box-title"><i class="fa fa-thermometer-half"></i></h3></button>&nbsp;&nbsp;
						 <button class="btn btn-box-tool"    data-toggle="tooltip"  title="Bookmarks" onclick="toggle_visibility_double('bookmarks');"><h3 class="box-title"><i class="fa fa-star"></i></h3></button>&nbsp;&nbsp;
                        
						</span>
                                                          <!--/.pull-right  -->
                                                        </div>
                                                <!-- /.box-header -->
                            <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
                                 
                                                <div class="box-body">
                                                  <div class="box-body">

						<div class="col-lg-12 col-md-12">


                            <div id="Traffic-on" class="alist" style="display:block;" >
							<div class="chart">
                             <!-- <div id="resizer" style="max-height: 400px; width: 730px; max-width: 860px;"> -->
							 <!-- <div id="resizer" style="max-height: 400px; width: 730px; max-width: 860px;"> -->
                            <!-- <div id="inner-resizer"> -->
							<div id="monitor-traffic" style="height: 400px;"></div>
							</div>
							<!-- </div>
							</div> -->
							<select  name="interface"  id="interface" >
	             <?php
				$ARRAY = $API->comm("/interface/print");
				$num =count($ARRAY);
				for($i=0; $i<$num; $i++){
				$seleceted = ($i == 0) ? 'selected="selected"' : '';
				echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
				}?></select>&nbsp;&nbsp;&nbsp;
				
			    </div> 
				<!-- /.Traffic -->


			                 <div id="log-on" class="alist" style="display:none;" >
							<div class="chart">
							<!-- <div class="text-box" > -->
							<p class="text-muted">
                     <span class="text-muted color-bottom-txt"><i class="fa fa-edit"></i> Log from Mikrotik</span></p>
				            <div class="logs" style="height: 330px;"></div>
							<br>
							<br>
							<br>
							<!-- </div> -->
							<!-- /.text-box -->
							 </div>
							 </div>
							  <!-- /.log -->

							   <div id="hotspot-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pro_hotspot"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot -->

							   <div id="pppoe-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pro_pppoe"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.pppoe -->
                    
							  <div id="hd-on" class="alist" style="display:none;">
							<div class="chart">
							<div id="hddchart"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hd -->

							   <div id="mem-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="memchart"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.mem -->

                             <form name="name" action="" method="post">
							  <div id="hotspot_money-on" class="alist" style="display:none;" >
							 




							<div class="chart">
							<div id="hotspot_money"  style="height: 400px;"></div>
							
							</div>
							
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot_money -->

							  <div id="pppoe_money-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="pppoe_money"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.pppoe_money -->
                            </form>
							    <div id="hotspot_load-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="hotspot_load"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.hotspot_load -->

							  <div id="interface_load-on" class="alist" style="display:none;" >
							<div class="chart">
							<div id="interface_load"  style="height: 400px;"></div>
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.interface_load -->


							  <div id="mikrotik-resource" class="alist" style="display:none;" >
							<div class="chart">
							<div class="row">
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
.style3 {color: #009900}
.style4 {color: #ff8000}
-->
</style>
				<?php
				 $resource_dash = $API->comm("/system/resource/print");
				$health_dash = $API->comm("/system/health/print");	?>
							<div class="col-md-6 col-xs-12">
                               <div class="text-center"><h3><strong>Mikrotik Resources</strong></h3></div><br><br>
							 <div class="row">
                                  <span class="style1"><div class="col-xs-6">Uptime </div>
                                  <div class="col-xs-6">
                                       <div class="res-up-time"></div></span>
                                  </div>
                          </div>
                          <div class="row">
                                 <span class="style2"><div class="col-xs-6">Device Name </div>
                                  <div class="col-xs-6">
                                       <div class="platform">
									   <?php print $resource_dash[0]['platform'];?>
									   </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                 <span class="style1"> <div class="col-xs-6">Model</div>

                                  <div class="col-xs-6">
                                       <div class="board_name">
									   <?php print $resource_dash[0]['board-name'];?>
									   </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Version  </div>
                                  <div class="col-xs-6">
                                       <div class="version">
									   	<?php print $resource_dash[0]['version'];?>
									   </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">CPU </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_model">
									  <?php print $resource_dash[0]['cpu'];?>
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">CPU Count </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_count">
									<?php print $resource_dash[0]['cpu-count']." Core"; ?>  
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">CPU Frequency </div>
                                  <div class="col-xs-6">
                                      <div class="cpu_frequency">
									 <?php print $resource_dash[0]['cpu-frequency']." MHz"; ?> 
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">CPU Load </div>
                                  <div class="col-xs-6">
                                      <div class="cpu-load"> %</div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Free Memory </div>
                                  <div class="col-xs-6">
                                      <div class="free-memory">
									 <?php print round(($resource_dash['0']['free-memory']/1048576),1)." MB"; ?> 
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Total Memory </div>
                                  <div class="col-xs-6">
                                      <div class="total_mem">
							<?php print round(($resource_dash[0]['total-memory']/1048576),1)." MB"; ?> 
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Free HDD Space </div>
                                  <div class="col-xs-6">
                                      <div class="free-hdd-space">
							<?php print round(($resource_dash[0]['free-hdd-space']/1048576),1)." MB"; ?>		  
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Total HDD Size </div>
                                  <div class="col-xs-6">
                                      <div class="total_hdd">
								<?php print round(($resource_dash[0]['total-hdd-space']/1048576),1)." MB"; ?>	  
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style1"><div class="col-xs-6">Architecture Name</div>
                                  <div class="col-xs-6">
                                      <div class="architecture_name">
							<?php print $resource_dash[0]['architecture-name']; ?>		  
									  </div>
                                  </div></span>
                          </div>
                          <div class="row">
                                  <span class="style2"><div class="col-xs-6">Build Time</div>
                                  <div class="col-xs-6">
                                      <div class="build_time">
							<?php print $resource_dash[0]['build-time']; ?>		  
									  </div>
                                  </div></span>
                          </div><br>
						 
						  </div>
						  <!-- /.col-->



                           <div class="col-md-6 col-xs-12">
							<div class="text-center"><h3><strong>Mikrotik Health</strong></h3></div><br><br>
							<div class="row">
                            <span class="style3"><div class="col-xs-6">Fan Mode</div>
                            <div class="col-xs-6">
                              <div class="fan_mode">
							 <?php print $health_dash[0]["fan-mode"]; ?> 
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Use Fan</div>
                            <div class="col-xs-6">
                              <div class="use_fan">
						<?php print $health_dash[0]["use-fan"]; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Active Fan</div>
                            <div class="col-xs-6">
                              <div class="active-fan">
						<?php print $health_dash['0']['active-fan']; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Voltage. </div>
                            <div class="col-xs-6">
                              <div class="voltage">
						<?php print $health_dash['0']['voltage']." Volt"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Temperature</div>
                            <div class="col-xs-6">
                              <div class="temperature">
						<?php print $health_dash['0']['temperature']." C"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">CPU Temperature</div>
                            <div class="col-xs-6">
                              <div class="cpu-temperature">
						<?php print $health_dash['0']['cpu-temperature']." C"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Current. </div>
                            <div class="col-xs-6">
                              <div class="current">
						<?php print $health_dash['0']['current']." mA"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Power Consumption</div>
                            <div class="col-xs-6">
                              <div class="power-consumption">
						<?php print $health_dash['0']['power-consumption']." Watt"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style3"><div class="col-xs-6">Fan1 Speed</div>
                            <div class="col-xs-6">
                              <div class="fan1-speed">
						<?php print $health_dash['0']['fan1-speed']." RPM"; ?>	  
							  </div>
                            </div></span>
                      </div>
                      <div class="row">
                            <span class="style4"><div class="col-xs-6">Fan2 Speed</div>
                            <div class="col-xs-6">
                              <div class="fan2-speed">
						<?php print $health_dash['0']['fan2-speed']." RPM"; ?>	  
							  </div>
                            </div></span>
                      </div>

					  </div>
					  <!-- /.col-->
					
					  </div>
					  <!--/.row  -->
					  </div>
					<!-- /.chart -->
					 </div>
				<!-- /.mikrotik-resource -->

				<div id="bookmarks" class="alist" style="display:none;" >
							<div class="chart">
							<div class="row">
							
							<?php if($_SESSION['hotspot_cus'] == 1) { ?>
							<div class="col-md-6 col-xs-12">
							<div class="text-center"><h3><strong>Hotspot Bookmarks</strong></h3></div>
							<div class="row">
							<div class="col-md-4 col-xs-12">
			<a href="index.php?page=interface" class="btn btn-app">
			  <span class="badge <?php echo $convert->bg_color_modify(12);?>"><?php $ARRAY = $API->comm("/interface/print", array(
												"count-only"=> "",));
			  echo($ARRAY)?></span> <i class="fa fa-signal"></i> Interface</a>



				 <a href="index.php?page=dhcp"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(11);?>"><?php $ARRAY = $API->comm("/ip/dhcp-server/lease/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span> <i class="fa fa-laptop"></i> Dhcp lease</a>
             
              
			  
              <a href="index.php?page=profilelist"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(10);?>"><?php $ARRAY = $API->comm("/ip/hotspot/user/profile/print", array(
				                                "count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span><i class="fa fa-folder-open"></i> Profile List</a>
			 
			  
			  
			  <a href="index.php?page=mikrotikuser"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(9);?>"><?php $ARRAY = $API->comm("/ip/hotspot/user/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",));
				$user_total=($ARRAY);print_r($ARRAY);?></span></span><i class="fa fa-users"></i>Mik Users</a>


				 <a href="index.php?page=listuser"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(8);?>">
				
				<?php echo $db->rows_num("SELECT * FROM mt_gen WHERE mt_id='".$id."'");?></span>
                <i class="fa fa-database"></i> Database users</a>
				</div>
				<!--./col -->
				
                
				
                <div class="col-md-4 col-xs-12">

				<a href="index.php?page=useronline"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(7);?>"><?php $ARRAY = $API->comm("/ip/hotspot/active/print", array(
				                                "count-only"=> "",
												"~active-address" => "1.1.",));
				print_r($ARRAY)?></span><i class="fa fa-flash"></i> User online</a>

<?php if($_SESSION['money_cus'] == 1 && $_SESSION['hotspot_cus'] == 1) { ?>
				 <a href="index.php?page=money_month"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(6);?>">1</span><i class="fa fa-bar-chart"></i> Money Chart</a>
<?php } ?>
				<a href="index.php?page=manuser"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(5);?>">0</span><i class="fa fa-user-plus"></i> Add Mik User</a>
<?php if($_SESSION['hotspot_userman'] == 1) { ?>
				<a href="index.php?page=add_usermanager"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(4);?>">0</span><i class="fa fa-user-plus"></i> Add Userman</a>
<?php } ?>
                </div>
				<!--./col -->
				</div>
				<!-- row -->
				</div>
							<?php } ?>
				<!--./col -->

               
				<?php if($_SESSION['pppoe_cus'] == 1) { ?>
				 <div class="col-md-6 col-xs-12">
				<div class="text-center"><h3><strong>PPPOE Bookmarks</strong></h3></div>
				<div class="row">
				
				
				<div class="col-md-4 col-xs-12">
                 <a href="index.php?page=pppoe_profile_list"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(2);?>"><?php $ARRAY = $API->comm("/ppp/profile/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",
											));
											print_r($ARRAY)?></span>
                <i class="fa fa-folder-open"></i> PPPOE Profile
              </a>
			  <a href="index.php?page=pppoe_mik_user"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(13);?>"><?php $ARRAY = $API->comm("/ppp/secret/print", array(
												"count-only"=> "",
												"~active-address" => "1.1.",
											));
											$pppuser_total=($ARRAY);print_r($ARRAY);?></span></span>
                <i class="fa fa-users"></i> PPPOE Users
              </a>
			  <a href="index.php?page=pppoe_dtb_user"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(12);?>">
				<?php echo $db->rows_num("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");?></span>
                <i class="fa fa-database"></i> Database users
              </a>
			  
			   <?php if($_SESSION['money_cus'] == 1 && $_SESSION['hotspot_cus'] == 1) { ?>
			   <a href="index.php?page=pppoe_money_month"class="btn btn-app">
                <span class="badge <?php echo $convert->bg_color_modify(11);?>">1</span>
                <i class="fa fa-bar-chart"></i> Money Chart</a>
			   <?php } ?>
			  </div>
				</div>
               <!-- row -->
				</div>
				<?php } ?>
				<!-- /col -->
							
					         </div>
							<!-- row -->
							</div>
							 <!-- /.chart -->
							 </div>
							  <!-- /.bookmarks -->
							  
							  
							  
							  
					 </div> 
			        <!-- /.col -->
              </div>           
			  <!-- /.box-body -->
			                                         
                      </div>                                         
					  <!-- /.box-body -->

					  
				
                         </div> 
                          <!-- /.box-panel_modify -->
                                      </div>
									  <!-- /col-lg-9 col-md-12 -->
        <!-- ปิดส่วน แสดงแถบกราฟ -->
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->

                      <!-- เปิดส่วน แสดงแถบด้านขวาของจอแสดงสถานะ -->
					    
                          <div id="pull-right-on" style="display:block;">
						                   <?php $color_account="style=\"color: #00ff00;\"";
											if($account=="write"){$color_account="style=\"color: #f7d13c;\"";}
											if($account=="read"){$color_account="style=\"color: #ff1c15;\"";}?>
                                              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">   
											<?php if($_SESSION['customer_login'] != 1) { ?>											  
											<div class="info-box <?php echo $convert->bg_color_modify(5);?>">
												<span class="info-box-icon">
												<a href="#" data-toggle="modal" data-target="#Detail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด">
												<i class="ion ion-ios-people-outline"  style="color: #ffffff;"></i></a></span>
										            <div class="info-box-content">
														<span class="info-box-text">Group Account</span>
														<span class="info-box-number">
														<a href="#" data-toggle="modal" data-target="#Detail" data-toggle="tooltip" data-placement="top" title="ดูรายละเอียด">
														<i class="fa fa-circle " <?php echo $color_account;?>></i> </a>
														
														<?php echo "<td>". $account."</td>";?></span>
															<div class="progress">
																<div class="progress-bar" style="width: 100%"></div>
															</div>
																<span class="progress-description">
																	
																</span>
																</div>
																</div>
											<?php } ?>
																</div>
																<!--./ box1 col -->
																<?php if($_SESSION['hotspot_cus'] == 1) { ?>

											 <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											 
											<div class="info-box <?php echo $convert->bg_color_modify(6);?>">
											<span class="info-box-icon">
											<a href="javascript:popup('index.php?page=listuser')">
											<i class="ion-ios-pricetags-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">Hotspot Database</span>
														<span class="info-box-number">
					<?php echo $db->rows_num("SELECT * FROM mt_gen WHERE mt_id='".$id."'");?> Users</span>
														<div class="progress">
														    <div class="progress-bar" style="width: 100%"></div>
														</div>
														    </div>
															</div>
															</div>
																<?php } ?>
															<!--./ box2 col-->
														         <?php if($_SESSION['pppoe_cus'] == 1) { ?>
											<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											<div class="info-box <?php echo $convert->bg_color_modify(7);?>">
												<span class="info-box-icon">
												<a href="javascript:popup('index.php?page=pppoe_dtb_user')">
												<i class="ion ion-ios-cloud-download-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">PPPOE Database</span>
														<span class="info-box-number">
														<?php  echo $db->rows_num("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");?> Users</span>
														<div class="progress">
															<div class="progress-bar" style="width: 70%"></div>
														</div>
														<!-- <span class="progress-description">โปรไฟล์  
																<?php $ARRAY = $API->comm("/ppp/profile/print", array(
																						"count-only"=> "",
																						"~active-address" => "1.1.",
																					));
																						print_r($ARRAY)?> Profile
														</span> -->
													</div>
													</div>
													</div>
																 <?php } ?>
													<!--./col box3 -->

                                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
											<div class="info-box <?php echo $convert->bg_color_modify(8);?>">
												<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">วันเวลาใช้งาน</span>
														<span class="date"></span>
														   
														        <div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
																<span class="time">
														        </span>
																</div>
																</div>
																</div>
													<!--./ box4 col -->
											
                                               <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
											<div class="info-box <?php echo $convert->bg_color_modify(9);?>">
												<span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">Mikrotik Uptime</span>
														<div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
														        <span class="res-up-time">
														        </span>
																</div>
																</div>
																</div>
									             <!--./ box5 col-->
      
<?php if($_SESSION['customer_login'] != 1) { ?>
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">

					 
					 <div class="info-box">
            <span class="info-box-icon <?php echo $convert->bg_color_modify(13);?>"><i class="ion-ios-person-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">ADMIN WINBOX</span>
              <span class="info-box-number">
			  <?php  echo $USER_ACCOUNT;?>
				 </span>
            </div>
          </div>
				   </div>
<?php } ?>
					<!-- ./col info-box4-->

                   </div>
				   <!--  -->
				   </div>
				    <!-- ./row 4 -->
                                    </div>
									<!--./pull-right-on  -->
									
							<!-- ปิดส่วน แสดงแถบด้านขวาของจอแสดงสถานะ -->
								</div>
									<!-- ./row 2-->
	<!-- ################################################################################################ -->
				<div id="pull-right-off" style="display:none;">
				 <div class="row">  
                   <!-- row 3 -->
                   
				   <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php echo $convert->bg_color_modify(8);?>">
											<span class="info-box-icon">
											<a href="javascript:popup('index.php?page=listuser')">
											<i class="ion-ios-pricetags-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">Hotspot Database</span>
														<span class="info-box-number">
					<?php  echo $db->rows_num("SELECT * FROM mt_gen WHERE mt_id='".$id."'");?> Users</span>
														<div class="progress">
														    <div class="progress-bar" style="width: 100%"></div>
														</div>
														    </div>
															</div>
															
																</div>
																<!-- ./col box1-->
				
				    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php echo $convert->bg_color_modify(7);?>">
												<span class="info-box-icon">
												<a href="javascript:popup('index.php?page=pppoe_dtb_user')">
												<i class="ion ion-ios-cloud-download-outline" style="color: #ffffff;"></i></a></span>
													<div class="info-box-content">
														<span class="info-box-text">PPPOE Database</span>
														<span class="info-box-number">
					<?php  echo $db->rows_num("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");?> Users</span>
														<div class="progress">
															<div class="progress-bar" style="width: 70%"></div>
														</div>
														<!-- <span class="progress-description">โปรไฟล์  
																<?php $ARRAY = $API->comm("/ppp/profile/print", array(
																						"count-only"=> "",
																						"~active-address" => "1.1.",
																					));
																						print_r($ARRAY)?> Profile
														</span> -->
													</div>
													</div>
					</div>
					<!-- ./col box2-->


					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php echo $convert->bg_color_modify(6);?>">
												<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">วันเวลาใช้งาน</span>
														<span class="date"></span>
														   
														        <div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
																<span class="time">
														        </span>
																</div>
																</div>
					</div>
					<!-- ./col box3-->

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="info-box <?php echo $convert->bg_color_modify(5);?>">
												<span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
													<div class="info-box-content">
														<span class="info-box-text">Mikrotik Uptime</span>
														<div class="progress">
														            <div class="progress-bar" style="width: 100%"></div>
														        </div>
														        <span class="up-time">
														        </span>
																</div>
																</div>
					</div>
					<!-- ./col box4-->
					</div>
				    <!-- ./row 3 -->
                

				    
				   </div>
				   <!--./pull-right-off  -->

 <!-- #################################################################### -->
                     
	 <!-- Modal -->
        <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          
			 <div class="modal-dialog" role="document" style="height: 600px; width: 800px;">
 <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>">
                           <h3 class="box-title">รายละเอียด ที่ User Account สามารถจัดการได้ในระบบ</h3>
						   <div class="box-tools pull-right">
						   <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						   </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Group Detail Account</th>
                                            <th><i class="fa fa-circle" style="color: #ff1c15;"></i> Read Group</th>
                                            <th><i class="fa fa-circle" style="color: #f7d13c;"></i> Write Group</th>
                                             <th><i class="fa fa-circle" style="color: #00ff00;"></i> Full Group</th>
											 <th><i class="fa fa-circle" style="color: #00ff00;"></i> Other Group</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Add user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Delete user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>Edit user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Import user</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
										<tr>
                                            <td>3</td>
                                            <td>Transfer user , Profile</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                         <tr>
                                            <td>5</td>
                                            <td>Export user</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Print Card</td>
                                            <td class="text-center"><i class="fa fa-close" style="color: #ff1c15;"></i></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                            <td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
											<td class="text-center"><i class="fa fa-check"  style="color: #00c600;"></td>
                                        </tr>
                                        </center></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>


        				
		<!-- ##################################### -->	
		

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
 <script src="../assets/js/log.js"></script><!--real-time  -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<!-- new -->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
 <script src="../assets/js/system-real-time-4.1.js"></script>

 <script type="text/javascript">
$(document).ready(function() {
	///////
   chart,
    origChartWidth = 1000,
    origChartHeight = 400,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	////
		var chart;
	function requestDatta(interface) {
		$.ajax({
			url: 'data/data_interface.php?interface='+interface,
			datatype: "json",
			success: function(data) {
				var midata = JSON.parse(data);
				if( midata.length > 0 ) {
					var TX=JSON.parse(midata[0].data);
					var RX=JSON.parse(midata[1].data);
					var ATemCPU=JSON.parse(midata[2].data);
					var ATem=JSON.parse(midata[3].data);
					var AVolt=JSON.parse(midata[4].data);
					var ACurrent=JSON.parse(midata[5].data);
					var ALoad=JSON.parse(midata[6].data);
					var x = (new Date()).getTime();
					     
					shift=chart.series[0].data.length > 19;
					chart.series[0].addPoint([x, TX], true, shift);
					chart.series[1].addPoint([x, RX], true, shift);
					chart.series[2].addPoint([x, ATemCPU], true, shift);
					chart.series[3].addPoint([x, ATem], true, shift);
					chart.series[4].addPoint([x, AVolt], true, shift);
					chart.series[5].addPoint([x, ACurrent], true, shift);
					chart.series[6].addPoint([x, ALoad], true, shift);
					
				}
			},
      
		});
	}	
			Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
	

           chart = new Highcharts.Chart({
			   chart: {
				renderTo: 'monitor-traffic',
				animation: Highcharts.svg,
				type: 'spline',

				events: {
					load: function () {
						setInterval(function () {
							requestDatta(document.getElementById("interface").value);
						}, 5000);
					},
	            addSeries: function () {
                var label = this.renderer.label('A series was added, about to redraw chart', 100, 120)
                    .attr({
                        fill: Highcharts.getOptions().colors[0],
                        padding: 10,
                        r: 5,
                        zIndex: 8
                    })
                    .css({
                        color: '#FFFFFF'
                    })
                    .add();

                setTimeout(function () {
                    label.fadeOut();
                }, 3000);
            }
						
			}
		 },
		 title: {
			text: 'Monitor-Traffic & System-Health'
		 },

		   tooltip: {
       headerFormat: '<span style="font-size:10px">{point.key}</span><br>',
        pointFormat: '<span  style="font-size:18px">{point.y: ,.2f}</span> <span style="font-size:14px"> {series.name}</span>',
        
    },
		 xAxis: {
			type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000
		 },
		 yAxis: {
			minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Mikrotik Thailand',
					margin: 10
				}
		 },
            series: [{
                name: 'Mbps-TX',
                data: []
            }, {
                name: 'Mbps-RX',
                data: []
            }]
	  });
// activate the button
$('<button class="btn btn-success2 btn-xs" id="series">Add Series</button>').insertBefore('#monitor-traffic').click(function () {
});
$('#series').click(function () {
    chart.addSeries({
                name: '°C-CPU',
                data: []
            });
	  chart.addSeries({
                name: '°C-Temp',
                data: []
            });
	    chart.addSeries({
                name: 'Volt',
                data: []
            });
	  chart.addSeries({
                name: 'mA-Current',
                data: []
            });
	    chart.addSeries({
                name: '% CPU-Load',
                data: []
            });

    $(this).attr('disabled', true);
});

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
///// 
  });
</script>



<!-- ############################# data_Hotspot_profile ############################# -->
<script type="text/javascript">

$(document).ready(function() {
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
    return {
        radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7
        },
        stops: [
            [0, color],
            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
        ]
    };
});
///////
   chart,
    origChartWidth = 1000,
    origChartHeight = 400,
    chartWidth = origChartWidth,
    chartHeight = origChartHeight;
	////
var chart;
var options = { 
chart: {
renderTo: 'pro_hotspot',
      plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
},
    title: {
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y: ,.0f}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
  
	series: []
};
		        $.getJSON("data/data_hotspotuser_profile.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ############################# data_pppoeuser_profile ############################# -->
<script type="text/javascript">

$(document).ready(function() {
	
	////
var chart;
var options = { 
chart: {
renderTo: 'pro_pppoe',
      plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
},
    title: {
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y: ,.0f}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
  
	series: []
};
		                    $.getJSON("data/data_pppoeuser_profile.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>

<!-- ############################# data_memory ############################# -->
<script type="text/javascript">

$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'memchart',
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
},
    title: {

    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
	
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
  
	series: []
};
		                    $.getJSON("data/data_memory.php", function(json) {
                if(json[0]!=null){
			    options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ############# harddisk ######################## -->
<script type="text/javascript">
    $(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'hddchart',
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {

    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
	
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: []
};
		       $.getJSON("data/data_harddisk.php", function(json) {
				    if(json[0]!=null){
               options.series = json[0].series;}
				options.title = json[1].title;
                 chart = new Highcharts.Chart(options);
            });

/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
});
</script>
<!-- ########################data_hotspot_money####################################### -->
<script type="text/javascript">
$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'hotspot_money',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y: -20
            }
        },
},
    title: {
},
    subtitle: {
},
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
  
	xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',

        pointFormat: '<span style="font-size:18px">{point.y: ,.0f} บาท</span>',

    },
series: [],
	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
    
		series:[]
	}
};
             $.getJSON("data/data_hotspot_money.php", function(json) {
				  if(json[0]!=null){
                options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown;}
				 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
                 chart = new Highcharts.Chart(options);
            });
 
 $('<button   value="hotspot" title= "click update" name="update_money" class="btn btn-primary btn-xs" type="submit">update money</button>').insertBefore('#hotspot_money').click(function () {
});
/////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});

</script>
<!-- #############################pppoe money################################################ -->
<script type="text/javascript">
$(document).ready(function() {
var chart;
var options = { 
chart: {
renderTo: 'pppoe_money',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },
     xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	  pointFormat: '<span style="font-size:18px">{point.y: ,.0f} บาท</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series: [],
	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       series:[]
	}
}///option
             $.getJSON("data/data_pppoe_money.php", function(json) {
               if(json[0]!=null){
			     options.series = json[0].series;
                 options.drilldown.series = json[1].drilldown; }
				  options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
              
                chart = new Highcharts.Chart(options);
            });
 //////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
/////
$('<button   value="pppoe" title= "click update" name="update_money" class="btn btn-success btn-xs" type="submit">update money</button>').insertBefore('#pppoe_money').click(function () {
});
});


</script>
<!--#################### hotspot_up/down #######################-->
<script type="text/javascript">

$(document).ready(function() {
	var chart;
var options = { 

chart: {
renderTo: 'hotspot_load',
        type: 'column',
	zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

		 xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	 // headerFormat: '<span style="font-size:14px">{point.x} {series.name}</span><br>',
        pointFormat: '<span style="font-size:18px">{point.y: ,.2f} Gbps.</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series:[],

	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       
		series:[]
	}

 }

             $.getJSON("data/data_hotspot_load.php", function(json) {
				  if(json[0]!=null){
             options.series = json[0].series;
             options.drilldown.series = json[1].drilldown;}
			 options.title = json[2].title;
				 options.subtitle = json[3].subtitle;
            chart = new Highcharts.Chart(options);
            });

//////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});
</script>
<!-- #################### interface_up/down ################# -->

<script type="text/javascript">

$(document).ready(function() {
	var chart;
var options = { 

chart: {
renderTo: 'interface_load',
        type: 'column',
        options3d: {
           // enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        },
		zoomType: 'xy',
	        resetZoomButton: {
            position: {
              // align: 'right', // by default
              // verticalAlign: 'top', // by default
               x: -50,
                y:-20
            }
        },
},
    title: {
    },
    subtitle: {
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true
            }
        }
    },

		 xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mikrotik Thailand'
        }
    },
	tooltip: {
      headerFormat: '<span style="font-size:14px">{point.key} {series.name}</span><br>',
	 // headerFormat: '<span style="font-size:14px">{point.x} {series.name}</span><br>',
        pointFormat: '<span style="font-size:18px">{point.y: ,.2f} Gbps.</span>',
        //footerFormat: '</table>',
      //  shared: true,
      //  useHTML: true
    },
series:[],

	drilldown: {
		        activeAxisLabelStyle: {
            textDecoration: 'none',
           // fontStyle: 'italic'
        },
        activeDataLabelStyle: {
            textDecoration: 'none',
          //  fontStyle: 'italic'
        },
       drillUpButton: {
            relativeTo: 'spacingBox',
            position: {
                y: 0,
                x: -50
            },
            theme: {
                fill: 'white',
                'stroke-width': 1,
                stroke: 'silver',
                r: 0,
                states: {
                    hover: {
                        fill: '#a4edba'
                    },
                    select: {
                        stroke: '#039',
                        fill: '#a4edba'
                    }
                }
            }

        },
       
		series:[]
	}

 }

             $.getJSON("data/data_interface_load.php", function(json) {
				  if(json[0]!=null){
             options.series = json[0].series;}
          // options.drilldown.series = json[1].drilldown;
			 options.title = json[1].title;
			options.subtitle = json[2].subtitle;
            chart = new Highcharts.Chart(options);
            });

//////////////////////////////////////////
$('#sidebar-hide-btn').click(function () {
    chart.setSize(730, 400);
});

$('#sidebar-show-btn').click(function () {
    chart.setSize(1000, 400);
});
// create some buttons to test the resize logic

$('#sizeplus').click(function () {
   chartWidth = 1200;
   // chartHeight *= 1.1;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizeminus').click(function () {
    chartWidth += (-30);
  //  chartHeight *= 0.9;
    chart.setSize(chartWidth, chartHeight);
});
$('#sizenormal').click(function () {
    chartWidth = origChartWidth;
    chartHeight = origChartHeight;
    chart.setSize(origChartWidth, origChartHeight);
});
});
</script>

	
 </section>  
 