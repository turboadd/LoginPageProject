<?php


$ARRAY = $API->comm( '/ip/dhcp-server/lease/print' );
if ( !empty( $_REQUEST[ 'check' ] ) ) {
	if ( $_REQUEST[ 'active' ] ) {
		for ( $i = 0; $i < count( $_REQUEST[ 'check' ] ); $i++ ) {
			$user = $_REQUEST[ 'check' ][ $i ];
			$num = count( $_REQUEST[ 'check' ] );
			$active = $_REQUEST[ 'active' ];
			$num3 = count( $ARRAY );
			for ( $ino1 = 0; $ino1 < $num3; $ino1++ ) {
				if ( $ARRAY[ $ino1 ][ 'address' ] == $user ) {
					$user2 = $ino1;

					$ARRAY2 = $API->comm( "/ip/dhcp-server/lease/" . $active . "
						                         =.id=" . $user2 . "" );
				}
			}



		}

	}
	echo "<script language='javascript'>swal('" . $active . " Successfully!','" . $active . " จำนวน " . $num . " Clients สำเร็จแล้ว!','success').then(function () {
    window.location.href='index.php?page=dhcp';}, function (dismiss) {if (dismiss === 'overlay') {
    window.location.href='index.php?page=dhcp';}})</script>";
	exit();

}

?>


