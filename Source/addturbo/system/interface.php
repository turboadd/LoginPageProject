<?php
		
			
			$ARRAY = $API->comm("/interface/print");			
									   								
?>
                 <section class="content"> 

                     <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong>INTERFACE</strong><?php print $date_time_show;?>
                        </div>
						 <div class="panel-body">
						 <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>     
                                        	<th>No.</th>                                                                     	
                                            <th>NAME</th>
											<th>MAC-ADDRESS</th>
											<th>Tx/Rx-BYTES</th>
                                            <th>COMMENT</th>                                            
                                            <th>TYPE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    <tbody>
                
												<?php
													$num =count($ARRAY);
													$no=1;
													for($i=0; $i<$num; $i++){	
													$no++;
													echo "<tr>";
																																															echo "<td>".$no."</td>";	
														echo "<td>".$ARRAY[$i]['name']."</td>";
														echo "<td>".$ARRAY[$i]['mac-address']."</td>";
		if(($ARRAY[$i]['rx-byte'] || $ARRAY[$i]['tx-byte'])!=0){
		if($ARRAY[$i]['tx-byte']<=1073741824){$tx= (round($ARRAY[$i]['tx-byte']/1048576,1))." M/";
		}else{$tx= (round($ARRAY[$i]['tx-byte']/1073741824,2))." G/";}
		if($ARRAY[$i]['rx-byte']<=1073741824){$rx= (round($ARRAY[$i]['rx-byte']/1048576,1))." M";
		}else{$rx= (round($ARRAY[$i]['rx-byte']/1073741824,2))." G";}}else{$tx="";$rx="";}
	   echo "<td>".$tx."".$rx."</td>";
	   if(!empty($ARRAY[$i]['comment'])){$comment=$ARRAY[$i]['comment'];}else{$comment="";}
														echo "<td>".iconv("tis-620", "utf-8",$comment)."</td>";
													    echo "<td>".$ARRAY[$i]['type']."</td>";
														echo "<td>";
                                                            if($ARRAY[$i]['running']=="true"){
                                                            echo 
															" <a href=\"javascript:popup('index.php?page=interface_traffic&interface=".$ARRAY[$i]['name']."')\" class=\"btn btn-xs btn-success2\"><i class=\"fa fa-random\"></i> Traffic  ON</a>
															";
                                                            }else{
                                                            echo "<a href=\"#\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-random\"></i> Traffic OFF</a>";
                                                            }
                                                           
													}
												?>
                                                                                                   
                                                                               
                                   </tbody>
                                </table>
                                </div>
                            </div> 
							 </div> 
                      	   <script src="../assets/js/date-time.js"></script>
  </section>