<?php
	   class convert
{
	
	/*******************bg_color_modify***************************/
				public function  bg_color_modify($num_color){
					
					if(!empty($num_color)){
				          $set_hours=date('h');
						  $in_color=($set_hours+$num_color);
			$bg_arr=array(
				          "2"=>" bg-green",
				          "3"=>" bg-yellow",
				          "4"=>" bg-red",
				          "5"=>" bg-color-style3",
				           "6"=>" bg-color-style4",
				           "7"=>" bg-color-style7",
				          "8"=>" bg-color-style8",
				          "9"=>" bg-color-style5",
				          "10"=>" bg-color-style1",
				          "11"=>" bg-color-style2",
				         "12"=>" bg-color-style6",
			              "13"=>" bg-color-brown",
				          // "14"=>" bg-aqua",
			              "14"=>" bg-color-pink",
			              "15"=>" bg-green",
				          "16"=>" bg-yellow",
				          "17"=>" bg-red",
				          "18"=>" bg-color-style3",
				           "19"=>" bg-color-style4",
				           "20"=>" bg-color-style7",
				          "21"=>" bg-color-style8",
				          "22"=>" bg-color-style5",
				          "23"=>" bg-color-style1",
				          "24"=>" bg-color-style2",
				         "25"=>" bg-color-style6",
				         "26"=>" bg-color-brown");
			            $output_color=$bg_arr[$in_color];return $output_color;
				           
				
					}}
	/**********************panel_modify*********************************************/
	    public function  panel_modify(){
				
					          $minute=date('i');
								
				if($minute<=3){$minute_panel="box box-solid box-style1";return $minute_panel;}
				if($minute<=6){$minute_panel="box box-solid box-style2";return $minute_panel;}
				if($minute<=9){$minute_panel="box box-solid box-style3";return $minute_panel;}
				if($minute<=12){$minute_panel="box box-solid box-style4";return $minute_panel;}
				if($minute<=15){$minute_panel="box box-solid box-style5";return $minute_panel;}
				if($minute<=18){$minute_panel="box box-solid box-style6";return $minute_panel;}
				if($minute<=21){$minute_panel="box box-solid box-style7";return $minute_panel;}
				if($minute<=24){$minute_panel="box box-solid box-style8";return $minute_panel;}
				if($minute<=27){$minute_panel="box box-solid box-black";return $minute_panel;}
				if($minute<=30){$minute_panel="box box-solid box-default";return $minute_panel;}
				if($minute<=33){$minute_panel="box box-solid box-primary";return $minute_panel;}
				if($minute<=36){$minute_panel="box box-solid box-warning";return $minute_panel;}
				if($minute<=39){$minute_panel="box box-solid box-danger";return $minute_panel;}
				if($minute<=42){$minute_panel="box box-solid box-info";return $minute_panel;}
				if($minute<=45){$minute_panel="box box-solid box-success";return $minute_panel;}
				if($minute<=48){$minute_panel="box box-solid box-success-mid";return $minute_panel;}
				if($minute<=51){$minute_panel="box box-solid box-info-mid";return $minute_panel;}
				if($minute<=54){$minute_panel="box box-solid box-danger-mid";return $minute_panel;}
				if($minute<=57){$minute_panel="box box-solid box-warning-mid";return $minute_panel;}
				if($minute<=60){$minute_panel="box box-solid box-primary-mid";return $minute_panel;}
			
				}
				
