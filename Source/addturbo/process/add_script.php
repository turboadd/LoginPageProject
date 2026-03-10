<?php
	

	$clock = $API->comm("/system/clock/print");
	$script = $API->comm("/system/scheduler/print");
	$num =count($script);
         $conf=($num+1); 
	$pro_no1=$_REQUEST['pro_no1'];
	$pro_no2=$_REQUEST['pro_no2'];
	$pro_no3=$_REQUEST['pro_no3'];
	$pro_no4=$_REQUEST['pro_no4'];
	$pro_no5=$_REQUEST['pro_no5'];
	$pro_no6=$_REQUEST['pro_no6'];
	$pro_no7=$_REQUEST['pro_no7'];
	$pro_no8=$_REQUEST['pro_no8'];
	$pro_no9=$_REQUEST['pro_no9'];
	$pro_no10=$_REQUEST['pro_no10'];
    #############ADD################
	$pro_no11=$_REQUEST['pro_no11'];
	$pro_no12=$_REQUEST['pro_no12'];
	$pro_no13=$_REQUEST['pro_no13'];
	$pro_no14=$_REQUEST['pro_no14'];
	$pro_no15=$_REQUEST['pro_no15'];
	$pro_no16=$_REQUEST['pro_no16'];
	$pro_no17=$_REQUEST['pro_no17'];
	$pro_no18=$_REQUEST['pro_no18'];
	$pro_no19=$_REQUEST['pro_no19'];
	$pro_no20=$_REQUEST['pro_no20'];
	############################
	
	
	$scr_no1=""; if($pro_no1!=""){$scr_no1="profile=\"".$pro_no1."\"";}
	$scr_no2=""; if($pro_no2!=""){$scr_no2=" || profile=\"".$pro_no2."\"";}
	$scr_no3=""; if($pro_no3!=""){$scr_no3=" || profile=\"".$pro_no3."\"";}
	$scr_no4=""; if($pro_no4!=""){$scr_no4=" || profile=\"".$pro_no4."\"";}
	$scr_no5=""; if($pro_no5!=""){$scr_no5=" || profile=\"".$pro_no5."\"";}
	$scr_no6=""; if($pro_no6!=""){$scr_no6=" || profile=\"".$pro_no6."\"";}
	$scr_no7=""; if($pro_no7!=""){$scr_no7=" || profile=\"".$pro_no7."\"";}
	$scr_no8=""; if($pro_no8!=""){$scr_no8=" || profile=\"".$pro_no8."\"";}
	$scr_no9=""; if($pro_no9!=""){$scr_no9=" || profile=\"".$pro_no9."\"";}
	$scr_no10=""; if($pro_no10!=""){$scr_no10=" || profile=\"".$pro_no10."\"";}
	###############ADD#################
	$scr_no11=""; if($pro_no11!=""){$scr_no11=" || profile=\"".$pro_no11."\"";}
	$scr_no12=""; if($pro_no12!=""){$scr_no12=" || profile=\"".$pro_no12."\"";}
	$scr_no13=""; if($pro_no13!=""){$scr_no13=" || profile=\"".$pro_no13."\"";}
	$scr_no14=""; if($pro_no14!=""){$scr_no14=" || profile=\"".$pro_no14."\"";}
	$scr_no15=""; if($pro_no15!=""){$scr_no15=" || profile=\"".$pro_no15."\"";}
	$scr_no16=""; if($pro_no16!=""){$scr_no16=" || profile=\"".$pro_no16."\"";}
	$scr_no17=""; if($pro_no17!=""){$scr_no17=" || profile=\"".$pro_no17."\"";}
	$scr_no18=""; if($pro_no18!=""){$scr_no18=" || profile=\"".$pro_no18."\"";}
	$scr_no19=""; if($pro_no19!=""){$scr_no19=" || profile=\"".$pro_no19."\"";}
	$scr_no20=""; if($pro_no20!=""){$scr_no20=" || profile=\"".$pro_no20."\"";}
	###################################
	
	
	$settotal_pro="".$scr_no1."".$scr_no2."".$scr_no3."".$scr_no4."".$scr_no5."".$scr_no6."".$scr_no7."".$scr_no8."".$scr_no9."".$scr_no10."".$scr_no11."".$scr_no12."".$scr_no13."".$scr_no14."".$scr_no15."".$scr_no16."".$scr_no17."".$scr_no18."".$scr_no19."".$scr_no20."";

	$offset_remove=$_REQUEST['after_expir'];

    $filter1_str_validity=substr("".$_REQUEST['expirepro_no1']."",-1);
	$filter1_num_validity=round("".$_REQUEST['expirepro_no1']."");
	$filter1_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter1_hour_validity= $filter1_validity_arr[$filter1_str_validity];
    $expirepro_no1=($filter1_num_validity*$filter1_hour_validity);
	
	$filter2_str_validity=substr("".$_REQUEST['expirepro_no2']."",-1);
	$filter2_num_validity=round("".$_REQUEST['expirepro_no2']."");
	$filter2_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter2_hour_validity= $filter2_validity_arr[$filter2_str_validity];
    $expirepro_no2=($filter2_num_validity*$filter2_hour_validity);

	$filter3_str_validity=substr("".$_REQUEST['expirepro_no3']."",-1);
	$filter3_num_validity=round("".$_REQUEST['expirepro_no3']."");
	$filter3_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter3_hour_validity= $filter3_validity_arr[$filter3_str_validity];
    $expirepro_no3=($filter3_num_validity*$filter3_hour_validity);

	$filter4_str_validity=substr("".$_REQUEST['expirepro_no4']."",-1);
	$filter4_num_validity=round("".$_REQUEST['expirepro_no4']."");
	$filter4_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter4_hour_validity= $filter4_validity_arr[$filter4_str_validity];
    $expirepro_no4=($filter4_num_validity*$filter4_hour_validity);

	$filter5_str_validity=substr("".$_REQUEST['expirepro_no5']."",-1);
	$filter5_num_validity=round("".$_REQUEST['expirepro_no5']."");
	$filter5_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter5_hour_validity= $filter5_validity_arr[$filter5_str_validity];
    $expirepro_no5=($filter5_num_validity*$filter5_hour_validity);

	$filter6_str_validity=substr("".$_REQUEST['expirepro_no6']."",-1);
	$filter6_num_validity=round("".$_REQUEST['expirepro_no6']."");
	$filter6_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter6_hour_validity= $filter6_validity_arr[$filter6_str_validity];
    $expirepro_no6=($filter6_num_validity*$filter6_hour_validity);

	$filter7_str_validity=substr("".$_REQUEST['expirepro_no7']."",-1);
	$filter7_num_validity=round("".$_REQUEST['expirepro_no7']."");
	$filter7_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter7_hour_validity= $filter7_validity_arr[$filter7_str_validity];
    $expirepro_no7=($filter7_num_validity*$filter7_hour_validity);

	$filter8_str_validity=substr("".$_REQUEST['expirepro_no8']."",-1);
	$filter8_num_validity=round("".$_REQUEST['expirepro_no8']."");
	$filter8_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter8_hour_validity= $filter8_validity_arr[$filter8_str_validity];
    $expirepro_no8=($filter8_num_validity*$filter8_hour_validity);

	$filter9_str_validity=substr("".$_REQUEST['expirepro_no9']."",-1);
	$filter9_num_validity=round("".$_REQUEST['expirepro_no9']."");
	$filter9_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter9_hour_validity= $filter9_validity_arr[$filter9_str_validity];
    $expirepro_no9=($filter9_num_validity*$filter9_hour_validity);

	$filter10_str_validity=substr("".$_REQUEST['expirepro_no10']."",-1);
	$filter10_num_validity=round("".$_REQUEST['expirepro_no10']."");
	$filter10_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter10_hour_validity= $filter10_validity_arr[$filter10_str_validity];
    $expirepro_no10=($filter10_num_validity*$filter10_hour_validity);

	################ADD########################
	$filter11_str_validity=substr("".$_REQUEST['expirepro_no11']."",-1);
	$filter11_num_validity=round("".$_REQUEST['expirepro_no11']."");
	$filter11_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter11_hour_validity= $filter11_validity_arr[$filter11_str_validity];
    $expirepro_no11=($filter11_num_validity*$filter11_hour_validity);

	$filter12_str_validity=substr("".$_REQUEST['expirepro_no12']."",-1);
	$filter12_num_validity=round("".$_REQUEST['expirepro_no12']."");
	$filter12_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter12_hour_validity= $filter12_validity_arr[$filter12_str_validity];
    $expirepro_no12=($filter12_num_validity*$filter12_hour_validity);

	$filter13_str_validity=substr("".$_REQUEST['expirepro_no13']."",-1);
	$filter13_num_validity=round("".$_REQUEST['expirepro_no13']."");
	$filter13_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter13_hour_validity= $filter13_validity_arr[$filter13_str_validity];
    $expirepro_no13=($filter13_num_validity*$filter13_hour_validity);

	$filter14_str_validity=substr("".$_REQUEST['expirepro_no14']."",-1);
	$filter14_num_validity=round("".$_REQUEST['expirepro_no14']."");
	$filter14_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter14_hour_validity= $filter14_validity_arr[$filter14_str_validity];
    $expirepro_no14=($filter14_num_validity*$filter14_hour_validity);

	$filter15_str_validity=substr("".$_REQUEST['expirepro_no15']."",-1);
	$filter15_num_validity=round("".$_REQUEST['expirepro_no15']."");
	$filter15_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter15_hour_validity= $filter15_validity_arr[$filter15_str_validity];
    $expirepro_no15=($filter15_num_validity*$filter15_hour_validity);

	$filter16_str_validity=substr("".$_REQUEST['expirepro_no16']."",-1);
	$filter16_num_validity=round("".$_REQUEST['expirepro_no16']."");
	$filter16_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter16_hour_validity= $filter16_validity_arr[$filter16_str_validity];
    $expirepro_no16=($filter16_num_validity*$filter16_hour_validity);

	$filter17_str_validity=substr("".$_REQUEST['expirepro_no17']."",-1);
	$filter17_num_validity=round("".$_REQUEST['expirepro_no17']."");
	$filter17_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter17_hour_validity= $filter17_validity_arr[$filter17_str_validity];
    $expirepro_no17=($filter17_num_validity*$filter17_hour_validity);

	$filter18_str_validity=substr("".$_REQUEST['expirepro_no18']."",-1);
	$filter18_num_validity=round("".$_REQUEST['expirepro_no18']."");
	$filter18_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter18_hour_validity= $filter18_validity_arr[$filter18_str_validity];
    $expirepro_no18=($filter18_num_validity*$filter18_hour_validity);

	$filter19_str_validity=substr("".$_REQUEST['expirepro_no19']."",-1);
	$filter19_num_validity=round("".$_REQUEST['expirepro_no19']."");
	$filter19_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter19_hour_validity= $filter19_validity_arr[$filter19_str_validity];
    $expirepro_no19=($filter19_num_validity*$filter19_hour_validity);

	$filter20_str_validity=substr("".$_REQUEST['expirepro_no20']."",-1);
	$filter20_num_validity=round("".$_REQUEST['expirepro_no20']."");
	$filter20_validity_arr=array("D"=>"24","d"=>"24","H"=>"1","h"=>"1","W"=>"168","w"=>"168");
	$filter20_hour_validity= $filter20_validity_arr[$filter20_str_validity];
    $expirepro_no20=($filter20_num_validity*$filter20_hour_validity);
	################ ./ADD#####################



	

   $scr_exno1=""; if($expirepro_no1!=0){$scr_exno1=":if (\"\$prof".($conf)."H\" = \"".$pro_no1."\") do={:set offset".($conf)."H ".$expirepro_no1."}";}
   $scr_exno2=""; if($expirepro_no2!=0){$scr_exno2=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no2."\") do={:set offset".($conf)."H ".$expirepro_no2."}";}
   $scr_exno3=""; if($expirepro_no3!=0){$scr_exno3=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no3."\") do={:set offset".($conf)."H ".$expirepro_no3."}";}
   $scr_exno4=""; if($expirepro_no4!=0){$scr_exno4=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no4."\") do={:set offset".($conf)."H ".$expirepro_no4."}";}
   $scr_exno5=""; if($expirepro_no5!=0){$scr_exno5=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no5."\") do={:set offset".($conf)."H ".$expirepro_no5."}";}
   $scr_exno6=""; if($expirepro_no6!=0){$scr_exno6=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no6."\") do={:set offset".($conf)."H ".$expirepro_no6."}";}
   $scr_exno7=""; if($expirepro_no7!=0){$scr_exno7=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no7."\") do={:set offset".($conf)."H ".$expirepro_no7."}";}
   $scr_exno8=""; if($expirepro_no8!=0){$scr_exno8=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no8."\") do={:set offset".($conf)."H ".$expirepro_no8."}";}
   $scr_exno9=""; if($expirepro_no9!=0){$scr_exno9=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no9."\") do={:set offset".($conf)."H ".$expirepro_no9."}";}
   $scr_exno10=""; if($expirepro_no10!=0){$scr_exno10=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no10."\") do={:set offset".($conf)."H ".$expirepro_no10."}";}
   ###########################ADD###############
   $scr_exno11=""; if($expirepro_no11!=0){$scr_exno11=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no11."\") do={:set offset".($conf)."H ".$expirepro_no11."}";}
   $scr_exno12=""; if($expirepro_no12!=0){$scr_exno12=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no12."\") do={:set offset".($conf)."H ".$expirepro_no12."}";}
   $scr_exno13=""; if($expirepro_no13!=0){$scr_exno13=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no13."\") do={:set offset".($conf)."H ".$expirepro_no13."}";}
   $scr_exno14=""; if($expirepro_no14!=0){$scr_exno14=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no14."\") do={:set offset".($conf)."H ".$expirepro_no14."}";}
   $scr_exno15=""; if($expirepro_no15!=0){$scr_exno15=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no15."\") do={:set offset".($conf)."H ".$expirepro_no15."}";}
   $scr_exno16=""; if($expirepro_no16!=0){$scr_exno16=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no16."\") do={:set offset".($conf)."H ".$expirepro_no16."}";}
   $scr_exno17=""; if($expirepro_no17!=0){$scr_exno17=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no17."\") do={:set offset".($conf)."H ".$expirepro_no17."}";}
   $scr_exno18=""; if($expirepro_no18!=0){$scr_exno18=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no18."\") do={:set offset".($conf)."H ".$expirepro_no18."}";}
   $scr_exno19=""; if($expirepro_no19!=0){$scr_exno19=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no19."\") do={:set offset".($conf)."H ".$expirepro_no19."}";}
   $scr_exno20=""; if($expirepro_no20!=0){$scr_exno20=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no20."\") do={:set offset".($conf)."H ".$expirepro_no20."}";}
   ###########################/.ADD############



   $scr_remno1=""; if($expirepro_no1!=0){$scr_remno1=":if (\"\$prof".($conf)."H\" = \"".$pro_no1."\") do={:set offset".($conf)."H ".($expirepro_no1+$offset_remove)."}";}
   $scr_remno2=""; if($expirepro_no2!=0){$scr_remno2=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no2."\") do={:set offset".($conf)."H ".($expirepro_no2+$offset_remove)."}";}
   $scr_remno3=""; if($expirepro_no3!=0){$scr_remno3=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no3."\") do={:set offset".($conf)."H ".($expirepro_no3+$offset_remove)."}";}
   $scr_remno4=""; if($expirepro_no4!=0){$scr_remno4=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no4."\") do={:set offset".($conf)."H ".($expirepro_no4+$offset_remove)."}";}
   $scr_remno5=""; if($expirepro_no5!=0){$scr_remno5=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no5."\") do={:set offset".($conf)."H ".($expirepro_no5+$offset_remove)."}";}
   $scr_remno6=""; if($expirepro_no6!=0){$scr_remno6=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no6."\") do={:set offset".($conf)."H ".($expirepro_no6+$offset_remove)."}";}
   $scr_remno7=""; if($expirepro_no7!=0){$scr_remno7=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no7."\") do={:set offset".($conf)."H ".($expirepro_no7+$offset_remove)."}";}
   $scr_remno8=""; if($expirepro_no8!=0){$scr_remno8=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no8."\") do={:set offset".($conf)."H ".($expirepro_no8+$offset_remove)."}";}
   $scr_remno9=""; if($expirepro_no9!=0){$scr_remno9=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no9."\") do={:set offset".($conf)."H ".($expirepro_no9+$offset_remove)."}";}
   $scr_remno10=""; if($expirepro_no10!=0){$scr_remno10=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no10."\") do={:set offset".($conf)."H ".($expirepro_no10+$offset_remove)."}";}
   ########################### ADD ############
   $scr_remno11=""; if($expirepro_no11!=0){$scr_remno11=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no11."\") do={:set offset".($conf)."H ".($expirepro_no11+$offset_remove)."}";}
   $scr_remno12=""; if($expirepro_no12!=0){$scr_remno12=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no12."\") do={:set offset".($conf)."H ".($expirepro_no12+$offset_remove)."}";}
   $scr_remno13=""; if($expirepro_no13!=0){$scr_remno13=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no13."\") do={:set offset".($conf)."H ".($expirepro_no13+$offset_remove)."}";}
   $scr_remno14=""; if($expirepro_no14!=0){$scr_remno14=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no14."\") do={:set offset".($conf)."H ".($expirepro_no14+$offset_remove)."}";}
   $scr_remno15=""; if($expirepro_no15!=0){$scr_remno15=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no15."\") do={:set offset".($conf)."H ".($expirepro_no15+$offset_remove)."}";}
   $scr_remno16=""; if($expirepro_no16!=0){$scr_remno16=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no16."\") do={:set offset".($conf)."H ".($expirepro_no16+$offset_remove)."}";}
   $scr_remno17=""; if($expirepro_no17!=0){$scr_remno17=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no17."\") do={:set offset".($conf)."H ".($expirepro_no17+$offset_remove)."}";}
   $scr_remno18=""; if($expirepro_no18!=0){$scr_remno18=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no18."\") do={:set offset".($conf)."H ".($expirepro_no18+$offset_remove)."}";}
   $scr_remno19=""; if($expirepro_no19!=0){$scr_remno19=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no19."\") do={:set offset".($conf)."H ".($expirepro_no19+$offset_remove)."}";}
   $scr_remno20=""; if($expirepro_no20!=0){$scr_remno20=" else={:if (\"\$prof".($conf)."H\" = \"".$pro_no20."\") do={:set offset".($conf)."H ".($expirepro_no20+$offset_remove)."}";}
   ###########################/.ADD############
  
  
   
   $end2=""; if($expirepro_no2!=0){$end2="}";}
   $end3=""; if($expirepro_no3!=0){$end3="}";}
   $end4=""; if($expirepro_no4!=0){$end4="}";}
   $end5=""; if($expirepro_no5!=0){$end5="}";}
   $end6=""; if($expirepro_no6!=0){$end6="}";}
   $end7=""; if($expirepro_no7!=0){$end7="}";}
   $end8=""; if($expirepro_no8!=0){$end8="}";}
   $end9=""; if($expirepro_no9!=0){$end9="}";}
   $end10=""; if($expirepro_no10!=0){$end10="}";}
   #########ADD#######
   $end11=""; if($expirepro_no11!=0){$end11="}";}
   $end12=""; if($expirepro_no12!=0){$end12="}";}
   $end13=""; if($expirepro_no13!=0){$end13="}";}
   $end14=""; if($expirepro_no14!=0){$end14="}";}
   $end15=""; if($expirepro_no15!=0){$end15="}";}
   $end16=""; if($expirepro_no16!=0){$end16="}";}
   $end17=""; if($expirepro_no17!=0){$end17="}";}
   $end18=""; if($expirepro_no18!=0){$end18="}";}
   $end19=""; if($expirepro_no19!=0){$end19="}";}
   $end20=""; if($expirepro_no20!=0){$end20="}";}
   ##################

  $settotal_expire="".$scr_exno1."".$scr_exno2."".$scr_exno3."".$scr_exno4."".$scr_exno5."".$scr_exno6."".$scr_exno7."".$scr_exno8."".$scr_exno9."".$scr_exno10."".$scr_exno11."".$scr_exno12."".$scr_exno13."".$scr_exno14."".$scr_exno15."".$scr_exno16."".$scr_exno17."".$scr_exno18."".$scr_exno19."".$scr_exno20."".$end20."".$end19."".$end18."".$end17."".$end16."".$end15."".$end14."".$end13."".$end12."".$end11."".$end10."".$end9."".$end8."".$end7."".$end6."".$end5."".$end4."".$end3."".$end2."";

  $settotal_remove="".$scr_remno1."".$scr_remno2."".$scr_remno3."".$scr_remno4."".$scr_remno5."".$scr_remno6."".$scr_remno7."".$scr_remno8."".$scr_remno9."".$scr_remno10."".$scr_remno11."".$scr_remno12."".$scr_remno13."".$scr_remno14."".$scr_remno15."".$scr_remno16."".$scr_remno17."".$scr_remno18."".$scr_remno19."".$scr_remno20."".$end20."".$end19."".$end18."".$end17."".$end16."".$end15."".$end14."".$end13."".$end12."".$end11."".$end10."".$end9."".$end8."".$end7."".$end6."".$end5."".$end4."".$end3."".$end2."";


	
	$expire_name="HOTSPOTstep1_Expire_User_".($num)."";
	$disable_name="HOTSPOTstep2_Disable_Expire_User_".($num)."";
	$remove_name="HOTSPOTstep3_Remove_User_Disabled_".($num)."";
	
	$interval_expire="00:01:00";
	$interval_disable="1d";
	$interval_remove="1d";
	$startdate_expire="jan/01/2000";

	//$start_time_expire="startup";
    $start_time_expire=$clock['0']['time'];
	$start_time_disable="05:05:15";
	$start_time_remove="05:10:15";
	if($_REQUEST['show_error']==1){
		$show_error_expire=" else={:local name".($num+1)."ERR [/ip hotspot user get \$i".($num+1)."i name];:set prof".($conf)."H [/ip hotspot user get \$i".($num+1)."i profile ];:log error \"ERROR HOTSPOT EXPIRE SCRIPT user :\$name".($num+1)."ERR profile \$prof".($conf)."H error by comment \$date\";}";

		$show_error_disable=" else={:local name".($num+2)."ERR [/ip hotspot user get \$i".($num+2)."i name];:set prof".($conf)."H [/ip hotspot user get \$i".($num+2)."i profile ];:log error \"ERROR HOTSPOT DISABLE SCRIPT user :\$name".($num+2)."ERR profile \$prof".($conf)."H error by comment \$date\";}";

		$show_error_remove=" else={:local name".($num+3)."ERR [/ip hotspot user get \$i".($num+3)."i name];:set prof".($conf)."H [/ip hotspot user get \$i".($num+3)."i profile ];:log error \"ERROR HOTSPOT REMOVE SCRIPT user :\$name".($num+3)."ERR profile \$prof".($conf)."H error by comment \$date\";}";}else{
		$show_error_expire="";
		$show_error_disable="";
		$show_error_remove="";}

	 $on_event_expire="{:global offset".($conf)."H;:global today;:global prof".($conf)."H;global yearTODAY;{:local date [ /system clock get date ];:local time [/system clock get time ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:set yearTODAY [ :pick \$date 7 11 ];:local monthdays;:if ((\$yearTODAY % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local months ([ :find \$montharray \$monthtxt]);:local hours [:pick \$time 0 2];:local minutes [:pick \$time 3 5];:local seconds [:pick \$time 6 8];:local todaytime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ]);:set daysmonth ( [ :pick \$monthdays \$nodays ] );};:set days ((\$yearTODAY-2017) * 365  + \$days -\$daysmonth );:set today (( \$days * 86400 )+\$todaytime);};:foreach i".($num+1)."i in [ /ip hotspot user find where limit-uptime!=00:00:01 disabled=no(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i".($num+1)."i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i".($num+1)."i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthtxt [ :pick \$date 0 3 ];:local countcomment [ len \$date];:if (\$countcomment >=20) do={:set \$countcomment 1;} else={:set \$countcomment 0;};:local aaa ([ :find \$montharray \$monthtxt]);:if (\$aaa > -1) do={:set \$aaa 1;} else={:set \$aaa 0;};:local bbb [ :pick \$date 3 4 ];:local ccc [ :pick \$date 6 7 ];:local ddd (\"\",\"/\");:local eee ([ :find \$ddd \$bbb]);:local eee2 ([ :find \$ddd \$ccc]);:local fff [ :pick \$date 14 15 ];:local ggg [ :pick \$date 17 18 ];:local hhh (\"\",\":\");:local kkk ([ :find \$hhh \$fff]);:local kkk2 ([ :find \$hhh \$ggg]);:local check".($num+1)."H (\$countcomment + \$aaa + \$eee + \$eee2 + \$kkk + \$kkk2);:if ((\$check".($num+1)."H)=6) do={:local year [ :pick \$date 7 11 ];:local monthdays;:if ((\$year % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local hours [:pick \$date 12 14];:local minutes [:pick \$date 15 17];:local seconds [:pick \$date 18 20];:local months ( [ :find \$montharray \$monthtxt ] );:local starttime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof".($conf)."H [/ip hotspot user get \$i".($num+1)."i profile ];".$settotal_expire."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set days ( \$days * 86400 );:local conoffset ( \$offset".($conf)."H * 3600 );:local stoplogoff (\$days + \$conoffset+\$starttime);:local plus 0;:if (((\$year % 4)=0)&&((\$yearTODAY % 4)!=0) ) do={:set \$plus 86400;};:if (((\$year % 4)=0)&&((\$yearTODAY % 4)=0)) do={:if (\$year != \$yearTODAY) do={:set \$plus 86400;};};:if ( \$stoplogoff < (\$today+\$plus)) do={ :local name".($num+1)."EXP [/ip hotspot user get \$i".($num+1)."i name];:log warning \"HOTSPOT EXPIRE SCRIPT: Profile \$prof".($conf)."H Set expire user :\$name".($num+1)."EXP  first logged in \$date\";[ /ip hotspot user set \$i".($num+1)."i limit-uptime=1];[ /ip hotspot active remove [find where user=\$name".($num+1)."EXP] ];}}".$show_error_expire."}}}";

    $on_event_disable="{:global offset".($conf)."H;:global today;:global prof".($conf)."H;global yearTODAY;{:local date [ /system clock get date ];:local time [/system clock get time ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:set yearTODAY [ :pick \$date 7 11 ];:local monthdays;:if ((\$yearTODAY % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local months ([ :find \$montharray \$monthtxt]);:local hours [:pick \$time 0 2];:local minutes [:pick \$time 3 5];:local seconds [:pick \$time 6 8];:local todaytime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ]);:set daysmonth ( [ :pick \$monthdays \$nodays ] );};:set days ((\$yearTODAY-2017) * 365  + \$days -\$daysmonth );:set today (( \$days * 86400 )+\$todaytime);};:foreach i".($num+2)."i in [ /ip hotspot user find where limit-uptime=00:00:01 disabled=no(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i".($num+2)."i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i".($num+2)."i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthtxt [ :pick \$date 0 3 ];:local countcomment [ len \$date];:if (\$countcomment >=20) do={:set \$countcomment 1;} else={:set \$countcomment 0;};:local aaa ([ :find \$montharray \$monthtxt]);:if (\$aaa > -1) do={:set \$aaa 1;} else={:set \$aaa 0;};:local bbb [ :pick \$date 3 4 ];:local ccc [ :pick \$date 6 7 ];:local ddd (\"\",\"/\");:local eee ([ :find \$ddd \$bbb]);:local eee2 ([ :find \$ddd \$ccc]);:local fff [ :pick \$date 14 15 ];:local ggg [ :pick \$date 17 18 ];:local hhh (\"\",\":\");:local kkk ([ :find \$hhh \$fff]);:local kkk2 ([ :find \$hhh \$ggg]);:local check".($num+2)."H (\$countcomment + \$aaa + \$eee + \$eee2 + \$kkk + \$kkk2);:if ((\$check".($num+2)."H)=6) do={:local year [ :pick \$date 7 11 ];:local monthdays;:if ((\$year % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local hours [:pick \$date 12 14];:local minutes [:pick \$date 15 17];:local seconds [:pick \$date 18 20];:local months ( [ :find \$montharray \$monthtxt ] );:local starttime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof".($conf)."H [/ip hotspot user get \$i".($num+2)."i profile ];".$settotal_expire."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set days ( \$days * 86400 );:local conoffset ( \$offset".($conf)."H * 3600 );:local stoplogoff (\$days + \$conoffset+\$starttime+86400);:local plus 0;:if (((\$year % 4)=0)&&((\$yearTODAY % 4)!=0) ) do={:set \$plus 86400;};:if (((\$year % 4)=0)&&((\$yearTODAY % 4)=0)) do={:if (\$year != \$yearTODAY) do={:set \$plus 86400;};};:if ( \$stoplogoff < (\$today+\$plus)) do={ :local name".($num+2)."DIS [/ip hotspot user get \$i".($num+2)."i name];:log warning \"HOTSPOT DISABLE SCRIPT:Disabling Profile \$prof".($conf)."H user \$name".($num+2)."DIS first logged in \$date\";[ /ip hotspot user disable \$i".($num+2)."i ];}}".$show_error_disable."}}}";



	$on_event_remove="{:global offset".($conf)."H;:global today;:global prof".($conf)."H;global yearTODAY;{:local date [ /system clock get date ];:local time [/system clock get time ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:set yearTODAY [ :pick \$date 7 11 ];:local monthdays;:if ((\$yearTODAY % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local monthtxt [ :pick \$date 0 3 ];:local months ([ :find \$montharray \$monthtxt]);:local hours [:pick \$time 0 2];:local minutes [:pick \$time 3 5];:local seconds [:pick \$time 6 8];:local todaytime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ]);:set daysmonth ( [ :pick \$monthdays \$nodays ] );};:set days ((\$yearTODAY-2017) * 365  + \$days -\$daysmonth );:set today (( \$days * 86400 )+\$todaytime);};:foreach i".($num+3)."i in [ /ip hotspot user find where limit-uptime=00:00:01 disabled=yes(".$settotal_pro." )] do={:if ([ :find [ /ip hotspot user get \$i".($num+3)."i comment ] ] = 0 ) do={:local date [ /ip hotspot user get \$i".($num+3)."i comment ];:local montharray ( \"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\"aug\",\"sep\",\"oct\",\"nov\",\"dec\" );:local monthtxt [ :pick \$date 0 3 ];:local countcomment [ len \$date];:if (\$countcomment >=20) do={:set \$countcomment 1;} else={:set \$countcomment 0;};:local aaa ([ :find \$montharray \$monthtxt]);:if (\$aaa > -1) do={:set \$aaa 1;} else={:set \$aaa 0;};:local bbb [ :pick \$date 3 4 ];:local ccc [ :pick \$date 6 7 ];:local ddd (\"\",\"/\");:local eee ([ :find \$ddd \$bbb]);:local eee2 ([ :find \$ddd \$ccc]);:local fff [ :pick \$date 14 15 ];:local ggg [ :pick \$date 17 18 ];:local hhh (\"\",\":\");:local kkk ([ :find \$hhh \$fff]);:local kkk2 ([ :find \$hhh \$ggg]);:local check".($num+3)."H (\$countcomment + \$aaa + \$eee + \$eee2 + \$kkk + \$kkk2);:if ((\$check".($num+3)."H)=6) do={:local year [ :pick \$date 7 11 ];:local monthdays;:if ((\$year % 4) = 0 ) do={:set monthdays ( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );} else={:set monthdays ( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );};:local days [ :pick \$date 4 6 ];:local daysmonth [ :pick \$date 0 3 ];:local hours [:pick \$date 12 14];:local minutes [:pick \$date 15 17];:local seconds [:pick \$date 18 20];:local months ( [ :find \$montharray \$monthtxt ] );:local starttime ((\$hours*3600) + (\$minutes*60) + (\$seconds));:for nodays from=0 to=[:tonum \$months] do={:set days ( \$days + [ :pick \$monthdays \$nodays ] );:set daysmonth ( [ :pick \$monthdays \$nodays ] );:set prof".($conf)."H [/ip hotspot user get \$i".($num+3)."i profile ];".$settotal_remove."};:set days ((\$year-2017) * 365  + \$days -\$daysmonth );:set days ( \$days * 86400 );:local conoffset ( \$offset".($conf)."H * 3600 );:local stoplogoff (\$days + \$conoffset+\$starttime);:local plus 0;:if (((\$year % 4)=0)&&((\$yearTODAY % 4)!=0) ) do={:set \$plus 86400;};:if (((\$year % 4)=0)&&((\$yearTODAY % 4)=0)) do={:if (\$year != \$yearTODAY) do={:set \$plus 86400;};};:if ( \$stoplogoff < (\$today+\$plus)) do={ :local name".($num+3)."REM [/ip hotspot user get \$i".($num+3)."i name];:log warning \"HOTSPOT REMOVE SCRIPT:remove Profile \$prof".($conf)."H user \$name".($num+3)."REM first logged in \$date\";[ /ip hotspot user remove \$i".($num+3)."i ];}}".$show_error_remove."}}}";
	

	if(!empty($pro_no1)){

		//check script error//
		$ch_all=0;
	if((!empty($pro_no1))||($expirepro_no1 != 0)){
        if(($pro_no1 == "")||($expirepro_no1 == 0)){$ch_all=1;$show_error="Package No.1 ERROR ";}}
	if((!empty($pro_no2))||($expirepro_no2 != 0)){
        if(($pro_no2 == "")||($expirepro_no2 == 0)){$ch_all=1;$show_error="Package No.2 ERROR ";}}
	if((!empty($pro_no3))||($expirepro_no3 != 0)){
        if(($pro_no3 == "")||($expirepro_no3 == 0)){$ch_all=1;$show_error="Package No.3 ERROR ";}}
	if((!empty($pro_no4))||($expirepro_no4 != 0)){
        if(($pro_no4 == "")||($expirepro_no4 == 0)){$ch_all=1;$show_error="Package No.4 ERROR ";}}
	if((!empty($pro_no5))||($expirepro_no5 != 0)){
        if(($pro_no5 == "")||($expirepro_no5 == 0)){$ch_all=1;$show_error="Package No.5 ERROR ";}}
	if((!empty($pro_no6))||($expirepro_no6 != 0)){
        if(($pro_no6 == "")||($expirepro_no6 == 0)){$ch_all=1;$show_error="Package No.6 ERROR ";}}
	if((!empty($pro_no7))||($expirepro_no7 != 0)){
        if(($pro_no7 == "")||($expirepro_no7 == 0)){$ch_all=1;$show_error="Package No.7 ERROR ";}}
	if((!empty($pro_no8))||($expirepro_no8 != 0)){
        if(($pro_no8 == "")||($expirepro_no8 == 0)){$ch_all=1;$show_error="Package No.8 ERROR ";}}
	if((!empty($pro_no9))||($expirepro_no9 != 0)){
        if(($pro_no9 == "")||($expirepro_no9 == 0)){$ch_all=1;$show_error="Package No.9 ERROR ";}}
	if((!empty($pro_no10))||($expirepro_no10 != 0)){
        if(($pro_no10 == "")||($expirepro_no10 == 0)){$ch_all=1;$show_error="Package No.10 ERROR ";}}
	###################### ADD ###############
	if((!empty($pro_no11))||($expirepro_no11 != 0)){
        if(($pro_no11 == "")||($expirepro_no11 == 0)){$ch_all=1;$show_error="Package No.11 ERROR ";}}

	if((!empty($pro_no12))||($expirepro_no12 != 0)){
        if(($pro_no12 == "")||($expirepro_no12 == 0)){$ch_all=1;$show_error="Package No.12 ERROR ";}}

	if((!empty($pro_no13))||($expirepro_no13 != 0)){
        if(($pro_no13 == "")||($expirepro_no13 == 0)){$ch_all=1;$show_error="Package No.13 ERROR ";}}

	if((!empty($pro_no14))||($expirepro_no14 != 0)){
        if(($pro_no14 == "")||($expirepro_no14 == 0)){$ch_all=1;$show_error="Package No.14 ERROR ";}}

	if((!empty($pro_no15))||($expirepro_no15 != 0)){
        if(($pro_no15 == "")||($expirepro_no15 == 0)){$ch_all=1;$show_error="Package No.15 ERROR ";}}

	if((!empty($pro_no16))||($expirepro_no16 != 0)){
        if(($pro_no16 == "")||($expirepro_no16 == 0)){$ch_all=1;$show_error="Package No.16 ERROR ";}}

	if((!empty($pro_no17))||($expirepro_no17 != 0)){
        if(($pro_no17 == "")||($expirepro_no17 == 0)){$ch_all=1;$show_error="Package No.17 ERROR ";}}

	if((!empty($pro_no18))||($expirepro_no18 != 0)){
        if(($pro_no18 == "")||($expirepro_no18 == 0)){$ch_all=1;$show_error="Package No.18 ERROR ";}}

	if((!empty($pro_no19))||($expirepro_no19 != 0)){
        if(($pro_no19 == "")||($expirepro_no19 == 0)){$ch_all=1;$show_error="Package No.19 ERROR ";}}

	if((!empty($pro_no20))||($expirepro_no20 != 0)){
        if(($pro_no20 == "")||($expirepro_no20 == 0)){$ch_all=1;$show_error="Package No.20 ERROR ";}}
	##########################################
         
		  //End//
    if($ch_all > 0){
				echo "<script language='javascript'>swal('".$show_error."!','กรุณาตรวจสอบความถูกต้อง!','error').then(function () {
               window.history.back();}, function (dismiss) {
             if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
            }else{
	
		for($i=0; $i<$num; $i++){
			if($script[$i]['name']==$expire_name){$error=$script[$i]['name']; }
			if($script[$i]['name']==$disable_name){$error=$script[$i]['name']; }
			if($script[$i]['name']==$remove_name){$error=$script[$i]['name']; }}
			if($error != ""){
				echo "<script language='javascript'>swal('Error Name!','มีชื่อ ".$error." แล้วใน scheduler               กรุณาลบหรือตั้งชื่อใหม่!','error').then(function () {
               window.history.back();}, function (dismiss) {
             if (dismiss === 'overlay') {
    window.history.back();
   }})</script>";
            }else{
	
	
	$API->comm("/system/scheduler/add", array(
									"name" => $expire_name,
									 "interval" => $interval_expire,
									"on-event" => $on_event_expire,
				                    "start-time" => $start_time_expire
		                           
									
								));
    $API->comm("/system/scheduler/add", array(
									"name" => $disable_name,
									 "interval" => $interval_disable,
									"on-event" => $on_event_disable,
				                    "start-time" => $start_time_disable
									
								));
	$API->comm("/system/scheduler/add", array(
									"name" => $remove_name,
									 "interval" => $interval_remove,
									"on-event" => $on_event_remove,
				                    "start-time" => $start_time_remove
									
								));


	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no1),"pro_name='".$pro_no1."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no2),"pro_name='".$pro_no2."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no3),"pro_name='".$pro_no3."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no4),"pro_name='".$pro_no4."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no5),"pro_name='".$pro_no5."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no6),"pro_name='".$pro_no6."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no7),"pro_name='".$pro_no7."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no8),"pro_name='".$pro_no8."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no9),"pro_name='".$pro_no9."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no10),"pro_name='".$pro_no10."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no11),"pro_name='".$pro_no11."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no12),"pro_name='".$pro_no12."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no13),"pro_name='".$pro_no13."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no14),"pro_name='".$pro_no14."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no15),"pro_name='".$pro_no15."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no16),"pro_name='".$pro_no16."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no17),"pro_name='".$pro_no17."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no18),"pro_name='".$pro_no18."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no19),"pro_name='".$pro_no19."'");
	$db->update_db("mt_profile",array("pro_expire"=>$expirepro_no20),"pro_name='".$pro_no20."'");

		



			echo "<script language='javascript'>swal('Save Done!','เพิ่ม Script 1.".$expire_name." 2.".$disable_name." และ  3.".$remove_name." สำเร็จแล้ว','success').then(function () {
    window.location.href = '../system/index.php';}, function (dismiss) {
  if (dismiss === 'overlay') {
    window.location.href = '../system/index.php';
   }})</script>";
			
			exit();
			}}}
		
?>