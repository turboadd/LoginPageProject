

<section class="content"> 
  
                 <div class="row">
         <div class="col-lg-12" >
                  <div class="<?php print $convert->panel_modify();?>">
                   <div class="<?php print $panel_heading;?>">
				  <i class="fa fa-user"></i><strong> PPPOE DATABASES USERS LIST   (PPPOE User ในฐานข้อมูล ) </strong><?php print $date_time_show;?></div>
			    
				<div class="panel-body">
			   <a href="index.php?page=pppoe_dtb_user" class="btn btn-default fa fa-rotate-right"></a><br><br>
					<div class="table-responsive">
					<table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>NO.</th>                                                                         	
                                            <th>PROFILE</th>
                                            <th>Date</th>
											<th>GROUP NAME</th>
                                            <th>TOTAL</th>                                            
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php
													$id=$_SESSION['id'];
			
											
			$db->update_db("pppoe_gen",array("group_code"=>'',),"mt_id='".$id."'");
			   
			$sql=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE mt_id='".$id."' GROUP BY csv_code");
	        $sql->execute();
	          $no=0;
            while($result = $sql->fetch( PDO::FETCH_ASSOC )){
											
													$no++;
													echo "<tr>";
														echo "<td>".$no."</td>";								
														echo "<td>".$result['profile']."</td>";
														echo "<td>".$result['date']."</td>";
														echo "<td>".$result['group_name']."</td>";

														echo "<td>";

								$count= $db->num_rows("pppoe_gen","user","csv_code='".$result['csv_code']."'");
														echo $count;
														echo "<td class=\"text-right\">";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=pppoe_user&id=".$result['csv_code']."'><span class=\"fa fa-list\"></span> ดูรายชื่อ </a>&nbsp;&nbsp;&nbsp;";
									#################################################################################
			$xs_print="on";
			$href_print="href='../csv/print_pppoecard.php?to=csv_code&id=".$result['csv_code']."' target=\"_blank \"";
			echo $convert->button_btn_xs_account($account,$href_print,'','','','','','',$xs_print,'');

			$xs_export="on";
			$onclick_csv="onclick=\"window.open('../csv/export_csv.php?to=csv_code&code=pppoe&id=".$result['csv_code']."')\"";
			echo $convert->button_btn_xs_account($account,$onclick_csv,'','','','','','','',$xs_export);
														 
									echo "</td>";
														  echo "</tr>";
													
														
													
													}
												?>
                                                                                                   
                                                                               
                                    </tbody>
                                </table>
                                </div>
                            	<br>
							<?php
							echo "<a class=\"btn btn-success \"  title= \"click to view\" href='index.php?page=pppoe_all_data_users&id=".$id."'><span class=\"fa fa-list\"></span> ALL DATABASES USERS </a>&nbsp;&nbsp;&nbsp;<a class=\"btn btn-warning \"  title= \"click to  view Card\" href='index.php?page=pppoe_card'><span class=\"fa fa-credit-card\"></span>   View Card  </a>&nbsp;&nbsp;&nbsp;";
							
							?>
							</div> 
							</div> 
							</div>
							</div>
						   <script src="../assets/js/date-time.js"></script>
  </section>