	//<!--ฟังชั่น แปลง commentเป็นไทย  may/03/2017=>03/พฤษภาคม/2560-->//
			public function  Convert_time($check){
				try {
					if(!empty($check)) {
				           $check_comment=substr("".$check."",-30,11);
						   $comm1_check_arr=substr("".$check_comment."",-8,1); //อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-5,1); //jan/16/2017 อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>1);

		         if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
				if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}
		              $total_pass=($date1_check+$date2_check);

				if($total_pass==2){
					$thai_conv=substr("".$check."",-30,11);
				$year_arr=substr("".$thai_conv."",-4)+543;//=2560
                $month_comment_arr=substr("".$thai_conv."",-11,3); //jan
               $date_arr=substr("".$thai_conv."",-7,2);//=23
              ///$exe=substr("".$thai_conv."",-5,1);//=/
					
       $month_arr=array("jan"=>"มกราคม","feb"=>"กุมภาพันธ์","mar"=>"มีนาคม","apr"=>"เมษายน","may"=>"พฤษภาคม","jun"=>"มิถุนายน","jul"=>"กรกฎาคม","aug"=>"สิงหาคม","sep"=>"กันยายน","oct"=>"ตุลาคม","nov"=>"พฤศจิกายน","dec"=>"ธันวาคม");
       $thai= $month_arr[$month_comment_arr];
      $convert="".$date_arr."/".$thai."/".$year_arr.""; if($thai_conv==""){$convert = "";}
     return $convert;
				}else{return false;}
					}
				}
				catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
	  }
	/*****************************************************************/
     //	<!--ฟังชั่น แปลง commentเป็นไทย  may/03/2017=>พฤษภาคม/2560-->
			public function  Convert_time_min($check){
				try {
					if(!empty($check)) {
				           $thai_conv=substr("".$check."",-30,11);
						   $comm1_check_arr=substr("".$thai_conv."",-8,1); //อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$thai_conv."",-5,1); //jan/16/2017 อิงเครื่องหมาย ../../..
			              $check1_comment=array("/"=>1);

		        if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
				if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}

		              $total_pass=($date1_check+$date2_check);

				if($total_pass==2){
				$year_arr=substr("".$thai_conv."",-4)+543;//=2560
                $month_comment_arr=substr("".$thai_conv."",-11,3); //jan
               $date_arr=substr("".$thai_conv."",-7,2);//=23
              ///$exe=substr("".$thai_conv."",-5,1);//=/
					
       $month_arr=array("jan"=>"มกราคม","feb"=>"กุมภาพันธ์","mar"=>"มีนาคม","apr"=>"เมษายน","may"=>"พฤษภาคม","jun"=>"มิถุนายน","jul"=>"กรกฎาคม","aug"=>"สิงหาคม","sep"=>"กันยายน","oct"=>"ตุลาคม","nov"=>"พฤศจิกายน","dec"=>"ธันวาคม");
       $thai= $month_arr[$month_comment_arr];
      $convert="".$thai."/".$year_arr.""; if($thai_conv==""){$convert = "";}
      $thai_conv=$convert;
	  return $thai_conv;
			} }}
			catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
	  }
 ####################################################################
						

             ////<!--ฟังชั่น แปลง commentเป็นไทย+คำนวนวันหมดอายุุุ  jan/31/2017 23:00:01 , +0=>31มกราคม2560-->jan/31/2017 23:00:01 ,+10=10กุมภาพันธ์2560
              ////$time_conv=jan/31/2017 23:00:01,$offset=7,$time_on=""(เวลาไม่แสดง)$time_on=1(แสดงเวลา)31มกราคม2560 23:00:01
	         public function  expdate($time_conv,$offset,$time_on){
				 try {
             if((!empty($time_conv))&&((!empty($offset))&&($offset >0))){
				  $check_comment=substr("".$time_conv."",-30,20);
						 
						  $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			              $comm3_check_arr=substr("".$check_comment."",-20,3);
		                  $comm3_arr_arr=array("jan"=>1,"feb"=>1,"mar"=>1,"apr"=>1,"may"=>1,"jun"=>1,"jul"=>1,"aug"=>1,"sep"=>1,"oct"=>1,"nov"=>1,"dec"=>1);
		                  
			if(empty($comm3_arr_arr[$comm3_check_arr])){$check3_comment=0;}else{$check3_comment=1;}

	                      $check1_comment=array("/"=>1);
		             if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
		    if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}

		              $time_arr1=array(":"=>1);
			            $time1_check_str=substr("".$check_comment."",-6,1);
			            $time2_check_str=substr("".$check_comment."",-3,1);


             if(empty($time_arr1[$time1_check_str])){$time1_check=0;}else{$time1_check=1;}
			if(empty($time_arr1[$time2_check_str])){$time2_check=0;}else{$time2_check=1;}



                            $total_pass=($check3_comment+$date1_check+$date2_check+$time1_check+$time2_check);
							if($total_pass==5){
				 
               $year_arr=substr("".$check_comment."",-13,4);//=2017 ปี
               $month_comment_arr=substr("".$check_comment."",-20,3); //jan เดือน
               $date_arr=substr("".$check_comment."",-16,2);//=23 วัน
              $hh_arr=substr("".$check_comment."",-8,2);
			  $mm_arr=substr("".$check_comment."",-5,2);
			  $ss_arr=substr("".$check_comment."",-2);
			  if (($year_arr %4)==0){
			  $month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(60),"apr"=>(91),"may"=>(121),"jun"=>(152),"jul"=>(182),"aug"=>(213),"sep"=>(244),"oct"=>(274),"nov"=>(305),"dec"=>(335));
			  $month_num= ($month_arr[$month_comment_arr]);
              $convert=(($year_arr-2000)*365+($month_num-2)+$date_arr);
			  }else{
              $month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
			  $month_num= ($month_arr[$month_comment_arr]);
              $convert=(($year_arr-2000)*365+($month_num-1)+$date_arr);
			  }


            
	          $tocon=(($hh_arr*3600) + ($mm_arr*60) + ($ss_arr));
	          $convert2=(($convert*86400)+$tocon);
	          $check_offset=($offset*3600);
               $convert3=($convert2+$check_offset);
               $seconds=$convert3;
                $years = floor($seconds / 31536000);
				$days = floor($seconds % 31536000 / 86400);
				$hours = floor($seconds % 86400 / 3600); 
                $minutes = floor($seconds % 3600 / 60); 
               $seconds = $seconds % 60;
	          $return=sprintf("%dy%03dd%02d:%02d:%02d", ($years+2000),($days), $hours, $minutes, $seconds);
             $output= "".$return."";
              
           $year_com=substr("".$output."",-17,4)+543;
		  
              $year_com2=substr("".$output."",-17,4);
              $time_com=substr("".$output."",-8);
              ///if($offset){
              $time="";if(!empty($time_on)){$time=" ".$time_com."";}
			 if ((($year_arr %4)==0)&&(($year_com2 %4)==0)){
				 $month_com=substr("".$output."",-12,3)+2;
			  if($month_com<=31){$rew="".($month_com)." มกราคม ".$year_com."".$time."";return  $rew;}
              if($month_com<=60){$rew="".($month_com-31)." กุมภาพันธ์ ".$year_com."".$time.""; return  $rew;}
            if($month_com<=91){$rew="".($month_com-60)." มีนาคม ".$year_com."".$time."" ;return  $rew;}
           if($month_com<=121){$rew="".($month_com-91)." เมษายน ".$year_com."".$time."";return  $rew;}
           if($month_com<=152){$rew="".($month_com-121)." พฤษภาคม ".$year_com."".$time."";return  $rew;}
           if($month_com<=182){$rew="".($month_com-152)." มิถุนายน ".$year_com."".$time."";return  $rew;}
             if($month_com<=213){$rew="".($month_com-182)." กรกฎาคม ".$year_com."".$time."";return  $rew;}
              if($month_com<=244){$rew="".($month_com-213)." สิงหาคม ".$year_com."".$time."";return  $rew;}
               if($month_com<=274){$rew="".($month_com-244)." กันยายน ".$year_com."".$time."";return  $rew;}
                 if($month_com<=305){$rew="".($month_com-274)." ตุลาคม ".$year_com."".$time."";return  $rew;}
                  if($month_com<=335){$rew="".($month_com-305)." พฤศจิกายน ".$year_com."".$time."";return  $rew;}
                  if($month_com>=336){$rew="".($month_com-335)." ธันวาคม ".$year_com."".$time."";return  $rew;}
			  }else{
				  $month_com=substr("".$output."",-12,3)+1;
               if($month_com<=31){$rew="".($month_com)." มกราคม ".$year_com."".$time."";return  $rew;}
              if($month_com<=59){$rew="".($month_com-31)." กุมภาพันธ์ ".$year_com."".$time.""; return  $rew;}
            if($month_com<=90){$rew="".($month_com-59)." มีนาคม ".$year_com."".$time."" ;return  $rew;}
           if($month_com<=120){$rew="".($month_com-90)." เมษายน ".$year_com."".$time."";return  $rew;}
           if($month_com<=151){$rew="".($month_com-120)." พฤษภาคม ".$year_com."".$time."";return  $rew;}
           if($month_com<=181){$rew="".($month_com-151)." มิถุนายน ".$year_com."".$time."";return  $rew;}
             if($month_com<=212){$rew="".($month_com-181)." กรกฎาคม ".$year_com."".$time."";return  $rew;}
              if($month_com<=243){$rew="".($month_com-212)." สิงหาคม ".$year_com."".$time."";return  $rew;}
               if($month_com<=273){$rew="".($month_com-243)." กันยายน ".$year_com."".$time."";return  $rew;}
                 if($month_com<=304){$rew="".($month_com-273)." ตุลาคม ".$year_com."".$time."";return  $rew;}
                  if($month_com<=334){$rew="".($month_com-304)." พฤศจิกายน ".$year_com."".$time."";return  $rew;}
                  if($month_com>=335){$rew="".($month_com-334)." ธันวาคม ".$year_com."".$time."";return  $rew;}
				  }
				
                   }else{return false;}}else{return false;}
			 } catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
				   }
