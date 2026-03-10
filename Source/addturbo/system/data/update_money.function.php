<?php

class money {
	  
		//for auto update comment,ip-address,mac-address to database //
   public function  user_info(){
     		 
      $db = new ConnectDB();
	  
	//   "".$convert->conv_empty($var).""
      $id=$_SESSION['id'];
	  $status=$_SESSION['status'];
	  $result=$db->selectquery("SELECT * FROM mt_config WHERE mt_num='".$status."'");
        $IP_ACCOUNT=$result['mt_ip'];
		$USER_ACCOUNT=$result['mt_user'];
		$PASS_ACCOUNT=$result['mt_pass'];
		$PORT_ACCOUNT=$result['port_api'];
		$API = new routeros_api();
	    $API->debug = false;
	    if($API->connect($IP_ACCOUNT, $USER_ACCOUNT, $PASS_ACCOUNT, $PORT_ACCOUNT)){
		  $convert=new convert();
		 ///<!--start update comment from hotspot user to  array-->
			 $ARRAY = $API->comm("/ip/hotspot/user/print");
			 $num =count($ARRAY);
		for($i=0; $i<$num; $i++){
			          if(!empty($ARRAY[$i]['comment'])){$comment=$ARRAY[$i]['comment'];}else{$comment="";}
                  $hot_array[]=array(
					             "user"=>"".$ARRAY[$i]['name']."",
					              "comment"=>"".iconv("tis-620", "utf-8",$comment)."" 
					                );					
									
			}
		
		
		//--start update comment from usermanager to  array-->

		 $ARRAY2 = $API->comm("/tool/user-manager/user/print");
		 $num2 =count($ARRAY2);
				 for($i=0; $i<$num2; $i++){	
					 if(!empty($ARRAY2[$i]['comment'])){$comment=$ARRAY2[$i]['comment'];}else{$comment="";}
			   $hot_array[]=array(
						         "user"=>"".$ARRAY2[$i]['username']."",
						         "comment"=>"".$comment.""
					               );	
									}
			         

					 
					  
	// <!--start update mac-address and ip-address from user online to  array-->  //
	       $ARRAY3 = $API->comm("/ip/hotspot/active/print");
		   $num3 =count($ARRAY3);
			$num_hot=count($hot_array);
                       for($i=0; $i<$num3; $i++){
						for($h=0; $h<$num_hot; $h++){
			if($ARRAY3[$i]['user']==$hot_array[$h]['user']){
			                                      $hot_array[$h]=array(
			                                     "user"=>"".$hot_array[$h]['user']."",
				                                 "mac_address"=>$ARRAY3[$i]['mac-address'],
				                                  "ip_address"=>$ARRAY3[$i]['address']);
						
					}}}
	//<!--start update comment from pppoe user to array-->
	      $ARRAY4 = $API->comm("/ppp/secret/print");
		  $num4 =count($ARRAY4);
			for($i=0; $i<$num4; $i++){
				if(!empty($ARRAY4[$i]['comment'])){$comment=$ARRAY4[$i]['comment'];}else{$comment="";}
					$ppp_array[]=array(
				                      "user"=>"".$ARRAY4[$i]['name']."",
				                     "comment"=>"".iconv("tis-620", "utf-8",$comment).""
			                                             );				
									}
											
						
	// <!--start update caller-id and address from pppoe online to  array-->  //	
			$ARRAY5 = $API->comm("/ppp/active/print");
			$num5 =count($ARRAY5);
			$num_ppp=count($ppp_array);
				for($i=0; $i<$num5; $i++){
				for($p=0; $p<$num_ppp; $p++){
					if($ARRAY5[$i]['name']==$ppp_array[$p]['user']){
                $ppp_array[$p]=array(
					"user"=>"".$ppp_array[$p]['user']."",
					"caller_id"=>$ARRAY5[$i]['caller-id'],
					"address"=>$ARRAY5[$i]['address']);							
						         
										  
											}}}	  
							/*<!--End update array --> */
							
		for($h=0; $h<$num_hot; $h++){
		   if(!empty($hot_array[$h]['mac_address'])){$mac=$hot_array[$h]['mac_address'];}else{$mac="";}
		   if(!empty($hot_array[$h]['ip_address'])){$ip=$hot_array[$h]['ip_address'];}else{$ip="";}
		   if(!empty($hot_array[$h]['comment'])){$comment=$hot_array[$h]['comment'];}else{$comment="";}
		$db->update_db("mt_gen",array(
				                      /// "user"=>$hot_array[$h]['user'],
				                    "mac_address"=>$mac,
				                   	"ip_address"=>$ip,
								   "comment"=>$comment),
								   "user='".$hot_array[$h]['user']."'");
			}
		
		 for($p=0; $p<$num_ppp; $p++){
			 if(!empty($ppp_array[$p]['caller_id'])){$mac=$ppp_array[$p]['caller_id'];}else{$mac="";}
		   if(!empty($ppp_array[$p]['address'])){$ip=$ppp_array[$p]['address'];}else{$ip="";}
		   if(!empty($ppp_array[$p]['comment'])){$comment=$ppp_array[$p]['comment'];}else{$comment="";}
		$db->update_db("pppoe_gen",array(
				                      /// "user"=>$ppp_array[$p]['user'],
				                    "caller_id"=>$mac,
				                   	"address"=>$ip,
								   "comment"=>$comment),
								   "user='".$ppp_array[$p]['user']."'");
		 
			}

		
		  
		    $API->disconnect();
			$db->DisConnectDB();
			return false;
	}//api connect//		
	}//user_info//
	 /*********************** end user info *************************************************/
	 
	 
	 
	 
	 public function  hotspot_money(){
		 $db = new ConnectDB();
        $id=$_SESSION['id'];
	 
	  //<!--start update money_code to databases-->
		$query=$db->DB->prepare("SELECT * FROM mt_gen WHERE mt_id='".$id."'");
	         $query->execute();
        while($part1 = $query->fetch( PDO::FETCH_ASSOC ))	{
		####ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
		
		 $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$part1['profile']."'");
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
				###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                             if((($check_profile) && ($check_price))>0){
                       $check_comment=substr("".$part1['comment']."",-30,11);//////jan/16/2017/////
                       $comm1_check_arr=substr("".$check_comment."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			           $comm2_check_arr=substr("".$check_comment."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			          $comm3_check_arr=substr("".$check_comment."",-11,3);
		     $comm3_arr_arr=array("jan"=>1,
				                  "feb"=>1,
				                  "mar"=>1,
				                  "apr"=>1,
				                   "may"=>1,
				                    "jun"=>1,
				                  "jul"=>1,
				                 "aug"=>1,
				                 "sep"=>1,
				                 "oct"=>1,
				                 "nov"=>1,
				                "dec"=>1
				                
				                        );
					 
		 if(empty($comm3_arr_arr[$comm3_check_arr])){$check3_comment=0;}else{$check3_comment=1;}
		 
	          $check1_comment=array("/"=>1);
		    if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
		    if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}
            
			
			$check_commentTime=substr("".$part1['comment']."",-30,20);//////jan/16/2017 23:00:34/////
			$time1_check_str=substr("".$check_commentTime."",-6,1);
			$time2_check_str=substr("".$check_commentTime."",-3,1);
			$time_arr1=array(":"=>1);
			
			if(empty($time_arr1[$time1_check_str])){$time1_check=0;}else{$time1_check=1;}
			if(empty($time_arr1[$time2_check_str])){$time2_check=0;}else{$time2_check=1;}

           
			 $total_pass=($check3_comment+$date1_check+$date2_check+$time1_check+$time2_check);
				   
					
	    ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ mt_money###
		    if($total_pass==5){	  ///echo $check_comment;
				$id_code="-id".$id."";
			   $db->update_db("mt_gen",array(
                                             "money_code"=>$check_comment."".$id_code
				                               ),"user='".$part1['user']."'");				
							
			
	}}}
	  /********* end step 1  ***********************************/




	  /********* step 2  for  mt_money  ******  may/03/2017-id7	  */
		 //<!--start update money_code to databases-->
		 $new_update=0;
		$query2=$db->DB->prepare("SELECT * FROM mt_gen WHERE mt_id='".$id."'");
	         $query2->execute();
        while($part2 = $query2->fetch( PDO::FETCH_ASSOC ))	{
					 ###ป้องกัน การupdateรายการเงินที่เป็น ศูนย์#####
		   $exp=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$part2['profile']."'");
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
				###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                             if((($check_profile) && ($check_price))>0){


		   $money_str=substr("".$part2['money_code']."",-30,11);//////jan/16/2017/////
            if($money_str){   
			$rows=$db->rows_num("SELECT money_code FROM mt_money WHERE money_code='".$part2['money_code']."'");	
			if($rows==0){		
	     
	                        ////new	/////
             $y_arr=substr("".$money_str."",-4);//=2017
              $m_arr=substr("".$money_str."",-11,3);//may
             $d_arr=substr("".$money_str."",-7,2);//31
                    $month_arr=array(
						"jan"=>"01",
						"feb"=>"02",
						"mar"=>"03",
						"apr"=>"04",
						"may"=>"05",
						"jun"=>"06",
						"jul"=>"07",
						"aug"=>"08",
						"sep"=>"09",
						"oct"=>"10",
						"nov"=>"11",
						"dec"=>"12"
					              );
                  
				  $con1_arr= $month_arr[$m_arr];
                 $con2_arr=($con1_arr)."/".($d_arr)."/".($y_arr);
				 $date_utc = new DateTime(''.$con2_arr.'');
				  $utc= $date_utc->format('U');
				//$utc_timezone=$utc+($timezone);
			      $utc_data=($utc);
                    
                  $id_code="-id".$id."";
                      $month=array(
						  "jan",
						  "feb",
						  "mar",
						  "apr",
						  "may",
						  "jun",
						  "jul",
						  "aug",
						  "sep",
						  "oct",
						  "nov",
						  "dec"
					           );
                $date=$month[date('m')-1].date ("/d/").date ("Y");
               $year=substr("".$money_str."",-4);
             $month2=substr("".$money_str."",-11,3);
            $exe=substr("".$money_str."",-5,1);
            $date2="".$year."".$exe."".$month2."".$id_code."";
            $money_code=$part2['money_code'];
                
	                ///ถ้ารายการไม่ใช่วันนี้///
                    if($money_str!=$date){
                      $utc_chart="".$utc_data."".$id_code."";
		               $rows2= $db->num_rows("mt_gen","user","money_code='".$money_code."'");
			               
						   $db->add_db("mt_money",array(
				                    "utc_time_for_chart" =>$utc_chart,
						             "money_code"        =>$money_code,
								  	  "date"             =>$money_str,
									   "month_code"      =>	$date2,
										"month"			 =>	$date2,
						                "tickets"		 =>$rows2,
									      "mt_id"        =>$id
						                           ));
			 
			 $new_update++;			   
 }}	
}


}}
/*************** step 3 *********************************************/                   
if(!empty($new_update)){
//<!--start update mt_money to hotspot databases step2-->
	$query3=$db->DB->prepare("SELECT * FROM mt_money WHERE mt_id ='".$id."'");
	 $query3->execute();
               while($part3 = $query3->fetch( PDO::FETCH_ASSOC ))	{
               $count=0;
	$query4=$db->DB->prepare("SELECT * FROM mt_gen WHERE money_code='".$part3['money_code']."'");
	$query4->execute();
               while($part4 = $query4->fetch( PDO::FETCH_ASSOC ))	{		

	$money2=$db->selectquery("SELECT * FROM mt_profile WHERE pro_name='".$part4['profile']."'");				
	
				$count=$count+($money2['pro_price']);
				
				}
if($part3['money']==null){
              // echo "".$count."//<br>";

				  $db->update_db("mt_money",array(
                                             "money"=>$count
				                               ),"money_code='".$part3['money_code']."'");


}}
//***************************************************************************//
 //<!--start update mt_money_month,mt_money_year to hotspot databases step1-->
         $query5=$db->DB->prepare("SELECT * FROM mt_money WHERE mt_id='".$id."' GROUP BY month_code ");
	       $query5->execute();
               while($part5 = $query5->fetch( PDO::FETCH_ASSOC ))	{

			   $count_y=0;
	 
           
              $yearmoney_data=$part5['month'];
               $y_data=substr("".$yearmoney_data."",-8,4)."-id".$id."";//=2017
			   $m_data=substr("".$yearmoney_data."",-3);//=jan
         // echo "".$y_data."//".$m_data."<br>";//2017/jan-id1
	    	$rows1=$db->rows_num("SELECT * FROM mt_money_month WHERE month_code='".$part5['month_code']."'");
	        $rows2=$db->rows_num("SELECT * FROM mt_money_year WHERE year='".$y_data."'");
		
		if($rows1==0){
			$db->add_db("mt_money_month",array(
				                    "month_code" =>$part5['month_code'],
						              "mt_id"        =>$id
						                           ));
		}
		if($rows2==0){
 			$db->add_db("mt_money_year",array(
				                    "year" =>$y_data,
						              "mt_id"        =>$id
						                           ));
		}
		
	 $query6=$db->DB->prepare("SELECT * FROM mt_money WHERE month_code='".$part5['month_code']."'");
	       $query6->execute();
               while($part6 = $query6->fetch( PDO::FETCH_ASSOC ))	{
              $count_y=$count_y+($part6['money']);
		   
		   $add_mt_money_month=substr("".$part6['date']."",-7,2);
		            
	    if(!empty($add_mt_money_month)){
		 $db->update_db("mt_money_month",array(
                                             "day_".$add_mt_money_month.""=>$part6['money']
				                               ),"month_code='".$part6['month_code']."'");}
} /*$query6*/
		if(!empty($m_data)){
		if($m_data=="dec"){  $db->update_db("mt_money_year",array(
                                             "december"=>$count_y."/dec"
				                               ),"year='".$y_data."'");
		 
		 
		 }else{	    $db->update_db("mt_money_year",array(
                                             "".$m_data.""=>$count_y."/".$m_data
				                               ),"year='".$y_data."'");

		 }}		  
		

}/*$query5*/													
  return $new_update;	 

}//.new update //	 
	
 }//hotspot_money



