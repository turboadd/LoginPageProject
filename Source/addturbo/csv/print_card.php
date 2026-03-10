<?php
	include_once('../config/routeros_api.class.php');
	include("../include/config.inc.php");
	include_once('../include/account.php');
    $to_print=$_GET['to'];

	$group_user=$db->selectquery("SELECT * FROM mt_gen WHERE ".$to_print."='".$_GET['id']."'");
	$pro=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$group_user['profile']."'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hotspot Vouchers</title>
        <script src="../assets/qr/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/qr/jquery.qrcode.min.js" type="text/javascript"></script>
        <style>
@media print {
  .noprint {
    display: none;
  }
  .pagebreak {
    page-break-after: always;
  }
}
            @media screen {
                html, body {
                    width: 800px;
                }
            }
            body
{
   padding: 0;
   margin:0;
   min-width: 1150px;
   color: #303F50;
   font-size: 10px;
   font-family: Arial, 'Arial Unicode MS', Helvetica, Sans-Serif;
   line-height: 115%;   
}
.kangndo table, table.kangndo
{
   border-collapse: collapse;
   margin: 2px;
}
.kangndo th, .kangndo td
{
   padding: 2px;
   border: solid 1px <?php print $pro['color'];?>;
   vertical-align: top;
   text-align: center;
   font-weight: bold;
}
.vertical-text {
transform: rotate(90deg);
padding: 4px;
float: right;
font-size: 15px;
margin-top: 8px;
width: 10px;

color:#E2341D;
}
            img.logo {
                width: 100%;
                margin-left: auto;
                margin-right: auto;
            }

            .qrcode {
                height: 80px;
                width: 80px;
            }
.style2 {font-size: 9px}
.style3 {
	font-size: 6px;
}
        </style>
    </head>
    <body>
<?php
$sql=$db->DB->prepare("SELECT * FROM mt_gen WHERE ".$to_print."='".$_GET['id']."'");
	        $sql->execute();
	        
            while($result = $sql->fetch( PDO::FETCH_ASSOC )){
?>
<table class="kangndo" style="display: inline-block; background-color:<?php print $pro['color'];?>; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 280px; height:140px;">
<tbody>
<tr>
<td style="width: 190px; text-align: center;"><span style="font-weight: bold; color: rgb(255, 255, 255); font-size: 11px; font-family: Tahoma;"><?php print $pro['card_name'];?></span><br>
<table class="kangndo" style="background-color:#FFFFFF; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 50%; text-align: center;">Package</td>
<td style="width: 50%; text-align: center;"><?php print $pro['package_name'];?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Home Page</td>
<td style="width: 50%; text-align: center;"><?php print $pro['home_page'];?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Time Limit</td>
<td style="width: 50%; text-align: center;"><?php print $pro['time_limit'];?></td>
</tr>
<tr>
<td style="width: 50%; text-align: center;">Price</td>
<td style="width: 50%; text-align: center;">ราคา.&nbsp;<?php print ($pro['pro_price']+$pro['vat']);?>&nbsp;บาท</td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 50%; text-align: center;"><span class="style4"style="color: rgb(255, 255, 255); font-family: Tahoma;">Username</span></td>
<td style="width: 50%; text-align: center;"><span class="style4"style="color: rgb(255, 255, 255); font-family: Tahoma;">Password</span></td>
</tr>
 <tr width: 50%>
<td style="background-color:#FFFFFF; width: 50%; text-align: center;"><span style="color: #400000; font-size:16px; font-family:  Tahoma;"><?php print $result['user'];?></span></td>
<td style="background-color:#FFFFFF; width: 50%; text-align: center;"><span style="color: #400000; font-size:16px; font-family: Tahoma;"><?php print $result['pass'];?></span></td>
</tr>
</tbody>
</table>
<table class="kangndo" style="border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px; border-style: initial; border-color: initial; width: 100%; margin-right: auto; margin-left: auto;">
<tbody>
<tr>
<td style="width: 40%; text-align: left;"><span style="color: rgb(255, 255, 255); font-family: Tahoma;"><?php print $pro['pro_limit'];?></span></td>
<td style="width: 60%; text-align: right;"><span style="color: rgb(255, 255, 255); font-family: Tahoma;">Call: <?php print $pro['phone'];?> </span></td>
</tr>
</table>
</td>
<td style="background-color:#FFFFFF; width: 10px; text-align: center;"><div align="center" class="qrcode" id="<?php print $result['user'];?>"><br><br><font color="red"><span class="style3"><font color="red"><span class="style3">SCAN LOG IN</span><br>
</font></span><script type="text/javascript"> jQuery(function(){jQuery('#<?php print $result["user"];?>').qrcode(     {         "render": 'div',         "size": 80,         "minVersion": 5,         "maxVersion": 5,         "ecLevel": 'L',         "mode": 0,         "text": "http://<?php print $pro['server_ip'];?>/login?username=<?php print $result['user'];?>&password=<?php print $result['pass'];?>",         "quiet": 0,     }  ); }) </script>       </div></td>
</tr>
</tbody>
</table>
 <body onload="window.print();"> 
 <?php
}

?>

</body>
</html>



