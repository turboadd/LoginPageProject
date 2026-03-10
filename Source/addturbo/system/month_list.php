<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 <section class="content"> 
  
    <form name="user" action="" method="post">
        <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><strong>$ Hotspot Month List</strong>                            
                        <?php print $date_time_show;?></div>
						<div class="panel-body">
						<span style="color:#ffffff;
float: left;
"><a href="index.php?page=money_month" class="btn btn-default fa fa-arrow-left"></a>&nbsp;<a href="index.php?page=month_list&id=<?php echo $_GET['id']; ?>" class="btn btn-default fa fa-rotate-right"></a> </span><br><br>
                      <div class="table-responsive">
						<table class="table table-striped table-hover"  id="dataTables-example">
                                  <thead>
                                        <tr>   
											  
                                        	<th>NO.</th>                                                                         	
                                            <th>COMMENT</th>                                            
                                            <th>วันที่</th>
											<th>จำนวนบัตร</th>
											<th>จำนวนเงิน/บาท</th>
                                             </tr>
                                    </thead>        
                                     <tbody>    
                                    <?php
													$comment=$_GET['id'];
													
									$i=0;$total=0;$total2=0;
									$sql=$db->DB->prepare("SELECT * FROM mt_money WHERE month_code='".$comment."'");
	                                   $sql->execute();
									while($result = $sql->fetch( PDO::FETCH_ASSOC ))	{
														$i++;
							
														$condate=$result['date'];
                                                        	echo "<tr>";
																	
															echo "<td>".$i."</td>";								
															echo "<td>".$result['month']."</td>";
															echo "<td>".$convert->Convert_time($condate)."</td>";	
															echo "<td>".$result['tickets']."</td>";
															//echo "<td>".$year."</td>";
															echo "<td>";
															echo      $result['money'];
															echo "</td>";
															echo "</tr>";
															$total = $total + ($result['money']);
															$total2 = $total2 + ($result['tickets']);
													
													}
												?>
												</tbody>
												 <tfoot>   
											  
                                        	<th></th>                                                                         	
                                            <th></th>                                            
                                            <th>ยอดรวม</th>
											<th><?php echo $total2;?></th>
											<th><?php echo $total;?></th>
                                             </tfoot>
											</table>
											</div>
											</div>
								 </div>
							
			<script src="../assets/js/date-time.js"></script>					
  </section>
	
                     