/***********************************************************************************/

	 public function  pppoe_money(){
		 $db = new ConnectDB();
        $id=$_SESSION['id'];
	 
	  //<!--start update money_code to databases-->
		$query=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");
	         $query->execute();
        while($part1 = $query->fetch( PDO::FETCH_ASSOC ))	{
		 ###รอบที่1###ตรวจสอบโปรไฟล์ที่กำหนด expireและprice (วันหมดอายุและราคามีครบหรือยัง?)###
	     $exp=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$part1['profile']."'");
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
				###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                             if((($check_profile) && ($check_price))>0){
                       $check_comment=substr("".$part1['comment']."",-30,11);//////jan/16/2017/////
                       $comm1_check_arr=substr("".$check_comment."",-5,1); //jan/16/2017อิงเครื่องหมาย ../../..
			           $comm2_check_arr=substr("".$check_comment."",-8,1); //jan/16/2017อิงเครื่องหมาย ../../..
			          $comm3_check_arr=substr("".$check_comment."",-11,3);
		     $comm3_arr_arr=array("jan"=>1,
				                  "feb"=>1,
				                  "mar"=>1,
				                  "apr"=>1,
				                   "may"=>1,
				                    "jun"=>1,
				                  "jul"=>1,
				                 "aug"=>1,
				                 "sep"=>1,
				                 "oct"=>1,
				                 "nov"=>1,
				                "dec"=>1
				                 );
			 if(empty($comm3_arr_arr[$comm3_check_arr])){$check3_comment=0;}else{$check3_comment=1;}
		 
	          $check1_comment=array("/"=>1);
		    if(empty($check1_comment[$comm1_check_arr])){$date1_check=0;}else{$date1_check=1;}
		    if(empty($check1_comment[$comm2_check_arr])){$date2_check=0;}else{$date2_check=1;}
            
			
			$check_commentTime=substr("".$part1['comment']."",-30,20);//////jan/16/2017 23:00:34/////
			$time1_check_str=substr("".$check_commentTime."",-6,1);
			$time2_check_str=substr("".$check_commentTime."",-3,1);
			$time_arr1=array(":"=>1);
			
			if(empty($time_arr1[$time1_check_str])){$time1_check=0;}else{$time1_check=1;}
			if(empty($time_arr1[$time2_check_str])){$time2_check=0;}else{$time2_check=1;}

           
			 $total_pass=($check3_comment+$date1_check+$date2_check+$time1_check+$time2_check);
				   
					
	    ###ถ้า commentมาจากที่ระบบสร้างให้จะเขียน ใส่ pppoe_money###
		    if($total_pass==5){	  ///echo $check_comment;
				$id_code="-id".$id."";
			   $db->update_db("pppoe_gen",array(
                                             "money_code"=>$check_comment."".$id_code
				                               ),"user='".$part1['user']."'");				
							
			
	}}}
	  /********* end step 1  ***********************************/




	  /********* step 2  for  pppoe_money  ******  may/03/2017-id7	  */
		 //<!--start update money_code to databases-->
		 $new_update=0;
		$query2=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE mt_id='".$id."'");
	         $query2->execute();
        while($part2 = $query2->fetch( PDO::FETCH_ASSOC ))	{
			###ป้องกัน การupdateรายการเงินที่เป็น ศูนย์#####
		   $exp=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$part2['profile']."'");
	                        $check_profile=$exp['pro_expire'];
							$check_price=$exp['pro_price'];
				###ตรวจสอบความถูกต้องของ comment เพื่อจะนับจำนวนเงิน ###
                             if((($check_profile) && ($check_price))>0){
		   $money_str=substr("".$part2['money_code']."",-30,11);//////jan/16/2017/////
            if($money_str){   
			$rows=$db->rows_num("SELECT money_code FROM pppoe_money WHERE money_code='".$part2['money_code']."'");	
			if($rows==0){		
	     
	                        ////new	/////
             $y_arr=substr("".$money_str."",-4);//=2017
              $m_arr=substr("".$money_str."",-11,3);//may
             $d_arr=substr("".$money_str."",-7,2);//31
                    $month_arr=array(
						"jan"=>"01",
						"feb"=>"02",
						"mar"=>"03",
						"apr"=>"04",
						"may"=>"05",
						"jun"=>"06",
						"jul"=>"07",
						"aug"=>"08",
						"sep"=>"09",
						"oct"=>"10",
						"nov"=>"11",
						"dec"=>"12"
					              );
                  
				  $con1_arr= $month_arr[$m_arr];
                 $con2_arr=($con1_arr)."/".($d_arr)."/".($y_arr);
				 $date_utc = new DateTime(''.$con2_arr.'');
				  $utc= $date_utc->format('U');
				//$utc_timezone=$utc+($timezone);
			      $utc_data=($utc);
                     ///end new
                  $id_code="-id".$id."";
                      $month=array(
						  "jan",
						  "feb",
						  "mar",
						  "apr",
						  "may",
						  "jun",
						  "jul",
						  "aug",
						  "sep",
						  "oct",
						  "nov",
						  "dec"
					           );
                $date=$month[date('m')-1].date ("/d/").date ("Y");
               $year=substr("".$money_str."",-4);
             $month2=substr("".$money_str."",-11,3);
            $exe=substr("".$money_str."",-5,1);
            $date2="".$year."".$exe."".$month2."".$id_code."";
            $money_code=$part2['money_code'];
                
	                ///ถ้ารายการไม่ใช่วันนี้///
                    if($money_str!=$date){
                      $utc_chart="".$utc_data."".$id_code."";
		               $rows2= $db->num_rows("pppoe_gen","user","money_code='".$money_code."'");
			               
						   $db->add_db("pppoe_money",array(
				                    "utc_time_for_chart" =>$utc_chart,
						             "money_code"        =>$money_code,
								  	  "date"             =>$money_str,
									   "month_code"      =>	$date2,
										"month"			 =>	$date2,
						                "tickets"		 =>$rows2,
									      "mt_id"        =>$id
						                           ));
			 
			 $new_update++;			   
 }}	
}}}
/*************** step 3 *********************************************/                   
if(!empty($new_update)){
//<!--start update pppoe_money to pppoe databases step2-->
	$query3=$db->DB->prepare("SELECT * FROM pppoe_money WHERE mt_id ='".$id."'");
	 $query3->execute();
               while($part3 = $query3->fetch( PDO::FETCH_ASSOC ))	{
               $count=0;
	$query4=$db->DB->prepare("SELECT * FROM pppoe_gen WHERE money_code='".$part3['money_code']."'");
	$query4->execute();
               while($part4 = $query4->fetch( PDO::FETCH_ASSOC ))	{		

	$money2=$db->selectquery("SELECT * FROM pppoe_pro WHERE pro_name='".$part4['profile']."'");				
	
				$count=$count+($money2['pro_price']);
				
				}
if($part3['money']==null){
              // echo "".$count."//<br>";

				  $db->update_db("pppoe_money",array(
                                             "money"=>$count
				                               ),"money_code='".$part3['money_code']."'");


}}
//***************************************************************************//
 //<!--start update pppoe_money_month,pppoe_money_year to pppoe databases step1-->
         $query5=$db->DB->prepare("SELECT * FROM pppoe_money WHERE mt_id='".$id."' GROUP BY month_code ");
	       $query5->execute();
               while($part5 = $query5->fetch( PDO::FETCH_ASSOC ))	{

			   $count_y=0;
	 
           
              $yearmoney_data=$part5['month'];
               $y_data=substr("".$yearmoney_data."",-8,4)."-id".$id."";//=2017
			   $m_data=substr("".$yearmoney_data."",-3);//=jan
         // echo "".$y_data."//".$m_data."<br>";//2017/jan-id1
	    	$rows1=$db->rows_num("SELECT * FROM pppoe_money_month WHERE month_code='".$part5['month_code']."'");
	        $rows2=$db->rows_num("SELECT * FROM pppoe_money_year WHERE year='".$y_data."'");
		
		if($rows1==0){
			$db->add_db("pppoe_money_month",array(
				                    "month_code" =>$part5['month_code'],
						              "mt_id"        =>$id
						                           ));
		}
		if($rows2==0){
 			$db->add_db("pppoe_money_year",array(
				                    "year" =>$y_data,
						              "mt_id"        =>$id
						                           ));
		}
		
	 $query6=$db->DB->prepare("SELECT * FROM pppoe_money WHERE month_code='".$part5['month_code']."'");
	       $query6->execute();
               while($part6 = $query6->fetch( PDO::FETCH_ASSOC ))	{
              $count_y=$count_y+($part6['money']);
		   
		   $add_pppoe_money_month=substr("".$part6['date']."",-7,2);
		            
	    if(!empty($add_pppoe_money_month)){
		 $db->update_db("pppoe_money_month",array(
                                             "day_".$add_pppoe_money_month.""=>$part6['money']
				                               ),"month_code='".$part6['month_code']."'");}
} /*$query6*/
		if(!empty($m_data)){
		if($m_data=="dec"){  $db->update_db("pppoe_money_year",array(
                                             "december"=>$count_y."/dec"
				                               ),"year='".$y_data."'");
		 
		 
		 }else{	    $db->update_db("pppoe_money_year",array(
                                             "".$m_data.""=>$count_y."/".$m_data
				                               ),"year='".$y_data."'");

		 }}		  
		

}/*$query5*/													
  return $new_update;	 

}//.new update //	 
	
 }//pppoe_money
} //class//



?>