#################################################################################################################


	   public function  exp_time($mik_time,$com_time_conv,$offset) {
		   try {
		    if((!empty($mik_time))&&(!empty($com_time_conv))&&($offset >0)){
				  $check_comment=substr("".$com_time_conv."",-30,20);
					 $comm1_check_arr=substr("".$check_comment."",-14,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			             $comm2_check_arr=substr("".$check_comment."",-17,1); //jan/16/2017 18:26:31อิงเครื่องหมาย ../../..
			              $comm3_check_arr=substr("".$check_comment."",-20,3);
		                  $comm3_arr_arr=array("jan"=>1,"feb"=>1,"mar"=>1,"apr"=>1,"may"=>1,"jun"=>1,"jul"=>1,"aug"=>1,"sep"=>1,"oct"=>1,"nov"=>1,"dec"=>1);

					if(empty($comm3_arr_arr[$comm3_check_arr])){$check3_comment=0;}else{$check3_comment=1;}
		                  
	                      $check1_comment=array("/"=>1,''=>0);
				 if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
		    if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}
                        
						 $time_arr1=array(":"=>1,''=>0);
			            $time1_check_str=substr("".$check_comment."",-6,1);
			            $time2_check_str=substr("".$check_comment."",-3,1);
                if(empty($time_arr1[$time1_check_str])){$time1_check=0;}else{$time1_check=1;}
			if(empty($time_arr1[$time2_check_str])){$time2_check=0;}else{$time2_check=1;}        
						 
				 $total_pass=($check3_comment+$date1_check+$date2_check+$time1_check+$time2_check);
							if($total_pass==5){       
		/***************************************/
								///date time function////dec/30/2012 23:40:05
								 $hh_arr=substr("".$mik_time."",-8,2);
			                   $mm_arr=substr("".$mik_time."",-5,2);
			                   $ss_arr=substr("".$mik_time."",-2);
							 
							  $year_arr=substr("".$mik_time."",-13,4);
                               $month_arr=substr("".$mik_time."",-20,3);
                                $date_arr=substr("".$mik_time."",-16,2);
								if (($year_arr %4)==0){
								$month_arr_con=array("jan"=>(0),"feb"=>(31),"mar"=>(60),"apr"=>(91),"may"=>(121),"jun"=>(152),"jul"=>(182),"aug"=>(213),"sep"=>(244),"oct"=>(274),"nov"=>(305),"dec"=>(335));
								$month_num= ($month_arr_con[$month_arr]);
								$convert=(($year_arr-2000)*365+($month_num-2)+$date_arr);
								}else{
								 $month_arr_con=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
								 $month_num= ($month_arr_con[$month_arr]);
								 $convert=(($year_arr-2000)*365+($month_num-1)+$date_arr);
								 }
                              
							  
	                          $tocon=(($hh_arr*3600) + ($mm_arr*60) + ($ss_arr));
	                        $miktime_total=(($convert*86400)+$tocon);
											 
					
						///////////////////////////////////////////////////////
						///comment function////dec/30/2012 23:40:05
          $com_year_arr=substr("".$check_comment."",-13,4);//=2017 
              $com_month_comment_arr=substr("".$check_comment."",-20,3); //jan เดือน
               $com_date_arr=substr("".$check_comment."",-16,2);//=23 วัน
              $com_hh_arr=substr("".$check_comment."",-8,2);
			  $com_mm_arr=substr("".$check_comment."",-5,2);
			  $com_ss_arr=substr("".$check_comment."",-2);
			  if ((($com_year_arr %4)==0)&&(($year_arr %4)==0)){
		$com_month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(60),"apr"=>(91),"may"=>(121),"jun"=>(152),"jul"=>(182),"aug"=>(213),"sep"=>(244),"oct"=>(274),"nov"=>(305),"dec"=>(335));
		$com_month_num= ($com_month_arr[$com_month_comment_arr]);
      $com_convert=(($com_year_arr-2000)*365+($com_month_num-2)+$com_date_arr);
			  }else{
		$com_month_arr=array("jan"=>(0),"feb"=>(31),"mar"=>(59),"apr"=>(90),"may"=>(120),"jun"=>(151),"jul"=>(181),"aug"=>(212),"sep"=>(243),"oct"=>(273),"nov"=>(304),"dec"=>(334));
		$com_month_num= ($com_month_arr[$com_month_comment_arr]);
      $com_convert=(($com_year_arr-2000)*365+($com_month_num-1)+$com_date_arr);}
       
	  $com_tocon=(($com_hh_arr*3600) + ($com_mm_arr*60) + ($com_ss_arr));
	  $com_convert2=(($com_convert*86400)+$com_tocon);
	  $com_offset=($offset*3600);
	  $com_convert_total=($com_convert2+$com_offset);
	  $setexpi=($com_convert_total-$miktime_total);
	   if(($setexpi)>0){
      
	   
	   
	 $seconds=$setexpi;
    $days = floor($seconds / 86400);
    $hours = floor($seconds % 86400/ 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 
 //  return sprintf("%dd %02d:%02d:%02d", $days, $hours, $minutes, $seconds);
   $return=sprintf("%dd %02d:%02d:%02d", $days, $hours, $minutes, $seconds);
   return $return;
}
							}} } catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
}
##############################################################################################################
         
		  //4//
			 public function  Expire_color($limit_uptimeA,$uptimeA,$status_userA,$profile_check){
				 try {
		$pro="";		
        if($limit_uptimeA=="1s"){return $time="#ff0000";}
		if($status_userA=="true"){return $time="#ff0000";}
		if(!empty($uptimeA)){if($limit_uptimeA==$uptimeA){return $time="#ff0000";}}
        if($profile_check==$pro){return $time="#ff0000";}
        return $time="";
} catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
			 }



