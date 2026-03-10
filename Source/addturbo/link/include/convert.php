<?php
	   class convert
{

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
###################################################################################

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
############################################################################################################
	public function  Engexpdate($time_conv,$offset,$time_on){
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
			  if($month_com<=31){$rew="".($month_com)."  January ".$year_com."".$time."";return  $rew;}
              if($month_com<=60){$rew="".($month_com-31)." February ".$year_com."".$time.""; return  $rew;}
            if($month_com<=91){$rew="".($month_com-60)." March ".$year_com."".$time."" ;return  $rew;}
           if($month_com<=121){$rew="".($month_com-91)." April ".$year_com."".$time."";return  $rew;}
           if($month_com<=152){$rew="".($month_com-121)." May ".$year_com."".$time."";return  $rew;}
           if($month_com<=182){$rew="".($month_com-152)." June ".$year_com."".$time."";return  $rew;}
             if($month_com<=213){$rew="".($month_com-182)." July ".$year_com."".$time."";return  $rew;}
              if($month_com<=244){$rew="".($month_com-213)." August ".$year_com."".$time."";return  $rew;}
               if($month_com<=274){$rew="".($month_com-244)." September ".$year_com."".$time."";return  $rew;}
                 if($month_com<=305){$rew="".($month_com-274)." October ".$year_com."".$time."";return  $rew;}
                  if($month_com<=335){$rew="".($month_com-305)." November ".$year_com."".$time."";return  $rew;}
                  if($month_com>=336){$rew="".($month_com-335)." December ".$year_com."".$time."";return  $rew;}
			  }else{
				  $month_com=substr("".$output."",-12,3)+1;
               if($month_com<=31){$rew="".($month_com)."  January ".$year_com."".$time."";return  $rew;}
              if($month_com<=59){$rew="".($month_com-31)." February ".$year_com."".$time.""; return  $rew;}
            if($month_com<=90){$rew="".($month_com-59)." March ".$year_com."".$time."" ;return  $rew;}
           if($month_com<=120){$rew="".($month_com-90)." April ".$year_com."".$time."";return  $rew;}
           if($month_com<=151){$rew="".($month_com-120)." May ".$year_com."".$time."";return  $rew;}
           if($month_com<=181){$rew="".($month_com-151)." June ".$year_com."".$time."";return  $rew;}
             if($month_com<=212){$rew="".($month_com-181)." July ".$year_com."".$time."";return  $rew;}
              if($month_com<=243){$rew="".($month_com-212)." August ".$year_com."".$time."";return  $rew;}
               if($month_com<=273){$rew="".($month_com-243)." September ".$year_com."".$time."";return  $rew;}
                 if($month_com<=304){$rew="".($month_com-273)." October ".$year_com."".$time."";return  $rew;}
                  if($month_com<=334){$rew="".($month_com-304)." November ".$year_com."".$time."";return  $rew;}
                  if($month_com>=335){$rew="".($month_com-334)." December ".$year_com."".$time."";return  $rew;}
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


   
}
?>


