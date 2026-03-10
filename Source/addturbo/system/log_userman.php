	    <?php
		$API->write('/tool/user-manager/log/getall');
                $ARRAY = $API->read();
                $data = $ARRAY;
            ?>  
			 <section class="content">
			 	<style type="text/css">
	div.dataTables_wrapper {
        min-width: 1200px;
        margin: 0 auto;
    }
  </style>
     <div class="<?php print $convert->panel_modify();?>">
                        <div class="<?php print $panel_heading;?>"><i class="fa fa-bar-chart-o"></i>
                           <strong>LOG USERMAN</strong><?php print $date_time_show;?>
                        </div>
						 <div class="panel-body">
						 <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>USER ORIG</th>
                                            <th>COLLING STATION ID</th>
                                            <th>USER IP</th>
                                            <th>HOST-IP</th>
                                            <th>TIME</th>
                                            <th>DESCRIPTION</th>
                                        </tr>
										 <tfoot>
                                            <th>USER ORIG</th>
                                            <th>COLLING STATION ID</th>
                                            <th>USER IP</th>
                                            <th>HOST-IP</th>
                                            <th>TIME</th>
                                            <th>DESCRIPTION</th>
                                        </tfoot>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $data as $index => $baris ) : ?> 
                                        <tr >
                                            <td><?php echo $baris['user-orig']; ?></td>
                                            <td><?php echo $baris['calling-station-id']; ?></td>
                                            <td><?php echo $baris['user-ip']; ?></td>
                                          <td><?php echo $baris['host-ip']; ?></td>
                                            <td><?php echo $baris['time']; ?></td>
											<td><?php echo $baris['description']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>                                  
                                    </tbody>
                                </table>
                            </table>
                                </div>
                            </div> 
							 </div>
							 <script src="../assets/js/date-time.js"></script>
			 </section> 