###########################################################################################################
//8//
public function  botton_account($account_user,$delete,$disable,$enable,$edit,$print,$export_csv,$small_text){
	try {
	if (empty($small_text)){
	  $text_delete=	"select to remove & kick user online";
	  $text_disable="select to disable & kick user online";
	  
	}else{$text_delete=$small_text;
	       $text_disable=$small_text;}
        if(!empty($account_user)){
		if($account_user=="read"){
        if($delete=="on"){
            return $delete="<button  value=\"remove\" data-toggle=\"tooltip\" title= \"".$text_delete."\" name=\"active\" class=\"btn btn-danger disabled\" type=\"button\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button value=\"disable\" data-toggle=\"tooltip\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black disabled\" type=\"button\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button value=\"enable\" data-toggle=\"tooltip\" title= \"select to enable\" name=\"active\" class=\"btn btn-success disabled\" type=\"button\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($edit=="on"){return $edit="<button value=\"set\" data-toggle=\"tooltip\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning disabled\" type=\"button\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button  value=\"print\" name=\"active\" class=\"btn btn-info disabled\" data-toggle=\"tooltip\" title= \"select to print\" type=\"button\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button  value=\"csv\" name=\"active\" class=\"btn btn-primary disabled\" data-toggle=\"tooltip\" title= \"select to download csv\" type=\"button\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}

}
		if($account_user=="write"){
            if($delete=="on"){return $delete="<button value=\"remove\" data-toggle=\"tooltip\" title=\"".$text_delete."\" name=\"active\" class=\"btn btn-danger disabled\" type=\"button\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black\" type=\"submit\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success\" type=\"submit\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
		    if($edit=="on"){return $edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning\" type=\"submit\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button data-toggle=\"tooltip\"  value=\"print\" name=\"active\" class=\"btn btn-info\" title= \"select to print\" type=\"submit\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button data-toggle=\"tooltip\"  value=\"csv\" name=\"active\" class=\"btn btn-primary\" title= \"select to download csv\" type=\"submit\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
}else{
	        if($delete=="on"){return $delete="<button data-toggle=\"tooltip\"  value=\"remove\" title= \"".$text_delete."\" name=\"active\" class=\"btn btn-danger\" type=\"submit\"><i class=\"fa fa-times\"></i>&nbsp;Delete&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
	        if($disable=="on"){return $disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black\" type=\"submit\"><i class=\"fa fa-lock\"></i>&nbsp;Disable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($enable=="on"){return $enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success\" type=\"submit\"><i class=\"fa fa-unlock\"></i>&nbsp;Enable&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
		    if($edit=="on"){return $edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning\" type=\"submit\"><i class=\"fa fa-edit\"></i>&nbsp;Edit&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($print=="on"){return $print="<button data-toggle=\"tooltip\"  value=\"print\" name=\"active\" class=\"btn btn-info\" title= \"select to print\" type=\"submit\"><i class=\"fa fa-print\"></i>&nbsp;Print&nbsp;</button>&nbsp;&nbsp;&nbsp;";}
			if($export_csv=="on"){return $export_csv="<button data-toggle=\"tooltip\"  value=\"csv\" name=\"active\" class=\"btn btn-primary\" title= \"select to download csv\" type=\"submit\"><i class=\"fa fa-download\"></i>&nbsp;Export CSV&nbsp;</button>&nbsp;&nbsp;&nbsp;";}

}
}
	}catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
}


#################################################################################################################
//9//
public function  botton_small_account($small_account_user,$small_delete,$small_disable,$small_enable,$small_edit,$small_transfer,$small_text,$small_add,$small_addALL){
	try {
	if (empty($small_text)){
	  $text_delete=	"select to remove & kick user online";
	  $text_disable="select to disable & kick user online";
	 }else{$text_delete=$small_text;
	       $text_disable=$small_text;}
        if(!empty($small_account_user)){
		if($small_account_user=="read"){
        if($small_delete=="on"){return $small_delete="<button value=\"remove\" data-toggle=\"tooltip\" title= \"".$text_delete."\" name=\"active\" class=\"btn btn-danger disabled fa fa-times\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button value=\"disable\" data-toggle=\"tooltip\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black disabled fa fa-lock\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button value=\"enable\" data-toggle=\"tooltip\" title= \"select to enable\" name=\"active\" class=\"btn btn-success disabled fa fa-unlock\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button value=\"set\" data-toggle=\"tooltip\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning disabled fa fa-edit\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button  value=\"transfer\" data-toggle=\"tooltip\" name=\"active\" class=\"btn btn-default disabled fa fa-exchange \" title= \"".$small_text."\" type=\"button\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}
			if($small_addALL=="on"){return $small_addALL="<button  value=\"add\" data-toggle=\"tooltip\" name=\"active\" class=\"btn btn-primary disabled fa fa-link \" title= \"".$small_text."\" type=\"button\"> Netwatch </button>&nbsp;&nbsp;&nbsp;";}
             if($small_add=="on"){return $small_add="<a class=\"btn btn-success2 fa fa-plus\"  href=\"#\" data-toggle=\"modal\" data-target=\"#modeladd\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"click add\"  > ".$small_text." </a>&nbsp;&nbsp;&nbsp;";}

}
		if($small_account_user=="write"){
             if($small_delete=="on"){return $small_delete="<button value=\"remove\" data-toggle=\"tooltip\" title= \"".$text_delete."\" name=\"active\" class=\"btn btn-danger disabled fa fa-times\" type=\"button\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black fa fa-lock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success fa fa-unlock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning fa fa-edit\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button  value=\"transfer\" name=\"active\" class=\"btn btn-default disabled fa fa-exchange \" data-toggle=\"tooltip\" title= \"".$small_text."\" type=\"button\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}
            if($small_addALL=="on"){return $small_addALL="<button  value=\"add\" data-toggle=\"tooltip\" name=\"active\" class=\"btn btn-primary fa fa-link \" title= \"".$small_text."\" type=\"submit\"> Netwatch </button>&nbsp;&nbsp;&nbsp;";}
			 if($small_add=="on"){return $small_add="<a class=\"btn btn-success2 fa fa-plus\"  href=\"#\" data-toggle=\"modal\" data-target=\"#modeladd\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"click add\"  > ".$small_text." </a>&nbsp;&nbsp;&nbsp;";}
}else{
             if($small_delete=="on"){
             return $small_delete="<button data-toggle=\"tooltip\"  value=\"remove\" title= \"".$text_delete."\" name=\"active\" class=\"btn btn-danger fa fa-times\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
	        if($small_disable=="on"){return $small_disable="<button data-toggle=\"tooltip\" value=\"disable\" title= \"".$text_disable."\" name=\"active\" class=\"btn btn-black fa fa-lock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_enable=="on"){return $small_enable="<button data-toggle=\"tooltip\" value=\"enable\" title= \"select to enable\" name=\"active\" class=\"btn btn-success fa fa-unlock\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_edit=="on"){return $small_edit="<button data-toggle=\"tooltip\" value=\"set\" title= \"select to edit\" name=\"active\" class=\"btn btn-warning fa fa-edit\" type=\"submit\"></button>&nbsp;&nbsp;&nbsp;";}
			if($small_transfer=="on"){return $small_transfer="<button data-toggle=\"tooltip\"  value=\"transfer\" name=\"active\" class=\"btn btn-default fa fa-exchange \" title= \"".$small_text."\" type=\"submit\"> Transfer </button>&nbsp;&nbsp;&nbsp;";}
            if($small_addALL=="on"){return $small_addALL="<button  value=\"add\" data-toggle=\"tooltip\" name=\"active\" class=\"btn btn-primary fa fa-link \" title= \"".$small_text."\" type=\"submit\"> Netwatch </button>&nbsp;&nbsp;&nbsp;";}
            if($small_add=="on"){return $small_add="<a class=\"btn btn-success2 fa fa-plus\"  href=\"#\" data-toggle=\"modal\" data-target=\"#modeladd\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"click add\"  > ".$small_text." </a>&nbsp;&nbsp;&nbsp;";}
			
}
}}catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
}
##################################################################################################################
//10//
public function  button_btn_xs_account($btn_xs_account_user,$action,$btn_xs_delete,$btn_xs_disable,$btn_xs_enable,$btn_xs_edit,$btn_xs_kick,$text,$btn_xs_print,$btn_xs_export){
	try {
        if(!empty($btn_xs_account_user)){
		if($btn_xs_account_user=="read"){
        	if($btn_xs_delete=="on"){return $btn_xs_delete="<button class=\"btn btn-danger disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\" title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</button>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<button class=\"btn btn-success disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\"  title= \"click to disable\" ><span></span> Enable </button>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<button class=\"btn btn-black disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\"  title= \"click to enable\" ><span></span>Disable</button>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<button class=\"btn btn-success2  disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\"  title= \"click to kick user online\"><span class=\"fa fa-wifi\">".$text."</span></button>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<button class=\"btn btn-info disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\"  title= \"click to print\"  ><span class=\"fa fa-print\"></span> พิมพ์บัตร </button>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<button class=\"btn btn-primary disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\"  title= \"click to download\" ><span class=\"fa fa-download\"></span> Export CSV </button>&nbsp;&nbsp;&nbsp;";}

}
		if($btn_xs_account_user=="write"){
             if($btn_xs_delete=="on"){return $btn_xs_delete="<button class=\"btn btn-danger disabled btn-xs\"  data-toggle=\"tooltip\" type=\"button\" title= \"click to remove\" ><span class=\"fa fa-times\"></span>ลบ</button>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<a class=\"btn btn-success btn-xs\" title= \"click to disable\" ".$action."><span></span> Enable </a>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<a class=\"btn btn-black btn-xs\" title= \"click to enable\" ".$action."><span></span>Disable</a>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" ".$action."><span class=\"fa fa-wifi\">".$text."</span></a>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<a class=\"btn btn-info btn-xs\" title= \"click to print\" ".$action." ><span class=\"fa fa-print\"></span> พิมพ์บัตร </a>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<a class=\"btn btn-primary btn-xs\" title= \"click to download\" ".$action."><span class=\"fa fa-download\"></span> Export CSV </a>&nbsp;&nbsp;&nbsp;";}
}else{
             
			 
			 if($btn_xs_delete=="on"){return $btn_xs_delete="<a class=\"btn btn-danger btn-xs\" title= \"click to remove\" ".$action."><span class=\"fa fa-times\"></span>ลบ</a>&nbsp;&nbsp;";}
			 if($btn_xs_disable=="on"){return $btn_xs_disable="<a class=\"btn btn-success btn-xs\" title= \"click to disable\" ".$action."><span></span> Enable </a>&nbsp;&nbsp;";}
			 if($btn_xs_enable=="on"){return $btn_xs_enable="<a class=\"btn btn-black btn-xs\" title= \"click to enable\" ".$action."><span></span>Disable</a>&nbsp;&nbsp;";}
			 if($btn_xs_edit=="on"){return $btn_xs_edit="<a class=\"btn btn-warning btn-xs\" title= \"click to edit\" ".$action."><span class=\"fa fa-edit\"></span>แก้ไข</a>&nbsp;&nbsp;";}
			 if($btn_xs_kick=="on"){return $btn_xs_kick="<a class=\"btn btn-success2 btn-xs\" title= \"click to kick user online\" ".$action."><span class=\"fa fa-wifi\"> ".$text."</span></a>&nbsp;&nbsp;";}
			 if($btn_xs_print=="on"){return $btn_xs_print="<a class=\"btn btn-info btn-xs\" title= \"click to print\" ".$action." ><span class=\"fa fa-print\"></span> พิมพ์บัตร </a>&nbsp;&nbsp;&nbsp;";}
			 if($btn_xs_export=="on"){return $btn_xs_export="<a class=\"btn btn-primary btn-xs\" title= \"click to download\" ".$action."><span class=\"fa fa-download\"></span> Export CSV </a>&nbsp;&nbsp;&nbsp;";}
	        
}
}}catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
}
#########################################################################################################
	 //8//
public function  button_btn_submit_account($btn_btn_account_user,$btn_text,$btn_success,$btn_danger,$btn_warning,$btn_primary,$btn_info,$btn_black){
	try {
        if(!empty($btn_btn_account_user)){
		if($btn_btn_account_user=="read"){
			 if($btn_success=="on"){return $btn_success="<button class=\"btn btn-success disabled \"  data-toggle=\"tooltip\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button class=\"btn btn-danger disabled \"  data-toggle=\"tooltip\" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}        	


}
		if($btn_btn_account_user=="write"){
			 if($btn_success=="on"){return $btn_success="<button data-toggle=\"tooltip\" class=\"btn btn-success \" name=\"active\" value=\"active\"type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button class=\"btn btn-danger disabled \"  data-toggle=\"tooltip\" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"button\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}


}else{
			 if($btn_success=="on"){return $btn_success="<button data-toggle=\"tooltip\" class=\"btn btn-success \" name=\"active\" value=\"active\" type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}
			 if($btn_danger=="on"){return $btn_danger="<button data-toggle=\"tooltip\" class=\"btn btn-danger \" title=\"select to delete\" value=\"remove\"  name=\"active\" type=\"submit\"><span>".$btn_text."</span></button>&nbsp;&nbsp;";}             
}
}}catch(PDOException $e) {
            echo "<b><font color=red>Texe ERROR: " . $e->getMessage()."</font></b>";
        }
}
/************************* GEN user *****************************************/
   public function genUser(){
	$allowed_chars = $_REQUEST['str_char'];
	$allowed_count = strlen($allowed_chars);
	$password = null;
	$password_length = $_REQUEST['num_user'];
		
		while($password === null || already_exists($password)) {
			$password = '';
			for($i = 0; $i < $password_length; ++$i) {
			$password .= $allowed_chars{mt_rand(0, $allowed_count - 1)};
			}
			return $password;
		}
}
/************************* GEN pass *****************************************/
public function genPass(){
	$allowed_chars = $_REQUEST['str_char'];
	$allowed_count = strlen($allowed_chars);
	$password = null;
	$password_length = $_REQUEST['num_pass'];
		
		while($password === null || already_exists($password)) {
			$password = '';
			for($i = 0; $i < $password_length; ++$i) {
			$password .= $allowed_chars{mt_rand(0, $allowed_count - 1)};
			}
			return $password;
		}
}
}
/******************end*********************************/

$date_time_show="<span class=\"pull-right hidden-xs  \"><span class=\"mik-up-time\"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"mik-date\"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"mik-time\"></span>&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                $panel_heading="box-header with-border";
				 $now_time = $API->comm("/system/clock/print");
								 $now_date = $API->comm("/system/clock/print");
							   $miktime=($now_time['0']['time']);
							
								$mikdate=($now_date['0']['date']);
                            
							   $convert_total="".$mikdate." ".$miktime."";
?>


