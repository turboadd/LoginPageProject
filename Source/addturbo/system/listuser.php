<section class="content"> 
 
                 <div class="row">
         <div class="col-lg-12" >
                  <div class="<?php print $convert->panel_modify();?>">
                 <div class="<?php print $panel_heading;?>"><strong><i class="fa fa-user"></i>
                            HOTSPOT DATABASES USER LIST   ( USER ในฐานข้อมูล ) </strong><?php print $date_time_show;?>
                        </div>
						<div class="panel-body">
						<span ><a href="index.php?page=listuser" class="btn btn-default fa fa-rotate-right"></a> </span><br><br>
						<div class="table-responsive">
                        <table class="table table-striped table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>NO.</th>                                                                         	
                                            <th>PROFILE</th>
                                            <th class="text-center">DATE</th>
											<th>GROUP NAME</th>
                                            <th>TOTAL</th>                                            
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            
												<?php
												
													$id=$_SESSION['id'];
			

            $db->update_db("mt_gen",array("group_code"=>'',),"mt_id='".$id."'");
			   
			$sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE mt_id='".$id."' GROUP BY profile");
	        $sql->execute();
	          $no=0;
            while($result = $sql->fetch( PDO::FETCH_ASSOC )){
				
                $no++;
				   
		 									               echo "<tr>";
														echo "<td>".$no."</td>";								
														echo "<td>".$result['profile']."</td>";
														echo "<td class=\"text-center\">".$result['date']."</td>";
														echo "<td>".$result['group_name']."</td>";
														echo "<td>";
					$count= $db->num_rows("mt_gen","user","profile='".$result['profile']."'");
														echo $count;
														echo "<td class=\"text-right\">";
														 echo"<a class=\"btn btn-black btn-xs\"  title= \"click to view\" href='index.php?page=user&id=".$result['profile']."'><span class=\"fa fa-list\"></span> ดูรายชื่อ </a>&nbsp;&nbsp;&nbsp;";
                             ###########################################################

			$xs_print="on";
			$href_print="href='../csv/print_card.php?to=profile&id=".$result['profile']."' target=\"_blank \"";
					echo $convert->button_btn_xs_account($account,$href_print,'','','','','','',$xs_print,'');

			$xs_export="off";
			$onclick_csv="onclick=\"window.open('../csv/export_csv.php?to=csv_code&code=hotspot&id=".$result['csv_code']."')\"";
					echo $convert->button_btn_xs_account($account,$onclick_csv,'','','','','','','',$xs_export);
														 
														 
														 echo "</td>";
														  echo "</tr>";
                         
													
													}
												?>
                                                                                                   
                                                                               
                                    </tbody>
                                </table>
                           </div>
							</br>

							<?php
							echo "<a class=\"btn btn-success \"  title= \"click to view\" href='index.php?page=all_data_users&id=".$id."'>
							<span class=\"fa fa-list\"></span> ALL DATABASES USERS </a>&nbsp;&nbsp;&nbsp;
							<a class=\"btn btn-warning \"  title= \"click to view card\" href='index.php?page=card'><span class=\"fa fa-credit-card\"></span>  View Card  </a>&nbsp;&nbsp;&nbsp;";
							
							?>
					</div>	
					 </div>
					 </div>	
					 </div>
				<script src="../assets/js/date-time.js"></script>	
  </section>