<section class="content">
	<style type="text/css">
		div.dataTables_wrapper {
			min-width: 1200px;
			margin: 0 auto;
		}
	</style>
	<div class="<?php print $convert->panel_modify();?>">
		<div class="<?php print $panel_heading;?>"><i class="fa fa-laptop"></i>
			<strong> DHCP LEASES</strong>
			<?php print $date_time_show;?> </div>
		<div class="panel-body">
			<form name="name" action="" method="post">
				<?php if($_SESSION['customer_login'] != 1) { ?>
				<span>
					<?php
					$small_delete_use = "on";
					$small_disable_use = "on";
					$small_enable_use = "on";
					// $small_edit_use="on";
					$text_del = "select to remove";
					$text_dis = "select to disable";
					$small_del = $convert->botton_small_account( $account, $small_delete_use, '', '', '', '', $text_del, '', '' );
					$small_dis = $convert->botton_small_account( $account, '', $small_disable_use, '', '', '', $text_dis, '', '' );
					$small_ena = $convert->botton_small_account( $account, '', '', $small_enable_use, '', '', '', '', '' );
					///$small_edi=$convert->botton_small_account($account,'','','',$small_edit_use,'','','','');
					echo $small_del;
					echo $small_dis;
					echo $small_ena;
					//echo $small_edi;

					$add_lease = "on";
					$text = "Add dhcp lease";
					$bind = $convert->botton_small_account( $account, '', '', '', '', '', $text, $add_lease, '' );
					echo "<span  style=\"float: right; \">" . $bind . "</span>";
					?>
				</span><br><br>
				<?php } ?>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="3%"><input type="checkbox" id="selecctall"/>
								</th>
								<th>No.</th>
								<th>ADDRESS</th>
								<th>MAC ADDRESS</th>
								<th>ACTIVE ADDRESS</th>
								<th>SERVER</th>
								<th>HOSTNAME</th>
								<th>RATE LIMIT</th>
								<th>COMMENT</th>
								<th class="text-center">STATUS</th>
							</tr>

							<tfoot>
								<th width="3%"><input type="checkbox" id="selecctall1"/>
								</th>
								<th>No.</th>
								<th>ADDRESS</th>
								<th>MAC ADDRESS</th>
								<th>ACTIVE ADDRESS</th>
								<th>SERVER</th>
								<th>HOSTNAME</th>
								<th>RATE LIMIT</th>
								<th>COMMENT</th>
								<th class="text-center">STATUS</th>
							</tfoot>
						</thead>
						<tbody>

							<?php
							$num = count( $ARRAY );
							for ( $i = 0; $i < $num; $i++ ) {
								$no = $i + 1;
								$check_status = $ARRAY[ $i ][ 'disabled' ];
								$profile_check = "off";
								$color = $convert->Expire_color( '', '', $check_status, $profile_check );
								echo "<tr>";
								echo "<td><center><input class=\"checkbox1\" type=\"checkbox\" name=\"check[]\" id=\"check[]\" value=\"" . $ARRAY[ $i ][ 'address' ] . "\"></center></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $no . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'address' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'mac-address' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'active-address' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'server' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'host-name' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . $ARRAY[ $i ][ 'rate-limit' ] . "</span></td>";
								echo "<td><span style=\"color:" . $color . ";\">" . iconv( "tis-620", "utf-8", $ARRAY[ $i ][ 'comment' ] ) . "</span></td>";



								####
								$xs_dis = "on";
								$xs_enab = "on";
								$href_dis = "href=\"index.php?page=disable&return=dhcp&user=" . $ARRAY[ $i ][ '.id' ] . "\"";
								$href_enab = "href=\"index.php?page=enable&return=dhcp&user=" . $ARRAY[ $i ][ '.id' ] . "\"";
								$dis_btn_xs = $convert->button_btn_xs_account( $account, $href_dis, '', $xs_dis, '', '', '', '', '', '' );
								$enab_btn_xs = $convert->button_btn_xs_account( $account, $href_enab, '', '', $xs_enab, '', '', '', '', '' );
								####
								echo "<td class=\"text-right\">";
								if ( $_SESSION[ 'customer_login' ] != 1 ) {
									if ( $ARRAY[ $i ][ 'dynamic' ] == "false" ) {
										if ( $ARRAY[ $i ][ 'disabled' ] == "false" ) {
											echo $dis_btn_xs;
										} else {
											echo $enab_btn_xs;
										}
									}
								}
								if ( $ARRAY[ $i ][ 'status' ] == "bound" ) {
									echo "<button  data-toggle=\"tooltip\" title= \"" . $ARRAY[ $i ][ 'status' ] . "\" name=\"active\" class=\"btn btn-success2 btn-xs\" type=\"button\">&nbsp;&nbsp;" . $ARRAY[ $i ][ 'status' ] . "&nbsp;</button>&nbsp;&nbsp;";
								} else {
									echo "<button  data-toggle=\"tooltip\" title= \"" . $ARRAY[ $i ][ 'status' ] . "\" name=\"active\" class=\"btn btn-black btn-xs\" type=\"button\">&nbsp;" . $ARRAY[ $i ][ 'status' ] . "&nbsp;</button>&nbsp;&nbsp;";
								}
								########################################
								if ( $_SESSION[ 'customer_login' ] != 1 ) {
									if ( $ARRAY[ $i ][ 'dynamic' ] == "false" ) {
										echo "<a class=\"btn btn-warning btn-xs\"  href=\"index.php?page=edit_dhcp&id=" . $i . "\" title=\"click to edit\"  ><span class=\"fa fa-edit \"></span> แก้ไข </a>&nbsp;&nbsp;&nbsp;";
									} else {

										echo "<a class=\"btn btn-primary btn-xs\"  href=\"index.php?page=edit_dhcp&id=" . $i . "\" title=\"click to make static ip\"  ><span class=\"fa fa-edit \"></span>&nbsp;static </a>&nbsp;&nbsp;&nbsp;";
									}
								}
								####################################################################			 
								$xs_delete = "on";
								$onclick_del = "onclick=\"swal({
                    title: 'Are you sure?',
                    text: 'ต้องการจะลบ  " . $ARRAY[ $i ][ 'address' ] . "  จริงหรือไม่ ?',
                    type: 'warning',
					//allowOutsideClick: false,
					//showCloseButton: true,
					 showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    }).then(
                    function () {
                    window.location.href = 'index.php?page=delete&return=dhcp&id=" . $i . "';})\"";
								echo $del_btn_xs = $convert->button_btn_xs_account( $account, $onclick_del, $xs_delete, '', '', '', '', '', '', '' );
								####################################################################
								echo "</td>";
								echo "</tr>";
							}
							?>


						</tbody>
					</table>
				</div>

				<br>
				<div class="form-group input-group">

					<?php




					$delete_use = "on";
					$disable_use = "on";
					$enable_use = "on";
					// $edit_use="on";
					$text_del = "select to remove";
					$text_dis = "select to disable";
					$del = $convert->botton_account( $account, $delete_use, '', '', '', '', '', $text_del );
					$dis = $convert->botton_account( $account, '', $disable_use, '', '', '', '', $text_dis );
					$ena = $convert->botton_account( $account, '', '', $enable_use, '', '', '', '' );
					//$edi=$convert->botton_account($account,'','','',$edit_use,'','','');

					echo $del;
					echo $dis;
					echo $ena;
					///echo $edi;
					?>
				</div>
			</form>
		</div>

	</div>

	<!-- Modal add-->
	<div class="modal fade" id="modeladd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		<div class="modal-dialog" role="document">
			<form name="add" action="index.php?page=add&return=dhcp" method="post">
				<div class="<?php print $convert->panel_modify();?>">
					<div class="box-header with-border">
						<h3 class="box-title">Add Dhcp lease </h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
					</div>
					<div class="panel-body">

						<div class="row">
							<div class="col-xs-12  col-md-6">
								<div class="form-group">
									<span class=" style1"><strong>Address</strong></span>
									<input name="address" type="text" placeholder="Ex. 192.168.1.50" class="form-control" required>
								</div>
							</div>
							<div class="col-xs-12  col-md-6">
								<div class="form-group">
									<span class=" style1"><strong>Mac-address</strong></span>
									<input name="mac" type="text" placeholder="Ex. 00:73:E0:B2:23:64" class="form-control" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12  col-md-6">
								<div class="form-group">
									<span class=" style1"><strong>Rate-limit</strong></span>
									<input name="rate_limit" type="text" placeholder="Ex. 1M/20M (upload/download)" class="form-control">
								</div>
							</div>



							<div class="col-xs-12  col-md-6">
								<div class="form-group">
									<span class=" style1"><strong>Server</strong></span>
									<select name="server" id="server" class="form-control" required>
										<option value="all">all</option>
										<?php
										$ARRAY = $API->comm( "/ip/dhcp-server/print" );
										$num = count( $ARRAY );
										for ( $i = 0; $i < $num; $i++ ) {
											if ( !empty( $ARRAY[ $i ][ 'name' ] ) ) {
												$seleceted = ( $i == 0 ) ? 'selected="selected"' : '';
												echo '<option value="' . $ARRAY[ $i ][ 'name' ] . $selected . '">' . $ARRAY[ $i ][ 'name' ] . '</option>';
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
									<span class=" style1"><strong>Comment</strong></span>
									<input name="comment" type="text" placeholder="comment" maxlength="30" class="form-control">
								</div>
							</div>
						</div>
						<br>





						<div class="row">
							<div class="col-lg-12 col-md-12 ">
								<?php

								$bottonbtn_success = "on";
								$text_success = "&nbsp;&nbsp;&nbsp;<i class=\"fa fa-check\"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;";
								echo $convert->button_btn_submit_account( $account, $text_success, $bottonbtn_success, '', '', '', '', '' );
								?>

								<button id="btnCancel" class="btn btn-danger" type="reset" Onclick="window.location.href = 'index.php?page=dhcp'">&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;
								<span class="hidden-xs"><button id="btnSave" class="btn btn-warning" type="reset">&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i>&nbsp;Reset&nbsp;&nbsp;&nbsp;</button></span>
							</div>
						</div>

					</div>
				</div>
			</form>
		</div>
	</div>



	<!-- ##############/.Modal add ####################### -->
	<script src="../assets/js/date-time.js"></script>
</section>